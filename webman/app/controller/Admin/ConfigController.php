<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\ConfigService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class ConfigController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = ConfigService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');


            $data = ConfigService::getAll($where);

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

            $data = ConfigService::getOne($where['id']);

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
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = ConfigService::add($where);

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
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = ConfigService::save($where);

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
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $data = ConfigService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
