<?php

namespace app\middleware;

use support\Log;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

//跨域
class  CrossDomain implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {


        if ($request->method() == 'OPTIONS') {
            Log::info('OPTIONS--------------------');
            Log::info(json($request->all()));
            Log::info(json($request->header()));
            Log::info('OPTIONS--------------------');
            return response('');
        } else {
            Log::info('request--------------------');
            Log::info(json($request->all()));
            Log::info(json($request->header()));
            Log::info('request--------------------');
            $response = $next($request);
            $response->withHeaders([
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Allow-Origin' => $request->header('origin', '*'),
                'Access-Control-Allow-Methods' => $request->header('access-control-request-method', '*'),
                'Access-Control-Allow-Headers' => $request->header('access-control-request-headers', '*'),
            ]);
            return $response;
        }
    }
}
