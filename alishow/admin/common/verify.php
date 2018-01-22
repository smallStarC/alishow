<?php
header("content-type:image/png");
//1. 创建验证码
//定义字符串，验证码中的所有字符都要从该字符串中产生
$str = "2345678abcdefhjkmnpqrstuvwxyz";
//要产生一个四位的验证码，每次产生一个
//获取字符串长度
$len = strlen($str);
//定义验证码变量
$code = '';
for ($i = 0; $i < 4; $i++) {
	$code .= $str[rand(0, $len - 1)];
}
//echo $code;
//将验证码保存在session中
session_start();
$_SESSION['syscode'] = $code;
//2.绘制验证码
//2.1创建画布
$img = imagecreatetruecolor(100, 40);
//创建颜色
$bg = imagecolorallocate($img, 192, 192, 192);
//填充画布颜色
imagefill($img, 1, 1, $bg);
//2.2绘图，绘制验证码
for ($i = 0; $i < 4; $i++) {
	//imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	imagettftext(
		$img, //画布资源
		rand(15, 25), //字体大小，像素为单位 
		rand(-20, 20), // 字体的倾斜角度
		10 + $i * 20, // 绘制文字的起始X点
		30, // 绘制文字的起始Y点
		imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255)), // 绘制文字的颜色
		'SIMHEI.TTF', // 绘制文字所使用的字体(C:/windows/fonts)
		$code[$i] //绘制的文字
	);
}
//2.3显示
imagepng($img);
//2.4销毁画布资源
imagedestroy($img);
?>