<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\PlatformService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class PlatformController 
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = PlatformService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');


            $data = PlatformService::getAll($where);

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

            $data = PlatformService::getOne($where['id']);

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
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = PlatformService::add($where);

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
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['value'] = parameterCheck($request->input('value'), 'string', '');

            $data = PlatformService::save($where);

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
            $data = PlatformService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
