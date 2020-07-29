<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="page-topic" content="Downloads">
    <meta name="page-type" content="File Hosting">
    <meta name="robots" content="index, follow">

    <?php
    $ProgramName = "XyunDLs";
    $WebName = "幸运云存储";
    $Version = 12.0;
    $API = "http://119.29.115.54/dl/lzapi.php";
    $token = "cpoPZ2KQR1fxMTi";
    $captcha = true;
    $cnzz = "<script src=\"http://www.admin88.com/mystat.asp?id=52600&logo=11\"></script>";

    header('Access-Control-Allow-Origin: *');
    session_start();
    
    if(empty($_GET['id']) && empty($_GET['pwd']))
    {
        $FCode = 400;
    }

    if ($captcha == true && $FCode != 200 && $FCode != 400)             //加载验证码
    {
        if (empty($_GET['autocode']))        //如果验证码为空
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
            echo("                <span style=\"background-image:url('./img/cloud.png')\"></span>");
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

            $_SESSION['id'] = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_GET['id']) ? $_GET['id'] : "");
            $_SESSION['pwd'] = isset($_SESSION['pwd']) ? $_SESSION['pwd'] : (isset($_GET['pwd']) ? $_GET['pwd'] : "");

            echo("		<form method=\"get\"  action=\"index.php" . "\">");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label1\">");
            echo("                <span></span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("<img border=\"1\" id=\"capthcha_img\" onclick=\"this.src=\'captcha.php?r=\'+Math.random()\" src=\"captcha.php?r=\"" .rand() ." width=\"100\" height=\"30\"  /> <a href=\"javascript:void(0)\" onclick=\"document.getElementById(\'capthcha_img\').src=\'captcha.php?r=\'+Math.random()\"></a>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label2\">");
            echo("                <span>验证码</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch2\"><input type=\"text\" name=\"autocode\" value=\"\" placeholder=\"请在此输入验证码\"/></p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("        <br>");
            echo("          <input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
            echo("		</form>");
            echo("		");
            echo("        <br>");
            echo("        <p aria-labelledby=\"branch3\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
            echo("        <p aria-labelledby=\"branch4\" align=\"center\">Copyright © " . date("Y", time()) . " NKXingXh. </p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
            echo("");
            echo("        </div>");
            echo("        ");
            echo("    </div>");
            echo("    ");
            echo("</body>");
            echo("</html>");
            exit();
        } 
        elseif(strtolower($_GET['autocode']) !== $_SESSION['authcode'])    //如果验证码错误
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
            echo("                <span style=\"background-image:url('./img/cloud.png')\"></span>");
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

            $_SESSION['id'] = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_GET['id']) ? $_GET['id'] : "");
            $_SESSION['pwd'] = isset($_SESSION['pwd']) ? $_SESSION['pwd'] : (isset($_GET['pwd']) ? $_GET['pwd'] : "");

            echo("		<form method=\"get\"  action=\"index.php" . "\">");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label1\">");
            echo("                <span></span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("<img border=\"1\" id=\"capthcha_img\" onclick=\"this.src=\'captcha.php?r=\'+Math.random()\" src=\"captcha.php?r=\"" .rand() ." width=\"100\" height=\"30\"  /> <a href=\"javascript:void(0)\" onclick=\"document.getElementById(\'capthcha_img\').src=\'captcha.php?r=\'+Math.random()\"></a>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("		<div class=\"field_layout\">");
            echo("            <div class=\"label\" id=\"label2\">");
            echo("                <span>验证码</span>");
            echo("            </div>");
            echo("            <div class=\"value\">");
            echo("				<p aria-labelledby=\"branch2\"><input type=\"text\" name=\"autocode\" value=\"\" placeholder=\"请在此输入验证码\" /></p>");
            echo("            </div>");
            echo("        </div>");
            echo("		");
            echo("        <br>");
            echo("          <input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
            echo("		</form>");
            echo("		");
            echo("        <br>");
            echo("        <p aria-labelledby=\"branch3\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
            echo("        <p aria-labelledby=\"branch4\" align=\"center\">Copyright © " . date("Y", time()) . " NKXingXh.</p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
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

    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : "";

    if($captcha)
    {
        if(isset($_SESSION['id']))
        {
            $id = ($_SESSION['id'] != "") ? $_SESSION['id'] : $id;
            unset($_SESSION['id']);
        }
        if(isset($_SESSION['pwd']))
        {
            $pwd = ($_SESSION['pwd'] != "") ? $_SESSION['pwd'] : $pwd;
            unset($_SESSION['pwd']);
        }
    }
    $url = isset($_GET['url']) ? $_GET['url'] : ("http://www.lanzous.com/" . $id);

    $OData = MloocCurlGet($API . "?url=" . $url . "&pwd=" . $pwd . "&type=0&token=" . $token);
    $OData = json_decode($OData, true);
    $FCode = $OData['code'];
    if($id == "")
    {
        $FileMsg = "请输入文件ID";
    }
    else
    {
        $FileMsg = $OData['msg'];
    }
    $FileName = $OData['name'];
    $fileInfo = $OData['info'];
    $FileSize = $OData['size'];
    $FileDate = $OData['date'];
    $Author = $OData['author'];
    $downUrl = $OData['url'];

    function MloocCurlGet($url, $UserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3626.121 Safari/537.36') {
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

    $FileIco = array("7z", "apk", "doc", "exe", "jpg", "mp3", "mp4", "pdf", "png", "ppt", "txt", "xls", "zip");
    ?>

    <title><?php
        if ($FCode == 400) {
            echo $ProgramName;
        } 
        else
        {
            echo $FileMsg;
        }
        echo " - " . $WebName;

        ?></title>

    <link rel="icon" href="img/<?php echo "icon.png"; ?>" type="image/png">
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
                    /*case 400:
                        echo $ProgramName;
                        break;
                    
                    case 200:
                        echo $FileName;
                        break;
                    */
                    default:
                        //echo "文件下载页";
                        echo '<a href="./">' . $ProgramName . '</a>';
                        break;
                }
                ?></h2>

            <div class="icon">
                <span style="background-image:url('./img/<?php
                    if ($FCode >= 400) 
                    {
                        echo "cloud.png";
                    } 
                    elseif (strcmp($FileName, "<div id=\"b\">") == 0) 
                    {
                        echo "cloud.png";
                    } 
                    else
                    {
                        $haveIco = false;
                        foreach ($FileIco as $itmp) 
                        {
                            if (substr($FileName, -3) == $itmp) 
                            {
                                $haveIco = true;
                                break;
                            } 
                            else
                            {
                                $haveIco = false;
                            }
                        }
                        if ($haveIco == true) 
                        {
                            echo substr($FileName, -3) . ".png";
                        } 
                        else
                        {
                            echo "cloud.png";
                        }
                    }
                    ?>')"></span>
            </div>
            <br>

            <?php

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
                echo "<div class=\"label\" id=\"label1\">";
                echo "<span>信 息</span>";
                echo "</div>";
                echo "<div class=\"value\">";
                echo "<p aria-labelledby=\"branch0\">" . $FileMsg . "</p>";
                echo "</div>";
                echo "</div>";

                if ($FCode == 401)         //如果是没有输入密码或密码错误
                {
                    $_SESSION['id'] = $id;
                    echo("<form method=\"get\"  action=\"index.php" . "\">");
                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label2\">";
                    echo "<span>密  码</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch2\"><input type=\"text\" name=\"pwd\" value=\"\" placeholder=\"请在此输入分享密码\"/></p>");
                    echo "</div>";
                    echo "</div>";
                    echo("<br>");
                    echo("<input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
                    echo("</form>");
                } 
                elseif ($FCode == 400)        //如果是没有ID
                {
                    echo("<form method=\"get\"  action=\"index.php" . "\">");
                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label3\">";
                    echo "<span>文件ID</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch3\"><input type=\"text\" name=\"id\" value=\"\" placeholder=\"请在此输入文件ID\" /></p>");
                    echo "</div>";
                    echo "</div>";

                    echo "<div class=\"field_layout\">";
                    echo "<div class=\"label\" id=\"label4\">";
                    echo "<span>密  码</span>";
                    echo "</div>";
                    echo "<div class=\"value\">";
                    echo("<p aria-labelledby=\"branch4\"><input type=\"text\" name=\"pwd\" value=\"\" placeholder=\"请在此输入分享密码\"/></p>");
                    echo "</div>";
                    echo "</div>";

                    echo("<br>");
                    echo("<input type=\"submit\"  value=\"确  认\" class=\"button\"/>");
                    echo("</form>");
                }
                else
                {
                    $getData = "?";
                    $getData = $getData . (isset($_GET['id']) ? ("id=" . $_GET['id'] . "&") : $id);
                    $getData = $getData . (isset($_GET['url']) ? ("url=" . $_GET['url'] . "&") : $url);
                    $getData = $getData . (isset($_GET['pwd']) ? ("pwd=" . $_GET['pwd'] . "&") : $id);

                    echo("<br>");
                    echo '<a onclick="javascript:history.back(-1);" class="button">返  回</a>';
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                    echo("<a href=\"./" . $getData ."\" class=\"button\">重  试</a>");
                }

                echo("<br>");
                echo "<br>";
                echo("        <p aria-labelledby=\"branch5\" align=\"center\">" . $ProgramName . " v" . $Version . " " . $cnzz . "</p>");
                echo("        <p aria-labelledby=\"branch6\" align=\"center\">Copyright © " . date("Y", time()) . " NKXingXh.</p><p aria-labelledby=\"branch1\" align=\"center\">Powered By ". $ProgramName ."</p>");
                echo("");
                die();
            }
            ?>

            <div class="field_layout">
                <div class="label" id="label0">
                    <span>文件名</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch0">
                        <?php echo $FileName;?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label1">
                    <span>文件ID</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch1">
                    <?php echo $id;?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label2">
                    <span>大小</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch2">
                        <?php echo $FileSize; ?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label3">
                    <span>日期</span>
                </div>
                <div class="value">
                    <p aria-labelledby="label3">
                        <?php echo $FileDate; ?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label4">
                    <span>发布者</span>
                </div>
                <div class="value">
                    <p aria-labelledby="label4">
                        <?php echo $Author; ?>
                    </p>
                </div>
            </div>

            <div class="field_layout">
                <div class="label" id="label5">
                    <span>备注</span>
                </div>
                <div class="value">
                    <p aria-labelledby="branch5">
                        <?php echo $fileInfo;
                        ?>
                    </p>
                </div>
            </div>

            <br>
            <input type="button" class="button" value="下    载" onclick="window.open('<?php echo $downUrl;?>','_blank')" />
            <br><br>
            <p aria-labelledby="branch6" align="center">
                <?php echo $ProgramName . " v" . $Version . " " . $cnzz;?>
            </p>
            <p aria-labelledby="branch7" align="center">
                Copyright © <?php date("Y", time());?> NKXingXh.
            </p>
            <p aria-labelledby="branch8" align="center">
                Powered By <?php echo $ProgramName;?>
            </p>
        </div>
    </div>

</body>
</html>