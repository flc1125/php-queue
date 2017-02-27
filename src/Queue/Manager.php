<?php
namespace Flc\Queue;

use Redis;
use Exception;

/**
 * 队列管理类
 *
 * @author Flc <2017-02-24 16:48:26> * 
 */
class Manager
{
    /**
     * 单例模式
     * @var null
     */
    protected static $_static = null;

    /**
     * 工厂模式
     * @param  Redis  $redis      redis
     * @param  string $queue_name 队列名称
     * @return [type]             [description]
     */
    public static function factory($redis = null, $queue_name = null)
    {
        if ($redis == null) {
            $redis = new Redis;
            $redis->connect('127.0.0.1', 6379);
        }

        $queue = new Queue($redis, $queue_name);
        return clone $queue;
    }

    /**
     * 单例模式
     * @param  [type] $redis      [description]
     * @param  [type] $queue_name [description]
     * @return [type]             [description]
     */
    public static function instance($redis = null, $queue_name = null)
    {
        if (self::$_static == null) {
            self::$_static = self::factory($redis, $queue_name);
        }

        return self::$_static;
    }
}