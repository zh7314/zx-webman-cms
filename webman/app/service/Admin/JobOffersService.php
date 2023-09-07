<?php

namespace app\service\Admin;

use app\model\JobOffers;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class JobOffersService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $jobOffers = new JobOffers();

        if (!empty($where['content'])) {
            $jobOffers = $jobOffers->where('content', $where['content']);
        }
        if (!empty($where['is_show'])) {
            $jobOffers = $jobOffers->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $jobOffers = $jobOffers->where('lang', $where['lang']);
        }
        if (!empty($where['number'])) {
            $jobOffers = $jobOffers->where('number', $where['number']);
        }
        if (!empty($where['place'])) {
            $jobOffers = $jobOffers->where('place', $where['place']);
        }
        if (!empty($where['platform'])) {
            $jobOffers = $jobOffers->where('platform', $where['platform']);
        }
        if (!empty($where['salary_range'])) {
            $jobOffers = $jobOffers->where('salary_range', $where['salary_range']);
        }
        if (!empty($where['sort'])) {
            $jobOffers = $jobOffers->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $jobOffers = $jobOffers->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $jobOffers = $jobOffers->where('url', $where['url']);
        }

        $count = $jobOffers->count();

        if ($page > 0 && $pageSize > 0) {
            $jobOffers = $jobOffers->forPage($page, $pageSize);
        }

        $list = $jobOffers->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $jobOffers = new JobOffers();

        if (!empty($where['content'])) {
            $jobOffers = $jobOffers->where('content', $where['content']);
        }
        if (!empty($where['is_show'])) {
            $jobOffers = $jobOffers->where('is_show', $where['is_show']);
        }
        if (!empty($where['lang'])) {
            $jobOffers = $jobOffers->where('lang', $where['lang']);
        }
        if (!empty($where['number'])) {
            $jobOffers = $jobOffers->where('number', $where['number']);
        }
        if (!empty($where['place'])) {
            $jobOffers = $jobOffers->where('place', $where['place']);
        }
        if (!empty($where['platform'])) {
            $jobOffers = $jobOffers->where('platform', $where['platform']);
        }
        if (!empty($where['salary_range'])) {
            $jobOffers = $jobOffers->where('salary_range', $where['salary_range']);
        }
        if (!empty($where['sort'])) {
            $jobOffers = $jobOffers->where('sort', $where['sort']);
        }
        if (!empty($where['title'])) {
            $jobOffers = $jobOffers->where('title', $where['title']);
        }
        if (!empty($where['url'])) {
            $jobOffers = $jobOffers->where('url', $where['url']);
        }

        return $jobOffers->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $jobOffers = JobOffers::where('id', $id)->first();
        if ($jobOffers == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $jobOffers;
    }

    public static function add(array $where = [])
    {

        $jobOffers = new JobOffers();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['content']) && $jobOffers->content = $where['content'];
        isset($where['is_show']) && $jobOffers->is_show = $where['is_show'];
        isset($where['lang']) && $jobOffers->lang = $where['lang'];
        isset($where['number']) && $jobOffers->number = $where['number'];
        isset($where['place']) && $jobOffers->place = $where['place'];
        isset($where['platform']) && $jobOffers->platform = $where['platform'];
        isset($where['salary_range']) && $jobOffers->salary_range = $where['salary_range'];
        isset($where['sort']) && $jobOffers->sort = $where['sort'];
        isset($where['title']) && $jobOffers->title = $where['title'];
        isset($where['url']) && $jobOffers->url = $where['url'];


        $res = $jobOffers->save();
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
        $jobOffers = JobOffers::where('id', $where['id'])->first();
        if ($jobOffers == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['content']) && $jobOffers->content = $where['content'];
        isset($where['is_show']) && $jobOffers->is_show = $where['is_show'];
        isset($where['lang']) && $jobOffers->lang = $where['lang'];
        isset($where['number']) && $jobOffers->number = $where['number'];
        isset($where['place']) && $jobOffers->place = $where['place'];
        isset($where['platform']) && $jobOffers->platform = $where['platform'];
        isset($where['salary_range']) && $jobOffers->salary_range = $where['salary_range'];
        isset($where['sort']) && $jobOffers->sort = $where['sort'];
        isset($where['title']) && $jobOffers->title = $where['title'];
        isset($where['url']) && $jobOffers->url = $where['url'];


        $res = $jobOffers->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $jobOffers = JobOffers::where('id', $id)->first();
        if ($jobOffers == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $jobOffers->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
