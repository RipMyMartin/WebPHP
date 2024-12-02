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

function createLinks($files, $baseDir) {
    $output = "<ul>\n";
    foreach ($files as $file) {
        // Преобразуем абсолютный путь в относительный для ссылки
        $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $file);
        $output .= '<li><a href="' . htmlspecialchars($relativePath) . '">' . htmlspecialchars($relativePath) . "</a></li>\n";
    }
    $output .= "</ul>\n";
    return $output;
}

// Определяем корневую директорию проекта
$projectDir = realpath(__DIR__ . '/../'); // Переходим на уровень выше от `content`
$phpFiles = findPhpFiles($projectDir);
$links = createLinks($phpFiles, $projectDir);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Files in Project</title>
</head>
<body>
    <h1>Все PHP-файлы в проекте</h1>
    <?= $links ?>
</body>
</html>
