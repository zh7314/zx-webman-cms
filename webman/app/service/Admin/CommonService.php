<?php

namespace app\service\Admin;


use app\model\Admin;
use app\model\AdminGroup;
use app\model\AdminPermission;
use app\model\BannerCate;
use app\model\DownloadCate;
use app\model\NewsCate;
use app\model\ProductCate;
use app\model\VideoCate;
use Exception;
use app\util\GlobalCode;
use ZX\Tools\File\SecurityCheck;
use ZX\Tools\File\MimeTypes;
use webman\Http\UploadFile;

class CommonService
{
    //公共url
    protected static $allowUrl = ['/api/admin/main', '/api/admin/login', '/api/admin/main', '/api/admin/logout', '/api/admin/upload', '/api/admin/adminPermission/getMenu', '/api/admin/adminPermission/getPermissionTree', '/api/admin/getInfo'];

    //获取菜单数据
    public static function getMenu(int $adminId = 0, int $isAdmin = 10)
    {
        if (empty($adminId)) {
            throw new Exception('管理员ID为空');
        }
        $field = array('id', 'parent_id', 'name', 'path', 'icon', 'is_menu', 'component', 'hidden');
        $permission = AdminPermission::where('is_menu', 10)->orderBy('sort', 'asc')->orderBy('id', 'asc')->get($field)->toArray();

        if (empty($permission)) {
            return [];
        }
        //获取菜单树数组
        $menu = self::treeMenu($permission);
        //店铺管理员或者超级管理员都有全部权限
        if ($isAdmin == 10) {
            return $menu;
        } else {
            return self::filterMenu($menu, $adminId);
        }
    }

    //过滤菜单，只做到3层过滤，超过4层不支持，第三层作为具体菜单层
    public static function filterMenu(array $menu = [], int $adminId = 0)
    {
        $permission = self::getCurrentAdminPermission($adminId);
        if (empty($permission)) {
            //如果在 admin_group  admin_permission  admin 三表关系有问题查询会有问题，就会返回false，就直接返回空，没有菜单
            return null;
        }

        foreach ($menu as $k => &$v) {
            if (!empty($v['children'])) {
                foreach ($v['children'] as $kk => &$vv) {

                    if (!in_array($vv['id'], $permission)) {
                        if (empty($vv['children'])) {
                            unset($menu[$k]['children'][$kk]);
                        }
                    }
                    if (empty($v['children'])) {
                        unset($menu[$k]);
                    }
                }
            }
        }
//        p($permission);
//        pp($menu);
        return $menu;
    }

    //获取当前用户的权限ID集合数组
    public static function getCurrentAdminPermission(int $adminId = 0, bool $father = true)
    {
        $admin = Admin::where('id', $adminId)->first(['admin_group_ids']);
        if ($admin == null) {
            return null;
        }
        if (empty($admin->admin_group_ids)) {
            return null;
        }

        $adminGroup = AdminGroup::whereIn('id', $admin->admin_group_ids)->get(['permission_ids'])->toArray();
        if (empty($adminGroup)) {
            throw new Exception('系统权限组设置有问题');
        }
        //合并 permission_ids 在做查询，减少查询，提高性能
        $permission_ids = [];
        foreach ($adminGroup as $k => &$v) {
            //空，unset防止出错
            if (empty($v['permission_ids'])) {
                unset($v);
            } else {
                foreach ($v['permission_ids'] as $kk => $vv) {
                    $permission_ids[] = $vv;
                }
            }
        }

        $ids_unique = array_unique($permission_ids);
        //防止数据出错
        $adminPermission = AdminPermission::whereIn('id', $ids_unique)->get(['id', 'parent_id'])->toArray();
        if (empty($adminPermission)) {
            throw new Exception('未获得权限数据');
        }

        $return_array = array();
        foreach ($adminPermission as $key => $value) {
            if ($father) {
                $return_array[] = $value['parent_id'];
            } else {
                $return_array[] = $value['id'];
            }
        }

        return array_unique($return_array);
    }

