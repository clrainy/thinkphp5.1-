<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/28
 * Time: 14:11
 */

namespace app\admin\validate;

use think\Validate;

class Home extends Validate
{
    protected $rule = [
        'password' => 'require',
        'passwd' => 'require|min:6|max:18',
    ];

    protected $message = [
        'password.require' => '原始密码必须！',
        'passwd.require' => '新密码必须！',
        'passwd.min' => '新密码长度不小于6位！',
        'passwd.max' => '新密码长度不大于18位！',
    ];
    protected $scene = [
        'ckpwd' => ['password', 'passwd'],
    ];
}