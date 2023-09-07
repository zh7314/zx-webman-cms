<?php

namespace app\service\Admin;

use App\Models\Feedback;
use Exception;
use App\util\GlobalCode;
use App\util\GlobalMsg;

class FeedbackService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $feedback = new Feedback();

        if (!empty($where['contact'])) {
            $feedback = $feedback->where('contact', $where['contact']);
        }
        if (!empty($where['content'])) {
            $feedback = $feedback->where('content', $where['content']);
        }
        if (!empty($where['lang'])) {
            $feedback = $feedback->where('lang', $where['lang']);
        }
        if (!empty($where['nick_name'])) {
            $feedback = $feedback->where('nick_name', $where['nick_name']);
        }
        if (!empty($where['platform'])) {
            $feedback = $feedback->where('platform', $where['platform']);
        }

        $count = $feedback->count();

        if ($page > 0 && $pageSize > 0) {
            $feedback = $feedback->forPage($page, $pageSize);
        }

        $list = $feedback->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $feedback = new Feedback();

        if (!empty($where['contact'])) {
            $feedback = $feedback->where('contact', $where['contact']);
        }
        if (!empty($where['content'])) {
            $feedback = $feedback->where('content', $where['content']);
        }
        if (!empty($where['lang'])) {
            $feedback = $feedback->where('lang', $where['lang']);
        }
        if (!empty($where['nick_name'])) {
            $feedback = $feedback->where('nick_name', $where['nick_name']);
        }
        if (!empty($where['platform'])) {
            $feedback = $feedback->where('platform', $where['platform']);
        }

        return $feedback->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $feedback = Feedback::where('id', $id)->first();
        if ($feedback == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $feedback;
    }

    public static function add(array $where = [])
    {

        $feedback = new Feedback();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['contact']) && $feedback->contact = $where['contact'];
        isset($where['content']) && $feedback->content = $where['content'];
        isset($where['lang']) && $feedback->lang = $where['lang'];
        isset($where['nick_name']) && $feedback->nick_name = $where['nick_name'];
        isset($where['platform']) && $feedback->platform = $where['platform'];


        $res = $feedback->save();
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
        $feedback = Feedback::where('id', $where['id'])->first();
        if ($feedback == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['contact']) && $feedback->contact = $where['contact'];
        isset($where['content']) && $feedback->content = $where['content'];
        isset($where['lang']) && $feedback->lang = $where['lang'];
        isset($where['nick_name']) && $feedback->nick_name = $where['nick_name'];
        isset($where['platform']) && $feedback->platform = $where['platform'];


        $res = $feedback->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $feedback = Feedback::where('id', $id)->first();
        if ($feedback == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $feedback->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
