<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/26
 * Time: 10:35
 */

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'id'=>'require',
        'real_name' => 'require|chs',
        'username' => 'require|mobile',
        'role_id' => 'require',
        'sn' => 'require',
    ];

    protected $message = [
        'real_name.require' => '姓名必须填写！',
        'real_name.chs' => '填写正确的中文姓名！',
        'username.require' => '账号必须填写！',
        'username.mobile' => '账号必须填写手机号码！',
//        'username.unique' => '账号已存在！',
        'role_id.require' => '角色必须选择！',

        'sn'=>'缺少要参数SN',
    ];
    protected $scene = [
        'save' => ['real_name', 'username', 'role_id'],
        'delete' => ['sn'],
        'read' => ['sn'],
    ];
}