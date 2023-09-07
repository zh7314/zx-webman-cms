<?php

namespace app\service\Admin;

use app\model\FriendLink;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class FriendLinkService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $friendLink = new FriendLink();

        if (!empty($where['is_follow'])) {
            $friendLink = $friendLink->where('is_follow', $where['is_follow']);
        }
        if (!empty($where['is_show'])) {
            $friendLink = $friendLink->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $friendLink = $friendLink->where('lang', $where['lang']);
        }
        if (!empty($where['pic'])) {
            $friendLink = $friendLink->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $friendLink = $friendLink->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $friendLink = $friendLink->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $friendLink = $friendLink->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $friendLink = $friendLink->where('url', $where['url']);
        }

        $count = $friendLink->count();

        if ($page > 0 && $pageSize > 0) {
            $friendLink = $friendLink->forPage($page, $pageSize);
        }

        $list = $friendLink->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $friendLink = new FriendLink();

        if (!empty($where['is_follow'])) {
            $friendLink = $friendLink->where('is_follow', $where['is_follow']);
        }
        if (!empty($where['is_show'])) {
            $friendLink = $friendLink->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $friendLink = $friendLink->where('lang', $where['lang']);
        }
        if (!empty($where['pic'])) {
            $friendLink = $friendLink->where('pic', $where['pic']);
        }
        if (!empty($where['platform'])) {
            $friendLink = $friendLink->where('platform', $where['platform']);
        }
        if (!empty($where['sort'])) {
            $friendLink = $friendLink->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $friendLink = $friendLink->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $friendLink = $friendLink->where('url', $where['url']);
        }

        return $friendLink->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $friendLink = FriendLink::where('id', $id)->first();
        if ($friendLink == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $friendLink;
    }

    public static function add(array $where = [])
    {

        $friendLink = new FriendLink();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['is_follow']) && $friendLink->is_follow = $where['is_follow'];
        isset($where['is_show']) && $friendLink->is_show = $where['is_show'];
        isset($where['lang']) && $friendLink->lang = $where['lang'];
        isset($where['pic']) && $friendLink->pic = $where['pic'];
        isset($where['platform']) && $friendLink->platform = $where['platform'];
        isset($where['sort']) && $friendLink->sort = $where['sort'];
        isset($where['title']) && $friendLink->title = $where['title'];
        isset($where['url']) && $friendLink->url = $where['url'];


        $res = $friendLink->save();
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
        $friendLink = FriendLink::where('id', $where['id'])->first();
        if ($friendLink == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['is_follow']) && $friendLink->is_follow = $where['is_follow'];
        isset($where['is_show']) && $friendLink->is_show = $where['is_show'];
        isset($where['lang']) && $friendLink->lang = $where['lang'];
        isset($where['pic']) && $friendLink->pic = $where['pic'];
        isset($where['platform']) && $friendLink->platform = $where['platform'];
        isset($where['sort']) && $friendLink->sort = $where['sort'];
        isset($where['title']) && $friendLink->title = $where['title'];
        isset($where['url']) && $friendLink->url = $where['url'];


        $res = $friendLink->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $friendLink = FriendLink::where('id', $id)->first();
        if ($friendLink == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $friendLink->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
