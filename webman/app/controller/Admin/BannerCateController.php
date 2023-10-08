<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\BannerCateService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class BannerCateController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);

            $data = BannerCateService::getList($where, $page, $pageSize);

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
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);


            $data = BannerCateService::getAll($where);

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

            $data = BannerCateService::getOne($where['id']);

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
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);

            $data = BannerCateService::add($where);

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
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);

            $data = BannerCateService::save($where);

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
            $data = BannerCateService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
