<?php

namespace app\middleware;

use support\Log;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use app\model\RequestLog;

//请求日志
class  ApiLog implements MiddlewareInterface
{
    protected static $id;

    public function process(Request $request, callable $next): Response
    {
        $log = new RequestLog();
        $log->method = $request->method();
        $log->ip = $request->ip() == '127.0.0.1' ? $request->header('x-real-ip', '127.0.0.1') : $request->ip();
        $log->url = $request->path();
        $log->params = json_encode([$request->all(), $request->getContent()], JSON_UNESCAPED_UNICODE);
        $header_array = array_intersect_key($request->header(), array_flip(['referer', 'authorization', 'x-real-ip', 'x-forwarded-for']));

        $log->header = json_encode($header_array, JSON_UNESCAPED_UNICODE);
        $log->save();
        self::$id = $log->id;

        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        //第二步 后置中间件 获取数据 进行处理
        $status_code = $response->getStatusCode();
        $data = $response->getContent();

        if ($status_code == 200) {
            //开启debug的时候
            if (env('DEBUG') !== GlobalCode::DEBUG) {
                if (!empty($data) && is_array($data)) {

                    if (isset($data['data'])) {
                        unset($data['data']);
                    }
                } elseif (!empty($data) && is_json($data)) {
                    $data = json_decode($data, true);

                    if (isset($data['data'])) {
                        unset($data['data']);
                    }
                }
            }
        }

        $data = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
        //第三步 保存数据
        RequestLog::where('id', self::$id)->update(['data' => $data, 'return_at' => date('Y-m-d H:i:s')]);
    }
}
