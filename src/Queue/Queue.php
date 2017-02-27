<?php
namespace Flc\Queue;

use Redis;
use Exception;

/**
 * 队列类
 *
 * @author Flc <2017-02-24 16:48:26> * 
 */
class Queue
{
    /**
     * redis服务
     * @var [type]
     */
    protected $redis;

    /**
     * 队列名称
     * @var [type]
     */
    protected $queue_name;

    /**
     * 初始化
     * @param Redis $redis [description]
     */
    function __construct(Redis $redis, $queue_name = '')
    {
        $this->redis = $redis;
        $this->queue_name = $queue_name;
    }

    /**
     * 推送队列任务
     * @param  \App\Queue\JobInterface $jobs [description]
     * @return [type]             [description]
     */
    public function push(JobInterface $job)
    {
        return $this->redis->lpush($this->getRedisKey(), serialize($job));
    }

    /**
     * 出队列
     * @return [type] [description]
     */
    public function pull()
    {
        $job_seria = $this->redis->rpop($this->getRedisKey());
        $job       = unserialize($job_seria);

        if (false === $job ||
            ! $job instanceof JobInterface
        ) {
            return false;
        }

        return $job;
    }

    /**
     * 获取队列任务总数
     * @return [type] [description]
     */
    public function count()
    {
        return $this->redis->llen($this->getRedisKey());
    }

    /**
     * 返回redis存储的key名
     * @return [type] [description]
     */
    protected function getRedisKey()
    {
        $name = ! empty($this->queue_name) ? $this->queue_name : $this->getRedisDefaultKeyName();

        return 'queues:' . $name;
    }

    /**
     * 获取默认的key名
     * @return [type] [description]
     */
    protected function getRedisDefaultKeyName()
    {
        return 'default';
    }
}