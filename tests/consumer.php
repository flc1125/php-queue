<?php
/**
 * 任务执行者（常驻）
 */
require_once __DIR__ . '/bootstrap.php';

use Flc\Queue\Manager;
use Jobs\Demo;

if ('cli' !== php_sapi_name()) {
    die('必须在命令行模式下运行');
}

while (true) {
    // 从队列拉取任务
    $job = Manager::instance()->pull();

    // 如无任务，则休息2秒
    if (! $job) {
        sleep(2);
        continue;
    }

    try {
        call_user_func_array([$job, 'handle'], []);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}