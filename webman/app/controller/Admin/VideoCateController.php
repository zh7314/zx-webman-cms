<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\VideoCateService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class VideoCateController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = VideoCateService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);


            $data = VideoCateService::getAll($where);

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

            $data = VideoCateService::getOne($where['id']);

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
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = VideoCateService::add($where);

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
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = VideoCateService::save($where);

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
            $data = VideoCateService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
