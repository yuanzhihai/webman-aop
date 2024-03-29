<?php

namespace yzh52521\aop\Aop;

use yzh52521\aop\Aop\interfaces\ProceedingJoinPointInterface;

/**
 * Class PipeLine.
 */
class PipeLine
{
    private $pipes;

    private $method = 'process';

    public function __construct($pipes)
    {
        $this->pipes = $pipes;
    }

    /**
     * @return mixed
     */
    public function run(ProceedingJoinPointInterface $entry, \Closure $cFun)
    {
        $pipe = array_reduce($this->pipes, $this->callback(), $this->default($cFun));
        return $pipe($entry);
    }

    /**
     * @param $cFun
     */
    public function default($cFun): \Closure
    {
        return function (ProceedingJoinPointInterface $entry) use ($cFun) {
            return $cFun($entry);
        };
    }

    public function callback(): \Closure
    {
        return function ($res, $pipe) {
            return function (ProceedingJoinPointInterface $entryClass) use ($res, $pipe) {
                $tempPipe = $pipe;
                if (is_string($pipe) && class_exists($pipe)) {
                    $tempPipe = new $pipe();
                }
                $entryClass->pipe = $res;
                return method_exists($tempPipe, $this->method) ? $tempPipe->{$this->method}($entryClass) : $tempPipe($entryClass);
            };
        };
    }
}
