<?php

namespace app\service\Admin;

use app\model\Admin;
use app\util\GlobalCode;
use Exception;

class LoginService
{

    //密码两次md5加密
    public static function login(string $name = '', string $password = '', string $code = '', string $captchaKey = '')
    {
//        $request_ip = request()->ip() == '127.0.0.1' ? request()->header('x-real-ip', '127.0.0.1') : request()->ip();
//        $key = 'admin_login:' . sha1(request()->getHost() . '|' . $request_ip);
//        if (empty($code)) {
//            throw new Exception('验证码不能为空');
//        }
//        if (!captcha_api_check($code, $captchaKey)) {
//            throw new Exception('验证码错误');
//        }

        if (empty($name)) {
            throw new Exception('登录名不能为空');
        }
        if (empty($password)) {
            throw new Exception('密码不能为空');
        }

        $admin = Admin::where('name', $name)->first();
        if (empty($admin)) {
            throw new Exception('登录名不存在');
        }
        if (md5(md5($password . $admin->salt)) !== (string)$admin->password) {
            throw new Exception('密码错误');
        }

        $token = getToken($admin->id);

        $admin->token_time = date('Y-m-d H:i:s', time());
        $admin->token = $token;
        $res = $admin->save();
        if (empty($res)) {
            throw new Exception('更新token失败');
        }
        $data = [];

        $data['token'] = $token;
        $data['userInfo']['dashboard'] = '';
        $data['userInfo']['role'][] = ["SA", "admin", "Auditor"];
        $data['userInfo']['userId'] = $admin->id;
        $data['userInfo']['avatar'] = $admin->avatar;
        $data['userInfo']['userName'] = $admin->real_name;
        $data['tokenTime'] = GlobalCode::TOKEN_TIME;
        $data['tokenKey'] = GlobalCode::API_TOKEN;

        return $data;
    }

    public static function logout(int $adminId = 0)
    {
        //清除token
        $admin = Admin::where('id', $adminId)->first();
        if ($admin == null) {
            return null;
        }
        $admin->token = '';
        $res = $admin->save();
        if ($res == false) {
            throw new Exception('退出失败，请联系管理员');
        }
        return $res;
    }

    public static function getInfo(int $adminId = 0)
    {
        if (empty($adminId)) {
            throw new Exception('id参数缺失');
        }
        $admin = Admin::where('id', $adminId)->first();
        if ($admin == null) {
            throw new Exception('用户不存在');
        }

        $data = [];
        $data['name'] = $admin->real_name;
        $data['avatar'] = URL::to($admin->avatar);
        $data['introduction'] = 'admin';
        $data['roles'][] = 'admin';

        return $data;
    }

    public static function getMenu(int $adminId = 0)
    {
        if (empty($adminId)) {
            throw new Exception('id参数缺失');
        }
        $admin = Admin::where('id', $adminId)->first();
        if ($admin == null) {
            throw new Exception('用户不存在');
        }

        $data = [];
        $data['dashboardGrid'] = ["welcome", "ver", "time", "progress", "echarts", "about"];
        $data['permissions'] = ["list.add", "list.edit", "list.delete", "user.add", "user.edit", "user.delete"];

        $data['menu'] = CommonService::getMenu($admin->id, $admin->is_admin);
        $data['menu'] = CommonService::orderedArray($data['menu']);

//        $t = [];
//        $t['0']['name'] = '首页';
//        $t['0']['path'] = '/home';
//        $t['0']['meta']['title'] = '首页';
//        $t['0']['meta']['icon'] = 'el-icon-eleme-filled';
//        $t['0']['meta']['type'] = 'menu';
//        $t['0']['children']['0']['name'] = '控制台';
//        $t['0']['children']['0']['path'] = '/home/index';
//        $t['0']['children']['0']['meta']['title'] = '控制台';
//        $t['0']['children']['0']['meta']['icon'] = 'el-icon-menu';
//        $t['0']['children']['0']['meta']['affix'] = 'true';
//        $t['0']['children']['0']['component'] = '/home/index';
//        $t['0']['children']['1']['name'] = '帐号信息';
//        $t['0']['children']['1']['path'] = '/usercenter/index';
//        $t['0']['children']['1']['meta']['title'] = '帐号信息';
//        $t['0']['children']['1']['meta']['icon'] = 'el-icon-user';
//        $t['0']['children']['1']['meta']['tag'] = 'bug';
//        $t['0']['children']['1']['meta']['fullpage'] = 'true';
//        $t['0']['children']['1']['meta']['hiddenBreadcrumb'] = 'true';
//        $t['0']['children']['1']['component'] = '/userCenter/index';
//        $data['menu'] = $t;

        return $data;
    }

    public static function getVersion()
    {
        $data = '1.6.9';
        return $data;
    }

    public static function changePwd()
    {
        $data = '1.6.9';
        return $data;
    }
}
