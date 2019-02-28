<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/19
 * Time: 13:49
 */

namespace app\common\model;

class Role extends BaseModel
{
    /**
     * @param $roleId -> string
     * @return array
     * array_flip()->数组 key和value 对调，进行value去重
     * array_values()->数组 key序列化重置
     */
    public function getUserRole(string $roleId)
    {
        $w_role = [
            ['id', 'in', $roleId]
        ];
        $rs_role = app('Role')->getFieldAll('*', $w_role);

        $str = '';
        foreach ($rs_role as $vo) {
            $str = $str . ',' . $vo['rule'];
        }

        if (empty(substr($str, 1))) {
            $result['rule'] = '';
            $where = $result['rule'];
        } else {
            $result['rule'] = array_values(array_flip(array_flip(explode(',', substr($str, 1)))));
            $where = [
                ['id', 'in', $result['rule']]
            ];
        }

        $res = app('Node')->getFieldAll('node_name,control_name,action_name', $where);
        $action = [];
        $nodeName = [];
        foreach ($res as $key => $vo) {
            if ('#' != $vo['action_name']) {
                $action[$key] = $vo['control_name'] . '/' . $vo['action_name'];
                $nodeName[$key] = $vo['node_name'];
            }
        }

        $result['action'] = array_values($action);
        $result['node_name'] = array_values($nodeName);

        return $result;
    }
}