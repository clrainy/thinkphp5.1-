<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/27
 * Time: 15:13
 */
namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
    protected $rule = [
        'rolename' => 'require|chs',
        'rule' => 'require',
        'sn' => 'require',
    ];

    protected $message = [
        'rolename.require' => '角色名必须填写！',
        'rolename.chs' => '填写正确的中文角色名！',
        'rule.require' => '权限必须选择！',

        'sn'=>'缺少要参数SN',
    ];
    protected $scene = [
        'save' => ['rolename', 'rule'],
        'read' => ['sn'],
    ];
}