<?php
use think\facade\Route;

/*
 *全局路由参数
 */
Route::option('domain', 'blog.cdyun.cc')
    ->option('middleware', ['CrossDomain', 'Validate'])
    ->option('https', true);

//Route::get('/', 'index/index/index');
//Route::get('/index', 'index/index/index');
/*管理后台访问的路由控制*/
Route::get('myadmin', 'admin/login/index');
Route::get('admin/login/index', 'admin/login/index');