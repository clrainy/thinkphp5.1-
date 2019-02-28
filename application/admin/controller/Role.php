<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/22
 * Time: 9:58
 */

namespace app\admin\controller;

class Role extends Token
{
    public function getall()
    {
        $field = '*';
        $where[] = ['id', 'neq', 1];
        $order = '';
        $param = input('param.');
        $limit = $param['limit'];
        $offset = ($param['page'] - 1) * $limit;
        $flag = app($this->request->controller())->getAll($field, $where, $order, $offset, $limit);
        $rows = app($this->request->controller())->getCount($where);
        return json(['code' => 0, 'msg' => '操作成功', 'count' => $rows, 'data' => $flag]);
    }

    /**
     * @return \think\response\Json
     */
    public function listrole()
    {
        $result = app('Node')->getAll('id,node_name,typeid,control_name,action_name,icon,sort', '', 'sort', '', '');
        $menu = getTree($result, 0);
        return json(['code' => 0, 'msg' => '操作成功', 'data' => $menu]);
    }

    /**
     * @param $id
     * @return string
     */
    public function getRoleName($id)
    {
        $flag = app('Role')->getOne('*', ['id' => $id]);
        return $flag;
    }
}