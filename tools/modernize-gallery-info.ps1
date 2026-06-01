$ErrorActionPreference = 'Stop'

function Escape-KeepEntities {
    param([string]$Value)

    if ($null -eq $Value) { return '' }

    $escaped = [regex]::Replace($Value, '&(?!(?:[a-zA-Z][a-zA-Z0-9]+|#\d+|#x[\da-fA-F]+);)', '&amp;')
    $escaped = $escaped.Replace('<', '&lt;').Replace('>', '&gt;').Replace('"', '&quot;')
    return $escaped
}

function Clean-Line {
    param([string]$Value)

    if ($null -eq $Value) { return '' }

    $cleaned = $Value -replace "`r", "`n"
    $cleaned = $cleaned -replace '(?i)&nbsp;|&#160;', ' '
    $cleaned = $cleaned -replace '\s+', ' '
    $cleaned = $cleaned -replace '\s+,', ','
    $cleaned = $cleaned -replace '(?i)\+\s*Euro', '+ Euro'
    $cleaned = $cleaned -replace '\s*\.\s*-', '.-'
    return $cleaned.Trim()
}

function Strip-InlineTags {
    param([string]$Html)

    $text = [regex]::Replace($Html, '<\s*br\s*/?\s*>', ' ', 'IgnoreCase')
    $text = [regex]::Replace($text, '<[^>]+>', '')
    return Clean-Line $text
}

function Get-TextLines {
    param([string]$Html)

    $text = [regex]::Replace($Html, '<\s*br\s*/?\s*>', "`n", 'IgnoreCase')
    $text = [regex]::Replace($text, '</(?:p|div|font|big|span|b|i)>', "`n", 'IgnoreCase')
    $text = [regex]::Replace($text, '<[^>]+>', '')

    return @($text -split "`n+" | ForEach-Object { Clean-Line $_ } | Where-Object { $_ })
}

function Test-SpecLine {
    param([string]$Line)

    return ($Line -match '^(?:Gr(?:&ouml;|ö|oe)?(?:&szlig;|ß|ss)e|Größe|Groesse|Beine|Preis|Preis Monogram|Preis Monogramm)\s*:') -or
        ($Line -match '^\+\s*Euro') -or
        ($Line -match '^nur Husse$') -or
        ($Line -match '^passend')
}

function Get-ProductTitle {
    param(
        [string]$InnerHtml,
        [string[]]$Lines
    )

    $match = [regex]::Match($InnerHtml, '<span[^>]*font-style\s*:\s*italic[^>]*>([\s\S]*?)</span>', 'IgnoreCase')
    if (-not $match.Success) {
        $match = [regex]::Match($InnerHtml, '<b>\s*<i>([\s\S]*?)</i>\s*</b>', 'IgnoreCase')
    }
    if (-not $match.Success) {
        $match = [regex]::Match($InnerHtml, '<i>([\s\S]*?)</i>', 'IgnoreCase')
    }
    if ($match.Success) {
        return Strip-InlineTags $match.Groups[1].Value
    }

    foreach ($line in $Lines) {
        if (-not (Test-SpecLine $line) -and $line -notmatch 'Gr(?:&ouml;|ö|oe)?(?:&szlig;|ß|ss)eres Bild') {
            return $line
        }
    }

    return 'Footstool'
}

function Get-ProductSpecs {
    param(
        [string[]]$Lines,
        [string]$Title
    )

    $specs = New-Object System.Collections.Generic.List[object]

    foreach ($rawLine in $Lines) {
        $line = Clean-Line $rawLine
        if (-not $line -or $line -eq $Title -or $line -match 'Gr(?:&ouml;|ö|oe)?(?:&szlig;|ß|ss)eres Bild') {
            continue
        }

        $label = ''
        $value = ''

        $match = [regex]::Match($line, '^(Gr(?:&ouml;|ö|oe)?(?:&szlig;|ß|ss)e|Größe|Groesse)\s*:\s*(.+)$', 'IgnoreCase')
        if ($match.Success) {
            $label = 'Gr&ouml;&szlig;e'
            $value = $match.Groups[2].Value
        } else {
            $match = [regex]::Match($line, '^Beine\s*:\s*(.+)$', 'IgnoreCase')
            if ($match.Success) {
                $label = 'Beine'
                $value = $match.Groups[1].Value
            } else {
                $match = [regex]::Match($line, '^Preis\s+Monogramm?\s*:\s*(.+)$', 'IgnoreCase')
                if ($match.Success) {
                    $label = 'Preis Monogramm'
                    $value = $match.Groups[1].Value
                } else {
                    $match = [regex]::Match($line, '^Preis\s*:\s*(.+)$', 'IgnoreCase')
                    if ($match.Success) {
                        $label = 'Preis'
                        $value = $match.Groups[1].Value
                    } elseif ($line -match '^\+\s*Euro') {
                        if ($specs.Count -gt 0 -and $specs[$specs.Count - 1].Label -like 'Preis*') {
                            $specs[$specs.Count - 1].Value = Clean-Line ($specs[$specs.Count - 1].Value + ' ' + $line)
                        } else {
                            $specs.Add([pscustomobject]@{ Label = 'Aufpreis'; Value = $line }) | Out-Null
                        }
                        continue
                    } elseif ($line -match '^nur Husse$' -or $line -match '^passend') {
                        $label = 'Hinweis'
                        $value = $line
                    } else {
                        continue
                    }
                }
            }
        }

        $value = Clean-Line $value
        if ($value) {
            $specs.Add([pscustomobject]@{ Label = $label; Value = $value }) | Out-Null
        }
    }

    return $specs
}

