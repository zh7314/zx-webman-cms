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
use support\Request;

//首页
Route::get('/', function ($rquest) {
    return view('index/view');
});

//前台页面，没有权限
Route::group('/', function () {

});

//前台，api有权限
Route::group('/open', function () {

    Route::get('/test', [app\controller\Web\TestController::class, 'index']);
    Route::post('/uploadPic', [app\controller\Web\IndexController::class, 'uploadPic']);//上传图片文件
    Route::post('/uploadFile', [app\controller\Web\IndexController::class, 'uploadFile']);//上传普通文件
});

//后台接口，没权限
Route::group('/api/admin', function () {

    Route::post('/login', [app\controller\Admin\IndexController::class, 'login']); //登录请求
    Route::get('/getCaptcha', [app\controller\Admin\IndexController::class, 'getCaptcha']); //获取验证码
    // 上传图片
    Route::post('/uploadPic', [app\controller\Admin\IndexController::class, 'uploadPic']);//上传图片文件
    Route::post('/uploadFile', [app\controller\Admin\IndexController::class, 'uploadFile']);//上传普通文件
})->middleware([
    app\middleware\CrossDomain::class,
    app\middleware\AdminLog::class
]);

////后台接口，有权限
Route::group('/api/admin', function () {

    Route::post('/getMenu', [app\controller\Admin\IndexController::class, 'getMenu']); //获取菜单信息
    Route::post('/getInfo', [app\controller\Admin\IndexController::class, 'getInfo']); //获取用户信息
    Route::post('/logout', [app\controller\Admin\IndexController::class, 'logout']); //登出
    Route::post('/getVersion', [app\controller\Admin\IndexController::class, 'getVersion']); //获取版本信息
    Route::post('/changePwd', [app\controller\Admin\IndexController::class, 'changePwd']);

    Route::post('/getGroupTree', [app\controller\Admin\IndexController::class, 'getGroupTree']);//获取权限组树状结构
    Route::post('/getMenuTree', [app\controller\Admin\IndexController::class, 'getMenuTree']);//获取所有权限树状结构
    Route::post('/getDownloadCateTree', [app\controller\Admin\IndexController::class, 'getDownloadCateTree']);
    Route::post('/getNewsCateTree', [app\controller\Admin\IndexController::class, 'getNewsCateTree']);
    Route::post('/getProductCateTree', [app\controller\Admin\IndexController::class, 'getProductCateTree']);
    Route::post('/getVideoCateTree', [app\controller\Admin\IndexController::class, 'getVideoCateTree']);
    Route::post('/getBannerCateTree', [app\controller\Admin\IndexController::class, 'getBannerCateTree']);

    Route::group('/admin', function () {
        Route::post('/getList', [app\controller\Admin\AdminController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\AdminController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\AdminController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\AdminController::class, 'add']);
        Route::post('/save', [app\controller\Admin\AdminController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\AdminController::class, 'delete']);
    });

    Route::group('/adminGroup', function () {
        Route::post('/getList', [app\controller\Admin\AdminGroupController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\AdminGroupController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\AdminGroupController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\AdminGroupController::class, 'add']);
        Route::post('/save', [app\controller\Admin\AdminGroupController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\AdminGroupController::class, 'delete']);
    });

    Route::group('/adminLog', function () {
        Route::post('/getList', [app\controller\Admin\AdminLogController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\AdminLogController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\AdminLogController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\AdminLogController::class, 'add']);
        Route::post('/save', [app\controller\Admin\AdminLogController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\AdminLogController::class, 'delete']);
    });

    Route::group('/adminPermission', function () {
        Route::post('/getList', [app\controller\Admin\AdminPermissionController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\AdminPermissionController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\AdminPermissionController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\AdminPermissionController::class, 'add']);
        Route::post('/save', [app\controller\Admin\AdminPermissionController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\AdminPermissionController::class, 'delete']);
    });

    Route::group('/banner', function () {
        Route::post('/getList', [app\controller\Admin\BannerController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\BannerController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\BannerController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\BannerController::class, 'add']);
        Route::post('/save', [app\controller\Admin\BannerController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\BannerController::class, 'delete']);
    });

    Route::group('/bannerCate', function () {
        Route::post('/getList', [app\controller\Admin\BannerCateController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\BannerCateController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\BannerCateController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\BannerCateController::class, 'add']);
        Route::post('/save', [app\controller\Admin\BannerCateController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\BannerCateController::class, 'delete']);
    });

    Route::group('/config', function () {
        Route::post('/getList', [app\controller\Admin\ConfigController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\ConfigController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\ConfigController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\ConfigController::class, 'add']);
        Route::post('/save', [app\controller\Admin\ConfigController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\ConfigController::class, 'delete']);
    });

    Route::group('/download', function () {
        Route::post('/getList', [app\controller\Admin\DownloadController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\DownloadController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\DownloadController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\DownloadController::class, 'add']);
        Route::post('/save', [app\controller\Admin\DownloadController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\DownloadController::class, 'delete']);
    });

    Route::group('/downloadCate', function () {
        Route::post('/getList', [app\controller\Admin\DownloadCateController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\DownloadCateController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\DownloadCateController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\DownloadCateController::class, 'add']);
        Route::post('/save', [app\controller\Admin\DownloadCateController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\DownloadCateController::class, 'delete']);
    });

    Route::group('/feedback', function () {
        Route::post('/getList', [app\controller\Admin\FeedbackController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\FeedbackController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\FeedbackController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\FeedbackController::class, 'add']);
        Route::post('/save', [app\controller\Admin\FeedbackController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\FeedbackController::class, 'delete']);
    });

    Route::group('/file', function () {
        Route::post('/getList', [app\controller\Admin\FileController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\FileController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\FileController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\FileController::class, 'add']);
        Route::post('/save', [app\controller\Admin\FileController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\FileController::class, 'delete']);
    });

    Route::group('/friendLink', function () {
        Route::post('/getList', [app\controller\Admin\FriendLinkController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\FriendLinkController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\FriendLinkController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\FriendLinkController::class, 'add']);
        Route::post('/save', [app\controller\Admin\FriendLinkController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\FriendLinkController::class, 'delete']);
    });

    Route::group('/jobOffers', function () {
        Route::post('/getList', [app\controller\Admin\JobOffersController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\JobOffersController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\JobOffersController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\JobOffersController::class, 'add']);
        Route::post('/save', [app\controller\Admin\JobOffersController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\JobOffersController::class, 'delete']);
    });

    Route::group('/lang', function () {
        Route::post('/getList', [app\controller\Admin\LangController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\LangController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\LangController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\LangController::class, 'add']);
        Route::post('/save', [app\controller\Admin\LangController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\LangController::class, 'delete']);
    });

    Route::group('/news', function () {
        Route::post('/getList', [app\controller\Admin\NewsController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\NewsController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\NewsController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\NewsController::class, 'add']);
        Route::post('/save', [app\controller\Admin\NewsController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\NewsController::class, 'delete']);
    });

    Route::group('/newsCate', function () {
        Route::post('/getList', [app\controller\Admin\NewsCateController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\NewsCateController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\NewsCateController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\NewsCateController::class, 'add']);
        Route::post('/save', [app\controller\Admin\NewsCateController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\NewsCateController::class, 'delete']);
    });

    Route::group('/product', function () {
        Route::post('/getList', [app\controller\Admin\ProductController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\ProductController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\ProductController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\ProductController::class, 'add']);
        Route::post('/save', [app\controller\Admin\ProductController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\ProductController::class, 'delete']);
    });

    Route::group('/productCate', function () {
        Route::post('/getList', [app\controller\Admin\ProductCateController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\ProductCateController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\ProductCateController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\ProductCateController::class, 'add']);
        Route::post('/save', [app\controller\Admin\ProductCateController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\ProductCateController::class, 'delete']);
    });

    Route::group('/seo', function () {
        Route::post('/getList', [app\controller\Admin\SeoController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\SeoController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\SeoController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\SeoController::class, 'add']);
        Route::post('/save', [app\controller\Admin\SeoController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\SeoController::class, 'delete']);
    });

    Route::group('/video', function () {
        Route::post('/getList', [app\controller\Admin\VideoController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\VideoController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\VideoController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\VideoController::class, 'add']);
        Route::post('/save', [app\controller\Admin\VideoController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\VideoController::class, 'delete']);
    });

    Route::group('/videoCate', function () {
        Route::post('/getList', [app\controller\Admin\VideoCateController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\VideoCateController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\VideoCateController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\VideoCateController::class, 'add']);
        Route::post('/save', [app\controller\Admin\VideoCateController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\VideoCateController::class, 'delete']);
    });
    Route::group('/platform', function () {
        Route::post('/getList', [app\controller\Admin\PlatformController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\PlatformController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\PlatformController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\PlatformController::class, 'add']);
        Route::post('/save', [app\controller\Admin\PlatformController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\PlatformController::class, 'delete']);
    });

    Route::group('/message', function () {
        Route::post('/getList', [app\controller\Admin\MessageController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\MessageController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\MessageController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\MessageController::class, 'add']);
        Route::post('/save', [app\controller\Admin\MessageController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\MessageController::class, 'delete']);
    });

    Route::group('/requestLog', function () {
        Route::post('/getList', [app\controller\Admin\RequestLogController::class, 'getList']);
        Route::post('/getAll', [app\controller\Admin\RequestLogController::class, 'getAll']);
        Route::post('/getOne', [app\controller\Admin\RequestLogController::class, 'getOne']);
        Route::post('/add', [app\controller\Admin\RequestLogController::class, 'add']);
        Route::post('/save', [app\controller\Admin\RequestLogController::class, 'save']);
        Route::post('/delete', [app\controller\Admin\RequestLogController::class, 'delete']);
    });
})->middleware([
    app\middleware\CrossDomain::class,
    app\middleware\AdminCheck::class,
    app\middleware\AdminLog::class
]);

//请求不存在的url返回信息
//Route::fallback(function () {
//    return json(['code' => 404, 'msg' => '404 not found']);
//});

Route::fallback(function (Request $request) {
    $response = strtoupper($request->method()) === 'OPTIONS' ? response('', 204) : json(['code' => 404, 'msg' => '404 not found']);
    $response->withHeaders([
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Allow-Origin' => "*",
        'Access-Control-Allow-Methods' => '*',
        'Access-Control-Allow-Headers' => '*',
    ]);
    return $response;
});
//关闭自动路由
Route::disableDefaultRoute();




