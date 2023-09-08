<?php

namespace app\middleware;

use support\Log;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

//请求日志
class  ApiLog implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
//        Log::info(self::class);

        return $next($request);
    }
}
