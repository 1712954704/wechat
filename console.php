<?php
define('ROOT_PATH',dirname(__FILE__.'/'));
if (file_exists(ROOT_PATH.'env.php')){
    require_once ROOT_PATH.'env.php';
}
// 定义环境变量
defined('PHP_ENV') || define('PHP_ENV','test');
// 定义配置文件
define('CONFIG_PATH',ROOT_PATH.'/config/'.PHP_ENV.'/');
// 定义前后台配置路径
define('FRONT',ROOT_PATH.'/front/');
define('BACK_CONFIG',ROOT_PATH.'/back/');
require __DIR__.'/vendor/autoload.php';
require CONFIG_PATH.'config.php';

use app\entrance\ConsoleAppLication;
$application = new ConsoleAppLication();
$application->run();
