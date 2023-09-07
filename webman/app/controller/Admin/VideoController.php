<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\VideoService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['count'] = parameterCheck($request->input('count'), 'int', 0);
            $where['file'] = parameterCheck($request->input('file'), 'string', '');
            $where['introduce'] = parameterCheck($request->input('introduce'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_cate_id'] = parameterCheck($request->input('video_cate_id'), 'float', 0);

            $data = VideoService::getList($where, $page, $pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $where = [];

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['count'] = parameterCheck($request->input('count'), 'int', 0);
            $where['file'] = parameterCheck($request->input('file'), 'string', '');
            $where['introduce'] = parameterCheck($request->input('introduce'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_cate_id'] = parameterCheck($request->input('video_cate_id'), 'float', 0);


            $data = VideoService::getAll($where);

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

            $data = VideoService::getOne($where['id']);

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
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['count'] = parameterCheck($request->input('count'), 'int', 0);
            $where['file'] = parameterCheck($request->input('file'), 'string', '');
            $where['introduce'] = parameterCheck($request->input('introduce'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_cate_id'] = parameterCheck($request->input('video_cate_id'), 'float', 0);

            $data = VideoService::add($where);

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
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['count'] = parameterCheck($request->input('count'), 'int', 0);
            $where['file'] = parameterCheck($request->input('file'), 'string', '');
            $where['introduce'] = parameterCheck($request->input('introduce'), 'string', '');
            $where['is_local'] = parameterCheck($request->input('is_local'), 'int', 0);
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['name'] = parameterCheck($request->input('name'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_cate_id'] = parameterCheck($request->input('video_cate_id'), 'float', 0);

            $data = VideoService::save($where);

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
            $data = VideoService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
