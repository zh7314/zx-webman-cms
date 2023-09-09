<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\SeoService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class SeoController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['description'] = parameterCheck($request->input('description'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['keyword'] = parameterCheck($request->input('keyword'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['position'] = parameterCheck($request->input('position'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');

            $data = SeoService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['description'] = parameterCheck($request->input('description'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['keyword'] = parameterCheck($request->input('keyword'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['position'] = parameterCheck($request->input('position'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');


            $data = SeoService::getAll($where);

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

            $data = SeoService::getOne($where['id']);

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
            $where['description'] = parameterCheck($request->input('description'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['keyword'] = parameterCheck($request->input('keyword'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['position'] = parameterCheck($request->input('position'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');

            $data = SeoService::add($where);

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
            $where['description'] = parameterCheck($request->input('description'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['keyword'] = parameterCheck($request->input('keyword'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['position'] = parameterCheck($request->input('position'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');

            $data = SeoService::save($where);

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
            $data = SeoService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
