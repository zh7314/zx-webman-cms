<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\FeedbackService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class FeedbackController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

            $where['contact'] = parameterCheck($request->input('contact'), 'string', '');
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['nick_name'] = parameterCheck($request->input('nick_name'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');

            $data = FeedbackService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['contact'] = parameterCheck($request->input('contact'), 'string', '');
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['nick_name'] = parameterCheck($request->input('nick_name'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');


            $data = FeedbackService::getAll($where);

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

            $data = FeedbackService::getOne($where['id']);

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
            $where['contact'] = parameterCheck($request->input('contact'), 'string', '');
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['nick_name'] = parameterCheck($request->input('nick_name'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');

            $data = FeedbackService::add($where);

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
            $where['contact'] = parameterCheck($request->input('contact'), 'string', '');
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['nick_name'] = parameterCheck($request->input('nick_name'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');

            $data = FeedbackService::save($where);

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
            $data = FeedbackService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
