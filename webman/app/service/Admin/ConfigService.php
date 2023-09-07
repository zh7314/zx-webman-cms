<?php

namespace app\service\Admin;

use App\Models\Config;
use Exception;
use App\util\GlobalCode;
use App\util\GlobalMsg;

class ConfigService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $config = new Config();

        if (!empty($where['name'])) {
            $config = $config->where('name', $where['name']);
        }
        if (!empty($where['value'])) {
            $config = $config->where('value', $where['value']);
        }

        $count = $config->count();

        if ($page > 0 && $pageSize > 0) {
            $config = $config->forPage($page, $pageSize);
        }

        $list = $config->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $config = new Config();

        if (!empty($where['name'])) {
            $config = $config->where('name', $where['name']);
        }
        if (!empty($where['value'])) {
            $config = $config->where('value', $where['value']);
        }

        return $config->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $config = Config::where('id', $id)->first();
        if ($config == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $config;
    }

    public static function add(array $where = [])
    {

        $config = new Config();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['name']) && $config->name = $where['name'];
        isset($where['value']) && $config->value = $where['value'];


        $res = $config->save();
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
        $config = Config::where('id', $where['id'])->first();
        if ($config == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['name']) && $config->name = $where['name'];
        isset($where['value']) && $config->value = $where['value'];


        $res = $config->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $config = Config::where('id', $id)->first();
        if ($config == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $config->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
