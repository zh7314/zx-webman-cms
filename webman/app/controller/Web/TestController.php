<?php

namespace app\controller\Web;

use support\Request;

class TestController
{

    public static function index(Request $request)
    {
        p(date('Y-m-d H:i:s', time()));
    }
}
