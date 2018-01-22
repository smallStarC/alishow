<?php
header("content-type:text/html;charset=utf8");
//1.接收表单提交的验证码
$usercode = $_POST['code'];
//开启session
session_start();
$syscode = $_SESSION['syscode'];
//2.判断验证码是否一致
if ($usercode == $syscode) {
	echo 1;
} else {
	echo 0;
}
?>