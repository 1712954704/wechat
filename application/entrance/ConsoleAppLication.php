<?php
namespace app\entrance;

class ConsoleAppLication
{
    private $config;
    private $ini;
    private $console;
    private $options = [];
    public function __construct()
    {
        // 读取.ini文件
        $filename = CONFIG_PATH.'config.ini';
        $this->ini = parse_ini_file($filename, true);
        // 读取php 文件
        $this->config = include CONFIG_PATH.'config.php';
        $this->console = $this->config['console'];
    }

    /**
     * 入口
    */
    public function run( $argv = null)
    {
        if (null === $argv) {
            $argv = $_SERVER['argv'];
            // 去除命令名
            array_shift($argv);
        }
        $subjectClass = $this->ini['console'].'\\'.$argv[0];
        // 处理方法名
        $str = implode('',$argv);
        $location_func = strrpos($str,'-a');
        $location_option = strrpos($str,'-p');
        if ($location_option){
            // 处理参数
            parse_str(substr($str,$location_option + 2),$this->options);
            $this->options = array_values($this->options);
            $location_option = $location_option - $location_func - 2;
            $func = substr($str,$location_func + 2 ,$location_option);
        }else{
            $func = substr($str,$location_func + 2);
        }
        $subject = new $subjectClass;
        if ($this->options){
            call_user_func_array([$subject,$func],$this->options);
        }else{
            call_user_func_array([$subject,$func],[]);
        }
    }

    /**
     * 获取文件路径
    */
    public function getFilePath($class)
    {
        foreach ($this->console as $dir) {
            if (file_exists($file = $dir . $class)) {
                return $file;
            }
        }
    }

    /**
     * 引入文件
    */
    function includeFile($file)
    {
        include $file;
    }
}