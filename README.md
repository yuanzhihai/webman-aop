# 安装
```
composer require yzh52521/webman-aop
```

AOP 相关配置
config/plugin/yzh52521/aop/app.php 配置
```
<?php
return [
    'aspect' => [
        \app\aspect\UserAspect::class,
    ],
];
```
首先让我们编写待切入类 
```
<?php
namespace app\service;

class UserService
{
    public function info()
    {
        echo 'UserService info' . PHP_EOL;
    }
}
```
其次新增对应的 UserAspect

```

namespace app\aspect;

use app\service\UserService;
use yzh52521\aop\Aop\AbstractAspect;
use yzh52521\aop\Aop\interfaces\ProceedingJoinPointInterface;

/**
 * Class UserAspect
 * @package app\aspect
 */
class UserAspect extends AbstractAspect
{
    public $classes = [
        UserService::class . '::info',
    ];

    /**
     * @param ProceedingJoinPointInterface $entryClass
     * @return mixed
     */
    public function process(ProceedingJoinPointInterface $entryClass)
    {
        var_dump('UserAspect before');
        $res = $entryClass->process();
        var_dump('UserAspect after');
        return $res;
    }
}
```

测试,在app\controller\Index 修改代码 eg：

```

    public function index()
    {
        /** @var UserService $userService */
        $userService = load(UserService::class);
        $userService->info();
    }

```
php start.php start， 命令行输出结果：
```
UserAspect before 
UserService info
UserAspect after 
```
#切入顺序
如果有多个切面类对同一个类方法进行切入， 会按照配置文件中顺序执行

容器 load 函数在 helpers.php 定义如下 eg:
```
/**
 *  加载容器的对象
 */
if (! function_exists('load')) {
    function load(string $class)
    {
        return \support\Container::get($class);
    }
}
```



