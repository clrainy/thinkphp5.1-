<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/18
 * Time: 15:47
 */

namespace app\http\middleware;

use think\Request;
use think\facade\Cache;

class CheckAdminOauth
{
    public function handle(Request $request, \Closure $next)
    {

        if (empty(session('username')) || empty(session('action_time')) || empty(session('login_tag'))) {
            return json(['code' => 10025, 'data' => url('/admin/login/index'), 'msg' => '系统session参数丢失！']);
        }

        if (time() - session('action_time') > 1800) {
            return json(['code' => 10025, 'data' => url('/admin/login/index'), 'msg' => '用户长时间无操作，为保证数据安全，请重新登录。']);
        } else {
            session('action_time', time());
        }

        if (session('login_tag') !== Cache::store('default')->get(session('username'))) {
            return json(['code' => 10025, 'data' => url('/admin/login/index'), 'msg' => '账号在别的地方登登录！']);
        }
        return $next($request);
    }
}