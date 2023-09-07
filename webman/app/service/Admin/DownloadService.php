<?php

namespace app\service\Admin;

use App\Models\Download;
use Exception;
use App\util\GlobalCode;
use App\util\GlobalMsg;

class DownloadService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $download = Download::with(['download_cate']);

        if (!empty($where['admin_id'])) {
            $download = $download->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['download_cate_id'])) {
            $download = $download->where('download_cate_id', $where['download_cate_id']);
        }
        if (!empty($where['introduction'])) {
            $download = $download->where('introduction', $where['introduction']);
        }
        if (!empty($where['is_local'])) {
            $download = $download->where('is_local', $where['is_local']);
        }
        if (!empty($where['is_show'])) {
            $download = $download->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $download = $download->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $download = $download->where('name', $where['name']);
        }
        if (!empty($where['path'])) {
            $download = $download->where('path', $where['path']);
        }
        if (!empty($where['pic'])) {
            $download = $download->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $download = $download->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $download = $download->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $download = $download->where('url', $where['url']);
        }

        $count = $download->count();

        if ($page > 0 && $pageSize > 0) {
            $download = $download->forPage($page, $pageSize);
        }

        $list = $download->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $download = new Download();

        if (!empty($where['admin_id'])) {
            $download = $download->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['download_cate_id'])) {
            $download = $download->where('download_cate_id', $where['download_cate_id']);
        }
        if (!empty($where['introduction'])) {
            $download = $download->where('introduction', $where['introduction']);
        }
        if (!empty($where['is_local'])) {
            $download = $download->where('is_local', $where['is_local']);
        }
        if (!empty($where['is_show'])) {
            $download = $download->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $download = $download->where('lang', $where['lang']);
        }
        if (!empty($where['name'])) {
            $download = $download->where('name', $where['name']);
        }
        if (!empty($where['path'])) {
            $download = $download->where('path', $where['path']);
        }
        if (!empty($where['pic'])) {
            $download = $download->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $download = $download->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $download = $download->where('sort', $where['sort']);
        }
        if (!empty($where['url'])) {
            $download = $download->where('url', $where['url']);
        }

        return $download->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $download = Download::where('id', $id)->first();
        if ($download == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $download;
    }

    public static function add(array $where = [])
    {

        $download = new Download();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $download->admin_id = $where['admin_id'];
        isset($where['download_cate_id']) && $download->download_cate_id = $where['download_cate_id'];
        isset($where['introduction']) && $download->introduction = $where['introduction'];
        isset($where['is_local']) && $download->is_local = $where['is_local'];
        isset($where['is_show']) && $download->is_show = $where['is_show'];
        isset($where['lang']) && $download->lang = $where['lang'];
        isset($where['name']) && $download->name = $where['name'];
        isset($where['path']) && $download->path = $where['path'];
        isset($where['pic']) && $download->pic = $where['pic'];
        isset($where['platform']) && $download->platform = $where['platform'];
        isset($where['sort']) && $download->sort = $where['sort'];
        isset($where['url']) && $download->url = $where['url'];


        $res = $download->save();
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
        $download = Download::where('id', $where['id'])->first();
        if ($download == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $download->admin_id = $where['admin_id'];
        isset($where['download_cate_id']) && $download->download_cate_id = $where['download_cate_id'];
        isset($where['introduction']) && $download->introduction = $where['introduction'];
        isset($where['is_local']) && $download->is_local = $where['is_local'];
        isset($where['is_show']) && $download->is_show = $where['is_show'];
        isset($where['lang']) && $download->lang = $where['lang'];
        isset($where['name']) && $download->name = $where['name'];
        isset($where['path']) && $download->path = $where['path'];
        isset($where['pic']) && $download->pic = $where['pic'];
        isset($where['platform']) && $download->platform = $where['platform'];
        isset($where['sort']) && $download->sort = $where['sort'];
        isset($where['url']) && $download->url = $where['url'];


        $res = $download->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $download = Download::where('id', $id)->first();
        if ($download == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $download->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
