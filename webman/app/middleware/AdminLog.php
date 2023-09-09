<?php

namespace app\middleware;

use app\model\Admin;
use app\model\AdminLog as Log;
use app\model\AdminPermission;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

//后台请求日志
class  AdminLog implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {

        $log = new Log();
        $log->method = $request->method();
        $log->url = $request->path();
        $log->route_name = $request->route()->getName();
//        $adminLog->route_path = $request->getRequestUri();
        $log->path = $request->url();
        $log->request_ip = $request->ip();
        $log->data = json_encode($request->input(), JSON_UNESCAPED_UNICODE);

        if (!empty($request->admin_id)) {
            $admin = Admin::where('id', $request->admin_id)->first();

            if ($admin == null) {
                $log->remark = '非admin_id权限';
            } else {
                $log->admin_id = $admin->id;
                $log->admin_name = $admin->real_name;
            }
        }
        $adminPermission = AdminPermission::where('path', $request->getRequestUri())->first();
        if ($adminPermission !== null) {
            $log->route_desc = $adminPermission->name;
        }
        $log->save();

        return $next($request);
    }
}
