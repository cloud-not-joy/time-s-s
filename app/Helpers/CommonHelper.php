<?php

/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/10/5
 * Time: 18:04
 */
class CommonHelper
{
    public static function curl($url, $request_data, $extra_opts = [], $is_post = true)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 20, //seconds
        ]);
        if ($is_post) {
            if (is_array($request_data)) {
                $request_data = http_build_query($request_data);
            }
            curl_setopt_array($ch, [
                CURLOPT_POST       => true,
                CURLOPT_POSTFIELDS => $request_data,
            ]);
        }
        curl_setopt_array($ch, $extra_opts);

        $data = curl_exec($ch);
        if ($curl_errno = curl_errno($ch)) {
            $err = sprintf("curl[%d]%s", $curl_errno, curl_error($ch));
            curl_close($ch);
            throw new CurlException($curl_errno, $err);
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!in_array($httpcode, [200, 201])) {
            curl_close($ch);
            throw new CHttpException($httpcode, $data, $httpcode);
        }
        curl_close($ch);

        return $data;
    }


}