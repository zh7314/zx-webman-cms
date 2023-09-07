<?php

namespace app\service\Admin;

use app\model\BannerCate;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class BannerCateService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $bannerCate = new BannerCate();

        if (!empty($where['name'])) {
            $bannerCate = $bannerCate->where('name', $where['name']);
        }
        if (!empty($where['is_show'])) {
            $bannerCate = $bannerCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['sort'])) {
            $bannerCate = $bannerCate->where('sort', $where['sort']);
        }
        if (!empty($where['pic'])) {
            $bannerCate = $bannerCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $bannerCate = $bannerCate->where('platform', $where['platform']);
        }
        if (!empty($where['lang'])) {
            $bannerCate = $bannerCate->where('lang', $where['lang']);
        }
        if (!empty($where['parent_id'])) {
            $bannerCate = $bannerCate->where('parent_id', $where['parent_id']);
        }

        $count = $bannerCate->count();

        if ($page > 0 && $pageSize > 0) {
            $bannerCate = $bannerCate->forPage($page, $pageSize);
        }

        $list = $bannerCate->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $bannerCate = new BannerCate();

        if (!empty($where['name'])) {
            $bannerCate = $bannerCate->where('name', $where['name']);
        }
        if (!empty($where['is_show'])) {
            $bannerCate = $bannerCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['sort'])) {
            $bannerCate = $bannerCate->where('sort', $where['sort']);
        }
        if (!empty($where['pic'])) {
            $bannerCate = $bannerCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $bannerCate = $bannerCate->where('platform', $where['platform']);
        }
        if (!empty($where['lang'])) {
            $bannerCate = $bannerCate->where('lang', $where['lang']);
        }
        if (!empty($where['parent_id'])) {
            $bannerCate = $bannerCate->where('parent_id', $where['parent_id']);
        }

        return $bannerCate->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $bannerCate = BannerCate::where('id', $id)->first();
        if ($bannerCate == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $bannerCate;
    }

    public static function add(array $where = [])
    {

        $bannerCate = new BannerCate();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['name']) && $bannerCate->name = $where['name'];
        isset($where['is_show']) && $bannerCate->is_show = $where['is_show'];
        isset($where['sort']) && $bannerCate->sort = $where['sort'];
        isset($where['pic']) && $bannerCate->pic = $where['pic'];
        isset($where['platform']) && $bannerCate->platform = $where['platform'];
        isset($where['lang']) && $bannerCate->lang = $where['lang'];
        isset($where['parent_id']) && $bannerCate->parent_id = $where['parent_id'];


        $res = $bannerCate->save();
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
        $bannerCate = BannerCate::where('id', $where['id'])->first();
        if ($bannerCate == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['name']) && $bannerCate->name = $where['name'];
        isset($where['is_show']) && $bannerCate->is_show = $where['is_show'];
        isset($where['sort']) && $bannerCate->sort = $where['sort'];
        isset($where['pic']) && $bannerCate->pic = $where['pic'];
        isset($where['platform']) && $bannerCate->platform = $where['platform'];
        isset($where['lang']) && $bannerCate->lang = $where['lang'];
        isset($where['parent_id']) && $bannerCate->parent_id = $where['parent_id'];


        $res = $bannerCate->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $bannerCate = BannerCate::where('id', $id)->first();
        if ($bannerCate == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $bannerCate->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
