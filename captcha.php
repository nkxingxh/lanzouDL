<?php
session_start(); //启动session

$image = imagecreatetruecolor(100,30);//创建一个宽100，高度30的图片
$bgcolor=imagecolorallocate($image,255,255,255);//图片背景是白色
imagefill($image,0,0,$bgcolor);//图片填充白色
//随机数，下面的例子是只是数字的验证码
/**
for($i=0;$i<4;$i++){
  $fontsize=6;
  $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
  $fontcontent=rand(0,9);
  $x=($i*100/4)+ rand(5,10);
  $y=rand(5,10);
  imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
**/
//随机数据，下面的例子是随机数据，包括字母和数字
$captch_code='';
for($i=0;$i<4;$i++){
  $fontsize=6;
  $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
  $data='asdfdfglfg74erf21854hgfhgfhkg4ljkghjtrtywiqpoqpwepdfgvnjytyut12313345645667686797800';
  $fontcontent=substr($data,rand(0,strlen($data)),1);
  $captch_code.=$fontcontent;

  $x=($i*100/4)+ rand(5,10);
  $y=rand(5,10);
  imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
$_SESSION['authcode'] = $captch_code;        //记录验证码

//随机点，生成干扰点
for($i=0;$i<200;$i++){
  $pointcolor=imagecolorallocate($image,rand(50,120),rand(50,120),rand(50,120));
  imagesetpixel($image,rand(1,99),rand(1,99),$pointcolor);
}
//随机线，生成干扰线
for($i=0;$i<3;$i++){
  $linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
  imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
}
header("content-type:image/png");
imagepng($image);

imagedestory($image);


?>
