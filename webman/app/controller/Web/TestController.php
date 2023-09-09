<?php

namespace app\controller\Web;

use app\util\GlobalCode;
use support\Request;
use Webman\Route;

class TestController
{

    public static function index(Request $request)
    {
        $data = [];
//        foreach (Route::getRoutes() as $k => $route) {
//            $data[$k]['Methods'] = $route->getMethods();
//            $data[$k]['Path'] = $route->getPath();
//            $data[$k]['Callback'] = $route->getCallback();
//            $data[$k]['Middleware'] = $route->getMiddleware();
//
//        }
//        $data['path'] = $request->path();
//        $data['host'] = $request->host();
//        $data['host1'] = $request->host(true);
//        $data['uri'] = $request->uri();
//        $data['query'] = $request->queryString();
//
//        $data['fullUrl'] = $request->fullUrl();
//        $data['remoteIp'] = $request->getRemoteIp();
//
//        $data['remotePort'] = $request->getRemotePort();
//        $data['realIp'] = $request->getRealIp();
//        $data['realIp1'] = $request->getRealIp(false);
//        $data['localIp'] = $request->getLocalIp();
//        $data['localPort'] = $request->getLocalPort();
//
//        $data['app'] = $request->app;
//        $data['controller'] = $request->controller;
//        $data['action'] = $request->action;
//
//        $data['header'] = $request->header();
//        $data['rawBody'] = $request->rawBody();
//        $data['rawHead'] = $request->rawHead();
//
//        $data['method'] = $request->method();
//        $data['token'] = $request->header(GlobalCode::API_TOKEN, '');

        return json($data);
    }

    public static function test(Request $request)
    {
        return 1111;
    }
}
