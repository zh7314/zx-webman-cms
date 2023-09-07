<?php


namespace app\util;


interface RedisCode
{
    //登录ttl存活时间
    const LOGIN_TTL = 3600 * 24 * 30;
    //token名称
    const TOKEN_NAME = 'YDToken';
    //token ttl自动刷新时间
    const TOKEN_TTL_REFRESH = 3600 * 24 * 7;
    //微信token名称
    const WX_TOKEN = 'wx_token';
    //微信token存活时间,微信是默认是7200秒，避免问题
    const WX_TOKEN_TIME = 7000;
    //五分钟存活时间
    const FIVE_TTL = 5 * 60;
    //短信存活时间
    const SURVIVAL = 60;

    //登录 redis的key
    const LOGIN = 'login:';
    //登录redis 注册key
    const REGISTER = 'register:';
    //app登录 redis的key
    const APP_LOGIN = 'app_login:';
    //app登录redis 注册key
    const APP_REGISTER = 'app_register:';

}
