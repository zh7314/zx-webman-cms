<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\MessageService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['ip'] = parameterCheck($request->input('ip'), 'string', '');
            $where['is_sent'] = parameterCheck($request->input('is_sent'), 'int', 0);
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['remark'] = parameterCheck($request->input('remark'), 'string', '');
            $where['status'] = parameterCheck($request->input('status'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['type'] = parameterCheck($request->input('type'), 'int', 0);

            $data = MessageService::getList($where, $page, $pageSize);

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
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['ip'] = parameterCheck($request->input('ip'), 'string', '');
            $where['is_sent'] = parameterCheck($request->input('is_sent'), 'int', 0);
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['remark'] = parameterCheck($request->input('remark'), 'string', '');
            $where['status'] = parameterCheck($request->input('status'), 'int', 0);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['type'] = parameterCheck($request->input('type'), 'int', 0);


            $data = MessageService::getAll($where);

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

            $data = MessageService::getOne($where['id']);

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
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['ip'] = parameterCheck($request->input('ip'), 'string', '');
            $where['is_sent'] = parameterCheck($request->input('is_sent'), 'int', 10);
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['remark'] = parameterCheck($request->input('remark'), 'string', '');
            $where['status'] = parameterCheck($request->input('status'), 'int', 10);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['type'] = parameterCheck($request->input('type'), 'int', 0);

            $data = MessageService::add($where);

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
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['ip'] = parameterCheck($request->input('ip'), 'string', '');
            $where['is_sent'] = parameterCheck($request->input('is_sent'), 'int', 10);
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['remark'] = parameterCheck($request->input('remark'), 'string', '');
            $where['status'] = parameterCheck($request->input('status'), 'int', 10);
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['type'] = parameterCheck($request->input('type'), 'int', 0);

            $data = MessageService::save($where);

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
            $data = MessageService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
