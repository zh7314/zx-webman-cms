<?php

namespace app\controller\Web;

use app\service\Admin\CommonService;
use app\util\ResponseTrait;
use Exception;
use support\Request;
use Throwable;


class IndexController
{
    use ResponseTrait;

    public function uploadPic(Request $request)
    {
        $file = $request->file('file');

        try {
            if ($file == null) {
                throw new Exception('未找到上传文件');
            }
            $data = CommonService::uploadFile($file, ['jpg', 'jpeg', 'png', 'mbp', 'gif']);

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

            return $this->success($data, '上传成功');
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function messageUploadPic(Request $request)
    {
        $file = $request->file('uploadfile');

        try {
            if ($file == null) {
                throw new Exception('未找到上传文件');
            }
            $data = CommonService::uploadFile($file, ['jpg', 'jpeg', 'png', 'mbp', 'gif']);

            return $this->success($data, '上传成功');
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

}
