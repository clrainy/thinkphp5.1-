<?php
namespace app\index\controller;

use think\Db;
use think\facade\Cache;
use think\facade\Config;

class Index
{
    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $flag = Db('test')->select();
//        Cache::set('test', $flag);
//        dump(Cache::get('test'));
//        Cache::store('redis')->set('test',$flag,0);
//        Cache::store('redis')->clear();
//        $c = Cache::store('redis')->get('test');
//        if(!$c){
//            $c = Cache::store('redis')->set('test','abc',0);
//        }
//        dump($c);
        return json(['code' => 1, 'msg' => '操作成功', 'data' => $flag]);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
