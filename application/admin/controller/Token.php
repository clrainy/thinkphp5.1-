<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/16
 * Time: 14:34
 */

namespace app\admin\controller;

use think\Controller;

class Token extends Controller
{
    protected $middleware = [
        'CheckAdminOauth' => [
            'except' => ['index', 'create', 'read']
        ]
    ];

    public function initialize()
    {
        if (empty(session('username'))) {
            $this->redirect(url('/admin/login/index'));
        }
        //检测权限
        $control = lcfirst(request()->controller());
        $action = lcfirst(request()->action());
        $nodename = '';
        //跳过登录系列的检测以及主页权限
        if (!in_array($control, ['login', 'home'])) {
            if (!in_array($control . '/' . $action, session('action'))) {
                $this->error('没有权限');
            }
            $offset = array_search($control . '/' . $action, session('action'));
            $nodename = session('node_name')[$offset];
        }

        //获取权限菜单
        $this->assign([
            'node_name' => $nodename,
            'username' => app()->session->get('username'),
            'menu' => $this->getMenu(session('rule'))
        ]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->fetch(strtolower($this->request->controller()) . '/index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->fetch(strtolower($this->request->controller()) . '/create');
    }

    /**
     * @return mixed
     */
    public function read($sn)
    {
        $flag = app($this->request->controller())->getOne('*', ['sn'=>$sn]);
        $this->assign([
            'list' => $flag
        ]);
        return $this->fetch(strtolower($this->request->controller()) . '/read');
    }

    /**
     * 新增与编辑
     * @return \think\response\Json
     */
    public function save()
    {
        $param = input('param.');
        $param['op_name'] = session('real_name');
        if (isset($param['sn']) && !empty($param['sn'])) {
            $param['update_time'] = time();
            app($this->request->controller())->getEdit($param, ['sn'=>$param['sn']]);
        }else{
            $param['sn'] = strtoupper(randomStr(6) . substr(time(), -6));
            $param['create_time'] = time();
            app($this->request->controller())->getAdd($param);
        }
        return json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * @param $sn
     * @return \think\response\Json
     */
    public function delete($sn)
    {
        app($this->request->controller())->deleteId($sn);
        return json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAll()
    {
        $field = '*';
        $where = [];
        $order = '';
        $param = input('param.');
        $limit = $param['limit'];
        $offset = ($param['page'] - 1) * $limit;
        $flag = app($this->request->controller())->getAll($field, $where, $order, $offset, $limit);
        $rows = app($this->request->controller())->getCount($where);
        return json(['code' => 0, 'msg' => '操作成功', 'count' => $rows, 'data' => $flag]);
    }

    /**
     * @param string $nodeStr
     * @return array
     */
    public function getMenu($nodeStr = '')
    {
        //超级管理员没有节点数组
        if (empty($nodeStr)) {
            $where = [
                ['is_menu', '=', 2]
            ];
        } else {
            $where = [
                ['is_menu', '=', 2],
                ['id', 'in', $nodeStr]
            ];
        }
//        $where = empty($nodeStr) ? 'is_menu = 2' : 'is_menu = 2 and id in(' . $nodeStr . ')';
        $result = app('Node')->getAll('id,node_name,typeid,control_name,action_name,icon,sort', $where, 'sort', '', '');
        $menu = getTree($result, 0);
        return $menu;
    }

    /**
     * 空操作
     * @return mixed
     */
    public function _empty()
    {
        session(null);
        if (request()->isAjax()) {
            return json(['code' => -1, 'data' => [], 'msg' => $this->request->action() . '为空操作！']);
        }
        $this->assign([
            'msg' => $this->request->action() . '为空操作！'
        ]);
        return $this->fetch('error/error');
    }
}
