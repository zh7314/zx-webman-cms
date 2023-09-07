<?php

namespace app\service\Admin;

use app\model\Banner;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class BannerService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $banner = Banner::with(['banner_cate']);

        if (!empty($where['admin_id'])) {
            $banner = $banner->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['end_time'])) {
            $banner = $banner->where('end_time', $where['end_time']);
        }
        if (!empty($where['lang'])) {
            $banner = $banner->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $banner = $banner->where('name', $where['name']);
        }
        if (!empty($where['pic_path'])) {
            $banner = $banner->where('pic_path', $where['pic_path']);
        }
        if (!empty($where['platform'])) {
            $banner = $banner->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $banner = $banner->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $banner = $banner->where('start_time', $where['start_time']);
        }
        if (!empty($where['url'])) {
            $banner = $banner->where('url', $where['url']);
        }
        if (!empty($where['video_path'])) {
            $banner = $banner->where('video_path', $where['video_path']);
        }
        if (!empty($where['banner_cate_id'])) {
            $banner = $banner->where('banner_cate_id', $where['banner_cate_id']);
        }

        $count = $banner->count();

        if ($page > 0 && $pageSize > 0) {
            $banner = $banner->forPage($page, $pageSize);
        }

        $list = $banner->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $banner = new Banner();

        if (!empty($where['admin_id'])) {
            $banner = $banner->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['end_time'])) {
            $banner = $banner->where('end_time', $where['end_time']);
        }
        if (!empty($where['lang'])) {
            $banner = $banner->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $banner = $banner->where('name', $where['name']);
        }
        if (!empty($where['pic_path'])) {
            $banner = $banner->where('pic_path', $where['pic_path']);
        }
        if (!empty($where['platform'])) {
            $banner = $banner->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $banner = $banner->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $banner = $banner->where('start_time', $where['start_time']);
        }
        if (!empty($where['url'])) {
            $banner = $banner->where('url', $where['url']);
        }
        if (!empty($where['video_path'])) {
            $banner = $banner->where('video_path', $where['video_path']);
        }

        return $banner->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $banner = Banner::where('id', $id)->first();
        if ($banner == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $banner;
    }

    public static function add(array $where = [])
    {

        $banner = new Banner();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $banner->admin_id = $where['admin_id'];
        isset($where['end_time']) && $banner->end_time = $where['end_time'];
        isset($where['lang']) && $banner->lang = $where['lang'];
        isset($where['name']) && $banner->name = $where['name'];
        isset($where['pic_path']) && $banner->pic_path = $where['pic_path'];
        isset($where['platform']) && $banner->platform = $where['platform'];
        isset($where['sort']) && $banner->sort = $where['sort'];
        isset($where['start_time']) && $banner->start_time = $where['start_time'];
        isset($where['url']) && $banner->url = $where['url'];
        isset($where['video_path']) && $banner->video_path = $where['video_path'];
        isset($where['banner_cate_id']) && $banner->banner_cate_id = $where['banner_cate_id'];

        $res = $banner->save();
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
        $banner = Banner::where('id', $where['id'])->first();
        if ($banner == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $banner->admin_id = $where['admin_id'];
        isset($where['end_time']) && $banner->end_time = $where['end_time'];
        isset($where['lang']) && $banner->lang = $where['lang'];
        isset($where['name']) && $banner->name = $where['name'];
        isset($where['pic_path']) && $banner->pic_path = $where['pic_path'];
        isset($where['platform']) && $banner->platform = $where['platform'];
        isset($where['sort']) && $banner->sort = $where['sort'];
        isset($where['start_time']) && $banner->start_time = $where['start_time'];
        isset($where['url']) && $banner->url = $where['url'];
        isset($where['video_path']) && $banner->video_path = $where['video_path'];
        isset($where['banner_cate_id']) && $banner->banner_cate_id = $where['banner_cate_id'];

        $res = $banner->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $banner = Banner::where('id', $id)->first();
        if ($banner == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $banner->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
