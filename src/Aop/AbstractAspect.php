<?php

namespace yzh52521\aop\Aop;

use yzh52521\aop\Aop\interfaces\ProceedingJoinPointInterface;
use yzh52521\aop\Aop\interfaces\ProxyInterface;

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
