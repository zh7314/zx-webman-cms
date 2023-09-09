<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\FileService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class FileController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['file_name'] = parameterCheck($request->input('file_name'), 'string', '');
            $where['file_path'] = parameterCheck($request->input('file_path'), 'string', '');
            $where['file_size'] = parameterCheck($request->input('file_size'), 'int', 0);

            $data = FileService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['file_name'] = parameterCheck($request->input('file_name'), 'string', '');
            $where['file_path'] = parameterCheck($request->input('file_path'), 'string', '');
            $where['file_size'] = parameterCheck($request->input('file_size'), 'int', 0);


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

            $where['id'] = parameterCheck($request->input('id'), 'int', 0);

            $data = FileService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['file_name'] = parameterCheck($request->input('file_name'), 'string', '');
            $where['file_path'] = parameterCheck($request->input('file_path'), 'string', '');
            $where['file_size'] = parameterCheck($request->input('file_size'), 'int', 0);

            $data = FileService::add($where);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->input('id'), 'int', 0);
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['file_name'] = parameterCheck($request->input('file_name'), 'string', '');
            $where['file_path'] = parameterCheck($request->input('file_path'), 'string', '');
            $where['file_size'] = parameterCheck($request->input('file_size'), 'int', 0);

            $data = FileService::save($where);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->input('id'), 'int', 0);
            $data = FileService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
