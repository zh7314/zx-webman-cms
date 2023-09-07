<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\AdminLogService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminLogController extends Controller
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['admin_name'] = parameterCheck($request->input('admin_name'), 'string', '');
            $where['data'] = parameterCheck($request->input('data'), 'string', '');
            $where['method'] = parameterCheck($request->input('method'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['request_ip'] = parameterCheck($request->input('request_ip'), 'string', '');
            $where['route_desc'] = parameterCheck($request->input('route_desc'), 'string', '');
            $where['route_name'] = parameterCheck($request->input('route_name'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['time'] = parameterCheck($request->input('time'), 'array', []);

            $data = AdminLogService::getList($where, $page, $pageSize);

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
            $where['admin_name'] = parameterCheck($request->input('admin_name'), 'string', '');
            $where['data'] = parameterCheck($request->input('data'), 'string', '');
            $where['method'] = parameterCheck($request->input('method'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['request_ip'] = parameterCheck($request->input('request_ip'), 'string', '');
            $where['route_desc'] = parameterCheck($request->input('route_desc'), 'string', '');
            $where['route_name'] = parameterCheck($request->input('route_name'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');


            $data = AdminLogService::getAll($where);

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

            $data = AdminLogService::getOne($where['id']);

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
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['admin_name'] = parameterCheck($request->input('admin_name'), 'string', '');
            $where['data'] = parameterCheck($request->input('data'), 'string', '');
            $where['method'] = parameterCheck($request->input('method'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['request_ip'] = parameterCheck($request->input('request_ip'), 'string', '');
            $where['route_desc'] = parameterCheck($request->input('route_desc'), 'string', '');
            $where['route_name'] = parameterCheck($request->input('route_name'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = AdminLogService::add($where);

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
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['admin_name'] = parameterCheck($request->input('admin_name'), 'string', '');
            $where['data'] = parameterCheck($request->input('data'), 'string', '');
            $where['method'] = parameterCheck($request->input('method'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['request_ip'] = parameterCheck($request->input('request_ip'), 'string', '');
            $where['route_desc'] = parameterCheck($request->input('route_desc'), 'string', '');
            $where['route_name'] = parameterCheck($request->input('route_name'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = AdminLogService::save($where);

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
            $data = AdminLogService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
