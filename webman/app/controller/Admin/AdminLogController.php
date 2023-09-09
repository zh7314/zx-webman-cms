<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\AdminLogService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class AdminLogController 
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->input('page'), 'int', 0);
            $pageSize = parameterCheck($request->input('pageSize'), 'int', 0);

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

            $where['id'] = parameterCheck($request->input('id'), 'int', 0);

            $data = AdminLogService::getOne($where['id']);

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
            $data = AdminLogService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
