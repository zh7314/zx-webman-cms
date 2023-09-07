<?php

namespace app\service\Admin;

use app\model\AdminLog;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class AdminLogService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $adminLog = new AdminLog();

        if (!empty($where['admin_id'])) {
            $adminLog = $adminLog->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['admin_name'])) {
            $adminLog = $adminLog->where('admin_name', $where['admin_name']);
        }
        if (!empty($where['data'])) {
            $adminLog = $adminLog->where('data', $where['data']);
        }
        if (!empty($where['method'])) {
            $adminLog = $adminLog->where('method', $where['method']);
        }
        if (!empty($where['path'])) {
            $adminLog = $adminLog->where('path', $where['path']);
        }
        if (!empty($where['request_ip'])) {
            $adminLog = $adminLog->where('request_ip', $where['request_ip']);
        }
        if (!empty($where['route_desc'])) {
            $adminLog = $adminLog->where('route_desc', $where['route_desc']);
        }
        if (!empty($where['route_name'])) {
            $adminLog = $adminLog->where('route_name', $where['route_name']);
        }
        if (!empty($where['url'])) {
            $adminLog = $adminLog->where('url', $where['url']);
        }
        if (!empty($where['time']['0'])) {
            $adminLog = $adminLog->where('create_at', '>=', $where['time']['0']);
        }
        if (!empty($where['time']['1'])) {
            $adminLog = $adminLog->where('create_at', '<=', $where['time']['1']);
        }

        $count = $adminLog->count();

        if ($page > 0 && $pageSize > 0) {
            $adminLog = $adminLog->forPage($page, $pageSize);
        }

        $list = $adminLog->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $adminLog = new AdminLog();

        if (!empty($where['admin_id'])) {
            $adminLog = $adminLog->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['admin_name'])) {
            $adminLog = $adminLog->where('admin_name', $where['admin_name']);
        }
        if (!empty($where['data'])) {
            $adminLog = $adminLog->where('data', $where['data']);
        }
        if (!empty($where['method'])) {
            $adminLog = $adminLog->where('method', $where['method']);
        }
        if (!empty($where['path'])) {
            $adminLog = $adminLog->where('path', $where['path']);
        }
        if (!empty($where['request_ip'])) {
            $adminLog = $adminLog->where('request_ip', $where['request_ip']);
        }
        if (!empty($where['route_desc'])) {
            $adminLog = $adminLog->where('route_desc', $where['route_desc']);
        }
        if (!empty($where['route_name'])) {
            $adminLog = $adminLog->where('route_name', $where['route_name']);
        }
        if (!empty($where['url'])) {
            $adminLog = $adminLog->where('url', $where['url']);
        }

        return $adminLog->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $adminLog = AdminLog::where('id', $id)->first();
        if ($adminLog == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $adminLog;
    }

    public static function add(array $where = [])
    {

        $adminLog = new AdminLog();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $adminLog->admin_id = $where['admin_id'];
        isset($where['admin_name']) && $adminLog->admin_name = $where['admin_name'];
        isset($where['data']) && $adminLog->data = $where['data'];
        isset($where['method']) && $adminLog->method = $where['method'];
        isset($where['path']) && $adminLog->path = $where['path'];
        isset($where['request_ip']) && $adminLog->request_ip = $where['request_ip'];
        isset($where['route_desc']) && $adminLog->route_desc = $where['route_desc'];
        isset($where['route_name']) && $adminLog->route_name = $where['route_name'];
        isset($where['url']) && $adminLog->url = $where['url'];


        $res = $adminLog->save();
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
        $adminLog = AdminLog::where('id', $where['id'])->first();
        if ($adminLog == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $adminLog->admin_id = $where['admin_id'];
        isset($where['admin_name']) && $adminLog->admin_name = $where['admin_name'];
        isset($where['data']) && $adminLog->data = $where['data'];
        isset($where['method']) && $adminLog->method = $where['method'];
        isset($where['path']) && $adminLog->path = $where['path'];
        isset($where['request_ip']) && $adminLog->request_ip = $where['request_ip'];
        isset($where['route_desc']) && $adminLog->route_desc = $where['route_desc'];
        isset($where['route_name']) && $adminLog->route_name = $where['route_name'];
        isset($where['url']) && $adminLog->url = $where['url'];


        $res = $adminLog->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $adminLog = AdminLog::where('id', $id)->first();
        if ($adminLog == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $adminLog->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
