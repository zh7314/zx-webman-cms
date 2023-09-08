<?php
/**
 * Here is your custom functions.
 */

use Illuminate\Http\JsonResponse;

if (!function_exists('https_request')) {

    function https_request($url, $data = NULL)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, false);
        $post_data = http_build_query($data);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($curl);

        if (empty($output)) {
            if (curl_errno($curl) == CURLE_OPERATION_TIMEDOUT) {
                curl_close($curl);
                return json_encode(['code' => 400, 'msg' => '请求超时']);
            }
            curl_close($curl);
            return json_encode(['code' => 400, 'msg' => '返回数据为空']);
        }

        curl_close($curl);
        return $output;
    }

}
if (!function_exists('curl_get')) {

    function curl_get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}

/**
 * send sms jianzhou
 */
if (!function_exists('sendsms')) {

    function sendsms($mobile, $content, $config)
    {
        $p = md5($config['username'] . "" . md5($config['password']));
        $param = [
            'username' => $config['username'],
            'password' => $p,
            'mobile' => $mobile,
            'content' => $content . $config['suffix']
        ];
        //开始发送
        return https_request($config['url'], $param);
    }

}


/**
 * rand num
 */
if (!function_exists('getRandom')) {

    function getRandom($length = 6, $content = '123456789')
    {
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $content[mt_rand(0, strlen($content) - 1)];
        }
        return $string;
    }

}
if (!function_exists('substr')) {

    function substr($str, $start, $length = false, $encoding = 'utf-8')
    {
        if (is_array($str) || is_object($str))
            return false;
        if (function_exists('mb_substr'))
            return mb_substr($str, intval($start), ($length === false ? strlen($str) : intval($length)), $encoding);
        return substr($str, $start, ($length === false ? strlen($str) : intval($length)));
    }

}

if (!function_exists('getRandNums')) {

    function getRandNums($lenth)
    {
        $char = '0123456789';
        $return = "";
        for ($i = 1; $i <= $lenth; ++$i) {
            $return .= $char[rand(0, 9)];
        }
        return $return;
    }

}
if (!function_exists('getRandNums')) {

    function checkPassword($password)
    {
        //1、密码不能有空格
        if (preg_match("/ /", $password)) {
            return false;
        }
        $len = strlen($password);
        //2、长度在6-16之间
        if ($len < 6 || $len > 16) {
            return false;
        }
        return true;
    }

}

if (!function_exists('strlen')) {

    function strlen($str, $encoding = 'UTF-8')
    {
        if (is_array($str) || is_object($str))
            return false;
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen'))
            return mb_strlen($str, $encoding);

        return strlen($str);
    }

}

if (!function_exists('intval')) {

    function intval($val)
    {
        if (is_int($val))
            return $val;
        if (is_string($val))
            return (int)$val;

        return (int)(string)$val;
    }

}

if (!function_exists('getday')) {

    function getday($date)
    {
        $strdate = strtotime($date);
        $date = date("m-d", $strdate);
        return $date;
    }

}

if (!function_exists('getLoginItemType')) {

    function getLoginItemType($value)
    {
        $login_item_value = trim($value);

        if (isEmail($login_item_value)) {
            return 'E';
        }
        if (isMobilePhone($login_item_value)) {
            return 'M';
        }
        if (isNickname($login_item_value)) {
            return 'N';
        }
        return false;
    }

}

if (!function_exists('isNickname')) {

    function isNickname($str)
    {
        if (strlen($str) < 4) {
            return false;
        }
        $length = mb_strlen($str, 'utf8');
        if ($length < 2 || $length > 20) {
            return false;
        }
        if (!preg_match('/^[a-zA-Z0-9_\x80-\xff]+$/', $str)) {
            return false;
        }
        return true;
    }

}

if (!function_exists('isMobilePhone')) {

    function isMobilePhone($mobilePhone)
    {
        return preg_match("/^1[3578][0-9]{9}$/", $mobilePhone);
    }

}


