<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;


class TestController extends Controller
{

    public static function index(Request $request)
    {
        p(date('Y-m-d H:i:s', time()));

    }
}
