<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\FriendLinkService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FriendLinkController extends Controller{

    use ResponseTrait;

    public function getList(Request $request) {
        try {
            $where = [];
            $page = parameterCheck($request->page,'int',0);
            $pageSize = parameterCheck($request->pageSize,'int',0);

            $where['is_follow']= parameterCheck($request->input('is_follow'),'int',0);
$where['is_show']= parameterCheck($request->input('is_show'),'int',0);
$where['lang']= parameterCheck($request->input('lang'),'string','');
$where['pic']= parameterCheck($request->input('pic'),'string','');
$where['platform']= parameterCheck($request->input('platform'),'string','');
$where['sort']= parameterCheck($request->input('sort'),'int',0);
$where['title']= parameterCheck($request->input('title'),'string','');
$where['url']= parameterCheck($request->input('url'),'string','');

            $data = FriendLinkService::getList($where,$page,$pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request) {
        try {
            $where = [];

            $where['is_follow']= parameterCheck($request->input('is_follow'),'int',0);
$where['is_show']= parameterCheck($request->input('is_show'),'int',0);
$where['lang']= parameterCheck($request->input('lang'),'string','');
$where['pic']= parameterCheck($request->input('pic'),'string','');
$where['platform']= parameterCheck($request->input('platform'),'string','');
$where['sort']= parameterCheck($request->input('sort'),'int',0);
$where['title']= parameterCheck($request->input('title'),'string','');
$where['url']= parameterCheck($request->input('url'),'string','');


            $data = FriendLinkService::getAll($where);

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

            $data = FriendLinkService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['is_follow']= parameterCheck($request->input('is_follow'),'int',0);
$where['is_show']= parameterCheck($request->input('is_show'),'int',0);
$where['lang']= parameterCheck($request->input('lang'),'string','');
$where['pic']= parameterCheck($request->input('pic'),'string','');
$where['platform']= parameterCheck($request->input('platform'),'string','');
$where['sort']= parameterCheck($request->input('sort'),'int',0);
$where['title']= parameterCheck($request->input('title'),'string','');
$where['url']= parameterCheck($request->input('url'),'string','');

            $data = FriendLinkService::add($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id']= parameterCheck($request->id,'int',0);
            $where['is_follow']= parameterCheck($request->input('is_follow'),'int',0);
$where['is_show']= parameterCheck($request->input('is_show'),'int',0);
$where['lang']= parameterCheck($request->input('lang'),'string','');
$where['pic']= parameterCheck($request->input('pic'),'string','');
$where['platform']= parameterCheck($request->input('platform'),'string','');
$where['sort']= parameterCheck($request->input('sort'),'int',0);
$where['title']= parameterCheck($request->input('title'),'string','');
$where['url']= parameterCheck($request->input('url'),'string','');

            $data = FriendLinkService::save($where);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['id']= parameterCheck($request->id,'int',0);
            $data = FriendLinkService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
