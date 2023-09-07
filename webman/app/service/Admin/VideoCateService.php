<?php

namespace app\service\Admin;

use app\model\VideoCate;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class VideoCateService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $videoCate = new VideoCate();

        if (!empty($where['is_show'])) {
            $videoCate = $videoCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $videoCate = $videoCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $videoCate = $videoCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $videoCate = $videoCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['platform'])) {
            $videoCate = $videoCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $videoCate = $videoCate->where('sort', $where['sort']);
        }

        $count = $videoCate->count();

        if ($page > 0 && $pageSize > 0) {
            $videoCate = $videoCate->forPage($page, $pageSize);
        }

        $list = $videoCate->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $videoCate = new VideoCate();

        if (!empty($where['is_show'])) {
            $videoCate = $videoCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $videoCate = $videoCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $videoCate = $videoCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $videoCate = $videoCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['platform'])) {
            $videoCate = $videoCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $videoCate = $videoCate->where('sort', $where['sort']);
        }

        return $videoCate->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $videoCate = VideoCate::where('id', $id)->first();
        if ($videoCate == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $videoCate;
    }

    public static function add(array $where = [])
    {

        $videoCate = new VideoCate();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['is_show']) && $videoCate->is_show = $where['is_show'];
        isset($where['lang']) && $videoCate->lang = $where['lang'];
        isset($where['name']) && $videoCate->name = $where['name'];
        isset($where['parent_id']) && $videoCate->parent_id = $where['parent_id'];
        isset($where['platform']) && $videoCate->platform = $where['platform'];
        isset($where['sort']) && $videoCate->sort = $where['sort'];


        $res = $videoCate->save();
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
        $videoCate = VideoCate::where('id', $where['id'])->first();
        if ($videoCate == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['is_show']) && $videoCate->is_show = $where['is_show'];
        isset($where['lang']) && $videoCate->lang = $where['lang'];
        isset($where['name']) && $videoCate->name = $where['name'];
        isset($where['parent_id']) && $videoCate->parent_id = $where['parent_id'];
        isset($where['platform']) && $videoCate->platform = $where['platform'];
        isset($where['sort']) && $videoCate->sort = $where['sort'];


        $res = $videoCate->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $son = VideoCate::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $videoCate = VideoCate::where('id', $id)->first();
        if ($videoCate == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $videoCate->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