    //递归数据
    public static function treeMenu(array $menu = null, int $parent = 0, string $parentKey = 'parent_id')
    {
        $tree = array();
        foreach ($menu as $v) {
            if ($v[$parentKey] == $parent) {
                $v['children'] = self::treeMenu($menu, $v['id'], $parentKey);
                if (empty($v['children'])) {
                    unset($v['children']);
                }
                $tree[] = $v;
            }
        }
        return $tree;
    }

    //生成下拉菜单树数据
    public static function pullTree(array $arr = [], $parent = 0, string $parentKey = 'parent_id', int $level = 0, string $nameKey = 'name')
    {
        static $pullTree = [];
        foreach ($arr as $v) {
            if ($v[$parentKey] == $parent) {
                // 找到子节点
                $v['label'] = str_repeat("++++", $level) . $v[$nameKey];
                $pullTree[] = $v;
                //继续寻找当前下级
                self::pullTree($arr, $v['id'], $parentKey, $level + 1, $nameKey);
            }
        }
        return $pullTree;
    }

    /*
     * 注意超级管理员最好只有一个，可以通过更改store_id 登录所有的店铺后台，这个权限最好不要随便给，因为删除的权限给的都是ID=1的账号
     */

    public static function permissionCheck(int $adminId = 0, string $requestUrl = '')
    {
        $admin = Admin::where('id', $adminId)->first();
        if ($admin == null) {
            throw new Exception('管理员信息丢失，联系管理员');
        }
        if ($admin->is_admin !== 10) {
            if (!in_array($requestUrl, self::$allowUrl)) {
                //不在$allow_url，再查询在授权数据里面是否有
                $permission_ids_array = self::getCurrentAdminPermission($adminId, false);
                if (empty($permission_ids_array)) {
                    throw new Exception('没有权限1');
                } else {
                    $permissions = self::getPermissionUrl($permission_ids_array);

                    if (empty($permissions)) {
                        throw new Exception('没有权限2');
                    } else {
                        $resultArray = [];
                        foreach ($permissions as $k => $v) {
                            if (!empty($v['path'])) {
                                $resultArray[] = $v['path'];
                            }
                        }
                        $resultArray = array_unique($resultArray);
//                        p($requestUrl);
//                        pp($resultArray);
                        if (!in_array($requestUrl, $resultArray)) {
                            throw new Exception('没有权限3');
                        }
                    }
                }
            }
        }

    }

    //根据权限ids获取权限url数组
    public static function getPermissionUrl(array $idsArray = [])
    {
        return AdminPermission::whereIn('id', $idsArray)->get()->toArray();
    }

    //兼容
    public static function orderedArray(array $array = [])
    {
        foreach ($array as $k => &$v) {
            if (!empty($v['children'])) {
                foreach ($v['children'] as $kk => &$vv) {
                    if (!empty($vv['children'])) {
                        foreach ($vv['children'] as $kkk => &$vvv) {
                            $vvv['meta']['title'] = $vvv['name'];
                            $vvv['meta']['icon'] = $vvv['icon'];
                            $vvv['meta']['hidden'] = $vvv['hidden'] == 10 ? false : true;
//                            unset($vvv['icon']);
//                            unset($vvv['hidden']);
//                            unset($vvv['id']);
//                            unset($vvv['parent_id']);
                        }
                        $vv['children'] = array_values($vv['children']);
                    }
                    $vv['meta']['title'] = $vv['name'];
                    $vv['meta']['icon'] = $vv['icon'];
                    $vv['meta']['hidden'] = $vv['hidden'] == 10 ? false : true;
//                    unset($vv['icon']);
//                    unset($vv['hidden']);
//                    unset($vv['id']);
//                    unset($vv['parent_id']);
                }
                $v['children'] = array_values($v['children']);
            }
            $v['meta']['title'] = $v['name'];
            $v['meta']['icon'] = $v['icon'];
            $v['meta']['hidden'] = $v['hidden'] == 10 ? false : true;
//            unset($v['icon']);
//            unset($v['hidden']);
//            unset($v['id']);
//            unset($v['parent_id']);
        }
        $newArray = array_values($array);
        return $newArray;
    }

