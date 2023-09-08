<?php

namespace app\controller\Web;

use support\Request;
use Webman\Route;

class TestController
{

    public static function index(Request $request)
    {
        $data = [];
        foreach (Route::getRoutes() as $k => $route) {
//            var_export($route->getMethods());
//            var_export($route->getPath());
//            var_export($route->getCallback());
//            var_export($route->getMiddleware());

            $data[$k]['Methods'] = $route->getMethods();
            $data[$k]['Path'] = $route->getPath();
            $data[$k]['Callback'] = $route->getCallback();
            $data[$k]['Middleware'] = $route->getMiddleware();

        }
        return json($data);

//        return route('ssssssssss');
    }

    public static function test(Request $request)
    {
        return 1111;
    }
}
