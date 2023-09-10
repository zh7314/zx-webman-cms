<?php

namespace app\util;

use app\util\GlobalCode;
use app\util\GlobalMsg;
use Throwable;

trait ResponseTrait
{
    public function success(mixed $data = '', string $msg = GlobalMsg::SUCCESS)
    {
        return returnJson([GlobalCode::CODE => GlobalCode::SUCCESS, GlobalCode::MSG => $msg, GlobalCode::DATA => $data]);
    }

    public function fail(Throwable $e, $status = 200, array $headers = [])
    {
        if (request()->input('debug') == GlobalCode::DEBUG || config('app.debug')) {
            return returnJson([GlobalCode::CODE => GlobalCode::FAIL, GlobalCode::MSG => $e->getMessage(), GlobalCode::DATA => $e->getTraceAsString()], $status, $headers);
        } else {
            return returnJson([GlobalCode::CODE => GlobalCode::FAIL, GlobalCode::MSG => $e->getMessage(), GlobalCode::DATA => $e->getMessage()], $status, $headers);
        }
    }

    public function grant(Throwable $e)
    {
        if (request()->input('debug') == GlobalCode::DEBUG || config('app.debug')) {
            return returnJson([GlobalCode::CODE => GlobalCode::GRANT, GlobalCode::MSG => $e->getMessage(), GlobalCode::DATA => $e->getTraceAsString()]);
        } else {
            return returnJson([GlobalCode::CODE => GlobalCode::GRANT, GlobalCode::MSG => $e->getMessage(), GlobalCode::DATA => $e->getMessage()]);
        }
    }

}
