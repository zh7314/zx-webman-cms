<?php

namespace app\controller\Admin;

use app\service\Admin\AdminService;
use support\Request;
use Throwable;
use app\util\ResponseTrait;
use support\Db;

class AdminController
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['avatar'] = parameterCheck($request->input('avatar'), 'string', '');
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['is_admin'] = parameterCheck($request->input('is_admin'), 'int', 0);
            $where['login_ip'] = parameterCheck($request->input('login_ip'), 'string', '');
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['salt'] = parameterCheck($request->input('salt'), 'string', '');
            $where['sex'] = parameterCheck($request->input('sex'), 'int', 0);

            $data = AdminService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['admin_group_ids'] = parameterCheck($request->input('admin_group_ids'), 'string', '');
            $where['avatar'] = parameterCheck($request->input('avatar'), 'string', '');
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['is_admin'] = parameterCheck($request->input('is_admin'), 'int', 0);
            $where['login_ip'] = parameterCheck($request->input('login_ip'), 'string', '');
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['password'] = parameterCheck($request->input('password'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['salt'] = parameterCheck($request->input('salt'), 'string', '');
            $where['sex'] = parameterCheck($request->input('sex'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['status'] = parameterCheck($request->input('status'), 'int', 0);

            $data = AdminService::getAll($where);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getOne(Request $request)
    {
        try {
            $where = [];

            $where['id'] = parameterCheck($request->admin_id, 'int', 0);

            $data = AdminService::getOne($where['id']);

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
            $where['admin_group_ids'] = parameterCheck($request->input('admin_group_ids'), 'string', '');
            $where['avatar'] = parameterCheck($request->input('avatar'), 'string', '');
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['is_admin'] = parameterCheck($request->input('is_admin'), 'int', 0);
            $where['login_ip'] = parameterCheck($request->input('login_ip'), 'string', '');
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['password'] = parameterCheck($request->input('password'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['salt'] = parameterCheck($request->input('salt'), 'string', '');
            $where['sex'] = parameterCheck($request->input('sex'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['status'] = parameterCheck($request->input('status'), 'int', 0);

            $data = AdminService::add($where);

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
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $where['admin_group_ids'] = parameterCheck($request->input('admin_group_ids'), 'array', []);
            $where['avatar'] = parameterCheck($request->input('avatar'), 'string', '');
            $where['email'] = parameterCheck($request->input('email'), 'string', '');
            $where['is_admin'] = parameterCheck($request->input('is_admin'), 'int', 0);
            $where['login_ip'] = parameterCheck($request->input('login_ip'), 'string', '');
            $where['mobile'] = parameterCheck($request->input('mobile'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['password'] = parameterCheck($request->input('password'), 'string', '');
            $where['real_name'] = parameterCheck($request->input('real_name'), 'string', '');
            $where['salt'] = parameterCheck($request->input('salt'), 'string', '');
            $where['sex'] = parameterCheck($request->input('sex'), 'int', 0);
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['status'] = parameterCheck($request->input('status'), 'int', 0);
            $where['token'] = parameterCheck($request->input('token'), 'string', '');
            $where['token_time'] = parameterCheck($request->input('token_time'), 'string', '');

            $data = AdminService::save($where);

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
            $where['id'] = parameterCheck($request->id, 'int', 0);

            $data = AdminService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
