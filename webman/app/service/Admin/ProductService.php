<?php

namespace app\service\Admin;

use app\model\Product;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class ProductService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $product = Product::with(['product_cate']);

        if (!empty($where['admin_id'])) {
            $product = $product->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['content'])) {
            $product = $product->where('content', $where['content']);
        }
        if (!empty($where['end_time'])) {
            $product = $product->where('end_time', $where['end_time']);
        }
        if (!empty($where['is_show'])) {
            $product = $product->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $product = $product->where('lang', $where['lang']);
        }
        if (!empty($where['pic'])) {
            $product = $product->where('pic', $where['pic']);
        }
        if (!empty($where['pics'])) {
            $product = $product->where('pics', $where['pics']);
        }
        if (!empty($where['platform'])) {
            $product = $product->where('platform', $where['platform']);
        }
        if (!empty($where['product_cate_id'])) {
            $product = $product->where('product_cate_id', $where['product_cate_id']);
        }
        if (!empty($where['short_title'])) {
            $product = $product->where('short_title', $where['short_title']);
        }
        if (!empty($where['sort'])) {
            $product = $product->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $product = $product->where('start_time', $where['start_time']);
        }
        if (!empty($where['title'])) {
            $product = $product->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $product = $product->where('url', $where['url']);
        }
        if (!empty($where['video_url'])) {
            $product = $product->where('video_url', $where['video_url']);
        }
        if (!empty($where['view_count'])) {
            $product = $product->where('view_count', $where['view_count']);
        }

        $count = $product->count();

        if ($page > 0 && $pageSize > 0) {
            $product = $product->forPage($page, $pageSize);
        }

        $list = $product->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $product = new Product();

        if (!empty($where['admin_id'])) {
            $product = $product->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['content'])) {
            $product = $product->where('content', $where['content']);
        }
        if (!empty($where['end_time'])) {
            $product = $product->where('end_time', $where['end_time']);
        }
        if (!empty($where['is_show'])) {
            $product = $product->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $product = $product->where('lang', $where['lang']);
        }
        if (!empty($where['pic'])) {
            $product = $product->where('pic', $where['pic']);
        }
        if (!empty($where['pics'])) {
            $product = $product->where('pics', $where['pics']);
        }
        if (!empty($where['platform'])) {
            $product = $product->where('platform', $where['platform']);
        }
        if (!empty($where['product_cate_id'])) {
            $product = $product->where('product_cate_id', $where['product_cate_id']);
        }
        if (!empty($where['short_title'])) {
            $product = $product->where('short_title', $where['short_title']);
        }
        if (!empty($where['sort'])) {
            $product = $product->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $product = $product->where('start_time', $where['start_time']);
        }
        if (!empty($where['title'])) {
            $product = $product->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $product = $product->where('url', $where['url']);
        }
        if (!empty($where['video_url'])) {
            $product = $product->where('video_url', $where['video_url']);
        }
        if (!empty($where['view_count'])) {
            $product = $product->where('view_count', $where['view_count']);
        }

        return $product->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $product = Product::where('id', $id)->first();
        if ($product == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $product;
    }

    public static function add(array $where = [])
    {

        $product = new Product();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $product->admin_id = $where['admin_id'];
        isset($where['content']) && $product->content = $where['content'];
        isset($where['end_time']) && $product->end_time = $where['end_time'];
        isset($where['is_show']) && $product->is_show = $where['is_show'];
        isset($where['lang']) && $product->lang = $where['lang'];
        isset($where['pic']) && $product->pic = $where['pic'];
        isset($where['pics']) && $product->pics = $where['pics'];
        isset($where['platform']) && $product->platform = $where['platform'];
        isset($where['product_cate_id']) && $product->product_cate_id = $where['product_cate_id'];
        isset($where['short_title']) && $product->short_title = $where['short_title'];
        isset($where['sort']) && $product->sort = $where['sort'];
        isset($where['start_time']) && $product->start_time = $where['start_time'];
        isset($where['title']) && $product->title = $where['title'];
        isset($where['url']) && $product->url = $where['url'];
        isset($where['video_url']) && $product->video_url = $where['video_url'];
        isset($where['view_count']) && $product->view_count = $where['view_count'];


        $res = $product->save();
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
        $product = Product::where('id', $where['id'])->first();
        if ($product == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $product->admin_id = $where['admin_id'];
        isset($where['content']) && $product->content = $where['content'];
        isset($where['end_time']) && $product->end_time = $where['end_time'];
        isset($where['is_show']) && $product->is_show = $where['is_show'];
        isset($where['lang']) && $product->lang = $where['lang'];
        isset($where['pic']) && $product->pic = $where['pic'];
        isset($where['pics']) && $product->pics = $where['pics'];
        isset($where['platform']) && $product->platform = $where['platform'];
        isset($where['product_cate_id']) && $product->product_cate_id = $where['product_cate_id'];
        isset($where['short_title']) && $product->short_title = $where['short_title'];
        isset($where['sort']) && $product->sort = $where['sort'];
        isset($where['start_time']) && $product->start_time = $where['start_time'];
        isset($where['title']) && $product->title = $where['title'];
        isset($where['url']) && $product->url = $where['url'];
        isset($where['video_url']) && $product->video_url = $where['video_url'];
        isset($where['view_count']) && $product->view_count = $where['view_count'];


        $res = $product->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $product = Product::where('id', $id)->first();
        if ($product == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $product->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
