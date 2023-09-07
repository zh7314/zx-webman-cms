<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\FileService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FileController extends Controller{

    use ResponseTrait;

    public function getList(Request $request) {
        try {
            $where = [];
            $page = parameterCheck($request->page,'int',0);
            $pageSize = parameterCheck($request->pageSize,'int',0);

            $where['admin_id']= parameterCheck($request->input('admin_id'),'float',0);
$where['file_name']= parameterCheck($request->input('file_name'),'string','');
$where['file_path']= parameterCheck($request->input('file_path'),'string','');
$where['file_size']= parameterCheck($request->input('file_size'),'int',0);

            $data = FileService::getList($where,$page,$pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request) {
        try {
            $where = [];

            $where['admin_id']= parameterCheck($request->input('admin_id'),'float',0);
$where['file_name']= parameterCheck($request->input('file_name'),'string','');
$where['file_path']= parameterCheck($request->input('file_path'),'string','');
$where['file_size']= parameterCheck($request->input('file_size'),'int',0);


            $data = FileService::getAll($where);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getOne(Request $request)
    {
        try {
            $where = [];

            $where['id'] = parameterCheck($request->id, 'int', 0);

            $data = FileService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['admin_id']= parameterCheck($request->input('admin_id'),'float',0);
$where['file_name']= parameterCheck($request->input('file_name'),'string','');
$where['file_path']= parameterCheck($request->input('file_path'),'string','');
$where['file_size']= parameterCheck($request->input('file_size'),'int',0);

            $data = FileService::add($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id']= parameterCheck($request->id,'int',0);
            $where['admin_id']= parameterCheck($request->input('admin_id'),'float',0);
$where['file_name']= parameterCheck($request->input('file_name'),'string','');
$where['file_path']= parameterCheck($request->input('file_path'),'string','');
$where['file_size']= parameterCheck($request->input('file_size'),'int',0);

            $data = FileService::save($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id']= parameterCheck($request->id,'int',0);
            $data = FileService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
