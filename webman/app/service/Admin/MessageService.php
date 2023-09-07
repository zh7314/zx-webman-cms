<?php

namespace app\service\Admin;

use app\model\Message;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class MessageService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $message = new Message();

        if (!empty($where['content'])) {
            $message = $message->where('content', $where['content']);
        }
        if (!empty($where['email'])) {
            $message = $message->where('email', $where['email']);
        }
        if (!empty($where['ip'])) {
            $message = $message->where('ip', $where['ip']);
        }
        if (!empty($where['is_sent'])) {
            $message = $message->where('is_sent', $where['is_sent']);
        }
        if (!empty($where['mobile'])) {
            $message = $message->where('mobile', $where['mobile']);
        }
        if (!empty($where['pics'])) {
            $message = $message->where('pics', $where['pics']);
        }
        if (!empty($where['real_name'])) {
            $message = $message->where('real_name', $where['real_name']);
        }
        if (!empty($where['remark'])) {
            $message = $message->where('remark', $where['remark']);
        }
        if (!empty($where['status'])) {
            $message = $message->where('status', $where['status']);
        }
        if (!empty($where['title'])) {
            $message = $message->where('title', $where['title']);
        }
        if (!empty($where['type'])) {
            $message = $message->where('type', $where['type']);
        }

        $count = $message->count();

        if ($page > 0 && $pageSize > 0) {
            $message = $message->forPage($page, $pageSize);
        }

        $list = $message->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $message = new Message();

        if (!empty($where['content'])) {
            $message = $message->where('content', $where['content']);
        }
        if (!empty($where['email'])) {
            $message = $message->where('email', $where['email']);
        }
        if (!empty($where['ip'])) {
            $message = $message->where('ip', $where['ip']);
        }
        if (!empty($where['is_sent'])) {
            $message = $message->where('is_sent', $where['is_sent']);
        }
        if (!empty($where['mobile'])) {
            $message = $message->where('mobile', $where['mobile']);
        }
        if (!empty($where['pics'])) {
            $message = $message->where('pics', $where['pics']);
        }
        if (!empty($where['real_name'])) {
            $message = $message->where('real_name', $where['real_name']);
        }
        if (!empty($where['remark'])) {
            $message = $message->where('remark', $where['remark']);
        }
        if (!empty($where['status'])) {
            $message = $message->where('status', $where['status']);
        }
        if (!empty($where['title'])) {
            $message = $message->where('title', $where['title']);
        }
        if (!empty($where['type'])) {
            $message = $message->where('type', $where['type']);
        }

        return $message->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $message = Message::where('id', $id)->first();
        if ($message == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $message;
    }

    public static function add(array $where = [])
    {

        $message = new Message();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['content']) && $message->content = $where['content'];
        isset($where['email']) && $message->email = $where['email'];
        isset($where['ip']) && $message->ip = $where['ip'];
        isset($where['is_sent']) && $message->is_sent = $where['is_sent'];
        isset($where['mobile']) && $message->mobile = $where['mobile'];
        isset($where['pics']) && $message->pics = $where['pics'];
        isset($where['real_name']) && $message->real_name = $where['real_name'];
        isset($where['remark']) && $message->remark = $where['remark'];
        isset($where['status']) && $message->status = $where['status'];
        isset($where['title']) && $message->title = $where['title'];
        isset($where['type']) && $message->type = $where['type'];


        $res = $message->save();
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
        $message = Message::where('id', $where['id'])->first();
        if ($message == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['content']) && $message->content = $where['content'];
        isset($where['email']) && $message->email = $where['email'];
        isset($where['ip']) && $message->ip = $where['ip'];
        isset($where['is_sent']) && $message->is_sent = $where['is_sent'];
        isset($where['mobile']) && $message->mobile = $where['mobile'];
        isset($where['pics']) && $message->pics = $where['pics'];
        isset($where['real_name']) && $message->real_name = $where['real_name'];
        isset($where['remark']) && $message->remark = $where['remark'];
        isset($where['status']) && $message->status = $where['status'];
        isset($where['title']) && $message->title = $where['title'];
        isset($where['type']) && $message->type = $where['type'];


        $res = $message->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $message = Message::where('id', $id)->first();
        if ($message == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $message->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
