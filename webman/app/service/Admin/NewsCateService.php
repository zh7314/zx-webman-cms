<?php

namespace app\service\Admin;

use app\model\NewsCate;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class NewsCateService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $newsCate = new NewsCate();

        if (!empty($where['is_show'])) {
            $newsCate = $newsCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $newsCate = $newsCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $newsCate = $newsCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $newsCate = $newsCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['platform'])) {
            $newsCate = $newsCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $newsCate = $newsCate->where('sort', $where['sort']);
        }

        $count = $newsCate->count();

        if ($page > 0 && $pageSize > 0) {
            $newsCate = $newsCate->forPage($page, $pageSize);
        }

        $list = $newsCate->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $newsCate = new NewsCate();

        if (!empty($where['is_show'])) {
            $newsCate = $newsCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $newsCate = $newsCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $newsCate = $newsCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $newsCate = $newsCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['platform'])) {
            $newsCate = $newsCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $newsCate = $newsCate->where('sort', $where['sort']);
        }

        return $newsCate->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $newsCate = NewsCate::where('id', $id)->first();
        if ($newsCate == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $newsCate;
    }

    public static function add(array $where = [])
    {

        $newsCate = new NewsCate();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['is_show']) && $newsCate->is_show = $where['is_show'];
        isset($where['lang']) && $newsCate->lang = $where['lang'];
        isset($where['name']) && $newsCate->name = $where['name'];
        isset($where['parent_id']) && $newsCate->parent_id = $where['parent_id'];
        isset($where['platform']) && $newsCate->platform = $where['platform'];
        isset($where['sort']) && $newsCate->sort = $where['sort'];


        $res = $newsCate->save();
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
        $newsCate = NewsCate::where('id', $where['id'])->first();
        if ($newsCate == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['is_show']) && $newsCate->is_show = $where['is_show'];
        isset($where['lang']) && $newsCate->lang = $where['lang'];
        isset($where['name']) && $newsCate->name = $where['name'];
        isset($where['parent_id']) && $newsCate->parent_id = $where['parent_id'];
        isset($where['platform']) && $newsCate->platform = $where['platform'];
        isset($where['sort']) && $newsCate->sort = $where['sort'];


        $res = $newsCate->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $son = NewsCate::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $newsCate = NewsCate::where('id', $id)->first();
        if ($newsCate == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $newsCate->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
