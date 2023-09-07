<?php

namespace app\service\Admin;

use app\model\Video;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class VideoService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $video = Video::with(['video_cate']);

        if (!empty($where['admin_id'])) {
            $video = $video->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['count'])) {
            $video = $video->where('count', $where['count']);
        }
        if (!empty($where['file'])) {
            $video = $video->where('file', $where['file']);
        }
        if (!empty($where['introduce'])) {
            $video = $video->where('introduce', $where['introduce']);
        }
        if (!empty($where['is_local'])) {
            $video = $video->where('is_local', $where['is_local']);
        }
        if (!empty($where['is_show'])) {
            $video = $video->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $video = $video->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $video = $video->where('name', $where['name']);
        }
        if (!empty($where['pic'])) {
            $video = $video->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $video = $video->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $video = $video->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $video = $video->where('url', $where['url']);
        }
        if (!empty($where['video_cate_id'])) {
            $video = $video->where('video_cate_id', $where['video_cate_id']);
        }

        $count = $video->count();

        if ($page > 0 && $pageSize > 0) {
            $video = $video->forPage($page, $pageSize);
        }

        $list = $video->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $video = new Video();

        if (!empty($where['admin_id'])) {
            $video = $video->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['count'])) {
            $video = $video->where('count', $where['count']);
        }
        if (!empty($where['file'])) {
            $video = $video->where('file', $where['file']);
        }
        if (!empty($where['introduce'])) {
            $video = $video->where('introduce', $where['introduce']);
        }
        if (!empty($where['is_local'])) {
            $video = $video->where('is_local', $where['is_local']);
        }
        if (!empty($where['is_show'])) {
            $video = $video->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $video = $video->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $video = $video->where('name', $where['name']);
        }
        if (!empty($where['pic'])) {
            $video = $video->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $video = $video->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $video = $video->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $video = $video->where('url', $where['url']);
        }
        if (!empty($where['video_cate_id'])) {
            $video = $video->where('video_cate_id', $where['video_cate_id']);
        }

        return $video->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $video = Video::where('id', $id)->first();
        if ($video == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $video;
    }

    public static function add(array $where = [])
    {

        $video = new Video();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $video->admin_id = $where['admin_id'];
        isset($where['count']) && $video->count = $where['count'];
        isset($where['file']) && $video->file = $where['file'];
        isset($where['introduce']) && $video->introduce = $where['introduce'];
        isset($where['is_local']) && $video->is_local = $where['is_local'];
        isset($where['is_show']) && $video->is_show = $where['is_show'];
        isset($where['lang']) && $video->lang = $where['lang'];
        isset($where['name']) && $video->name = $where['name'];
        isset($where['pic']) && $video->pic = $where['pic'];
        isset($where['platform']) && $video->platform = $where['platform'];
        isset($where['sort']) && $video->sort = $where['sort'];
        isset($where['url']) && $video->url = $where['url'];
        isset($where['video_cate_id']) && $video->video_cate_id = $where['video_cate_id'];


        $res = $video->save();
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
        $video = Video::where('id', $where['id'])->first();
        if ($video == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $video->admin_id = $where['admin_id'];
        isset($where['count']) && $video->count = $where['count'];
        isset($where['file']) && $video->file = $where['file'];
        isset($where['introduce']) && $video->introduce = $where['introduce'];
        isset($where['is_local']) && $video->is_local = $where['is_local'];
        isset($where['is_show']) && $video->is_show = $where['is_show'];
        isset($where['lang']) && $video->lang = $where['lang'];
        isset($where['name']) && $video->name = $where['name'];
        isset($where['pic']) && $video->pic = $where['pic'];
        isset($where['platform']) && $video->platform = $where['platform'];
        isset($where['sort']) && $video->sort = $where['sort'];
        isset($where['url']) && $video->url = $where['url'];
        isset($where['video_cate_id']) && $video->video_cate_id = $where['video_cate_id'];


        $res = $video->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $video = Video::where('id', $id)->first();
        if ($video == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $video->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
