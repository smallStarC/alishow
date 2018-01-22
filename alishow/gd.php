<?php
	//如果想要将图片显示在网页上设置该
	header("content-type:image/png");
	//1.创建真色彩画布
	//参数1/2：画布宽高
	//返回值：画布资源
	$img = imagecreatetruecolor(300, 300);
	//创建填充颜色
	//参数1：画布资源
	//参数2/3/4：红绿蓝三色值
	$bg = imagecolorallocate($img, 100, 255, 100);
	$red = imagecolorallocate($img, 255, 0, 0);
	$green = imagecolorallocate($img, 0, 255, 0);
	$blue = imagecolorallocate($img, 0, 0, 255);
	//填充画布颜色
	//参数1：画布资源
	//参数2/3：代表画布中的一个点(当前的取值范围0-299)
	imagefill($img, 1, 1, $bg);
	//2.绘图(使用GD库提供的各种绘图函数)
	//参数1：画布资源
	//参数2：文字大小，取值范围是1-7,1最小,7最大
	//参数3/4：绘制的文字的起始坐标
	//参数5：要绘制的文字
	//参数6：字体颜色
	//imagestring($image, $font, $x, $y, $string, $color);
	imagestring($img, 7, $x, 10, 10, $red);
	//绘制一个实现椭圆
	//参数1：画布资源
	//参数2/3：圆心的坐标点
	//参数4/5：圆的宽、高
	//参数6/7：起始角度和结束角度
	//参数8：圆的颜色
	//参数9：圆的样式
	//imagefilledarc($image, $cx, $cy, $width, $height, $start, $end, $color, $style);
	imagefilledarc($img, 150, 150, 100, 50, 0, 360, $blue, IMG_ARC_PIE);
	imagesetpixel($img, 100, 100, $blue);
	//3.显示或保存绘制好的图片
	//显示和保存是互斥的，只能选择一种
	//参数1：画布资源
	//参数2：图片的保存路径(如果有参数2，则进行图片保存，没有参数2，则进行图片显示)
	imagepng($img,'./1.png');
	//imagepng($img);
	//4.销毁画布资源
	imagedestroy($img);
?>