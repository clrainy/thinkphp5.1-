<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/21
 * Time: 14:30
 */

namespace app\admin\controller;

class User extends Token
{

    /**
     * @return \think\response\Json
     */
    public function getall()
    {
        $field = '*';
        $order = '';
        $param = input('param.');
        $limit = $param['limit'];
        $offset = ($param['page'] - 1) * $limit;
        if (isset($param['searchText']) && !empty($param['searchText'])) {
            $where[] = ['username|sn', 'like', '%' . $param['searchText'] . '%'];
        }
        if (isset($param['searchStatus']) && !empty($param['searchStatus'])) {
            $where[] = ['status', '=', $param['searchStatus']];
        } else {
            $where[] = ['status', 'in', '-1,1'];
        }
        $flag = app($this->request->controller())->getAll($field, $where, $order, $offset, $limit);
        foreach ($flag as $key => $vo) {
            $arr = explode(",", $vo['role_id']);
            $roleName = [];
            foreach ($arr as $v) {
                array_push($roleName, controller('Role')->getRoleName($v)->rolename);
            }
            $flag[$key]['role_id'] = implode(' | ',$roleName);
        }
        $rows = app($this->request->controller())->getCount($where);
        return json(['code' => 0, 'msg' => '加载完成', 'count' => $rows, 'data' => $flag]);
    }

    /**
     * @return \think\response\Json
     */
    public function save()
    {
        $param = input('param.');
        $param['op_name'] = session('real_name');
        if (isset($param['sn']) && !empty($param['sn'])) {
            if (!$param['password'] || empty($param['password'])) {
                unset($param['password']);
            } else {
                $param['password'] = md5(md5($param['username']) . md5($param['password']));
            }
            $param['update_time'] = time();
            app($this->request->controller())->getEdit($param, ['sn' => $param['sn']]);
        } else {
            if (!$param['password'] || empty($param['password'])) {
                return json(['code' => -1, 'msg' => '密码不能为空！']);
            }
            $ck = app($this->request->controller())->getOne('*', ['username' => $param['username']]);
            if ($ck) {
                return json(['code' => -1, 'msg' => '帐号已存在！']);
            }
            $param['sn'] = strtoupper(randomStr(6) . substr(time(), -6));
            $param['password'] = md5(md5($param['username']) . md5($param['password']));
            $param['create_time'] = time();
            app($this->request->controller())->getAdd($param);
        }
        return json(['code' => 0, 'msg' => '操作成功']);
    }
}