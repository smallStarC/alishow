<?php
include '../common/checksession.php';
//1.接收数据
$id = $_POST['id'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$pic = $_POST['pic'];
//die($pic);
$upfile_path = "";
if ($_FILES['pic']['error'] == 0) {
	$ext = strrchr($_FILES['pic']['name'], '.');
	$upfile_path = '../upload/'.time().rand(100, 999).$ext;
	move_uploaded_file($_FILES['pic']['tmp_name'], $upfile_path);
}
if (empty($pic)) {
	$picUrl = $upfile_path;
} else {
	$picUrl = $pic;
}
//echo $upfile_path;
//2.连接数据库
include '../common/mysql_connect.php';
//3.编写SQL语句并执行
$sql = "update ali_user set user_slug = '$slug',user_nickname = '$nickname', user_pic = '$picUrl' where user_id = $id";
//die($sql);
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
if ($num > 0) {
	echo '修改个人资料成功';
	header("Refresh:2;url=profile.php?id=$id");
} else {
	echo '修改个人资料失败';
	header("Refresh:2;url=profile.php?id=$id");
}

?>