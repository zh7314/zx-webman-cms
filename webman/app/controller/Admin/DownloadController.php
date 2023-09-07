<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\DownloadService;
use Throwable;
use app\util\ResponseTrait;
use Illuminate\Support\Facades\DB;


class DownloadController 
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['download_cate_id'] = parameterCheck($request->input('download_cate_id'), 'float', 0);
            $where['introduction'] = parameterCheck($request->input('introduction'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = DownloadService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['download_cate_id'] = parameterCheck($request->input('download_cate_id'), 'float', 0);
            $where['introduction'] = parameterCheck($request->input('introduction'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');


            $data = DownloadService::getAll($where);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getOne(Request $request)
    {
        try {
            $where = [];

            $where['id'] = parameterCheck($request->id, 'int', 0);

            $data = DownloadService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['download_cate_id'] = parameterCheck($request->input('download_cate_id'), 'float', 0);
            $where['introduction'] = parameterCheck($request->input('introduction'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = DownloadService::add($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['download_cate_id'] = parameterCheck($request->input('download_cate_id'), 'float', 0);
            $where['introduction'] = parameterCheck($request->input('introduction'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['path'] = parameterCheck($request->input('path'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');

            $data = DownloadService::save($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request)
    {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $data = DownloadService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
