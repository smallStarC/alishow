<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收数据
$id = trim($_POST['id']);
$name = trim($_POST['name']);//去除空格
$slug = trim($_POST['slug']);
$icon = trim($_POST['icon']);
$status = $_POST['status'];
$show = $_POST['show'];
//2.连接数据库
include_once '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "update ali_cate set cate_name = '$name',cate_slug = '$slug',cate_class = '$icon',cate_status = '$status',cate_show = '$show' where cate_id = '$id';";
//die($sql);
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
if ($num > 0) {
	echo '修改分类成功';
	header("Refresh:2;url=categories.php");
} else {
	echo '修改分类失败';
	//header("Refresh:2;url=editcate.php?id='$id'");
	header("Refresh:2;url=editcate.php?id=$id");
	//header("Refresh:2;url='editcate.php?id=$id'");//url地址可以用单引号包起来，也可以不包起来
}
?>