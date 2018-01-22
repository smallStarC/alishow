<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收数据
$id = $_GET['id'];
//2.连接数据库
include_once '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "delete from ali_cate where cate_id = $id";
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
if ($num > 0) {
	echo '删除分类成功';
	header("Refresh:2;url=categories.php");
} else {
	echo '删除分类失败';
	header("Refresh:2;url=categories.php");
}
?>