function New-GalleryInfoCell {
    param(
        [string]$Title,
        [object[]]$Specs,
        [string]$Href
    )

    $specHtml = @()
    foreach ($spec in $Specs) {
        $specHtml += "  <div><dt>$(Escape-KeepEntities $spec.Label)</dt><dd>$(Escape-KeepEntities $spec.Value)</dd></div>"
    }

    return @"
<td class="gallery-info">
<span class="product-title">$(Escape-KeepEntities $Title)</span>
<dl class="product-specs">
$($specHtml -join "`n")
</dl>
<a class="product-link" href="$(Escape-KeepEntities $Href)">Gr&ouml;&szlig;eres Bild</a>
</td>
"@
}

function Update-GalleryFile {
    param([string]$Path)

    $encoding = New-Object System.Text.UTF8Encoding($false)
    $text = [System.IO.File]::ReadAllText($Path, $encoding)
    $comments = New-Object System.Collections.Generic.List[string]

    $protected = [regex]::Replace(
        $text,
        '<!--[\s\S]*?-->',
        [System.Text.RegularExpressions.MatchEvaluator]{
            param($match)
            $index = $comments.Count
            $comments.Add($match.Value)
            return "@@GALLERY_COMMENT_$index@@"
        },
        [System.Text.RegularExpressions.RegexOptions]::IgnoreCase
    )

    $script:GalleryInfoChanged = 0
    $pattern = '(?<Prefix></td>\s*)<td(?![^>]*class=["''][^"'']*gallery-info)(?:\s+[^>]*)?>(?<Inner>[\s\S]*?<a\s+href=["''](?<Href>[^"'']+)["''][^>]*>\s*Gr(?:&ouml;|ö|oe)?(?:&szlig;|ß|ss)eres Bild\s*</a>[\s\S]*?)</td>'

    $updated = [regex]::Replace(
        $protected,
        $pattern,
        [System.Text.RegularExpressions.MatchEvaluator]{
            param($match)

            $innerHtml = $match.Groups['Inner'].Value
            $href = $match.Groups['Href'].Value
            $lines = Get-TextLines $innerHtml
            $title = Get-ProductTitle $innerHtml $lines
            $specs = @(Get-ProductSpecs $lines $title)

            if ($specs.Count -eq 0) {
                return $match.Value
            }

            $script:GalleryInfoChanged++
            return $match.Groups['Prefix'].Value + (New-GalleryInfoCell $title $specs $href)
        },
        [System.Text.RegularExpressions.RegexOptions]::IgnoreCase
    )

    $updated = [regex]::Replace(
        $updated,
        '@@GALLERY_COMMENT_(\d+)@@',
        [System.Text.RegularExpressions.MatchEvaluator]{
            param($match)
            return $comments[[int]$match.Groups[1].Value]
        }
    )

    if ($updated -ne $text) {
        [System.IO.File]::WriteAllText($Path, $updated, $encoding)
    }

    return [pscustomobject]@{ Path = $Path; Changed = $script:GalleryInfoChanged }
}

$root = Split-Path -Parent $PSScriptRoot
$targets = @(
    (Join-Path $root 'country-line.html'),
    (Join-Path $root 'city-forum.html')
)

$results = foreach ($target in $targets) {
    Update-GalleryFile $target
}

$results | Format-Table -AutoSize
