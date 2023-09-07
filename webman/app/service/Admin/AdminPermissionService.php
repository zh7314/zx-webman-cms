<?php

namespace app\service\Admin;

use App\Models\AdminPermission;
use Exception;
use App\util\GlobalCode;
use App\util\GlobalMsg;

class AdminPermissionService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $adminPermission = new AdminPermission();

        if (!empty($where['component'])) {
            $adminPermission = $adminPermission->where('component', $where['component']);
        }
        if (!empty($where['hidden'])) {
            $adminPermission = $adminPermission->where('hidden', $where['hidden']);
        }
        if (!empty($where['icon'])) {
            $adminPermission = $adminPermission->where('icon', $where['icon']);
        }
        if (!empty($where['is_menu'])) {
            $adminPermission = $adminPermission->where('is_menu', $where['is_menu']);
        }
        if (!empty($where['name'])) {
            $adminPermission = $adminPermission->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $adminPermission = $adminPermission->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['path'])) {
            $adminPermission = $adminPermission->where('path', $where['path']);
        }
        if (!empty($where['sort'])) {
            $adminPermission = $adminPermission->where('sort', $where['sort']);
        }

        $count = $adminPermission->count();

        if ($page > 0 && $pageSize > 0) {
            $adminPermission = $adminPermission->forPage($page, $pageSize);
        }

        $list = $adminPermission->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $adminPermission = new AdminPermission();

        if (!empty($where['component'])) {
            $adminPermission = $adminPermission->where('component', $where['component']);
        }
        if (!empty($where['hidden'])) {
            $adminPermission = $adminPermission->where('hidden', $where['hidden']);
        }
        if (!empty($where['icon'])) {
            $adminPermission = $adminPermission->where('icon', $where['icon']);
        }
        if (!empty($where['is_menu'])) {
            $adminPermission = $adminPermission->where('is_menu', $where['is_menu']);
        }
        if (!empty($where['name'])) {
            $adminPermission = $adminPermission->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $adminPermission = $adminPermission->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['path'])) {
            $adminPermission = $adminPermission->where('path', $where['path']);
        }
        if (!empty($where['sort'])) {
            $adminPermission = $adminPermission->where('sort', $where['sort']);
        }

        return $adminPermission->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $adminPermission = AdminPermission::where('id', $id)->first();
        if ($adminPermission == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $adminPermission;
    }

    public static function add(array $where = [])
    {

        $adminPermission = new AdminPermission();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['component']) && $adminPermission->component = $where['component'];
        isset($where['hidden']) && $adminPermission->hidden = $where['hidden'];
        isset($where['icon']) && $adminPermission->icon = $where['icon'];
        isset($where['is_menu']) && $adminPermission->is_menu = $where['is_menu'];
        isset($where['name']) && $adminPermission->name = $where['name'];
        isset($where['parent_id']) && $adminPermission->parent_id = $where['parent_id'];
        isset($where['path']) && $adminPermission->path = $where['path'];
        isset($where['sort']) && $adminPermission->sort = $where['sort'];


        $res = $adminPermission->save();
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
        $adminPermission = AdminPermission::where('id', $where['id'])->first();
        if ($adminPermission == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['component']) && $adminPermission->component = $where['component'];
        isset($where['hidden']) && $adminPermission->hidden = $where['hidden'];
        isset($where['icon']) && $adminPermission->icon = $where['icon'];
        isset($where['is_menu']) && $adminPermission->is_menu = $where['is_menu'];
        isset($where['name']) && $adminPermission->name = $where['name'];
        isset($where['parent_id']) && $adminPermission->parent_id = $where['parent_id'];
        isset($where['path']) && $adminPermission->path = $where['path'];
        isset($where['sort']) && $adminPermission->sort = $where['sort'];


        $res = $adminPermission->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $son = AdminPermission::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $adminPermission = AdminPermission::where('id', $id)->first();
        if ($adminPermission == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $adminPermission->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
