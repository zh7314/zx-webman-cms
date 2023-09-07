<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;

//首页
Route::any('/', function ($rquest) {
    return view('index/view');
});

//前台，没有权限
Route::group('/', function () {


});

//前台，api有权限
Route::group('/', function () {


})->middleware([
    app\middleware\CrossDomain::class,
]);;

//后台接口，没权限
Route::group('/api', function () {


});

//后台接口，有权限
Route::group('/api', function () {


});

//请求不存在的url返回信息
Route::fallback(function () {
    return json(['code' => 404, 'msg' => '404 not found']);
});
//关闭自动路由
Route::disableDefaultRoute();




