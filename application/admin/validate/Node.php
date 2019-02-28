<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/28
 * Time: 12:14
 */

namespace app\admin\validate;

use think\Validate;

class Node extends Validate
{
    protected $rule = [
        'node_name' => 'require|chs',
        'module_name' => 'require',
        'control_name' => 'require',
        'action_name' => 'require',

        'sn' => 'require',
        'id' => 'require',
    ];

    protected $message = [
        'node_name.require' => '功能名称须填写！',
        'node_name.chs' => '填写正确的中文功能名称！',
        'module_name.require' => '模块名称必须填写！',
        'control_name.require' => '控制器名称必须填写！',
        'action_name.require' => '方法名称必须填写！',

        'sn' => '缺少要参数SN',
    ];
    protected $scene = [
        'save' => ['node_name', 'module_name', 'control_name', 'action_name'],
        'read' => ['sn'],
        'delete' => ['id'],
    ];
}