$ErrorActionPreference = 'Stop'

$root = Split-Path -Parent $PSScriptRoot
$encoding = New-Object System.Text.UTF8Encoding($false)
$pricePattern = '<div\s+id=["'']preistabelle["''][^>]*>[\s\S]*?</div>\s*'
$detailPattern = '<div\s+id=["'']inhaltleft["''][^>]*>\s*'

$files = Get-ChildItem -Path $root -Recurse -File -Include *.html, *.htm |
    Where-Object { $_.FullName -notmatch '\\clickandbuilds\\' }

$updated = 0
$skipped = 0

foreach ($file in $files) {
    $text = [System.IO.File]::ReadAllText($file.FullName, $encoding)
    if ($text -notmatch 'id=["'']preistabelle["'']' -or $text -notmatch 'id=["'']inhaltleft["'']') {
        continue
    }

    $detailMatch = [regex]::Match($text, $detailPattern, [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    if (-not $detailMatch.Success) {
        $skipped++
        continue
    }

    $priceMatch = [regex]::Match($text, $pricePattern, [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    if (-not $priceMatch.Success) {
        $skipped++
        continue
    }

    if ($priceMatch.Index -gt $detailMatch.Index) {
        continue
    }

    $priceBlock = $priceMatch.Value.Trim()
    $withoutPrice = $text.Remove($priceMatch.Index, $priceMatch.Length)

    $detailOpenMatch = [regex]::Match($withoutPrice, '<div\s+id=["'']inhaltleft["''][^>]*>', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    if ($detailOpenMatch.Success -and $detailOpenMatch.Value -notmatch '\bclass\s*=') {
        $newOpen = $detailOpenMatch.Value -replace '>$', ' class="detail-page">'
        $withoutPrice = $withoutPrice.Remove($detailOpenMatch.Index, $detailOpenMatch.Length).Insert($detailOpenMatch.Index, $newOpen)
    } elseif ($detailOpenMatch.Success -and $detailOpenMatch.Value -notmatch '\bdetail-page\b') {
        $newOpen = [regex]::Replace($detailOpenMatch.Value, 'class=(["''])([^"'']*)(["''])', 'class=$1$2 detail-page$3', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
        $withoutPrice = $withoutPrice.Remove($detailOpenMatch.Index, $detailOpenMatch.Length).Insert($detailOpenMatch.Index, $newOpen)
    }

    $detailMatch = [regex]::Match($withoutPrice, $detailPattern, [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    if (-not $detailMatch.Success) {
        $skipped++
        continue
    }

    $contentStart = $detailMatch.Index + $detailMatch.Length
    $afterDetailStart = $withoutPrice.Substring($contentStart)
    $imageMatch = [regex]::Match($afterDetailStart, '<img\b', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    if ($imageMatch.Success) {
        $insertAt = $contentStart + $imageMatch.Index
    } else {
        $headlineMatch = [regex]::Match($afterDetailStart, '<span\s+class=["'']headline["''][\s\S]*?</span>(?:\s*<br\s*/?>)*', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
        $insertAt = if ($headlineMatch.Success) {
            $contentStart + $headlineMatch.Index + $headlineMatch.Length
        } else {
            $contentStart
        }
    }

    $replacement = "`r`n" + $priceBlock + "`r`n"
    $newText = $withoutPrice.Insert($insertAt, $replacement)

    [System.IO.File]::WriteAllText($file.FullName, $newText, $encoding)
    $updated++
}

[pscustomobject]@{
    Updated = $updated
    Skipped = $skipped
} | Format-List
