<?php

namespace app\service\Admin;

use app\model\Platform;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class PlatformService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $platform = new Platform();

        if (!empty($where['sort'])) {
            $platform = $platform->where('sort', $where['sort']);
        }
        if (!empty($where['name'])) {
            $platform = $platform->where('name', $where['name']);
        }
        if (!empty($where['value'])) {
            $platform = $platform->where('value', $where['value']);
        }

        $count = $platform->count();

        if ($page > 0 && $pageSize > 0) {
            $platform = $platform->forPage($page, $pageSize);
        }

        $list = $platform->orderBy('sort', 'asc')->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $platform = new Platform();

        if (!empty($where['sort'])) {
            $platform = $platform->where('sort', $where['sort']);
        }
        if (!empty($where['name'])) {
            $platform = $platform->where('name', $where['name']);
        }
        if (!empty($where['value'])) {
            $platform = $platform->where('value', $where['value']);
        }

        return $platform->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $platform = Platform::where('id', $id)->first();
        if ($platform == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $platform;
    }

    public static function add(array $where = [])
    {

        $platform = new Platform();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['sort']) && $platform->sort = $where['sort'];
        isset($where['name']) && $platform->name = $where['name'];
        isset($where['value']) && $platform->value = $where['value'];


        $res = $platform->save();
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
        $platform = Platform::where('id', $where['id'])->first();
        if ($platform == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['sort']) && $platform->sort = $where['sort'];
        isset($where['name']) && $platform->name = $where['name'];
        isset($where['value']) && $platform->value = $where['value'];


        $res = $platform->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $platform = Platform::where('id', $id)->first();
        if ($platform == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $platform->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
