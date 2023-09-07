<?php

namespace app\service\Admin;

use app\model\AdminGroup;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class AdminGroupService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $adminGroup = new AdminGroup();

        if (!empty($where['name'])) {
            $adminGroup = $adminGroup->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $adminGroup = $adminGroup->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['permission_ids'])) {
            $adminGroup = $adminGroup->where('permission_ids', $where['permission_ids']);
        }
        if (!empty($where['sort'])) {
            $adminGroup = $adminGroup->where('sort', $where['sort']);
        }

        $count = $adminGroup->count();

        if ($page > 0 && $pageSize > 0) {
            $adminGroup = $adminGroup->forPage($page, $pageSize);
        }

        $list = $adminGroup->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $adminGroup = new AdminGroup();

        if (!empty($where['name'])) {
            $adminGroup = $adminGroup->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $adminGroup = $adminGroup->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['permission_ids'])) {
            $adminGroup = $adminGroup->where('permission_ids', $where['permission_ids']);
        }
        if (!empty($where['sort'])) {
            $adminGroup = $adminGroup->where('sort', $where['sort']);
        }

        return $adminGroup->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $adminGroup = AdminGroup::where('id', $id)->first();
        if ($adminGroup == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $adminGroup;
    }

    public static function add(array $where = [])
    {

        $adminGroup = new AdminGroup();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['name']) && $adminGroup->name = $where['name'];
        isset($where['parent_id']) && $adminGroup->parent_id = $where['parent_id'];
        isset($where['permission_ids']) && $adminGroup->permission_ids = $where['permission_ids'];
        isset($where['sort']) && $adminGroup->sort = $where['sort'];


        $res = $adminGroup->save();
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
        $adminGroup = AdminGroup::where('id', $where['id'])->first();
        if ($adminGroup == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['name']) && $adminGroup->name = $where['name'];
        isset($where['parent_id']) && $adminGroup->parent_id = $where['parent_id'];
        isset($where['permission_ids']) && $adminGroup->permission_ids = $where['permission_ids'];
        isset($where['sort']) && $adminGroup->sort = $where['sort'];


        $res = $adminGroup->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        //如果有这个id为parent_id的就不能删除

        $son = AdminGroup::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $adminGroup = AdminGroup::where('id', $id)->first();
        if ($adminGroup == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $adminGroup->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
