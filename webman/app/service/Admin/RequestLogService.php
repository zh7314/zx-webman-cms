<?php

namespace app\service\Admin;

use app\model\RequestLog;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class RequestLogService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $requestLog = new RequestLog();

        if (!empty($where['method'])) {
            $requestLog = $requestLog->where('method', $where['method']);
        }
        if (!empty($where['ip'])) {
            $requestLog = $requestLog->where('ip', $where['ip']);
        }
        if (!empty($where['url'])) {
            $requestLog = $requestLog->where('url', $where['url']);
        }
        if (!empty($where['params'])) {
            $requestLog = $requestLog->where('params', $where['params']);
        }
        if (!empty($where['header'])) {
            $requestLog = $requestLog->where('header', $where['header']);
        }
        if (!empty($where['data'])) {
            $requestLog = $requestLog->where('data', $where['data']);
        }
        if (!empty($where['return_at'])) {
            $requestLog = $requestLog->where('return_at', $where['return_at']);
        }
        if (!empty($where['time']['0'])) {
            $requestLog = $requestLog->where('create_at', '>=', $where['time']['0']);
        }
        if (!empty($where['time']['1'])) {
            $requestLog = $requestLog->where('create_at', '<=', $where['time']['1']);
        }

        $count = $requestLog->count();

        if ($page > 0 && $pageSize > 0) {
            $requestLog = $requestLog->forPage($page, $pageSize);
        }

        $list = $requestLog->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $requestLog = new RequestLog();

        if (!empty($where['method'])) {
            $requestLog = $requestLog->where('method', $where['method']);
        }
        if (!empty($where['ip'])) {
            $requestLog = $requestLog->where('ip', $where['ip']);
        }
        if (!empty($where['url'])) {
            $requestLog = $requestLog->where('url', $where['url']);
        }
        if (!empty($where['params'])) {
            $requestLog = $requestLog->where('params', $where['params']);
        }
        if (!empty($where['header'])) {
            $requestLog = $requestLog->where('header', $where['header']);
        }
        if (!empty($where['data'])) {
            $requestLog = $requestLog->where('data', $where['data']);
        }
        if (!empty($where['return_at'])) {
            $requestLog = $requestLog->where('return_at', $where['return_at']);
        }

        return $requestLog->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $requestLog = RequestLog::where('id', $id)->first();
        if ($requestLog == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $requestLog;
    }

    public static function add(array $where = [])
    {

        $requestLog = new RequestLog();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['method']) && $requestLog->method = $where['method'];
        isset($where['ip']) && $requestLog->ip = $where['ip'];
        isset($where['url']) && $requestLog->url = $where['url'];
        isset($where['params']) && $requestLog->params = $where['params'];
        isset($where['header']) && $requestLog->header = $where['header'];
        isset($where['data']) && $requestLog->data = $where['data'];
        isset($where['return_at']) && $requestLog->return_at = $where['return_at'];


        $res = $requestLog->save();
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
        $requestLog = RequestLog::where('id', $where['id'])->first();
        if ($requestLog == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['method']) && $requestLog->method = $where['method'];
        isset($where['ip']) && $requestLog->ip = $where['ip'];
        isset($where['url']) && $requestLog->url = $where['url'];
        isset($where['params']) && $requestLog->params = $where['params'];
        isset($where['header']) && $requestLog->header = $where['header'];
        isset($where['data']) && $requestLog->data = $where['data'];
        isset($where['return_at']) && $requestLog->return_at = $where['return_at'];


        $res = $requestLog->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $requestLog = RequestLog::where('id', $id)->first();
        if ($requestLog == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $requestLog->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
