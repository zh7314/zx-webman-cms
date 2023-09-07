<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\JobOffersService;
use Throwable;
use app\util\ResponseTrait;
use Illuminate\Support\Facades\DB;


class JobOffersController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['number'] = parameterCheck($request->input('number'), 'string', '');
            $where['place'] = parameterCheck($request->input('place'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['salary_range'] = parameterCheck($request->input('salary_range'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = JobOffersService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['number'] = parameterCheck($request->input('number'), 'string', '');
            $where['place'] = parameterCheck($request->input('place'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['salary_range'] = parameterCheck($request->input('salary_range'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');


            $data = JobOffersService::getAll($where);

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

            $data = JobOffersService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['number'] = parameterCheck($request->input('number'), 'string', '');
            $where['place'] = parameterCheck($request->input('place'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['salary_range'] = parameterCheck($request->input('salary_range'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = JobOffersService::add($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['number'] = parameterCheck($request->input('number'), 'string', '');
            $where['place'] = parameterCheck($request->input('place'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['salary_range'] = parameterCheck($request->input('salary_range'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = JobOffersService::save($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $data = JobOffersService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
