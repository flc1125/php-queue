<?php
/**
 * 入口文件
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * 自动引入测试JOB文件
 */
spl_autoload_register(function($classname){
    $baseDir = __DIR__  . DIRECTORY_SEPARATOR . 'Jobs' . DIRECTORY_SEPARATOR;

    if (strpos($classname, 'Jobs\\') == 0) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, substr($classname, strlen('Jobs\\')));

        $file = $baseDir . $path . '.php';

        if (is_file($file))
            require_once $file;
    }
});