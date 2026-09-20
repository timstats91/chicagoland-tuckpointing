<#
.SYNOPSIS
    Builds installable ZIPs of the ctp theme and the ctp-core plugin.

.DESCRIPTION
    Produces dist/ctp.zip and dist/ctp-core.zip, ready to upload through the
    WordPress admin (Appearance > Themes > Add New > Upload, and
    Plugins > Add New > Upload).

    Entry paths are written explicitly with forward slashes. Some versions of
    PowerShell's built-in Compress-Archive write Windows backslashes into the
    archive, which WordPress's unzipper handles badly — hence the manual build.

    The zips are gitignored on purpose. Run this whenever you need fresh ones
    rather than committing archives that go stale the moment you edit a file.

.EXAMPLE
    .\tools\build-zips.ps1
#>

[CmdletBinding()]
param(
    # Where to write the archives. Defaults to dist/ at the repo root.
    [string] $OutputDir
)

$ErrorActionPreference = 'Stop'

# Repo root is the parent of the folder holding this script.
$repoRoot = Split-Path -Parent $PSScriptRoot

if (-not $OutputDir) {
    $OutputDir = Join-Path $repoRoot 'dist'
}

if (-not (Test-Path $OutputDir)) {
    New-Item -ItemType Directory -Path $OutputDir -Force | Out-Null
}

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$separator = [System.IO.Path]::DirectorySeparatorChar

function New-WpPackage {
    param(
        [Parameter(Mandatory)] [string] $SourceDir,
        [Parameter(Mandatory)] [string] $RootName,
        [Parameter(Mandatory)] [string] $ZipPath,
        [Parameter(Mandatory)] [char]   $Separator
    )

    if (-not (Test-Path $SourceDir)) {
        throw "Source folder not found: $SourceDir"
    }

    if (Test-Path $ZipPath) {
        [System.IO.File]::Delete($ZipPath)
    }

    $base = (Resolve-Path $SourceDir).Path
    $zip  = [System.IO.Compression.ZipFile]::Open(
        $ZipPath,
        [System.IO.Compression.ZipArchiveMode]::Create
    )

    $count = 0

    try {
        foreach ($file in (Get-ChildItem -Path $base -Recurse -File)) {

            # Skip editor and OS noise that should never ship.
            if ($file.Name -in @('.DS_Store', 'Thumbs.db', 'desktop.ini')) { continue }

            $relative = $file.FullName.Substring($base.Length + 1).Replace($Separator, '/')
            $entry    = $RootName + '/' + $relative

            [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile(
                $zip,
                $file.FullName,
                $entry,
                [System.IO.Compression.CompressionLevel]::Optimal
            ) | Out-Null

            $count++
        }
    }
    finally {
        $zip.Dispose()
    }

    return $count
}

$targets = @(
    @{ Source = 'wp-content/themes/ctp';        Root = 'ctp';      Zip = 'ctp.zip' },
    @{ Source = 'wp-content/plugins/ctp-core';  Root = 'ctp-core'; Zip = 'ctp-core.zip' }
)

foreach ($target in $targets) {
    $sourcePath = Join-Path $repoRoot $target.Source
    $zipPath    = Join-Path $OutputDir $target.Zip

    $fileCount = New-WpPackage -SourceDir $sourcePath -RootName $target.Root -ZipPath $zipPath -Separator $separator
    $sizeKb    = (Get-Item $zipPath).Length / 1KB

    "{0,-14} {1,3} files  {2,6:N1} KB" -f $target.Zip, $fileCount, $sizeKb
}

""
"Written to: $OutputDir"
