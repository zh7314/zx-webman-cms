<?php

namespace app\service\Admin;

use App\Models\Lang;
use Exception;
use App\util\GlobalCode;
use App\util\GlobalMsg;

class LangService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $lang = new Lang();

        if (!empty($where['name'])) {
            $lang = $lang->where('name', $where['name']);
        }
        if (!empty($where['sort'])) {
            $lang = $lang->where('sort', $where['sort']);
        }
        if (!empty($where['value'])) {
            $lang = $lang->where('value', $where['value']);
        }

        $count = $lang->count();

        if ($page > 0 && $pageSize > 0) {
            $lang = $lang->forPage($page, $pageSize);
        }

        $list = $lang->orderBy('sort', 'asc')->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $lang = new Lang();

        if (!empty($where['name'])) {
            $lang = $lang->where('name', $where['name']);
        }
        if (!empty($where['sort'])) {
            $lang = $lang->where('sort', $where['sort']);
        }
        if (!empty($where['value'])) {
            $lang = $lang->where('value', $where['value']);
        }

        return $lang->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $lang = Lang::where('id', $id)->first();
        if ($lang == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $lang;
    }

    public static function add(array $where = [])
    {

        $lang = new Lang();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['name']) && $lang->name = $where['name'];
        isset($where['sort']) && $lang->sort = $where['sort'];
        isset($where['value']) && $lang->value = $where['value'];


        $res = $lang->save();
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
        $lang = Lang::where('id', $where['id'])->first();
        if ($lang == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['name']) && $lang->name = $where['name'];
        isset($where['sort']) && $lang->sort = $where['sort'];
        isset($where['value']) && $lang->value = $where['value'];


        $res = $lang->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $lang = Lang::where('id', $id)->first();
        if ($lang == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $lang->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
