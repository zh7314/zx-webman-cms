<?php

namespace app\controller\Admin;

use support\Request;
use app\service\Admin\ProductService;
use Throwable;
use app\util\ResponseTrait;
use support\Db;


class ProductController 
{

    use ResponseTrait;

    public function getList(Request $request)
    {
        try {
            $where = [];
            $page = parameterCheck($request->page, 'int', 0);
            $pageSize = parameterCheck($request->pageSize, 'int', 0);

            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['product_cate_id'] = parameterCheck($request->input('product_cate_id'), 'int', 0);
            $where['short_title'] = parameterCheck($request->input('short_title'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_url'] = parameterCheck($request->input('video_url'), 'string', '');
            $where['view_count'] = parameterCheck($request->input('view_count'), 'int', 0);

            $data = ProductService::getList($where, $page, $pageSize);

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
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['product_cate_id'] = parameterCheck($request->input('product_cate_id'), 'int', 0);
            $where['short_title'] = parameterCheck($request->input('short_title'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_url'] = parameterCheck($request->input('video_url'), 'string', '');
            $where['view_count'] = parameterCheck($request->input('view_count'), 'int', 0);


            $data = ProductService::getAll($where);

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

            $data = ProductService::getOne($where['id']);

            return $this->success($data);
        } catch (Throwable $e) {
            return $this->fail($e);
        }
    }

    public function add(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['product_cate_id'] = parameterCheck($request->input('product_cate_id'), 'int', 0);
            $where['short_title'] = parameterCheck($request->input('short_title'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_url'] = parameterCheck($request->input('video_url'), 'string', '');
            $where['view_count'] = parameterCheck($request->input('view_count'), 'int', 0);

            $data = ProductService::add($where);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

    public function save(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $where['admin_id'] = parameterCheck($request->input('admin_id'), 'int', 0);
            $where['content'] = parameterCheck($request->input('content'), 'string', '');
            $where['end_time'] = parameterCheck($request->input('end_time'), 'string', '');
            $where['is_show'] = parameterCheck($request->input('is_show'), 'int', 0);
            $where['lang'] = parameterCheck($request->input('lang'), 'string', '');
            $where['pic'] = parameterCheck($request->input('pic'), 'string', '');
            $where['pics'] = parameterCheck($request->input('pics'), 'string', '');
            $where['platform'] = parameterCheck($request->input('platform'), 'string', '');
            $where['product_cate_id'] = parameterCheck($request->input('product_cate_id'), 'int', 0);
            $where['short_title'] = parameterCheck($request->input('short_title'), 'string', '');
            $where['sort'] = parameterCheck($request->input('sort'), 'int', 0);
            $where['start_time'] = parameterCheck($request->input('start_time'), 'string', '');
            $where['title'] = parameterCheck($request->input('title'), 'string', '');
            $where['url'] = parameterCheck($request->input('url'), 'string', '');
            $where['video_url'] = parameterCheck($request->input('video_url'), 'string', '');
            $where['view_count'] = parameterCheck($request->input('view_count'), 'int', 0);

            $data = ProductService::save($where);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

    public function delete(Request $request)
    {

        Db::beginTransaction();
        try {
            $where = [];
            $where['id'] = parameterCheck($request->id, 'int', 0);
            $data = ProductService::delete($where['id']);

            Db::commit();
            return $this->success($data);
        } catch (Throwable $e) {
            Db::rollBack();
            return $this->fail($e);
        }
    }

}
