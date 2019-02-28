<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/20
 * Time: 17:39
 */

namespace app\admin\controller;

class Node extends Token
{
    /**
     * @param $page
     * @param $limit
     * @return \think\response\Json
     */
    public function getall()
    {
        $field = '*';
        $order = '';
        $limit = '';
        $offset = '';
        $where = [];
        $flag = app($this->request->controller())->getAll($field, $where, $order, $offset, $limit);
        foreach ($flag as $key => $vo)
//            $flag[$key]['pid'] = $vo['typeid'];
        return json($flag);
    }

    /**
     * @return \think\response\Json
     */
    public function listall()
    {
        $field = '*';
        $order = '';
        $param = input('param.');
        $limit = $param['limit'];
        $offset = ($param['page'] - 1) * $limit;
        if (isset($param['node_name']) && !empty($param['node_name'])) {
            $where = [
                ['node_name', 'like', '%' . $param['node_name'] . '%']
            ];
        } else {
            $where = [];
        }
        $flag = app($this->request->controller())->getAll($field, $where, $order, $offset, $limit);
        $rows = app($this->request->controller())->getCount($where);
        return json(['code' => 0, 'msg' => '操作成功', 'count' => $rows, 'data' => $flag]);

    }


    public function delete($id)
    {
        $flag = app($this->request->controller())->getOne('*', ['typeid'=>$id]);
        if($flag){
            return json(['code' => -1, 'msg' => '不能删除，该节点存在子级']);
        }
        app($this->request->controller())->getDel(['id' => $id]);
//        做个判断
        return json(['code' => 0, 'msg' => '操作成功']);
    }
}
