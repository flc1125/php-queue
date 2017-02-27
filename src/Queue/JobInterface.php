<?php
namespace Flc\Queue;

/**
 * 队列任务接口类
 *
 * @author Flc <2017-02-24 16:46:51>
 */
Interface JobInterface
{
    /**
     * 任务处理方法
     * @return [type] [description]
     */
    public function handle();
}