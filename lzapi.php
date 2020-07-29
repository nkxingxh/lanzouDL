<?php

GetFile(strtolower(isset($_GET['url']) ? $_GET['url'] : ""), isset($_GET['pwd']) ? $_GET['pwd'] : "", isset($_GET['type']) ? $_GET['type'] : 0, isset($_GET['token']) ? $_GET['token'] : "");

function GetFile($url = "", $pwd = "", $type = 0, $tokenin = "")
{
    //设置token，留空为关闭
    $token = "cpoPZ2KQR1fxMTi";
    $UserAgent = 'Mozilla/5.0 (Linux; Android 10; MAR-AL00 Build/HUAWEIMAR-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Mobile Safari/537.36';
    $version = "12.0";
    header('API-By: NKXingXh');
    header('API-version: ' . $version);
    if($token != "" && $token != $tokenin)
    {
        header('HTTP/1.1 403 Forbidden');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 403,
                        'msg' => 'API token error'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('403: API token error');    
        }
    }

    if($url == "" || GetDomain($url) != "lanzous.com")
    {
        header('HTTP/1.1 400 Bad Request');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 400,
                        'msg' => 'Bad Request'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('400: Bad Request');    
        }
    }

    $OriginData = "";
    $OriginData = MloocCurlGet($url, $UserAgent);
    CheckError($OriginData);

    if(strstr($OriginData, '<a href="/tp/') != false)
    {
        $url = Get_tp_url($OriginData, $url);
        $OriginData = MloocCurlGet($url, $UserAgent);
        CheckError($OriginData);
    }

    $FileName = GetFileName($OriginData);
    $FileSize = GetFileSize($OriginData);
    $FileDate = GetFileDate($OriginData);
    $FileAuthor = GetFileAuthor($OriginData);
    $FileInfo = GetFileInfo($OriginData);
    $needPwd = isNeedPwd($OriginData);

    if($needPwd && $pwd == "")
    {
        header('HTTP/1.1 401 Unauthorized');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 401,
                        'msg' => '需要密码',
                        'name' => $FileName,
                        'size' => $FileSize,
                        'date' => $FileDate,
                        'author' => $FileAuthor,
                        'info' => $FileInfo
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die("401: 需要密码");
        }
    }
    else
    {
        $DownUrl = GetDownUrl($OriginData, $pwd, $needPwd, $url, $UserAgent);
    }
    
    if($DownUrl == "PE")
    {
        header('HTTP/1.1 401 Unauthorized');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 401,
                        'msg' => '密码错误',
                        'name' => $FileName,
                        'size' => $FileSize,
                        'date' => $FileDate,
                        'author' => $FileAuthor,
                        'info' => $FileInfo
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die("401: 密码错误");
        }
    }

    if($DownUrl == "")
    {
        header('HTTP/1.1 500 Internal Server Error');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 500,
                        'msg' => '获取链接失败'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die("500: 获取链接失败");
        }
    }

    header('HTTP/1.1 200 OK');
    if($type == 0)
    {
        die
        (
            json_encode
            (
                array
                (
                    'code' => 200,
                    'msg' => '获取链接成功',
                    'name' => $FileName,
                    'size' => $FileSize,
                    'date' => $FileDate,
                    'author' => $FileAuthor,
                    'info' => $FileInfo,
                    'url' => $DownUrl
                ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );
    }
    elseif($type == 1)
    {
        die($DownUrl);
    }
    else
    {
        header("Location: " . $DownUrl);
        exit();
    }
}

function CheckError($OriginData)
{
    header('HTTP/1.1 500 Internal Server Error');
    if($OriginData == "")
    {
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 500,
                        'msg' => '无法获取数据'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('500: 无法获取数据');
        }
    } 
    if (strstr($OriginData, "文件取消分享了") != false)
    {
        header('HTTP/1.1 404 Not Found');
        if($type == 0)
        {
            die
            (//停止代码继续执行
                json_encode
                (
                    array
                    (
                        'code' => 404,
                        'msg' => '文件取消分享'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('404: 文件取消分享');
        }
    }
    if(strstr($OriginData, '<div id="infos">') != false && strstr($OriginData, '$("#filemore").text("显示更多文件");') != false)
    {
        header('HTTP/1.1 400 Bad Request');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 400,
                        'msg' => '不支持文件夹链接'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('400: 不支持文件夹链接');
        }
    }
    if((strstr($OriginData, 'The requested URL') != false && strstr($OriginData, 'was not found on this server.') != false) || strstr($OriginData, '<div class="md">') == false)
    {
        header('HTTP/1.1 400 Bad Request');
        if($type == 0)
        {
            die
            (
                json_encode
                (
                    array
                    (
                        'code' => 400,
                        'msg' => '无效链接'
                    ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        else
        {
            die('400: 无效链接');
        }
    }
}

function GetDownUrl($OriginData, $pwd = "", $needPwd = false, $url = "", $UserAgent = 'Mozilla/5.0 (Linux; Android 10; MAR-AL00 Build/HUAWEIMAR-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Mobile Safari/537.36')
{
    if($needPwd)
    {
        $sign = strstr($OriginData, "'sign':'");
        $sign = substr($sign, strlen("'sign':'"));
        $sign = substr($sign, 0, strpos($sign, "'"));
        $sign = "action=downprocess&sign=" . $sign . "&p=" . $pwd;
        $OriginData = MloocCurlPost($sign, "http://" . GetHost($url) . "/ajaxm.php", $url, $UserAgent);
        if(strstr($OriginData, '"url":0') != false)
        {
            return "PE";
        }
        else
        {
            $OriginData = strstr($OriginData, '"dom":"');
            $dom = substr($OriginData, strlen('"dom":"'));
            $dom = substr($dom, 0, strpos($dom, '"'));
            $uri = strstr($OriginData, '"url":"');
            $uri = substr($uri, strlen('"url":"'));
            $uri = substr($uri, 0, strpos($uri, '"'));
            return $dom . "/file/" . $uri;
        }
    }
    else
    {
        $OriginData = strstr($OriginData, 'var cdomain');
        $cdomain = strstr($OriginData, 'http');
        $cdomain = substr($cdomain, 0, strpos($cdomain, "'"));
        $sts = strstr($OriginData, '?');
        $sts = substr($sts, 0, strpos($sts, "'"));
        return $cdomain . $sts;
    }  
}

function isNeedPwd($OriginData)
{
    return strstr($OriginData, '<div id="f_pwd">') != false;
}

function GetFileInfo($OriginData)
{
    $Info = strstr($OriginData, '<div class="mdo">');
    $Info = substr($Info, strlen('<div class="mdo">'), strpos($Info, '</div>') - strlen('<div class="mdo">\n'));
    $Info = str_replace('<span>', '', $Info);
    $Info = str_replace('</span>', '', $Info);
    return $Info;
}

function Get_tp_url($res, $url)
{
    $res = strstr($res, 'href="/tp/');
    $res = strstr($res, '/');
    $res = substr($res, 0, strpos($res, '"'));
    return "http://" . GetHost($url) . $res;
}

function GetDomain($url)
{
    $url = GetHost($url);
    $url = substr($url, strpos($url,'.') + 1);
    return $url;
}

function GetHost($url)
{
    $host = substr(strstr($url, '://'), 3);
    $host =  substr($host, 0, strpos($host, '/'));
    return $host;
}

function GetFileName($OriginData)
{
    $FileName = strstr($OriginData, '<div class="md">');
    $FileName = substr($FileName, strlen('<div class="md">'), strpos($FileName, ' <span class="mtt">') - strlen('<div class="md">'));
    return $FileName;
}

function GetFileSize($OriginData)
{
    $FileSize = strstr($OriginData, '<span class="mtt">( ');
    $FileSize = substr($FileSize, strlen('<span class="mtt">( '), strpos($FileSize, ' )</span>') - strlen('<span class="mtt">( '));
    return $FileSize;
}

function GetFileDate($OriginData)
{
    $FDate = strstr($OriginData, '时间:</span>');
    $FDate = substr($FDate, strlen('时间:</span>'), strpos($FDate, ' <span') - strlen('时间:</span>'));
    return $FDate;
}

function GetFileAuthor($OriginData)
{
    $Author = strstr($OriginData, '发布者:</span>');
    $Author = substr($Author, strlen('发布者:</span>'), strpos($Author, ' <span') - strlen('发布者:</span>'));
    return $Author;
}

function MloocCurlGet($url, $UserAgent = 'Mozilla/5.0 (Linux; Android 10; MAR-AL00 Build/HUAWEIMAR-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Mobile Safari/537.36') 
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    if ($UserAgent != "") 
    {
        curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
    }
    #关闭SSL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    #返回数据不直接显示
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function MloocCurlPost($post_data, $url, $ifurl = '', $UserAgent = 'Mozilla/5.0 (Linux; Android 10; MAR-AL00 Build/HUAWEIMAR-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Mobile Safari/537.36') {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
    if ($ifurl != '') 
    {
        curl_setopt($curl, CURLOPT_REFERER, $ifurl);
    }
    #关闭SSL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    #返回数据不直接显示
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

?>