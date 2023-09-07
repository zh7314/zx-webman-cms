<?php

namespace app\service\Admin;

use app\model\ProductCate;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class ProductCateService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $productCate = new ProductCate();

        if (!empty($where['description'])) {
            $productCate = $productCate->where('description', $where['description']);
        }
        if (!empty($where['is_show'])) {
            $productCate = $productCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $productCate = $productCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $productCate = $productCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $productCate = $productCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['pic'])) {
            $productCate = $productCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $productCate = $productCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $productCate = $productCate->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $productCate = $productCate->where('url', $where['url']);
        }

        $count = $productCate->count();

        if ($page > 0 && $pageSize > 0) {
            $productCate = $productCate->forPage($page, $pageSize);
        }

        $list = $productCate->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $productCate = new ProductCate();

        if (!empty($where['description'])) {
            $productCate = $productCate->where('description', $where['description']);
        }
        if (!empty($where['is_show'])) {
            $productCate = $productCate->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $productCate = $productCate->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $productCate = $productCate->where('name', $where['name']);
        }
        if (!empty($where['parent_id'])) {
            $productCate = $productCate->where('parent_id', $where['parent_id']);
        }
        if (!empty($where['pic'])) {
            $productCate = $productCate->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $productCate = $productCate->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $productCate = $productCate->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $productCate = $productCate->where('url', $where['url']);
        }

        return $productCate->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $productCate = ProductCate::where('id', $id)->first();
        if ($productCate == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $productCate;
    }

    public static function add(array $where = [])
    {

        $productCate = new ProductCate();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['description']) && $productCate->description = $where['description'];
        isset($where['is_show']) && $productCate->is_show = $where['is_show'];
        isset($where['lang']) && $productCate->lang = $where['lang'];
        isset($where['name']) && $productCate->name = $where['name'];
        isset($where['parent_id']) && $productCate->parent_id = $where['parent_id'];
        isset($where['pic']) && $productCate->pic = $where['pic'];
        isset($where['platform']) && $productCate->platform = $where['platform'];
        isset($where['sort']) && $productCate->sort = $where['sort'];
        isset($where['url']) && $productCate->url = $where['url'];


        $res = $productCate->save();
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
        $productCate = ProductCate::where('id', $where['id'])->first();
        if ($productCate == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['description']) && $productCate->description = $where['description'];
        isset($where['is_show']) && $productCate->is_show = $where['is_show'];
        isset($where['lang']) && $productCate->lang = $where['lang'];
        isset($where['name']) && $productCate->name = $where['name'];
        isset($where['parent_id']) && $productCate->parent_id = $where['parent_id'];
        isset($where['pic']) && $productCate->pic = $where['pic'];
        isset($where['platform']) && $productCate->platform = $where['platform'];
        isset($where['sort']) && $productCate->sort = $where['sort'];
        isset($where['url']) && $productCate->url = $where['url'];


        $res = $productCate->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $son = ProductCate::where('parent_id', $id)->count();
        if ($son > 0) {
            throw new Exception('请先删除子节点');
        }

        $productCate = ProductCate::where('id', $id)->first();
        if ($productCate == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $productCate->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
