<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/19
 * Time: 13:52
 */
namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username'  => 'require',
        'password'  => 'require',
        'pp'  => 'require',
    ];

    protected $message = [
        'username.require'  => '账号必须！',
        'password.require'   => '密码必须！',
    ];
    protected $scene = [
        'dologin'    => ['username', 'password'],
    ];
}