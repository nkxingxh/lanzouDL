<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- meta http-equiv="X-UA-Compatible" content="IE=edge" -->
    <meta name="page-topic" content="Downloads">
    <meta name="page-type" content="File Hosting">
    <!-- meta http-equiv="content-language" content="en" -->
    <meta name="robots" content="index, follow">

    <?php

    //感谢Filmy开源的lanzouAPI，本人只是在其基础上进行界面优化
    /**
     * @package Lanzou
     * @author Filmy
     * @version 1.2.2
     * @link https://mlooc.cn
     */

    /*###################################*/
    /*                                   */
    /*            XyunDLs v9             */
    /*                                   */
    /*###################################*/

    $ProgramName = "XyunDLs";
    //程序名
    $WebName = "幸运云存储";
    //站点名称
    $Version = 9.2;
    //版本号
    $cnzz = "<script src=\"http://www.admin88.com/mystat.asp?id=52600&logo=11\"></script>";
    //统计代码
    $captcha = true ;
    //是否开启验证码

    header('Access-Control-Allow-Origin:*');
    //header('Content-Type:application/json; charset=utf-8');
    //开启session
    session_start();

    if (empty($_GET['id']) && empty($_GET['url']) && empty($_REQUEST['pid']))        //判断ID和URL是否为空
    {
        $FileMsg = "请输入URL或文件ID";
        $FCode = 403;
    }

    if ($captcha == true && $FCode !== 403)             //加载验证码
    {
        if (empty($_REQUEST['autocode']))        //如果验证码为空
        {
            echo "<title>" . "人机验证" . " - " . $WebName . "</title>" . "<link rel=\"stylesheet\" href=\"css/style.css\">" . "<link rel=\"icon\" href=\"img/icon.png\"  type=\"image/png\">" . "</head>";
            echo("<body>  ");
            echo("    <noscript>");
            echo("        <p>JavaScript seems to be disabled in your Browser settings. Please enabled it or try another browser. Only contact us if this error does not go away: nkxingxh@nkxingxh.top.</p>");
            echo("    </noscript>");
            echo("    ");
            echo("    <div class=\"main_content\">");
            echo("        <div class=\"meta\">");
            echo("            ");
            echo("            <h2>人机验证</h2>");
            echo("            ");
            echo("            <div class=\"icon\">");
            echo("                <span style=\"background-image:url('/img/cloud.png')\"></span>");
            echo("            </div>");
            echo("            <br>");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span>提示</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch0\">请输入验证码以继续</p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("        ");

            //获取数据
            
            $getData = "?";
            
            /*
            $getData = "?" . (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : "");
            $getData = $getData . (isset($_GET['url']) ? ("url=" . $_GET['url'] . "&") : "");
            */

            //优先POST获取数据
            $getData = $getData . (isset($_REQUEST['ipwd']) ? ("pwd=" . strtolower($_POST['ipwd']) . "&") : (isset($_GET['pwd']) ? ("pwd=" . $_GET['pwd'] . "&") : ""));
            $getData = $getData . (isset($_REQUEST['pid']) ? ("id=" . strtolower($_POST['pid']) . "&") : (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : ""));

            $getData = $getData . (isset($_GET['type']) ? ("type=" . $_GET['type'] . "&") : "");
            $getData = $getData . (isset($_GET['name']) ? ("name=" . $_GET['name'] . "&") : "");
            $getData = $getData . (isset($_GET['info']) ? ("info=" . $_GET['info']) : "");

            echo("		<form method=\"post\"  action=\"index.php" . $getData . "\">");

            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span></span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("<img border=\"1\" id=\"capthcha_img\" onclick=\"this.src=\'captcha.php?r=\'+Math.random()\" src=\"captcha.php?r=\"" .rand() ." width=\"100\" height=\"30\"  /> <a href=\"javascript:void(0)\" onclick=\"document.getElementById(\'capthcha_img\').src=\'captcha.php?r=\'+Math.random()\"></a>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span>验证码</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch0\"><input type=\"text\" name=\"autocode\" value=\"\" placeholder=\"请在此输入验证码\"/></p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("        <br>");
            echo("          <input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
            echo("		</form>");
            echo("		");
            echo("        <br>");
            echo("        <p aria-labelledby=\"branch1\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
            echo("        <p aria-labelledby=\"branch1\" align=\"center\">Copyright © " . date("Y",time()) . " NKXingXh. </p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
            echo("");
            echo("        </div>");
            echo("        ");
            echo("    </div>");
            echo("    ");
            echo("</body>");
            echo("</html>");

            exit();
        } else
            if (strtolower($_POST['autocode']) !== $_SESSION['authcode'])    //如果验证码错误
        {
            echo "<title>" . "人机验证" . " - " . $WebName . "</title>" . "<link rel=\"stylesheet\" href=\"css/style.css\">" . "<link rel=\"icon\" href=\"img/icon.png\"  type=\"image/png\">" . "</head>";
            echo("<body>  ");
            echo("    <noscript>");
            echo("        <p>JavaScript seems to be disabled in your Browser settings. Please enabled it or try another browser. Only contact us if this error does not go away: nkxingxh@nkxingxh.top.</p>");
            echo("    </noscript>");
            echo("    ");
            echo("    <div class=\"main_content\">");
            echo("        <div class=\"meta\">");
            echo("            ");
            echo("            <h2>人机验证</h2>");
            echo("            ");
            echo("            <div class=\"icon\">");
            echo("                <span style=\"background-image:url('/img/cloud.png')\"></span>");
            echo("            </div>");
            echo("            <br>");
            echo("        ");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span>提示</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch0\">验证码错误</p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");

            //获取数据
            
            $getData = "?";
            
            /*
            $getData = (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : "");
            $getData = $getData . (isset($_GET['url']) ? ("url=" . $_GET['url'] . "&") : "");
            */

            //优先POST获取数据
            $getData = $getData . (isset($_REQUEST['ipwd']) ? ("pwd=" . strtolower($_POST['ipwd']) . "&") : (isset($_GET['pwd']) ? ("pwd=" . $_GET['pwd'] . "&") : ""));
            $getData = $getData . (isset($_REQUEST['pid']) ? ("id=" . strtolower($_POST['pid']) . "&") : (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : ""));

            $getData = $getData . (isset($_GET['type']) ? ("type=" . $_GET['type'] . "&") : "");
            $getData = $getData . (isset($_GET['name']) ? ("name=" . $_GET['name'] . "&") : "");
            $getData = $getData . (isset($_GET['info']) ? ("info=" . $_GET['info']) : "");

            echo("		<form method=\"post\"  action=\"index.php" . $getData . "\">");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span></span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("<img border=\"1\" id=\"capthcha_img\" onclick=\"this.src=\'captcha.php?r=\'+Math.random()\" src=\"captcha.php?r=\"" .rand() ." width=\"100\" height=\"30\"  /> <a href=\"javascript:void(0)\" onclick=\"document.getElementById(\'capthcha_img\').src=\'captcha.php?r=\'+Math.random()\"></a>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label0\">");
            echo("                <span>验证码</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch0\"><input type=\"text\" name=\"autocode\" value=\"\" placeholder=\"请在此输入验证码\" /></p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("        <br>");
            echo("          <input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
            echo("		</form>");
            echo("		");
            echo("        <br>");
            echo("        <p aria-labelledby=\"branch1\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
            echo("        <p aria-labelledby=\"branch1\" align=\"center\">Copyright © " . date("Y",time()) . " NKXingXh.</p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
            echo("");
            echo("        </div>");
            echo("        ");
            echo("    </div>");
            echo("    ");
            echo("</body>");
            echo("</html>");

            exit();
        }

    }
    //主程序开始
    $FCode = 0;
    //初始化状态码

    if (empty($_GET['id']) && empty($_GET['url']))        //判断ID和URL是否为空
    {
        $FileMsg = "请输入URL或文件ID";
        $FCode = 403;
    } else
    {
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        //$url = isset($_GET['url']) ? $_GET['url'] : "";
        $url = isset($_GET['url']) ? $_GET['url'] : ("http://www.lanzous.com/" . $id);
        $idtmp = substr($url, -7);
        $id = isset($_GET['id']) ? $_GET['id'] : $idtmp;
        $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : "";
        $type = isset($_GET['type']) ? $_GET['type'] : "";
    }

    //优化掉这段代码，新的请看上面那段
    /*if (empty($id)) {
    $FileMsg = isset($FileMsg) ? $FileMsg : "请输入URL或文件ID";
    $FCode = 400;
    die(        //停止代码继续执行
    json_encode(
        array(
            'code' => 400,
            'msg' => '请输入URL或文件ID'
        )
        , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );
}*/

    $softInfo = MloocCurlGet($url);
    if (strstr($softInfo, "文件取消分享了") != false) {
        $FileMsg = isset($FileMsg) ? $FileMsg : "文件取消分享了";
        //$FileMsg = "文件取消分享了";
        $FCode = 402;

        /*die(
    json_encode(
        array(
            'code' => 400,
            'msg' => '文件取消分享了'
        )
        , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );*/
    }
    preg_match('~class="b">(.*?)<\/div>~', $softInfo, $softName);
    if (!isset($softName[1])) {
        preg_match('~<div class="n_box_fn".*?>(.*?)</div>~', $softInfo, $softName);
    }
    preg_match('~<div class="n_box_des".*?>(.*?)</div>~', $softInfo, $softDesc);
    if (strstr($softInfo, "手机Safari可在线安装") != false) {
        if (strstr($softInfo, "n_file_infos") != false) {
            $ipaInfo = MloocCurlGet($url, 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1');
            preg_match('~href="(.*?)" target="_blank" class="appa"~', $ipaInfo, $ipaDownUrl);
        } else {
            preg_match('~com/(\w+)~', $url, $lanzouId);
            if (!isset($lanzouId[1])) {
                $FileMsg = isset($FileMsg) ? $FileMsg : "解析失败，无法获取文件ID";
                //$FileMsg = "解析失败，无法文件ID";
                $FCode = 404;
                /*die(
            json_encode(
                array(
                    'code' => 400,
                    'msg' => '解析失败，获取不到文件ID'
                )
                , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );*/
            }
            $lanzouId = $lanzouId[1];
            $ipaInfo = MloocCurlGet("https://www.lanzous.com/tp/" . $lanzouId, 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1');
            preg_match('~href="(.*?)" id="plist"~', $ipaInfo, $ipaDownUrl);
        }

        $ipaDownUrl = isset($ipaDownUrl[1]) ? $ipaDownUrl[1] : "";
        /*if ($type != "down") {
        die(
        json_encode(
            array(
                'code' => 200,
                'msg' => '',
                'name' => isset($softName[1]) ? $softName[1] : "",
                'downUrl' => $ipaDownUrl
            )
            , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    } else {
        header("Location:$ipaDownUrl");
        die;
    }*/
    }
    if (strstr($softInfo, "function down_p(){") != false) {
        if (empty($pwd)) {
            $FileMsg = isset($FileMsg) ? $FileMsg : "请输入分享密码";
            //$FileMsg = "请输入分享密码";
            $FCode = 401;
            /*die(
		json_encode(
			array(
				'code' => 400,
				'msg' => '请输入分享密码'
			)
			, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
		);*/
        }
        preg_match("~'action=(.*?)&sign=(.*?)&p='\+(.*?),~", $softInfo, $segment);
        $post_data = array(
            "action" => $segment[1],
            "sign" => $segment[2],
            "p" => $pwd
        );
        $softInfo = MloocCurlPost($post_data, "https://www.lanzous.com/ajaxm.php", $url);
    } else {
        preg_match("~iframe.*?name=\"[\s\S]*?\"\ssrc=\"\/(.*?)\"~", $softInfo, $link);
        $ifurl = "https://www.lanzous.com/" . $link[1];
        $softInfo = MloocCurlGet($ifurl);
        preg_match("~'action':'(.*?)','sign':'(.*?)'~", $softInfo, $segment);
        $post_data = array(
            "action" => $segment[1],
            "sign" => $segment[2],
        );
        $softInfo = MloocCurlPost($post_data, "https://www.lanzous.com/ajaxm.php", $ifurl);
    }
    $softInfo = json_decode($softInfo, true);
    if ($softInfo['zt'] != 1) {
        //$FileMsg = $softInfo['inf'];
        if ($FCode == 0)
            $FCode = 400;
        /*die(
    json_encode(
        array(
            'code' => 400,
            'msg' => $softInfo['inf']
        )
        , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );*/
    }
    $downUrl = $softInfo['dom'] . '/file/' . $softInfo['url'];
    $headers = [
        'Host: vip.d0.baidupan.com',
        'Connection: keep-alive',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        'Accept-Encoding: gzip, deflate, br',
        'Accept-Language: zh-CN,zh;q=0.9'
    ];
    $downUrl = MloocCurlGetDownUrl($downUrl, $headers);
    /*if ($type != "down") {
    die(
    json_encode(
        array(
            'code' => 200,
            'msg' => '',
            'name' => isset($softName[1]) ? $softName[1] : "",
			'desc' => isset($softDesc[1]) ? $softDesc[1] : "",
            'downUrl' => $downUrl
        )
        , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );
} else {
    header("Location:$downUrl");
    die;
}*/
    function MloocCurlGetDownUrl($url, $headers) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        #关闭SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #返回数据不直接显示
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if (isset($info['url']) && $info['url'] != null && $info['url'] != "") {
            return $info['url'];
        }
        return "";
    }
    function MloocCurlGet($url, $UserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36') {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        if ($UserAgent != "") {
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
    function MloocCurlPost($post_data, $url, $ifurl = '', $UserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36') {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
        if ($ifurl != '') {
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

    <?php
    $softName[1] = isset($_GET['name']) ? $_GET['name'] : $softName[1];
    $fileInfo = isset($_GET['info']) ? $_GET['info'] : "暂无";
    $FileIco = array("apk","doc","exe","jpg","mp3","mp4","pdf","png","ppt","txt","xls","zip");
    //拥有图标的文件扩展名
    ?>

    <title><?php
        //$tmpn = substr($softName[1], 0,1);
        $tmpn = strcmp($softName[1] ,"<div id=\"b\">");
        //$tmp = strcmp($tmpn ,"<");

        switch ($FCode) {
            case 400:
                echo "啊哦，出错啦";
                break;

            case 401:
                echo "请输入分享密码";
                break;

            case 402:
                echo "文件取消分享了";
                break;

            case 403:
                echo $ProgramName;
                break;

            case 404:
                echo "找不到文件";
                break;

            default:
                if (strcmp($softName[1] ,"<div id=\"b\">") == 0) {
                    echo "文件下载页" ;
                } else
                {
                    echo $softName[1];
                }
                break;
        }

        /*改用Switch语句
        if ($FCode >= 400)
        {
            if ($FCode == 401)
            {
                echo isset($_GET['name']) ? $_GET['name'] : "文件下载页";
            }
            else
            {
                echo "啊哦，出错啦";
            }
        }
        else
        if (strcmp($softName[1] ,"<div id=\"b\">") == 0)
        {
            echo "文件下载页" ;
        }
        else
        {
            echo $softName[1];
        }*/

        echo " - " . $WebName;

        ?></title>

    <link rel="icon" href="img/<?php
    //$tmpn = substr($softName[1], 0,1);
    //$tmpn = strcmp($softName[1] ,"<div id=\"b\">");
    //$tmp = strcmp($tmpn ,"<");
    /*if($FCode >= 400)
            {
                echo "cloud.png";
            }
            else
            if(strcmp($softName[1] ,"<div id=\"b\">") == 0)
            {
                echo "cloud.png";
            }
            else
            {
                echo substr($softName[1],-3) . ".png";
            }*/
    echo "icon.png";
    ?>" type="image/png">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <noscript>
        <p>
            JavaScript seems to be disabled in your Browser settings. Please enabled it or try another browser. Only contact us if this error does not go away: nkxingxh@nkxingxh.top.
        </p>
    </noscript>

    <div class="main_content">
        <div class="meta">

            <h2><?php

                switch ($FCode) {
                    case 400:
                        echo "出错啦";
                        break;

                    case 401:
                        echo "请输入分享密码";
                        break;

                    case 402:
                        echo "文件取消分享了";
                        break;

                    case 403:
                        echo $ProgramName;
                        break;

                    case 404:
                        echo "找不到文件";
                        break;

                    case 200:
                        if (strcmp($softName[1] ,"<div id=\"b\">") == 0) {
                            echo "文件下载页" ;
                        } else
                        {
                            echo $softName[1];
                        }
                        break;

                    default:
                        echo "文件下载页";
                        break;
                }

                /*//改用Switch语句
                if ($FCode >= 400)
                {
                    if ($FCode == 401)
                    {
                        echo isset($_GET['name']) ? $_GET['name'] : "文件下载页";
                    }
                    else
                    {
                        echo "出错啦";
                    }
                }
                else
                {
                    echo "文件下载页";
                }*/

                ?></h2>

            <div class="icon">
                <span style="background-image:url('/img/<?php
                    //$tmpn = substr($softName[1], 0,1);
                    //$tmpn = strcmp($softName[1] ,"<div id=\"b\">");
                    //$tmp = strcmp($tmpn ,"<");
                    if ($FCode >= 400) {
                        echo "cloud.png";
                    } else
                        if (strcmp($softName[1] ,"<div id=\"b\">") == 0) {
                        echo "cloud.png";
                    } else
                    {
                        $haveIco = false;
                        foreach ($FileIco as $itmp) {
                            if (substr($softName[1], -3) == $itmp) {
                                $haveIco = true;
                                break;
                            } else
                            {
                                $haveIco = false;
                            }
                        }

                        if ($haveIco == true) {
                            echo substr($softName[1],-3) . ".png";
                        } else
                        {
                            echo "cloud.png";
                        }
                    }
                    ?>')"></span>
            </div>
            <br>

            <?php

            if (empty($FileMsg)) {
                
                if (isset($pwd) && isset($_GET['pwd']))        //如果输入了密码则说明是密码错误，否则是请求太频繁
                {
                    $FileMsg = "未知错误，请检查密码是否有误！";
                } 
                else
                {
                    $FileMsg = "未知错误，可能是请求太频繁！";
                }
                
                //$FileMsg = "未知错误，可能是请求太频繁或密码有误！";
            }

            if ($FCode >= 400) {

                echo "<div class=\"field_layout\">";
                echo "<div class=\"label\" id=\"label0\">";
                echo "<span>状态码</span>";
                echo "</div>";
                echo "<div class=\"value\">";
                echo "<p aria-labelledby=\"branch0\">" . $FCode . "</p>";
                echo "</div>";
                echo "</div>";

                echo "<div class=\"field_layout\">";
                echo "<div class=\"label\" id=\"label0\">";
                echo "<span>信 息</span>";
                echo "</div>";
                echo "<div class=\"value\">";
                echo "<p aria-labelledby=\"branch0\">" . $FileMsg . "</p>";
                echo "</div>";
                echo "</div>";

                if ($FCode == 401)         //如果是没有输入密码
                {

                    $getData = "?" . (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : "");
                    $getData = $getData . (isset($_GET['url']) ? ("url=" . $_GET['url'] . "&") : "");
                    $getData = $getData . (isset($_GET['type']) ? ("type=" . $_GET['type'] . "&") : "");
                    $getData = $getData . (isset($_GET['name']) ? ("name=" . $_GET['name'] . "&") : "");
                    $getData = $getData . (isset($_GET['info']) ? ("info=" . $_GET['info']) : "");

                    echo("<form method=\"post\"  action=\"index.php" . $getData . "\">");
                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label0\">";
                    echo "<span>密  码</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch0\"><input type=\"text\" name=\"ipwd\" value=\"\" placeholder=\"请在此输入分享密码\"/></p>");
                    echo "</div>";
                    echo "</div>";

                    echo("<br>");
                    echo("<input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
                    echo("</form>");

                } else
                    if ($FCode == 403)        //如果是没有ID
                {
                    $getData = "?" ;
                    $getData = $getData . (isset($_GET['pwd']) ? ("pwd=" . $_GET['pwd'] . "&") : "");
                    $getData = $getData . (isset($_GET['type']) ? ("type=" . $_GET['type'] . "&") : "");
                    $getData = $getData . (isset($_GET['name']) ? ("name=" . $_GET['name'] . "&") : "");
                    $getData = $getData . (isset($_GET['info']) ? ("info=" . $_GET['info']) : "");

                    echo("<form method=\"post\"  action=\"index.php" . $getData . "\">");
                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label0\">";
                    echo "<span>文件ID</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch0\"><input type=\"text\" name=\"pid\" value=\"\" placeholder=\"请在此输入文件ID\" /></p>");
                    echo "</div>";
                    echo "</div>";

                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label0\">";
                    echo "<span>密  码</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch0\"><input type=\"text\" name=\"ipwd\" value=\"\" placeholder=\"请在此输入分享密码\"/></p>");
                    echo "</div>";
                    echo "</div>";

                    echo("<br>");
                    echo("<input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
                    echo("</form>");
                } else
                {
                    $getData = "?";

                    if ($FCode !== 402)        //如果文件没有取消分享
                    {
                        $getData = $getData . (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : "");
                        $getData = $getData . (isset($_GET['url']) ? ("url=" . $_GET['url'] . "&") : "");
                    }

                    if (empty($pwd) && $FCode !== 402)     //如果密码为空（排除错误密码）且文件没有取消分享
                    {
                        $getData = $getData . (isset($_GET['pwd']) ? ("pwd=" . $_GET['pwd'] . "&") : "");
                    }
                    
                    $getData = $getData . (isset($_GET['type']) ? ("type=" . $_GET['type'] . "&") : "");
                    $getData = $getData . (isset($_GET['name']) ? ("name=" . $_GET['name'] . "&") : "");
                    $getData = $getData . (isset($_GET['info']) ? ("info=" . $_GET['info']) : "");

                    echo("<br>");
                    echo("<a href=\"/" . $getData ."\" class=\"button\">重  试</a>");
                }

                echo("<br>");
                echo "<br>";
                echo("        <p aria-labelledby=\"branch1\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
                echo("        <p aria-labelledby=\"branch1\" align=\"center\">Copyright © " . date("Y",time()) . " NKXingXh.</p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
                echo("");
                die();
            }

            ?>

            <div class="field_layout">
                <div class="label" id="label0">
                    <span>文件</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch0">
                        <?php
                        //$tmpn = substr($softName[1], 0,1);
                        //$tmpn = strcmp($softName[1] ,"<div id=\"b\">");
                        //$tmp = strcmp($tmpn ,"<");
                        if (strcmp($softName[1] ,"<div id=\"b\">") == 0) {
                            echo "无法获取文件名！" ;
                        } else
                        {
                            echo $softName[1];
                        }

                        ?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label0">
                    <span>I  D</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch0">
                        <?php echo $id;
                        ?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label0">
                    <span>备注</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch0">
                        <?php echo $fileInfo;
                        ?>
                    </p>
                </div>
            </div>
            <!--div class="field_layout">
                                    <div class="label" id="label1">
                                        <span>大小</span>
                                    </div>
                                    <div class="value">
                                        <p aria-labelledby="branch1"><?php echo $filesize;
            ?> MB</p>
                                    </div>
                                </div>
                                < div class="field_layout">
                                    <div class="label" id="label3">
                                        <span>CRC32</span>
                                    </div>
                                    <div class="value">
                                    <p aria-labelledby="label3">
                                        <span>db802fd3</span>
                                    </p>
                                    </div>
                                </div>
                                <div class="field_layout">
                                    <div class="label" id="label4">
                                        <span>DLs</span>
                                    </div>
                                    <div class="value">
                                    <p aria-labelledby="label4">
                                        <span>30,457</span>
                                    </p>
                                    </div>
                                </div>
                                <div class="field_layout">
                                    <div class="label" id="label5">
                                        <span>Upload</span>
                                    </div>
                                    <div class="value">
                                        <p aria-labelledby="label5">July 12, 2019 20:41</p>
                                    </div>
                                </div-->
            <br>
            <!-- a href="<?php echo $downUrl;
            ?>" class="button" target="view_window">下  载</a -->
            <input type="button" class="button" value="下  载" onclick="window.open('<?php echo $downUrl;
            ?>','_blank')" />

            <br><br><br>
            <p aria-labelledby=\"branch1\" align=\"center\">
                <?php echo $ProgramName . " v" . $Version . " " . $cnzz;
                ?>
            </p>
            <p aria-labelledby="branch1" align="center">
                Copyright © <?php date("Y",time());
                ?> NKXingXh.
            </p>
            <p aria-labelledby="branch1" align="center">
                Powered By <?php echo $ProgramName;
                ?>
            </p>

        </div>

    </div>

</body>
</html>