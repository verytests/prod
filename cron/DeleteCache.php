<?php

$prod = '../var/cache/prod';
$dev = '../var/cache/dev';

rmdir_recursive($prod);
rmdir_recursive($dev);

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}