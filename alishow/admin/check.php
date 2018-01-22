<?php
header("content-type:text/html;charset=utf8");
//1.接收表单提交的验证码
$code = $_POST['code'];
//开启session
session_start();
//2.判断验证码是否一致
if ($code != $_SESSION['syscode']) {//$_SESSION['code']为系统中产生的验证码
	echo '验证码错误';
	header('refresh:2;url=login.html');
	die();
}
//3.接收表单提交的用户名和密码
$email = $_POST['email'];
$password = $_POST['password'];
//4.连接数据库
include "./common/mysql_connect.php";
//5.编写SQL语句
$sql = "select * from ali_user where user_email = '$email'";
$res = mysql_query($sql);
$user_info = mysql_fetch_assoc($res);
//die($user_info['user_pwd']);
//6.通过判断用户输入的密码和数据表获取的密码是否相同来判断是否正常登陆
if ($user_info['user_pwd'] == md5($password)) {
	//将用户的重要信息(用户id、用户名、用户昵称等)保存到session中
	$_SESSION['id'] = $user_info['user_id'];
	$_SESSION['email'] = $user_info['user_email'];
	$_SESSION['nickname'] = $user_info['user_nickname'];
	//把用户所有信息保存在session
	$_SESSION['user_info'] = $user_info;
	echo '登陆成功';
	header('refresh:2;url=other/index.php');
} else {
	echo '用户名或密码错误';
	header('refresh:2;url=login.html');
}
?>