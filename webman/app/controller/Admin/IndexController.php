<?php

namespace app\controller\Admin;


use app\service\Admin\CommonService;
use app\service\Admin\LoginService;
use support\Db;
use Throwable;
use Exception;
use app\util\ResponseTrait;
use support\Request;

class IndexController
{
    use ResponseTrait;

    public function getCaptcha(Request $request)
    {
        try {
            $data = app('captcha')->create('default', true);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function login(Request $request)
    {
        try {

            $name = parameterCheck($request->input('username'), 'string', '');
            $password = parameterCheck($request->input('password'), 'string', '');

            $code = parameterCheck($request->input('code'), 'string', '');
            $captchaKey = parameterCheck($request->input('captchaKey'), 'string', '');

            $data = LoginService::login($name, $password, $code, $captchaKey);

            return $this->success($data, '登录成功');
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function logout(Request $request)
    {
        try {

            $adminId = parameterCheck($request->admin_id, 'int', 0);

            $data = LoginService::logout($adminId);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getInfo(Request $request)
    {
        try {

            $adminId = parameterCheck($request->admin_id, 'int', 0);

            $data = LoginService::getInfo($adminId);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getMenu(Request $request)
    {
        try {
            $adminId = parameterCheck($request->admin_id, 'int', 0);

            $data = LoginService::getMenu($adminId);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }


    public function uploadPic(Request $request)
    {
        $file = $request->file('file');

        try {
            if ($file == null) {
                throw new Exception('未找到上传文件');
            }
            $data = CommonService::uploadFile($file, ['jpg', 'jpeg', 'png', 'mbp', 'gif']);
//            $data['src'] = getResource($data['src']);

            return $this->success($data, '上传成功');
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');

        try {
            if ($file == null) {
                throw new Exception('未找到上传文件');
            }
            $data = CommonService::uploadFile($file, ['xls', 'xlsx', 'pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'zip', 'pptx', 'mp4', 'flv'], 'file');
//            $data['src'] = getResource($data['src']);

            return $this->success($data, '上传成功');
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getVersion(Request $request)
    {
        try {

            $data = LoginService::getVersion();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function changePwd(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->admin_id, 'int', 0);

            $where['userPassword'] = parameterCheck($request->input('userPassword'), 'string', '');
            $where['newPassword'] = parameterCheck($request->input('newPassword'), 'string', '');
            $where['confirmNewPassword'] = parameterCheck($request->input('confirmNewPassword'), 'string', '');

            $data = LoginService::changePwd($where);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

    public function getGroupTree(Request $request)
    {
        try {

            $data = CommonService::getGroupTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getMenuTree(Request $request)
    {
        try {

            $data = CommonService::getMenuTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getdownloadCateTree(Request $request)
    {
        try {

            $data = CommonService::getdownloadCateTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getNewsCateTree(Request $request)
    {
        try {

            $data = CommonService::getNewsCateTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getProductCateTree(Request $request)
    {
        try {

            $data = CommonService::getProductCateTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getVideoCateTree(Request $request)
    {
        try {

            $data = CommonService::getVideoCateTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getBannerCateTree(Request $request)
    {
        try {

            $data = CommonService::getBannerCateTree();

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }
}