if (!function_exists('isEmail')) {

    function isEmail($email)
    {
        return !empty($email) && preg_match(cleanNonUnicodeSupport('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+[._a-z\p{L}0-9-]*\.[a-z0-9]+$/ui'), $email);
    }

}

if (!function_exists('replaceHTML')) {

    function replaceHTML($str)
    {
        $content_01 = $str; //从数据库获取富文本content
        $content_02 = htmlspecialchars_decode($content_01); //把一些预定义的 HTML 实体转换为字符
        $content_03 = str_replace("&nbsp;", "", $content_02); //将空格替换成空
        $contents = strip_tags($content_03); //函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
        $str = mb_substr($contents, 0, 100, "utf-8"); //返回字符串中的前100字符串长度的字符
        return $str;
    }

}

if (!function_exists('cleanNonUnicodeSupport')) {

    function cleanNonUnicodeSupport($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET'))
            return $pattern;
        return preg_replace('/\\\[px]\{[a-z]\}{1,2}|(\/[a-z]*)u([a-z]*)$/i', "$1$2", $pattern);
    }

}
if (!function_exists('floorThree')) {

    function floorThree($data)
    {
        return round($data, 2);
    }

}
if (!function_exists('objectToArray')) {

    function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource')
                return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)objectToArray($v);
        }
        return $e;
    }

}

if (!function_exists('createPage')) {

    function createPage($url, $currentPage, $totalPage, $delta = 2, $target = '_self')
    {

        $high = $currentPage + $delta;
        $low = $currentPage - $delta;
        if ($high > $totalPage) {
            $high = $totalPage;
            $low = $totalPage - 2 * $delta;
        }
        if ($low < 1) {
            $low = 1;
            $high = $low + 2 * $delta;
            if ($high > $totalPage)
                $high = $totalPage;
        }
        $ret_string = '<div class="zgt_page clearfix">';
        if ($currentPage > 1) {
            $ret_string .= '<a style="cursor:pointer" href=\'' . str_replace('%d', 1, $url) . "' target='{$target}'>首页</a>";
            $ret_string .= '<a style="cursor:pointer" href=\'' . str_replace('%d', $currentPage - 1, $url) . "' target='{$target}'>上一页</a>";
        } else {
            $ret_string .= '<a class="disabled" style="color: #ccc">首页</a>';
            $ret_string .= '<a class="disabled" style="color: #ccc">上一页</a>';
        }
        $links = array();
        for (; $low <= $high; $low++) {
            if ($low != $currentPage)
                $links[] = '<a style="cursor:pointer" href=\'' . str_replace('%d', $low, $url) . '\' target=\'' . $target . '\'>' . $low . '</a>';
            else
                $links[] = "<a class='curr' >{$low}</a>";
        }
        $links = implode('', $links);
        $ret_string .= "\r\n" . $links;
        if ($currentPage < $totalPage) {
            $ret_string .= '<a style="cursor:pointer" href=\'' . str_replace('%d', $currentPage + 1, $url) . "' target='{$target}'>下一页</a>";
            $ret_string .= '<a style="cursor:pointer" href=\'' . str_replace('%d', $totalPage, $url) . '\' target=\'' . $target . '\'>尾页</a>';
        } else {
            $ret_string .= '<a class="disabled" style="color: #ccc">下一页</a>';
            $ret_string .= '<a class="disabled" style="color: #ccc">尾页</a>';
        }
        return $ret_string . '</div>';
    }

}

if (!function_exists('p')) {

    function p($data = null)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}
