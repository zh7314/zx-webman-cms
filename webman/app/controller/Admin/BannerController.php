<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\BannerService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'float', 0);
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic_path'] = parameterCheck($request->input('pic_path'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_path'] = parameterCheck($request->input('video_path'), 'string', '');
            $where['banner_cate_id'] = parameterCheck($request->input('banner_cate_id'), 'float', 0);

            $data = BannerService::getList($where, $page, $pageSize);

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
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic_path'] = parameterCheck($request->input('pic_path'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_path'] = parameterCheck($request->input('video_path'), 'string', '');

            $data = BannerService::getAll($where);

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

            $data = BannerService::getOne($where['id']);

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
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic_path'] = parameterCheck($request->input('pic_path'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_path'] = parameterCheck($request->input('video_path'), 'string', '');
            $where['banner_cate_id'] = parameterCheck($request->input('banner_cate_id'), 'float', 0);

            $data = BannerService::add($where);

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
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic_path'] = parameterCheck($request->input('pic_path'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_path'] = parameterCheck($request->input('video_path'), 'string', '');
            $where['banner_cate_id'] = parameterCheck($request->input('banner_cate_id'), 'float', 0);

            $data = BannerService::save($where);

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
            $data = BannerService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
