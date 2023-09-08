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

        $header = [
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => $request->header('origin', '*'),
            'Access-Control-Allow-Methods' => $request->header('access-control-request-method', '*'),
            'Access-Control-Allow-Headers' => $request->header('access-control-request-headers', '*'),
        ];

        if ($request->method() === 'OPTIONS') {
            return response('', 200, $header);
        } else {
            $response = $next($request);
            $response->withHeaders($header);
            return $response;
        }

//        header('Access-Control-Allow-Credentials: true');
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
//        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With');
//        return $next($request);
    }
}
