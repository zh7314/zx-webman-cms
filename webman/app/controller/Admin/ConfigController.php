<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\ConfigService;
use Throwable;
use App\util\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConfigController extends Controller{

    use ResponseTrait;

    public function getList(Request $request) {
        try {
            $where = [];
            $page = parameterCheck($request->page,'int',0);
            $pageSize = parameterCheck($request->pageSize,'int',0);

            $where['name']= parameterCheck($request->input('name'),'string','');
$where['value']= parameterCheck($request->input('value'),'string','');

            $data = ConfigService::getList($where,$page,$pageSize);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function getAll(Request $request) {
        try {
            $where = [];

            $where['name']= parameterCheck($request->input('name'),'string','');
$where['value']= parameterCheck($request->input('value'),'string','');


            $data = ConfigService::getAll($where);

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

            $data = ConfigService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request) {

        DB::beginTransaction();
        try {
            $where = [];
            $where['name']= parameterCheck($request->input('name'),'string','');
$where['value']= parameterCheck($request->input('value'),'string','');

            $data = ConfigService::add($where);

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
            $where['name']= parameterCheck($request->input('name'),'string','');
$where['value']= parameterCheck($request->input('value'),'string','');

            $data = ConfigService::save($where);

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
            $data = ConfigService::delete($where['id']);

            DB::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->fail($e);
        }
    }

}
