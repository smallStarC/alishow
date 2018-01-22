<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收表单数据
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = strtotime($_POST['created']);
$status = $_POST['status'];
/*表单提交的能够直接使用的数据只有6个，而数据表中的数据有14个，剩下的8个数据手动补充。
post_id： 自增长不用管
post_desc： 摘要可以截取文章内容的前100个字符
post_author： 从session当中获得
post_file： 保存图片上传之后的路径
post_updtime： 添加时，可以使用addtime来作为updtime
post_click： 使用一个随机数设置一个默认值
post_goods： 使用一个随机数设置一个默认值，要小于点击量
post_bad：  使用一个随机数设置一个默认值*/
//2.手动补充表单中没有的数据
$desc = $_POST['desc'];
$author = $_SESSION['id'];
$updtime = $created;
$click = rand(300, 800);
$good = rand(200, 300);
$bad = rand(5, 200);
//3.保存文件路径，文件上传的特殊处理
$upfile_path = "null";
if ($_FILES['feature']['error'] == 0) {
	$ext = strrchr($_FILES['feature']['name'], '.');
	$upfile_path = '../upload/'.time().rand(100, 999).$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'], $upfile_path);
}
//echo $upfile_path;
//4.连接MySQL数据库，编写SQL语句并执行
include_once '../common/mysql_connect.php';
$sql = "insert into ali_post values (null, '$title', '$slug', '$desc', '$content', $author, $category, 
'$upfile_path', $created, $updtime, $click, $good, $bad, '$status')";
//die($sql);
$res = mysql_query($sql);
//var_dump($res);
//5.获取影响行数，根据影响行数进行跳转
$num = mysql_affected_rows($link);
//die($num.'44444444');
if ($num > 0) {
	echo '添加新文章成功';
	header('refresh:2;url=posts.php');
} else {
	echo '添加新文章失败';
	header('refresh:2;url=addpost.php');
}
?>