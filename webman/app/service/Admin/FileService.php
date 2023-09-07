<?php

namespace app\service\Admin;

use app\model\File;
use Exception;
use app\util\GlobalCode;
use app\util\GlobalMsg;

class FileService
{

    public static function getList(array $where = [], int $page = 0, int $pageSize = 0)
    {
        $file = new File();

        if (!empty($where['admin_id'])) {
            $file = $file->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['file_name'])) {
            $file = $file->where('file_name', $where['file_name']);
        }
        if (!empty($where['file_path'])) {
            $file = $file->where('file_path', $where['file_path']);
        }
        if (!empty($where['file_size'])) {
            $file = $file->where('file_size', $where['file_size']);
        }

        $count = $file->count();

        if ($page > 0 && $pageSize > 0) {
            $file = $file->forPage($page, $pageSize);
        }

        $list = $file->orderBy('id', 'desc')->get()->toArray();

        return ['count' => $count, 'list' => $list];
    }

    public static function getAll(array $where = [])
    {
        $file = new File();

        if (!empty($where['admin_id'])) {
            $file = $file->where('admin_id', $where['admin_id']);
        }
        if (!empty($where['file_name'])) {
            $file = $file->where('file_name', $where['file_name']);
        }
        if (!empty($where['file_path'])) {
            $file = $file->where('file_path', $where['file_path']);
        }
        if (!empty($where['file_size'])) {
            $file = $file->where('file_size', $where['file_size']);
        }

        return $file->orderBy('id', 'desc')->get()->toArray();
    }

    public static function getOne(int $id = 0)
    {
        $file = File::where('id', $id)->first();
        if ($file == null) {
            throw new Exception(GlobalMsg::GET_HAS_NO);
        }
        return $file;
    }

    public static function add(array $where = [])
    {

        $file = new File();
        if (!empty($where['id'])) {
            throw new Exception(GlobalMsg::ADD_ID);
        }
        isset($where['admin_id']) && $file->admin_id = $where['admin_id'];
        isset($where['file_name']) && $file->file_name = $where['file_name'];
        isset($where['file_path']) && $file->file_path = $where['file_path'];
        isset($where['file_size']) && $file->file_size = $where['file_size'];


        $res = $file->save();
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
        $file = File::where('id', $where['id'])->first();
        if ($file == null) {
            throw new Exception(GlobalMsg::SAVE_HAS_NO);
        }

        isset($where['admin_id']) && $file->admin_id = $where['admin_id'];
        isset($where['file_name']) && $file->file_name = $where['file_name'];
        isset($where['file_path']) && $file->file_path = $where['file_path'];
        isset($where['file_size']) && $file->file_size = $where['file_size'];


        $res = $file->save();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }

    public static function delete(int $id = 0)
    {
        $file = File::where('id', $id)->first();
        if ($file == null) {
            throw new Exception(GlobalMsg::DEL_HAS_NO);
        }
        $res = $file->delete();
        if ($res == false) {
            throw new Exception(GlobalMsg::SAVE_FAIL);
        }
        return $res;
    }
}
