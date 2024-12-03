<?php
function findPhpFiles($baseDir) {
    $files = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            $files[] = $file->getPathname();
        }
    }

    return $files;
}
function groupFilesByFolder($files, $baseDir) {
    $folders = [];
    $excludedFiles = ['footer.php', 'header.php', 'index.php', 'nav.php', '../Database/conf.php','../Database/confZone.php' ];

    foreach ($files as $file) {
        $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $file);
        $pathParts = explode(DIRECTORY_SEPARATOR, $relativePath);



        if (count($pathParts) === 1 && in_array($pathParts[0], $excludedFiles)) {
            continue;
        }


        $folderName = array_shift($pathParts);
        $remainingPath = implode(DIRECTORY_SEPARATOR, $pathParts);


        if (!isset($folders[$folderName])) {
            $folders[$folderName] = [];
        }


        if ($remainingPath) {
            $folders[$folderName][] = $remainingPath . DIRECTORY_SEPARATOR . pathinfo(end($pathParts), PATHINFO_FILENAME);
        } else {
            $folders[$folderName][] = pathinfo(end($pathParts), PATHINFO_FILENAME);
        }
    }

    return $folders;
}

function createFolderStructure($folders) {
    $output = "<div class='folder-structure'>\n";
    foreach ($folders as $folder => $files) {
        $output .= "<div class='folder'>\n";
        $output .= "<div class='folder-name'>" . htmlspecialchars($folder) . "</div>\n";
        $output .= "<div class='files'>\n";
        
        foreach ($files as $file) {

            $relativePath = $folder . DIRECTORY_SEPARATOR . $file . ".php";

            $filePath = $folder . DIRECTORY_SEPARATOR . $file;

            $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);

            $output .= "<div class='file-item'><a href='/phpTund/" . htmlspecialchars($filePath) . ".php'>" . htmlspecialchars($fileNameWithoutExtension) . "</a></div>\n";
        }

        $output .= "</div>\n</div>\n";
    }
    $output .= "</div>\n";
    return $output;
}

$projectDir = realpath(__DIR__ . '/../'); 
$phpFiles = findPhpFiles($projectDir);
$folders = groupFilesByFolder($phpFiles, $projectDir);
$folderStructure = createFolderStructure($folders);
?>

<div class="folder-structure">
    <?= $folderStructure ?>
</div>

<style>
.folder-structure {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
    margin: 20px;
}

.folder {
    width: 250px;
    background-color: #506485;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.folder:hover {
    transform: translateY(-5px);
}

.folder-name {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    color: #333;
    margin-bottom: 15px;
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
}

.files {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.file-item {
    background-color: #f9f9f9;
    padding: 10px;
    text-align: center;
    border-radius: 6px;
    font-size: 16px;
    color: #333;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.file-item:hover {
    background-color: #e0e0e0;
    transform: scale(1.05);
}

.file-item a {
    background-color: transparent;
    text-decoration: none;
    color: inherit;
}

.file-item a:hover {
    color: inherit; 
}

.file-item + .file-item {
    margin-top: 5px;
}
</style>