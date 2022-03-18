<?php

namespace yzh52521\aop\interfaces;

/**
 * Interface ProxyInterface.
 */
interface ProxyInterface
{
    public function process(ProceedingJoinPointInterface $entryClass);
}
