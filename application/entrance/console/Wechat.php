<?php
namespace app\entrance\console;

class Wechat
{
    public function callBack($type = 1,$time = null)
    {
        if ($time){
            $time = date('Y-m-d H:i:s');
        }
        switch ($type)
        {
            case 1:
                echo '111'.$time;
                break;
            case 2:
                echo '222'.$time;
                break;
            default:
                echo 'default'.$time;
        }
    }
}