<?php
chdir(__DIR__);

require 'Parsedown.php';

// Remove docs
rrmdir('docs');

// Rebuild docs
$parsedown = new Parsedown();

$dirs = glob('src/*', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $template = file_get_contents($dir . '/template.html');
    $template = preg_replace(['/^\s+/m', '/\s*$/'], '', $template);
    $target_dir = str_replace('src/', 'docs/', $dir);
    $files = glob($dir . '/*.md');

    foreach ($files as $file) {
        $content = file_get_contents($file);
        $content = $parsedown->text($content);

        preg_match('/<h1>(.*)<\/h1>/', $content, $matches);

        $title = $matches[1];

        $page = str_replace('{title}', $title, $template);
        $page = str_replace('{content}', $content, $page);

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $pathinfo = pathinfo($file);
        $target_file = $target_dir . '/' . $pathinfo['filename'] . '.html';

        file_put_contents($target_file, $page);

        echo $file, ' -> ', $target_file, PHP_EOL;
    }
}

// Remove all directories and files recursively
function rrmdir($dir)
{
    if (!file_exists($dir)) return false;

    $files = glob($dir . '/*');

    foreach ($files as $file) {
        if (is_dir($file)) {
            rrmdir($file);
        } elseif (is_file($file)) {
            unlink($file);
        }
    }

    rmdir($dir);

    return true;
}
?>
