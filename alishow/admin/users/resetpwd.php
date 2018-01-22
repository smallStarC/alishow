<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收旧密码
$oldpwd = $_POST['oldpwd'];
//2.取出session中的密码
//session_start();
//Notice: A session had already been started - ignoring session_start() in...
//在checksession.php中已经开启过session，此处在开启会报错
$syspwd = $_SESSION['user_info']['user_pwd'];
$id = $_SESSION['user_info']['user_id'];
//3.判断旧密码是否和数据表中的密码一致
if (md5($oldpwd) != $syspwd) {
	echo '旧密码不正确';
	header('refresh:2;url=password-reset.php');
	die();
} else {
	//4.检测两次输入的新密码是否一致
	if ($_POST['newpwd'] != $_POST['newpwdreset']) {
		echo '两次新密码不一致';
		header('refresh:2;url=password-reset.php');
		die;
	} else {
		//5.连接数据库
		include '../common/mysql_connect.php';
		//6.两次新密码是否一致，则修改数据
		//编写SQL语句
		$newpwd = md5($_POST['newpwd']);
		$sql = "update ali_user set user_pwd='$newpwd' where user_id=$id";
		mysql_query($sql);
		$num = mysql_affected_rows($link);
		if ($num > 0) {
			echo '修改密码成功';
			header('refresh:2;url=profile.php');
			die;
		} else{
			echo '修改密码失败';
			header('refresh:2;url=password-reset.php');
			die;
		}
	}
}
?>