$ErrorActionPreference = "Stop"

$encoding = [System.Text.Encoding]::GetEncoding(28591)
$targets = @(
    "kamin.html",
    "city-edition.html",
    "stoffe\blau.html",
    "stoffe\rot.html",
    "stoffe\beige.html",
    "stoffe\pferde.html",
    "stoffe\jagd.html",
    "stoffe\maritim.html",
    "stoffe\hochzeitshusse.html"
)

function Clean-CellText([string]$html) {
    $text = [regex]::Replace($html, '<br\s*/?>', ' ', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
    $text = [regex]::Replace($text, '<[^>]+>', '')
    $text = $text -replace '&nbsp;', ' '
    return $text.Trim()
}

function Fallback-Label([string]$href) {
    $name = [System.IO.Path]::GetFileNameWithoutExtension($href)
    if (-not $name) { return "Mehr ansehen" }
    $name = $name -replace '[-_]+', ' '
    return (Get-Culture).TextInfo.ToTitleCase($name.ToLowerInvariant())
}

$updated = 0

foreach ($rel in $targets) {
    $full = Join-Path (Get-Location) $rel
    if (-not (Test-Path -LiteralPath $full)) { continue }

    $text = $encoding.GetString([System.IO.File]::ReadAllBytes($full))
    if ($text -match 'selection-grid-large') { continue }

    $options = [System.Text.RegularExpressions.RegexOptions]::Singleline -bor [System.Text.RegularExpressions.RegexOptions]::IgnoreCase
    $tableMatch = [regex]::Match($text, '<table\b(?![^>]*class="gallery-list")[^>]*>.*?</table>', $options)
    if (-not $tableMatch.Success) { continue }

    $table = $tableMatch.Value
    $items = [System.Collections.Generic.List[object]]::new()
    $pending = [System.Collections.Generic.List[object]]::new()
    $introParts = [System.Collections.Generic.List[string]]::new()
    $seenImage = $false

    $rows = [regex]::Matches($table, '<tr\b[^>]*>(.*?)</tr>', $options)
    foreach ($rowMatch in $rows) {
        $row = $rowMatch.Groups[1].Value
        $imgMatches = [regex]::Matches($row, '<a\b[^>]*href="([^"]+)"[^>]*>\s*(<img\b[^>]*>)\s*</a>', $options)

        if ($imgMatches.Count -gt 0) {
            $seenImage = $true
            $pending.Clear()
            foreach ($match in $imgMatches) {
                $item = [PSCustomObject]@{
                    Href = $match.Groups[1].Value
                    Img = $match.Groups[2].Value
                    Label = ''
                }
                $items.Add($item)
                $pending.Add($item)
            }
            continue
        }

        $cells = [regex]::Matches($row, '<td\b([^>]*)>(.*?)</td>', $options)
        if (-not $seenImage) {
            foreach ($cell in $cells) {
                $cellHtml = $cell.Groups[2].Value.Trim()
                if ((Clean-CellText $cellHtml).Length -gt 0) {
                    $introParts.Add($cellHtml)
                }
            }
            continue
        }

        if ($pending.Count -gt 0) {
            $labels = [System.Collections.Generic.List[string]]::new()
            foreach ($cell in $cells) {
                $attr = $cell.Groups[1].Value
                $cellHtml = $cell.Groups[2].Value.Trim()
                if ($cellHtml -match '<img\b' -or $attr -match 'colspan') { continue }
                if ((Clean-CellText $cellHtml).Length -gt 0) {
                    $labels.Add($cellHtml)
                }
            }

            for ($i = 0; $i -lt [Math]::Min($labels.Count, $pending.Count); $i++) {
                $pending[$i].Label = $labels[$i]
            }
            if ($labels.Count -gt 0) { $pending.Clear() }
        }
    }

    if ($items.Count -eq 0) { continue }

    foreach ($item in $items) {
        if ([string]::IsNullOrWhiteSpace($item.Label)) {
            $item.Label = Fallback-Label $item.Href
        }
    }

    $lineEnding = if ($text.Contains("`r`n")) { "`r`n" } else { "`n" }
    $intro = ''
    if ($introParts.Count -gt 0) {
        $intro = '<div class="gallery-intro">' + $lineEnding +
            (($introParts | ForEach-Object { $_.Trim() }) -join ($lineEnding + '<br>' + $lineEnding)) +
            $lineEnding + '</div>' + $lineEnding
    }

    $gridItems = $items | ForEach-Object {
        '<a class="bildmenu" href="' + $_.Href + '">' + $_.Img + $_.Label + '</a>'
    }
    $replacement = $intro + '<div class="selection-grid selection-grid-large">' + $lineEnding +
        ($gridItems -join $lineEnding) +
        $lineEnding + '</div>'

    $newText = $text.Substring(0, $tableMatch.Index) + $replacement + $text.Substring($tableMatch.Index + $tableMatch.Length)
    [System.IO.File]::WriteAllBytes($full, $encoding.GetBytes($newText))
    $updated++
}

[PSCustomObject]@{ Updated = $updated }
