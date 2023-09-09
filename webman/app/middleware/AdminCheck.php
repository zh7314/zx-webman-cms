<?php

namespace app\middleware;

use app\model\Admin;
use app\service\Admin\CommonService;
use app\util\GlobalCode;
use app\util\ResponseTrait;
use Exception;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

//后台管理员权限检查
class  AdminCheck implements MiddlewareInterface
{
    use ResponseTrait;

    public function process(Request $request, callable $next): Response
    {
        try {
            $token = $request->header(GlobalCode::API_TOKEN, '');
            if (empty($token)) {
                //兼容文件下载文件验证 token
                $token = $request->input(GlobalCode::API_TOKEN, '');
                if (empty($token)) {
                    throw new Exception('token为空，请重新登录');
                }
            }
            $admin = Admin::where('token', $token)->first();
            if ($admin == null) {
                throw new Exception('token不存在');
            }
            if ((int)time() > ((int)strtotime($admin->token_time) + (int)GlobalCode::TOKEN_TIME)) {
                throw new Exception('token过期，请重新登录');
            }

            $request->admin_id = $admin->id;
            $request->token = $token;

//            p($request->admin_id);
//            p($request->token);

            $request_url = $request->path();
            try {
                //权限验证
                CommonService::permissionCheck($admin->id, $request_url);
            } catch (Exception $e) {
                return $this->fail($e);
            }

        } catch (Throwable $e) {
            return $this->grant($e);
        }

        return $next($request);
    }
}