if (!function_exists('pp')) {

    function pp($data = null)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }

}
if (!function_exists('is_json')) {

    function is_json($string)
    {
        @json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}

if (!function_exists('price_format')) {

    //统一返回金额是小数点后2位，四舍五入，如果不是标准格式也会返回小数点后面的0.负数也可以使用
    function price_format($price = 0, $prec = 2)
    {
        $price = round($price, $prec);
        $price = number_format($price, $prec);
        return $price;
    }

}

if (!function_exists('get_lately_month_start_to_end')) {
    /* 返回近一个月的开始和结束时间
      1,返回时间格式 0000-00-00 00:00:00
      2,返回时间戳
     *
     * $end_all_day 是否计算当天全部时间 true 到结束时间+00:00:00   false +23:59:59
     * $start_all_day 是否计算当天全部时间 true 到结束时间+00:00:00   false +23:59:59
     */

    function get_lately_month_start_to_end($type = 1, $start_all_day = false, $end_all_day = false)
    {

        if ($end_all_day) {
            $end_time = date('Y-m-d 23:59:59', strtotime(date("Y-m-d", time())));
        } else {
            $end_time = date('Y-m-d 00:00:00', strtotime(date("Y-m-d", time())));
        }
        if ($start_all_day) {
            $start_time = date('Y-m-d 23:59:59', strtotime("$end_time -1 month"));
        } else {
            $start_time = date('Y-m-d 00:00:00', strtotime("$end_time -1 month"));
        }
        if ($type == 1) {
            $return['end_time'] = $end_time;
            $return['start_time'] = $start_time;
        } else {
            $return['end_time'] = strtotime($end_time);
            $return['start_time'] = strtotime($start_time);
        }
        return $return;
    }

}

if (!function_exists('is_url_valid')) {

    /*
     * 注意，此函数遇到超时url，就会报错，404没关系，只有返回http状态码都可以使用，超时就完蛋
     * get_headers(http://google.com/): failed to open stream，这个函数的超时参数设置没什么用
     */

    function is_url_valid($url = '')
    {
        if (empty($url)) {
            return FALSE;
        }
        $array = get_headers($url, 1);
        if (preg_match('/200/', $array[0])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
if (!function_exists('getDateFromRange')) {

    //格式 2020-10-12
    function getDateFromRange($startdate, $enddate, $type = 'Y-m-d')
    {

        $stimestamp = strtotime($startdate);
        $etimestamp = strtotime($enddate);

        // 计算日期段内有多少天
        $days = ($etimestamp - $stimestamp) / 86400 + 1;

        // 保存每天日期
        $date = array();

        for ($i = 0; $i < $days; $i++) {
            $date[] = date($type, $stimestamp + (86400 * $i));
        }

        return $date;
    }

}


if (!function_exists('getExpressInfo')) {

    //$express_name 是快递拼音名称
    function getExpressInfo($express_name = '', $express_number = '', $temp = '')
    {
        if (empty($express_name) || empty($express_number)) {
            return false;
        }
        $url = "https://www.kuaidi100.com/query?type={$express_name}&postid={$express_number}&temp={$temp}";
        $data = curl_get($url);
        $data = json_decode($data, true);
        return $data;
    }

}


if (!function_exists('get_curl')) {

    function get_curl($url = '')
    {
        if (empty($url)) {
            return false;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        $get_content = curl_exec($curl);
        curl_close($curl);
        return $get_content;
    }

}

if (!function_exists('curl_url_valid')) {

    //http https都可以使用
    function curl_url_valid($url = '', $time_out = 2)
    {
        if (empty($url)) {
            return false;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $time_out); //2秒差不多
        $get_content = curl_exec($curl);

        if (empty($get_content)) {
            curl_close($curl);
            return 'time_out';
        } else {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//            if ($statusCode == 200) {
//                curl_close($curl);
//                return '200';
//            } else {
//                curl_close($curl);
//                return $statusCode;
//            }
            curl_close($curl);
            return $statusCode;
        }
    }

}

if (!function_exists('time_str_is_valid')) {

    /*
     * 判断时间字符串是否合法
     * type 格式
     * 0 2018-06-01
     * 1 20180601
     * 2 2018/06/01
     * 3 2018-06-01 00:00:00
     * 需要新验证新格式就增加
     * 注意：date_default_timezone_set() 和系统时间以格式化数据免出现意外bug
     */

    function time_str_is_valid($str = '', $type = '0')
    {
        $format = array('0' => 'Y-m-d', '1' => 'Ymd', '2' => 'Y/m/d', '3' => 'Y-m-d H:i:s');
        if (date($format[$type], strtotime($str)) == $str) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('multi_array_sort')) {

    /*
     * 多维数组指定字段排序
     */

    function multi_array_sort($data, $sort_field, $sort_order = SORT_ASC, $sort_type = SORT_REGULAR)
    {
        foreach ($data as $val) {
            $key_arrays[] = $val[$sort_field];
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $data);
        return $data;
    }

}


if (!function_exists('intercept_string_by_tag')) {

    /*
     * $tag 分割字符
     * $return_type 1是返回分割符左边，2是翻个分隔符右边，如果
     */

    function intercept_string_by_tag($string, $tag = '-', $return_type = 2)
    {
        //出现多次就返回false
        $nums = substr_count(trim($string), trim($tag));

        if ($nums == 0) {
            return trim($string);
        } elseif ($nums == 1) {
            $pos = mb_strpos(trim($string), trim($tag));
            if ($return_type == 1) {
                //返回分隔符左边
                return mb_substr(trim($string), 0, $pos);
            } elseif ($return_type == 2) {
                //返回分隔符右边
                return mb_substr(trim($string), $pos + 1, strlen(trim($string)));
            }
        } else {
            //多个分隔符，截取第一个返回左右或者右边
            $pos = mb_strpos(trim($string), trim($tag));
            if ($return_type == 1) {
                //返回分隔符左边
                return mb_substr(trim($string), 0, $pos);
            } elseif ($return_type == 2) {
                //返回分隔符右边
                return mb_substr(trim($string), $pos + 1, strlen(trim($string)));
            }
        }
    }

}

if (!function_exists('getToken')) {

    function getToken($id = null)
    {
        if (empty($id)) {
            $str = mt_rand(1000, 9999) . mt_rand(100, 999) . uniqid() . microtime(true);
        } else {
            $str = mt_rand(1000, 9999) . mt_rand(100, 999) . uniqid() . microtime(true) . $id;
        }
        return md5($str);
    }

}


if (!function_exists('des_encrypt')) {

//3des加密 OPENSSL_RAW_DATA 为Pkcs7填充模式
    function des_encrypt($data = [], $key = '12345678', $iv = '87654321', $type = 'des-ede3-cbc')
    {
        $str = openssl_encrypt(json_encode($data), $type, $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($str);
    }

}
if (!function_exists('des_decrypt')) {

//3des解密  OPENSSL_RAW_DATA 为Pkcs7填充模式
    function des_decrypt($data = '', $key = '12345678', $iv = '87654321', $type = 'des-ede3-cbc')
    {
        $str = openssl_decrypt(base64_decode($data), $type, $key, OPENSSL_RAW_DATA, $iv);
        return json_decode($str, true);
    }

}
if (!function_exists('getDateStartToEnd')) {

    /**
     *
     * @param type $date 格式 Y-m-d H:i:s
     * @param bool $type true就是当前时间0点到第二天0点，false就是当前执行时间的到第二天同样时间
     * @return type
     */
    function getDateStartToEnd($date = '', bool $type = true)
    {

        $return = [];
        if (empty($date)) {
            $date = date('Y-m-d', time());
        }
        if ($type) {
            $start_time = date('Y-m-d 00:00:00', strtotime($date));
            $end_time = date('Y-m-d 23:59:59', strtotime($date));
        } else {
            $time = date('H:i:s', time());
//            $time = '18:00:00';
            $start_time = date("Y-m-d {$time}", strtotime($date) - 3600 * 24);
            $end_time = date("Y-m-d {$time}", strtotime($date));
        }

        $return['start_time'] = $start_time;
        $return['end_time'] = $end_time;

        return $return;
    }

}

if (!function_exists('returnResult')) {

    /**
     * 自定义返回信息 便于接口返回
     * @param string $msg
     * @param array|string $data 如果为空[] 则返回和msg一致内容 小程序那边是需要这样的处理
     * @param int $code
     * @return JsonResponse
     */
    function returnResult(string $msg = 'success', $data = '', int $code = 200)
    {
        if (empty($data)) {
            $data = $msg;
        }
        return response()->json(compact('code', 'msg', 'data'));
    }

}

//多个参数 bc系列 加 减 乘 除 可扩展
if (!function_exists('multiple_parameters_bc')) {
    /*
     * add 加
     * sub 减
     * mul 乘
     * div 除
     */

    function multiple_parameters_bc($type = 'add', $accuracy = 2, ...$parameter)
    {
//    pp($parameter);
        //bc 对小数点位数不是四舍五入，先高精度计算最后对小数点位数四舍五入
        // $calculation_accuracy 计算时保持的小数点精度  返回值保留的精度$accuracy
        $calculation_accuracy = 10;
        if (count($parameter) < 2) {
            throw new Exception('参数少于2个');
        }
        //防止数组操作导致循环次数异常
        $temp = $parameter;
        for ($i = 1; $i <= (count($temp) - 1); $i++) {
//        p($i);
            //保证指针一直指向数组第一个元素
            reset($parameter);
            //获取第一个元素
            $data_1 = current($parameter);
            array_shift($parameter);
            //获取第二个元素
            $data_2 = current($parameter);
            array_shift($parameter);

            if ($type == 'add') {
                $res = bcadd($data_1, $data_2, $calculation_accuracy);
            } elseif ($type == 'sub') {
                $res = bcsub($data_1, $data_2, $calculation_accuracy);
            } elseif ($type == 'mul') {
//                if ((int) $data_2 == 0) {
//                    throw new \Exception('被乘元素不能为0');
//                }
                $res = bcmul($data_1, $data_2, $calculation_accuracy);
            } elseif ($type == 'div') {
                if ((int)$data_2 == 0) {
                    throw new Exception('被除元素不能为0');
                }
                $res = bcdiv($data_1, $data_2, $calculation_accuracy);
            } else {
                throw new Exception('计算类型不识别');
            }
            //计算结果再次压入队首，循环继续使用
            array_unshift($parameter, $res);
        }
        //加减不需要四舍五入，只需要截取小数位精度 ，乘除需要四舍五入
        if ($type == 'add') {
            return number_format($parameter['0'], $accuracy, '.', '');
        } elseif ($type == 'sub') {
            return number_format($parameter['0'], $accuracy, '.', '');
        } elseif ($type == 'mul') {
            return round($parameter['0'], $accuracy);
        } elseif ($type == 'div') {
            return round($parameter['0'], $accuracy);
        } else {
            throw new Exception('计算类型不识别');
        }
    }

}

if (!function_exists('simple_encryption')) {


    function simple_encryption(string $str, int $from_base = 10, int $to_base = 17)
    {
        $convert = base_convert($str, $from_base, $to_base);
        return urlencode(base64_encode($convert));
    }
}
if (!function_exists('simple_decryption')) {


    function simple_decryption(string $str, int $from_base = 17, int $to_base = 10)
    {
        $convert = base64_decode(urldecode($str));
        return base_convert($convert, $from_base, $to_base);
    }
}

if (!function_exists('normalized_mapping')) {

    /*
     * 数据归一化映射到任一区间算法
     * $x = 0;
     * $x_min = 358012;
     * $x_max = 361571;
     * $y = 0;
     * $y_min = 1;
     * $y_max = 1000000;
     *
     * $k = 1;
     * $data = [];
     * for ($i = $x_min; $i <= $x_max; $i++) {
     * $t = (int)$this->jisuan($i, $x_min, $x_max, $y_min, $y_max);
     * $data[] = $t;
     * //            p($k++ . '------' . $t);
     * }
     *
     * $array = $data;
     * $unique_arr = array_unique($array);
     * $repeat_arr = array_diff_assoc($array, $unique_arr);
     * p($repeat_arr);
     *
     * 参照算法
     *https://blog.csdn.net/willduan1/article/details/80448493?utm_source=blogxgwz6
     *
     * y_max  要映射的目标区间最大值
     * y_min 要映射的目标区间最小值
     * x_max 目前数据最大值
     * x_min 目前数据最小值
     * x 假设目前数据中的任一值
     * y 归一化映射后的值
     *
     * 注意，如果x_max x_min是小数请乘以小数点位的长度的
     * 比如 3580.12 3615.71 请乘以100 358012 361571避免小数问题
     *
     * 这里可能是小数，看自己是否需要四舍五入取正数
     */
    function normalized_mapping(int $x, int $x_min, int $x_max, int $y_min, int $y_max)
    {
        return $y_min + (($y_max - $y_min) / ($x_max - $x_min)) * ($x - $x_min);
    }
}


if (!function_exists('formatErr')) {

    //格式化错误信息，方便输出
    function formatErr(Exception $e)
    {
//        if ($e instanceof \Exception == false) {
//            throw new \Exception('数据类型错误');
//        }
        $msg['File'] = $e->getFile();
        $msg['Line'] = $e->getLine();
        $msg['Msg'] = $e->getMessage();
        $msg['Trace'] = $e->getTraceAsString();

        return $msg;
    }
}

if (!function_exists('parameterCheck')) {

    /**
     * 如果是double的话，也使用float，需要处理其他类型数据自己添加
     * @param type $param 需要处理的参数
     * @param type $ExpectDataType 期望返回数据类型
     * @param type $defaultValue 如果没有值返回的默认值
     * @return array|bool|float|int|string
     * @throws Exception
     */
    function parameterCheck(mixed $param, string $ExpectDataType, mixed $defaultValue)
    {
        if (empty($param)) {
            return $defaultValue;
        }
        $res = match ($ExpectDataType) {
            'int' => (int)htmlFilter($param),
            'float' => (float)htmlFilter($param),
            'string' => (string)htmlFilter($param),
            'array' => (array)$param,
            'bool' => (bool)htmlFilter($param),
            default => throw new Exception('数据类型不存在')
        };
        return $res;
    }

}

if (!function_exists('htmlFilter')) {

    /**
     * @param type $param 需要html转义和去除空格的参数
     * @throws Exception
     */
    function htmlFilter($param)
    {
        return htmlspecialchars(trim($param), ENT_QUOTES, "UTF-8");
    }

}
if (!function_exists('amountConversion')) {
    /*
     * 吧金额数字转成可视化的方便读的汉字表述
     */

    function amountConversion(float $amount = 0, $unit = '元')
    {
        $moneyArray = [
            ['length' => 100000000, 'unit' => '亿'],
            ['length' => 10000, 'unit' => '万'],
            ['length' => 1, 'unit' => $unit]
        ];

        $return = '';
        foreach ($moneyArray as $k => $v) {
            if ($amount > $v['length']) {
                $temp = intval($amount / $v['length']);
                $return .= $temp . $v['unit'];
                $amount -= $temp * $v['length'];
            }
        }
        return $return;
    }

}

if (!function_exists('timeStrIsValid')) {

    /**
     * 判断时间字符串是否合法,自己传入需要的时间格式
     * 注意：date_default_timezone_set() 和系统时间以格式化数据免出现意外bug
     * @param type $str
     * @param type $formatType
     * @return boolean
     */
    function timeStrIsValid(string $str = '', string $formatType = 'Y-m-d')
    {
        if (date($formatType, strtotime($str)) == $str) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('decimalPointCheck')) {

    //统一返回金额是小数点后2位，四舍五入，如果不是标准格式也会返回小数点后面的0.负数也可以使用
    function decimalPointFormat($price = 0, $prec = 2)
    {
        $price = round($price, $prec);
        $price = number_format($price, $prec);
        $price = str_replace(',', '', $price);
        return $price;
    }

}

if (!function_exists('arrayToXml')) {

    //数组转xml
    function arrayToXml(array $array)
    {
        $xml = '';
//        $xml = "<xml>";
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $xml .= "<" . $k . ">" . arrayToXml($v) . "</" . $k . ">";
            } else {
                $xml .= "<" . $k . ">" . $v . "</" . $k . ">";
            }
        }
//        $xml .= "</xml>";
        return $xml;
    }

}
if (!function_exists('xmlToArray')) {

    //xml转数组
    function xmlToArray(string $xml)
    {
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

}
if (!function_exists('interceptStr')) {
    //截取字符串全部指定字符串，获取剩余字符串
    function interceptStr(string $str = '', string $prefix = '')
    {
        if (empty($str) || empty($prefix)) {
            throw new Exception('截取字符串和指定前缀不能为空');
        }
        $start = strlen($prefix);
        $length = strlen($str) - strlen($prefix);
        return substr($str, $start, $length);
    }

}

if (!function_exists('isMobile')) {

    function isMobile($mobile)
    {
        return preg_match("/^1(3\d|4[5-9]|5[0-35-9]|6[2567]|7[0-8]|8\d|9[0-35-9])\d{8}$/", $mobile);

    }

}

if (!function_exists('isChineseName')) {

    /*
     * 新疆人的姓名会很长，最长不知道有多长，目前是2-15  迪丽热巴·迪力木拉提 还有 ·这样特殊的字符，所以姓名不做校验
     * 这里还有外籍姓名里面有空格的 LEE HAN
     * his系统里有普通汉字姓名
     * 这里校验的是汉字符 2-15位长度的字符
     */
    function isChineseName($name)
    {
        return preg_match("/^[\u4e00-\u9fa5]{2,15}$/", $name);
    }

}

if (!function_exists('array_replace_key')) {
    function array_replace_key(array &$array, callable $call)
    {
        if (empty($array)) {
            throw new Exception('被数组不能为空');
        }

        $total = count($array);
        $i = 1;
        foreach ($array as $k => &$v) {
            $new_k = call_user_func_array($call, [$k, $v]);
//            $new_k = $call($k, $v);
            $array[$new_k] = $v;
            unset($array[$k]);
            if ($i == $total) {
                break;
            }
            $i++;
        }
    }
}

if (!function_exists('mb_padding_str')) {
    //填充,裁剪多字节字符串
    function mb_padding_str(string $str = '', int $length = 20, string $paddingStr = '&nbsp;')
    {
        $len = mb_strlen($str);

        if ($len >= $length) {
            $uft8_str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
            return mb_substr($uft8_str, 0, $length);

        } else {
            $padding = $length - $len;

            $return = $str;
            for ($i = 0; $i < $padding; $i++) {
                $return .= $paddingStr;
            }
            return $return;
        }
    }

}

if (!function_exists('getDomain')) {
    function getDomain()
    {
        $https = request()->header('HTTPS');
        $protocol = isset($https) && $https === 'on' ? 'https://' : 'http://';
        $host = request()->header('HTTP_HOST') ?? request()->header('HOST');
        $fullPath = $protocol . $host;
        return $fullPath;
    }
}

if (!function_exists('getResource')) {
    function getResource(string $path = '')
    {
        if (empty($path)) {
            return '';
        }

        $domain = getDomain();
        return $domain . DIRECTORY_SEPARATOR . trim($path, '/');
    }
}
