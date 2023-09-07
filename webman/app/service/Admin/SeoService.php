<?php

namespace app\service\Admin;

use app\model\Seo;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class SeoService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $seo = new Seo();

        if (!empty($where['description'])) {
            $seo = $seo->where('description', $where['description']);
        }
        if (!empty($where['is_show'])) {
            $seo = $seo->where('is_show', $where['is_show']);
        }
        if (!empty($where['keyword'])) {
            $seo = $seo->where('keyword', $where['keyword']);
        }
        if (!empty($where['lang'])) {
            $seo = $seo->where('lang', $where['lang']);
        }
        if (!empty($where['platform'])) {
            $seo = $seo->where('platform', $where['platform']);
        }
        if (!empty($where['position'])) {
            $seo = $seo->where('position', $where['position']);
        }
        if (!empty($where['sort'])) {
            $seo = $seo->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $seo = $seo->where('title', $where['title']);
        }

        $count = $seo->count();

        if ($page > 0 && $pageSize > 0) {
            $seo = $seo->forPage($page, $pageSize);
        }

        $list = $seo->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $seo = new Seo();

        if (!empty($where['description'])) {
            $seo = $seo->where('description', $where['description']);
        }
        if (!empty($where['is_show'])) {
            $seo = $seo->where('is_show', $where['is_show']);
        }
        if (!empty($where['keyword'])) {
            $seo = $seo->where('keyword', $where['keyword']);
        }
        if (!empty($where['lang'])) {
            $seo = $seo->where('lang', $where['lang']);
        }
        if (!empty($where['platform'])) {
            $seo = $seo->where('platform', $where['platform']);
        }
        if (!empty($where['position'])) {
            $seo = $seo->where('position', $where['position']);
        }
        if (!empty($where['sort'])) {
            $seo = $seo->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $seo = $seo->where('title', $where['title']);
        }

        return $seo->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $seo = Seo::where('id', $id)->first();
        if ($seo == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $seo;
    }

    public static function add(array $where = [])
    {

        $seo = new Seo();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['description']) && $seo->description = $where['description'];
        isset($where['is_show']) && $seo->is_show = $where['is_show'];
        isset($where['keyword']) && $seo->keyword = $where['keyword'];
        isset($where['lang']) && $seo->lang = $where['lang'];
        isset($where['platform']) && $seo->platform = $where['platform'];
        isset($where['position']) && $seo->position = $where['position'];
        isset($where['sort']) && $seo->sort = $where['sort'];
        isset($where['title']) && $seo->title = $where['title'];


        $res = $seo->save();
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
        $seo = Seo::where('id', $where['id'])->first();
        if ($seo == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['description']) && $seo->description = $where['description'];
        isset($where['is_show']) && $seo->is_show = $where['is_show'];
        isset($where['keyword']) && $seo->keyword = $where['keyword'];
        isset($where['lang']) && $seo->lang = $where['lang'];
        isset($where['platform']) && $seo->platform = $where['platform'];
        isset($where['position']) && $seo->position = $where['position'];
        isset($where['sort']) && $seo->sort = $where['sort'];
        isset($where['title']) && $seo->title = $where['title'];


        $res = $seo->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $seo = Seo::where('id', $id)->first();
        if ($seo == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $seo->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
