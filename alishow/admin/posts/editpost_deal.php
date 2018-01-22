<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收表单提交数据
$id = $_POST['id'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = time();//$_POST['created'];
$status = $_POST['status'];
//2.接收上传图片
include '../common/mysql_connect.php';
$upfile_path = "";
$oldpath = '';
if ($_FILES['feature']['error'] == 0) {
	$ext = strrchr($_FILES['feature']['name'], '.');
	$upfile_path = '../upload/'.time().rand(100, 999).$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'], $upfile_path);
	//如果有上传的文件时，查询原始文件的路径，在成功执行之后删除原始图片
	$sql = "select post_file from ali_post where post_id=$id";
	$res = mysql_query($sql);
	$file = mysql_fetch_assoc($res);
	$oldpath = $file['post_file'];
}
//3.编写修改的SQL语句
$upfile = '';
if ($upfile_path != '') {
	$upfile = ",post_file='$upfile_path'";
}
$sql = "update ali_post set post_title = '$title', post_desc = '$desc', post_content = '$content', post_slug = '$slug', 
post_cateid = '$category', post_updtime = $created, post_state = '$status'
$upfile where post_id = $id";
//die($sql);
mysql_query($sql);
//4.获取影响行数
$num = mysql_affected_rows($link);
if ($num > 0) {
	//删除图片
	if ($oldpath != '') {
		unlink($oldpath);
	}
	echo "修改文章成功";
	header('refresh:2;url=posts.php');
} else {
	echo "修改文章失败";
	header('refresh:2;url=editpost.php?id='.$id);
}
?>