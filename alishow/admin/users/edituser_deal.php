<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';	
//1.接收数据
$id = trim($_POST['id']);
$email = trim($_POST['email']);//去除空格
$slug = trim($_POST['slug']);
$nickname = trim($_POST['nickname']);
$password = md5(trim($_POST['password']));
$status = $_POST['status'];
//2.连接数据库
include_once '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "update ali_user set user_email = '$email',user_slug = '$slug',user_nickname = '$nickname',user_pwd = '$password',user_pic = '',user_state = '$status' where user_id = '$id';";
//die($sql);
//die($sql);
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
if ($num > 0) {
	echo '修改用户成功';
	header("Refresh:2;url=users.php");
} else {
	echo '修改用户失败';
	header("Refresh:2;url=edituser.php?id=$id");
}
?>