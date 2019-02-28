<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/15
 * Time: 14:43
 */

namespace app\admin\controller;

use think\Controller;
use think\facade\Cache;

class Login extends Controller
{
    public function index()
    {
        session(null);
        return $this->fetch('login/index');
    }

    /**
     * @param $username
     * @param $password
     * @return \think\response\Json
     */
    public function dologin($username, $password)
    {
        $where['username'] = $username;
        $where['status'] = 1;
        $hasUser = app('User')->getOne('id,real_name,username,password,role_id,login_num,last_login_ip,last_login_time', $where);
        if (!$hasUser) {
            return json(['code' => -1, 'msg' => '账号不存在！', 'data' => date('Y-m-d H:i:s', time())]);
        }
        if ($hasUser['password'] != $password) {
            return json(['code' => -1, 'msg' => '账号或密码有错误！', 'data' => date('Y-m-d H:i:s', time())]);
        }
        $data = [
            'login_num' => $hasUser['login_num'] + 1,
            'last_login_ip' => $this->request->ip(),
            'last_login_time' => time()
        ];
        app('User')->getEdit($data, $where);

        $loginTag = randomStr(16);
        Cache::store('default')->set($username, $loginTag, 8 * 60 * 60);//缓存本次用户的登录标记
        session('username', $username);
        session('real_name', $hasUser['real_name']);
        session('action_time', time());
        session('login_tag', $loginTag);

        $info = app('Role')->getUserRole($hasUser['role_id']);
//        dump($info);
        session('rule', $info['rule']);  //角色节点
        session('node_name', $info['node_name']);  //节点名称
        session('action', $info['action']);  //角色权限
        return json(['code' => 1, 'data' => url('/admin/home/index'), 'msg' => '登录成功']);
    }
}
