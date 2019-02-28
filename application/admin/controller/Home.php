<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/15
 * Time: 14:43
 */

namespace app\admin\controller;

use think\Db;
use think\facade\Cache;
use think\facade\Config;
use think\facade\Session;

class Home extends Token
{
    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
//    public function getData()
//    {
////        $flag = Db('test')->select();
////        Cache::set('test', $flag);
////        dump(Cache::get('test'));
////        Cache::store('redis')->set('test',$flag,0);
////        Cache::store('redis')->clear();
////        $c = Cache::store('redis')->get('test');
////        if(!$c){
////            $c = Cache::store('redis')->set('test','abc',0);
////        }
////        dump(session('user_token'));
////        Session::clear();
////        dump(time() - session('action_time'));

//    }
    /**
     * 修改密码
     * @param $password
     * @param $passwd
     * @return \think\response\Json
     */
    public function ckpwd($password, $passwd)
    {
        $flag = app('User')->getone('*', ['username' => session('username'), 'password' => md5(md5(session('username')) . md5($password))]);
        if (!$flag) {
            return json(['code' => -1, 'data' => [], 'msg' => '原始密码错误']);
        }
        app('User')->getEdit(['password' => md5(md5(session('username')) . md5($passwd))], ['username' => session('username')]);
        return json(['code' => 0, 'data' => [], 'msg' => '操作成功']);
    }
}
