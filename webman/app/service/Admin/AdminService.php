<?php

namespace app\service\Admin;

use app\model\Admin;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class AdminService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $admin = new Admin();

        if (!empty($where['avatar'])) {
            $admin = $admin->where('avatar', $where['avatar']);
        }
        if (!empty($where['email'])) {
            $admin = $admin->where('email', $where['email']);
        }
        if (!empty($where['is_admin'])) {
            $admin = $admin->where('is_admin', $where['is_admin']);
        }
        if (!empty($where['login_ip'])) {
            $admin = $admin->where('login_ip', $where['login_ip']);
        }
        if (!empty($where['mobile'])) {
            $admin = $admin->where('mobile', $where['mobile']);
        }
        if (!empty($where['name'])) {
            $admin = $admin->where('name', $where['name']);
        }
        if (!empty($where['password'])) {
            $admin = $admin->where('password', $where['password']);
        }
        if (!empty($where['real_name'])) {
            $admin = $admin->where('real_name', $where['real_name']);
        }
        if (!empty($where['salt'])) {
            $admin = $admin->where('salt', $where['salt']);
        }
        if (!empty($where['sex'])) {
            $admin = $admin->where('sex', $where['sex']);
        }
        if (!empty($where['sort'])) {
            $admin = $admin->where('sort', $where['sort']);
        }
        if (!empty($where['status'])) {
            $admin = $admin->where('status', $where['status']);
        }

        $count = $admin->count();

        if ($page > 0 && $pageSize > 0) {
            $admin = $admin->forPage($page, $pageSize);
        }

        $list = $admin->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $admin = new Admin();

        if (!empty($where['avatar'])) {
            $admin = $admin->where('avatar', $where['avatar']);
        }
        if (!empty($where['email'])) {
            $admin = $admin->where('email', $where['email']);
        }
        if (!empty($where['is_admin'])) {
            $admin = $admin->where('is_admin', $where['is_admin']);
        }
        if (!empty($where['login_ip'])) {
            $admin = $admin->where('login_ip', $where['login_ip']);
        }
        if (!empty($where['mobile'])) {
            $admin = $admin->where('mobile', $where['mobile']);
        }
        if (!empty($where['name'])) {
            $admin = $admin->where('name', $where['name']);
        }
        if (!empty($where['password'])) {
            $admin = $admin->where('password', $where['password']);
        }
        if (!empty($where['real_name'])) {
            $admin = $admin->where('real_name', $where['real_name']);
        }
        if (!empty($where['salt'])) {
            $admin = $admin->where('salt', $where['salt']);
        }
        if (!empty($where['sex'])) {
            $admin = $admin->where('sex', $where['sex']);
        }
        if (!empty($where['sort'])) {
            $admin = $admin->where('sort', $where['sort']);
        }
        if (!empty($where['status'])) {
            $admin = $admin->where('status', $where['status']);
        }

        return $admin->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $admin;
    }

    public static function add(array $where = [])
    {

        $admin = new Admin();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_group_ids']) && $admin->admin_group_ids = $where['admin_group_ids'];
        isset($where['avatar']) && $admin->avatar = $where['avatar'];
        isset($where['email']) && $admin->email = $where['email'];
        isset($where['is_admin']) && $admin->is_admin = $where['is_admin'];
        isset($where['login_ip']) && $admin->login_ip = $where['login_ip'];
        isset($where['mobile']) && $admin->mobile = $where['mobile'];
        isset($where['name']) && $admin->name = $where['name'];
        isset($where['password']) && $admin->password = $where['password'];
        isset($where['real_name']) && $admin->real_name = $where['real_name'];
        isset($where['salt']) && $admin->salt = $where['salt'];
        isset($where['sex']) && $admin->sex = $where['sex'];
        isset($where['sort']) && $admin->sort = $where['sort'];
        isset($where['status']) && $admin->status = $where['status'];

        $res = $admin->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function save(array $where = [])
    {
        if (empty($where['id'])) {
            throw new Exception(GlobalMsg::SAVE_NO_ID);
        }
        $admin = Admin::where('id', $where['id'])->first();
        if ($admin == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }
//        p($where['admin_group_ids']);
//        pp($admin->toArray());

        isset($where['admin_group_ids']) && $admin->admin_group_ids = $where['admin_group_ids'];
        isset($where['avatar']) && $admin->avatar = $where['avatar'];
        isset($where['email']) && $admin->email = $where['email'];
        isset($where['is_admin']) && $admin->is_admin = $where['is_admin'];
        isset($where['login_ip']) && $admin->login_ip = $where['login_ip'];
        isset($where['mobile']) && $admin->mobile = $where['mobile'];
        isset($where['name']) && $admin->name = $where['name'];
        !empty($where['password']) && $admin->password = md5(md5($where['password']));
        isset($where['real_name']) && $admin->real_name = $where['real_name'];
        isset($where['salt']) && $admin->salt = $where['salt'];
        isset($where['sex']) && $admin->sex = $where['sex'];
        isset($where['sort']) && $admin->sort = $where['sort'];
        isset($where['status']) && $admin->status = $where['status'];

        $res = $admin->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $admin->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
