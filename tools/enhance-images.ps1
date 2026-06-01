$ErrorActionPreference = "Stop"

$encoding = [System.Text.Encoding]::GetEncoding(28591)
$root = Get-Location
$files = Get-ChildItem -Recurse -File -Include *.html,*.htm |
    Where-Object { $_.FullName -notmatch '\\clickandbuilds\\' }

function Html-Attribute([string]$text) {
    return ($text -replace '&', '&amp;' -replace '"', '&quot;' -replace '<', '&lt;' -replace '>', '&gt;')
}

function Image-Alt([string]$src) {
    $file = [System.IO.Path]::GetFileNameWithoutExtension(($src -replace '\\', '/'))
    $lower = $file.ToLowerInvariant()

    if ($lower -in @('blind', 'verlauf', 'higru-verlauf', 'footer')) { return '' }
    if ($lower -like 'goldmann-logo*') { return 'Goldmann Footstools' }
    if ($lower -like 'mail-button*') { return 'E-Mail' }

    $name = $file -replace '[_-]+', ' '
    $name = $name -replace '\b(klein|mini|maxi|gross|groß|bearbeitet|cropped)\b', ''
    $name = [regex]::Replace($name, '\s+', ' ').Trim()
    if (-not $name) { return '' }
    return (Get-Culture).TextInfo.ToTitleCase($name.ToLowerInvariant())
}

$updatedFiles = 0
$updatedImages = 0

foreach ($file in $files) {
    $text = $encoding.GetString([System.IO.File]::ReadAllBytes($file.FullName))
    $script:fileChanged = $false

    $newText = [regex]::Replace($text, '<img\b[^>]*>', {
        param($match)
        $tag = $match.Value
        $srcMatch = [regex]::Match($tag, '\bsrc="([^"]*)"', [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)
        $src = if ($srcMatch.Success) { $srcMatch.Groups[1].Value } else { '' }

        if ($tag -notmatch '\bdecoding=') {
            $tag = $tag -replace '>$', ' decoding="async">'
            $script:fileChanged = $true
        }

        if ($tag -notmatch '\bloading=') {
            $loading = if ($src -match 'goldmann-logo3\.jpg$|redcover\.jpg$') { 'eager' } else { 'lazy' }
            $tag = $tag -replace '>$', (' loading="' + $loading + '">')
            $script:fileChanged = $true
        }

        $altText = Html-Attribute (Image-Alt $src)
        if ($tag -match '\balt=""') {
            if ($altText.Length -gt 0) {
                $tag = $tag -replace '\balt=""', ('alt="' + $altText + '"')
                $script:fileChanged = $true
            }
        } elseif ($tag -notmatch '\balt=') {
            $tag = $tag -replace '>$', (' alt="' + $altText + '">')
            $script:fileChanged = $true
        }

        if ($tag -ne $match.Value) { $script:updatedImages++ }
        return $tag
    }, [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)

    if ($script:fileChanged -and $newText -ne $text) {
        [System.IO.File]::WriteAllBytes($file.FullName, $encoding.GetBytes($newText))
        $updatedFiles++
    }
}

[PSCustomObject]@{
    UpdatedFiles = $updatedFiles
    UpdatedImages = $updatedImages
}
