# php+redis消息队列

## 环境

- PHP >= 5.4
- composer

## 安装

```
composer require flc/php-queue
```

## 使用范例

producer

```php
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
```

consumer

```php
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
```

## License

MIT