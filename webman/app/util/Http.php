<?php

namespace app\util;

use CURLFile;
use Exception;

class Http
{

    private static function getCurl()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        return $curl;
    }

    public static function post(string $url, array $params = [], bool $json = false, int $timeout = 5, bool $JSON_UNESCAPED_UNICODE = false)
    {
        $curl = self::getCurl();
        if ($json) {
            if ($JSON_UNESCAPED_UNICODE) {
                $params = json_encode($params, JSON_UNESCAPED_UNICODE);
            } else {
                $params = json_encode($params);
            }
//            curl_setopt($curl, CURLOPT_SSLVERSION, 3);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length:' . strlen($params))
            );
        } else {
            $params = http_build_query($params);
        }
//        pp($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        $result = curl_exec($curl);
        if (empty($result)) {
            $error = curl_error($curl);
            throw new Exception($error);
        }
        curl_close($curl);
        return $result;
    }

    public static function get(string $url, array $params = [], int $timeout = 5)
    {
        if (strstr($url, '?') === false) {
            $url .= '?' . http_build_query($params);
        } else {
            $url .= '&' . http_build_query($params);
        }
//        pp($url);
        $curl = self::getCurl();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        $result = curl_exec($curl);
        if (empty($result)) {
            $error = curl_error($curl);
            throw new Exception($error);
        }
        curl_close($curl);
        return $result;
    }

    public static function postFile(string $url = '', string $path = '', string $type = '', string $file_name = '')
    {
        $curl = self::getCurl();
        $data = ['file' => new CURLFile($path, $type, $file_name)];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "TEST");
        $result = curl_exec($curl);
        if (empty($result)) {
            $error = curl_error($curl);
            throw new Exception($error);
        }
        curl_close($curl);
        return $result;
    }

}
