# yaf-phpunit

## Introduction

yaf-phpunit是以[Yaf](https://github.com/laruence/php-yaf)扩展，基于PHPUnit自动化测试的开发框架，目的在于以人为核心，将项目分割为多个服务，进行快速迭代的敏捷开发，同时保证每个环节是可以被测试。

## Requirement
- PHP 5.4 + (需要支持命名空间)
- EXT Yaf 2.3.6-dev
- EXT Runkit

## Tutorial

### Layout
标准项目结构：

```
+ public
  | - index.php     // Application entry
  | + static/
     | + scripts    // js script files
     | + images     // images files
     | + styles     // css files
+ application
  | - Bootstrap.php   // Bootstrap
  | + config 
     | - application.ini // Configure 
  | + controllers
     - Article.php      // Article controller
  | + views
     | + user
        - index.html // View template for user controller
  | + library
  | + models   // Models
  | + modules  // Modules
  | + plugins  // Plugins
  | + cores    // 自定义核心文件，autoload
     | + exception                    // 核心异常类，应用公用的异常
        |- DatabaseException   // 如DB异常...
     | - ClassLoader.php              // 核心装载类，注册自动转载Core\Service命名空间下的类
     | - Controller.php               // 核心控制器，应用的控制器将会继承这个类
     | - Model.php                    // 核心模型，应用的模型将会继承这个类，同时可以自己构建一些 MySQLModel 等
     | - Exception.php                // 核心异常类，应用的自定义异常将会继承这个类
     | - ExceptionHandler.php         // 核心异常处理类，不启动YAF本身自带的异常接收方式，抛出的异常将会被这个类接收
     | - View.php                     // 核心视图模板引擎类，应用的视图会继承这个类，可以重写一些display，render方法
     | - Session.php                  // 核心会话类，自动判断当CLI请求时模拟一个虚拟的会话句柄来完成会话操作
   | + services        // 自定义服务层，每个服务实现自己的业务逻辑，尽量减少耦合度
     | + http          // 这是一个Http服务例子
        |+ Request.php // 
+ tests                // 这里测试用例的目录，以下目录结构和application一致，测试文件尾部增加Test标识
  | + units            // 单元测试目录
    | + controllers
       - UserTest.php  // unit test user controller
    | + library        // unit test library
    | + modules        // unit test modules
    | + models         // unit test models
    | + plugins        // unit test plugins
    | + services       // unit test Services
  | + acceptances      // 验收测试目录
    | + api
       - ArticleTest.php // acceptance test article controller
  | - phpunit.xml        // 里面配置的需要测试的测试用例
  | - bootstrap.php      // 测试初始化文件，基类，所有测试类将会继承这个类，在基境时加载需要的Yaf信息
+ vandor           // 第三方composer.json生成的文件夹，里面包含了第三方安装的所有类库，不建议修改
- composer.json    // 配置composer安装
- runtests.sh      // 自动化phpunit测试，同时测试验收测试与单元测试
```

### DocumentRoot
设置应用访问的Web根目录为public下

### Nginx Rewrite rules
```
server {
        listen ****;
        server_name  domain.com;
        root   document_root;
        index  index.php index.html index.htm;

        if (!-e $request_filename) {
                rewrite  ^(.*)$  /index.php?r=/$1  last;
                break;
        }
}
```

### PHP INI
```
[Yaf]
extension=yaf.so
yaf.environ=local
yaf.cache_config=0
yaf.name_suffix=0
yaf.name_separator="_"
yaf.forward_limit=5
yaf.use_namespace=1
yaf.use_spl_autoload=1
yaf.lowcase_path=1
```

### PHPUnit Testing
测试分为 `验收测试` 与 `单元测试`，通过如下命令进行区别
```
php ./vendor/bin/phpunit -c tests/phpunit.xml --testsuite acceptance
php ./vendor/bin/phpunit -c tests/phpunit.xml --testsuite unit
```
或者使用 `runtests.sh` 将会测试的更完整。
```
[work@centos ~]# cd /var/www/yaf-phpunit
[work@centos yaf-phpunit]# ./runtests.sh
./runtests.sh
Checking syntax for *.php in ./public, OK!
Checking syntax for *.php in ./application, OK!
Checking syntax for *.php in ./tests, OK!

Run unit tests.
PHPUnit 4.4.5 by Sebastian Bergmann.

Configuration read from /Users/lancer/workspace/github/yaf-phpunit/tests/phpunit.xml

........

Time: 108 ms, Memory: 8.25Mb

OK (8 tests, 23 assertions)

Run acceptance tests.
PHPUnit 4.4.5 by Sebastian Bergmann.

Configuration read from /Users/lancer/workspace/github/yaf-phpunit/tests/phpunit.xml

..............

Time: 83 ms, Memory: 7.00Mb

OK (14 tests, 27 assertions)
```

### About namespace
以下目录结构中项目必须存在命名空间，除tests目录外，命名空间和文件路径一致才能保证自动装载，tests目录默认使用 `Tests` 做命名空间，防止冲突。
```
[yourwebroot]/application/cores/
[yourwebroot]/application/services/
[yourwebroot]/tests/
```

为了以防命名空间的错乱，可以将类的书写全部加上全局空间定义，如：
```
Yaf\Dispatcher => \Yaf\Dispatcher
Core\Session  => \Core\Session
Util_Validate  => \Util_Validate
```

### About ORM
默认使用 `php-activerecord` 作为ORM方式，验收测试时，数据模式为 `sqlite::memory:` 在内存中创建库表结构解耦数据库依赖。
> 由于默认情况 `php-activerecord` 版本不支持 sqlite memory 模式，需要修改 `SqliteAdapter` 中 `__construct` 方法
```
// vendor/php-activerecord/php-activerecord/lib/adapters/SqliteAdapter.php  
protected function __construct($info)
    if ($info->host != 'memory' && !file_exists($info->host))
      throw new DatabaseException("Could not find sqlite db: $info->host");
    if ($info->host == 'memory')
      $info->host = sprintf(":%s:", $info->host);
    $this->connection = new PDO("sqlite:$info->host",null,null,static::$PDO_OPTIONS);
}
```

### More
这个应用的设计初衷是为了实现基本的框架底层，规范框架命名和结构体系，定制自动化测试。

其他核心业务请根据自身场景进行扩展：
- 在Core下扩展需要的Db类, Cache实现方式, 核心Controller等；
- 在Services下完成需要的业务服务，尽量减少各个Service之间的耦合度；
- 在Models下只处理底层的Db数据逻辑，把业务逻辑移动到Service中处理，提高Service的独立性；
- 在library中属于本地类库，按照Yaf自动装载规则，根据文件类型分类目录；
- 使用会话时，请使用Core\Session，该对象会自动判断是否是CLI模式进行Session管理；
- Controller, Model, Service类中都可以增加defaultExceptionHandler静态方法用于捕捉异常的默认处理；
- 扩展Core\View的方法，如assign，display方法等，不建议引入其他模板引擎；
- 测试用例的目录结构和application一致，测试文件尾部增加Test标识，为了可以自动生成对应的xml测试列表；
- 可以通过定义 APPLICATION_NOT_RUN 的值，引入public/index.php，实现守护进程/Crontab需求。