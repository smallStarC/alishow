<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收数据
$name = trim($_POST['name']);//去除空格
$slug = trim($_POST['slug']);
$icon = trim($_POST['icon']);
$status = $_POST['status'];
$show = $_POST['show'];
//2.连接数据库
include_once '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "insert into ali_cate values (null,'$name','$slug','$icon','$status','$show');";
//die($sql);
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
if ($num > 0) {
	echo '添加分类成功';
	header("Refresh:2;url=categories.php");
} else {
	echo '添加分类失败';
	header("Refresh:2;url=addcategories.php");
}
?>