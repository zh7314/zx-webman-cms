<?php


namespace app\util;


interface GlobalCode
{
    //接口返回成功
    const SUCCESS = 200;
    //返回错误
    const FAIL = 400;
    //需要授权
    const GRANT = 401;
    //数据库 状态定义 10 正常 99删除
    const NORMAL = 10;
    const DELETE = 99;

    const CODE = 'code';
    const MSG = 'msg';
    const DATA = 'data';


    //上传文件总路径
    const UPLOAD_URL = 'upload';

    const IS_DELETE = 'is_delete';
    //后台token名称
    const API_TOKEN = 'X-Token';
    const TOKEN_TIME = 24 * 3600;
    //请求，是否返回debug
    const DEBUG = 'need_debug';
}
