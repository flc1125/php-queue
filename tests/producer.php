<?php
/**
 * 任务创建
 */
require_once __DIR__ . '/bootstrap.php';

use Flc\Queue\Manager;
use Jobs\Demo;

// 创建工作
$demo = new Demo('测试');

// 推送到队列
for ($i = 0; $i <= 100; $i ++) {
    Manager::instance()->push($demo);
}

echo Manager::instance()->count();