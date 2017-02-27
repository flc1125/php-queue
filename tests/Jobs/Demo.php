<?php
namespace Jobs;

use Flc\Queue\JobInterface;

/**
 * 测试任务
 *
 * @author Flc <2017-02-24 16:48:26>
 */
class Demo implements JobInterface
{
    /**
     * 测试值
     * @var [type]
     */
    protected $value;

    /**
     * 初始化
     * @param Redis $redis [description]
     */
    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * 处理业务
     * @return [type] [description]
     */
    public function handle()
    {
        echo '[' . (date('Y-m-d H:i:s') . $this->millisecond()) . ']' . $this->value . PHP_EOL;
    }

    /**
     * 获取当前毫秒
     * @return [type] [description]
     */
    protected function millisecond()
    {
        list($usec, $sec) = explode(" ", microtime());  
        $msec = round($usec * 1000);

        return $msec;  
    }
}