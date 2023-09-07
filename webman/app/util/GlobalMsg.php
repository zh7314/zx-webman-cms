<?php


namespace app\util;


interface GlobalMsg
{
    const SUCCESS = '操作成功';
    const FAIL = '操作失败';
    const GRANT = '需要授权';
    //业务逻辑常用的一些消息
    const ADD_ID = '添加数据不建议直接传主键id';
    const SAVE_NO_ID = '缺少编辑数据的主键id';
    const SAVE_HAS_NO = '待编辑数据为空或者被删除';
    const DEL_HAS_NO = '数据已经被删除';
    const GET_HAS_NO = '数据不存在';

    const SAVE_FAIL = '保存失败';
}
