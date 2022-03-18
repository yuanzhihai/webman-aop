<?php
/**
 * This file is part of monda-worker.
 *
 * @contact  mondagroup_php@163.com
 *
 */

namespace yzh52521\aop;

use yzh52521\aop\interfaces\ProceedingJoinPointInterface;
use yzh52521\aop\interfaces\ProxyInterface;

/**
 * Class AbstractAspect.
 */
class AbstractAspect implements ProxyInterface
{
    //类名 eg: Index:class
    //类名 . '::方法明' eg: Index:class . '::hello'
    public $classes = [];

    /**
     * @return mixed
     */
    public function process(ProceedingJoinPointInterface $entryClass)
    {
        return $entryClass->process();
    }
}
