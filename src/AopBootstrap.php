<?php

namespace yzh52521\aop;

use Webman\Bootstrap;
use yzh52521\aop\Aop\ClassLoader;

class AopBootstrap implements Bootstrap
{
    protected static $instance = null;

    public static function start($worker)
    {
        if ($worker) {
            $config = config('plugin.yzh52521.aop.app');
            if ($config['enable'] === true) {
                ClassLoader::reload($config);
                ClassLoader::init();
            }
        }
    }
}