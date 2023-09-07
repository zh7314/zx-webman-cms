<?php

namespace app\service\Admin;

use app\model\DownloadCate;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class DownloadCateService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $downloadCate = new DownloadCate();

        if (!empty($where['is_show'])) {
            $downloadCate = $downloadCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $downloadCate = $downloadCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $downloadCate = $downloadCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $downloadCate = $downloadCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['pic'])) {
            $downloadCate = $downloadCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $downloadCate = $downloadCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $downloadCate = $downloadCate->where('sort', $where['sort']);
        }

        $count = $downloadCate->count();

        if ($page > 0 && $pageSize > 0) {
            $downloadCate = $downloadCate->forPage($page, $pageSize);
        }

        $list = $downloadCate->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $downloadCate = new DownloadCate();

        if (!empty($where['is_show'])) {
            $downloadCate = $downloadCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $downloadCate = $downloadCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $downloadCate = $downloadCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $downloadCate = $downloadCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['pic'])) {
            $downloadCate = $downloadCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $downloadCate = $downloadCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $downloadCate = $downloadCate->where('sort', $where['sort']);
        }

        return $downloadCate->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $downloadCate = DownloadCate::where('id', $id)->first();
        if ($downloadCate == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $downloadCate;
    }

    public static function add(array $where = [])
    {

        $downloadCate = new DownloadCate();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['is_show']) && $downloadCate->is_show = $where['is_show'];
        isset($where['lang']) && $downloadCate->lang = $where['lang'];
        isset($where['name']) && $downloadCate->name = $where['name'];
        isset($where['parent_id']) && $downloadCate->parent_id = $where['parent_id'];
        isset($where['pic']) && $downloadCate->pic = $where['pic'];
        isset($where['platform']) && $downloadCate->platform = $where['platform'];
        isset($where['sort']) && $downloadCate->sort = $where['sort'];


        $res = $downloadCate->save();
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
        $downloadCate = DownloadCate::where('id', $where['id'])->first();
        if ($downloadCate == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['is_show']) && $downloadCate->is_show = $where['is_show'];
        isset($where['lang']) && $downloadCate->lang = $where['lang'];
        isset($where['name']) && $downloadCate->name = $where['name'];
        isset($where['parent_id']) && $downloadCate->parent_id = $where['parent_id'];
        isset($where['pic']) && $downloadCate->pic = $where['pic'];
        isset($where['platform']) && $downloadCate->platform = $where['platform'];
        isset($where['sort']) && $downloadCate->sort = $where['sort'];


        $res = $downloadCate->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        //如果有这个id为parent_id的就不能删除

        $son = DownloadCate::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $downloadCate = DownloadCate::where('id', $id)->first();
        if ($downloadCate == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $downloadCate->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
