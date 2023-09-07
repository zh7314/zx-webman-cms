<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\AdminGroupService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminGroupController extends Controller
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['permission_ids'] = parameterCheck($request->input('permission_ids'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = AdminGroupService::getList($where, $page, $pageSize);

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
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['permission_ids'] = parameterCheck($request->input('permission_ids'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);


            $data = AdminGroupService::getAll($where);

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

            $data = AdminGroupService::getOne($where['id']);

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
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['permission_ids'] = parameterCheck($request->input('permission_ids'), 'array', []);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = AdminGroupService::add($where);

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
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['parent_id'] = parameterCheck($request->input('parent_id'), 'float', 0);
            $where['permission_ids'] = parameterCheck($request->input('permission_ids'), 'array', []);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);

            $data = AdminGroupService::save($where);

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
            $data = AdminGroupService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
