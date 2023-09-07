<?php

namespace app\service\Admin;

use app\model\News;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class NewsService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $news = News::with(['news_cate']);

        if (!empty($where['count'])) {
            $news = $news->where('count', $where['count']);
        }
        if (!empty($where['end_time'])) {
            $news = $news->where('end_time', $where['end_time']);
        }
        if (!empty($where['is_show'])) {
            $news = $news->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $news = $news->where('lang', $where['lang']);
        }
        if (!empty($where['news_cate_id'])) {
            $news = $news->where('news_cate_id', $where['news_cate_id']);
        }
        if (!empty($where['pic'])) {
            $news = $news->where('pic', $where['pic']);
        }
        if (!empty($where['pics'])) {
            $news = $news->where('pics', $where['pics']);
        }
        if (!empty($where['platform'])) {
            $news = $news->where('platform', $where['platform']);
        }
        if (!empty($where['seo_description'])) {
            $news = $news->where('seo_description', $where['seo_description']);
        }
        if (!empty($where['seo_keyword'])) {
            $news = $news->where('seo_keyword', $where['seo_keyword']);
        }
        if (!empty($where['seo_title'])) {
            $news = $news->where('seo_title', $where['seo_title']);
        }
        if (!empty($where['short_title'])) {
            $news = $news->where('short_title', $where['short_title']);
        }
        if (!empty($where['sort'])) {
            $news = $news->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $news = $news->where('start_time', $where['start_time']);
        }
        if (!empty($where['title'])) {
            $news = $news->where('title', $where['title']);
        }

        $count = $news->count();

        if ($page > 0 && $pageSize > 0) {
            $news = $news->forPage($page, $pageSize);
        }

        $list = $news->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $news = new News();

        if (!empty($where['count'])) {
            $news = $news->where('count', $where['count']);
        }
        if (!empty($where['end_time'])) {
            $news = $news->where('end_time', $where['end_time']);
        }
        if (!empty($where['is_show'])) {
            $news = $news->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $news = $news->where('lang', $where['lang']);
        }
        if (!empty($where['news_cate_id'])) {
            $news = $news->where('news_cate_id', $where['news_cate_id']);
        }
        if (!empty($where['pic'])) {
            $news = $news->where('pic', $where['pic']);
        }
        if (!empty($where['pics'])) {
            $news = $news->where('pics', $where['pics']);
        }
        if (!empty($where['platform'])) {
            $news = $news->where('platform', $where['platform']);
        }
        if (!empty($where['seo_description'])) {
            $news = $news->where('seo_description', $where['seo_description']);
        }
        if (!empty($where['seo_keyword'])) {
            $news = $news->where('seo_keyword', $where['seo_keyword']);
        }
        if (!empty($where['seo_title'])) {
            $news = $news->where('seo_title', $where['seo_title']);
        }
        if (!empty($where['short_title'])) {
            $news = $news->where('short_title', $where['short_title']);
        }
        if (!empty($where['sort'])) {
            $news = $news->where('sort', $where['sort']);
        }
        if (!empty($where['start_time'])) {
            $news = $news->where('start_time', $where['start_time']);
        }
        if (!empty($where['title'])) {
            $news = $news->where('title', $where['title']);
        }

        return $news->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $news = News::where('id', $id)->first();
        if ($news == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $news;
    }

    public static function add(array $where = [])
    {

        $news = new News();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $news->admin_id = $where['admin_id'];
        isset($where['content']) && $news->content = $where['content'];
        isset($where['count']) && $news->count = $where['count'];
        isset($where['end_time']) && $news->end_time = $where['end_time'];
        isset($where['is_show']) && $news->is_show = $where['is_show'];
        isset($where['lang']) && $news->lang = $where['lang'];
        isset($where['news_cate_id']) && $news->news_cate_id = $where['news_cate_id'];
        isset($where['pic']) && $news->pic = $where['pic'];
        isset($where['pics']) && $news->pics = $where['pics'];
        isset($where['platform']) && $news->platform = $where['platform'];
        isset($where['seo_description']) && $news->seo_description = $where['seo_description'];
        isset($where['seo_keyword']) && $news->seo_keyword = $where['seo_keyword'];
        isset($where['seo_title']) && $news->seo_title = $where['seo_title'];
        isset($where['short_title']) && $news->short_title = $where['short_title'];
        isset($where['sort']) && $news->sort = $where['sort'];
        isset($where['start_time']) && $news->start_time = $where['start_time'];
        isset($where['title']) && $news->title = $where['title'];


        $res = $news->save();
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
        $news = News::where('id', $where['id'])->first();
        if ($news == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $news->admin_id = $where['admin_id'];
        isset($where['content']) && $news->content = $where['content'];
        isset($where['count']) && $news->count = $where['count'];
        isset($where['end_time']) && $news->end_time = $where['end_time'];
        isset($where['is_show']) && $news->is_show = $where['is_show'];
        isset($where['lang']) && $news->lang = $where['lang'];
        isset($where['news_cate_id']) && $news->news_cate_id = $where['news_cate_id'];
        isset($where['pic']) && $news->pic = $where['pic'];
        isset($where['pics']) && $news->pics = $where['pics'];
        isset($where['platform']) && $news->platform = $where['platform'];
        isset($where['seo_description']) && $news->seo_description = $where['seo_description'];
        isset($where['seo_keyword']) && $news->seo_keyword = $where['seo_keyword'];
        isset($where['seo_title']) && $news->seo_title = $where['seo_title'];
        isset($where['short_title']) && $news->short_title = $where['short_title'];
        isset($where['sort']) && $news->sort = $where['sort'];
        isset($where['start_time']) && $news->start_time = $where['start_time'];
        isset($where['title']) && $news->title = $where['title'];


        $res = $news->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $news = News::where('id', $id)->first();
        if ($news == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $news->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
