<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//var_dump($_POST);die;
//1.接收表单数据
$name = $_POST['site_name'];
$desc = $_POST['site_description'];
$keys = $_POST['site_keywords'];
$status = isset($_POST['comment_status'])?$_POST['comment_status']:0;
$reviewed = isset($_POST['comment_reviewed'])?$_POST['comment_reviewed']:0;
//2.检测是否有文件上传
//获取原图片路径
$tmp = include 'site.conf.php';
$old_logo = $tmp['site_logo'];
$upfile_path = '';
if ($_FILES['site_logo']['error'] == 0) {
	$ext = strrchr($_FILES['site_logo']['name'], '.');
	$upfile_path = "../upload/".time().rand(100, 999).$ext;
	move_uploaded_file($_FILES['site_logo']['tmp_name'], $upfile_path);
}
if ($upfile_path != "") {
	unlink($old_logo);
} else {
	$upfile_path = $old_logo;
}
//3.将数据写回到site.conf.php文件
//调用fopen方法打开文件
$fp = fopen('site.conf.php', 'w');
$str = "
<?php
return array(
	'site_logo' => '{$upfile_path}',
	'site_name' => '{$name}',
	'site_desc' => '{$desc}',
	'site_keys' => '{$keys}',
	'site_cmts' => $status,
	'site_allow' => $reviewed
);
?>";
//调用fwrite方法将字符串写入文件
fwrite($fp, $str);
echo '重置设置成功';
header('refresh:2;url=settings.php');
?>