    //全局通用文件上传组件
    public static function uploadFile(UploadFile $uploadedFile, array $acceptExt, string $fileType = 'image')
    {
        $ext = $uploadedFile->getUploadExtension();
        if (!in_array($ext, $acceptExt)) {
            throw new Exception('文件名后缀不允许');
        }
        //图片检测安全
        if ($fileType == 'image') {
            $res = self::checkMimeType($uploadedFile, $ext);
            if ($res == false) {
                throw new Exception('文件安全检测未通过');
            }
        }

        $date = date('Ymd');
        $filePath = GlobalCode::UPLOAD_URL . DIRECTORY_SEPARATOR . $fileType . DIRECTORY_SEPARATOR . $date . DIRECTORY_SEPARATOR;
        $allDir = public_path() . DIRECTORY_SEPARATOR . $filePath;

        if (!is_dir($allDir)) {
            if (!mkdir($allDir, 0755, true)) {
                throw new Exception('创建文件夹失败');
            }
        }

        $fileName = getToken() . '.' . $ext;
        $uploadedFile->move($allDir . DIRECTORY_SEPARATOR . $fileName);
        /*
         * 注意windows下返回的地址可能会出现双斜杠，linux不会
         * windows：http://www.la.com/upload\\image\\20230626\\15d092d9058b7c3ac1952c79ede5b411.jpg
         * linux：http://www.la.com/upload/image/20230626/15d092d9058b7c3ac1952c79ede5b411.jpg
         */
//        return $filePath . $fileName;

        return ['id' => uniqid(), 'src' => $filePath . $fileName, 'fileName' => $fileName];
    }

    //检测文件是否合法
    public static function checkMimeType(UploadFile $uploadedFile, string $ext = '')
    {
        try {
            $filePath = $uploadedFile->getPathname();
            $fileMimeType = mime_content_type($filePath);
            $mimeTypes = MimeTypes::getImage();
            $isExist = array_key_exists($fileMimeType, $mimeTypes);

            if (!$isExist) {
                throw new Exception('非允许mime types类型');
            }

            list($width, $height, $type, $attr) = getimagesize($filePath, $ext);
            if ($width <= 0 || $height <= 0) {
                return false;
            } else {
                return true;
            }

        } catch (Exception $e) {
            return false;
        }

    }

    //格式化菜单，兼容 scui
    public static function formatMenu(array $array = [])
    {
//        pp($array);

        $menu = [];
        foreach ($array as $k => &$v) {
//            $menu[$k][''] = $v[''];

            if (!empty($v['children'])) {
                foreach ($v['children'] as $kk => &$vv) {
                    if (!empty($vv['children'])) {
                        foreach ($vv['children'] as $kkk => &$vvv) {


//                            $menu['']
                        }
                        $vv['children'] = array_values($vv['children']);
                    }
                }
                $v['children'] = array_values($v['children']);
            }
        }
        $newArray = array_values($array);


        return $newArray;
    }

    public static function getGroupTree(array $array = [])
    {
        $group = AdminGroup::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($group)) {
            return [];
        }

        return self::treeMenu($group);
    }

    public static function getMenuTree(array $array = [])
    {
        $permission = AdminPermission::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($permission)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($permission);
    }

    public static function getdownloadCateTree(array $array = [])
    {
        $cate = DownloadCate::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($cate)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($cate);
    }

    public static function getNewsCateTree(array $array = [])
    {
        $cate = NewsCate::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($cate)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($cate);
    }

    public static function getProductCateTree(array $array = [])
    {
        $cate = ProductCate::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($cate)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($cate);
    }

    public static function getVideoCateTree(array $array = [])
    {
        $cate = VideoCate::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($cate)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($cate);
    }

    public static function getBannerCateTree(array $array = [])
    {
        $cate = BannerCate::orderBy('sort', 'asc')->orderBy('id', 'asc')->get()->toArray();

        if (empty($cate)) {
            return [];
        }
        //获取菜单树数组
        return self::treeMenu($cate);
    }
}

