<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收前台发送的数据
$id = $_POST['id'];
$name = $_POST['name'];
//2.连接MySQL服务器
include '../common/mysql_connect.php';
//3.编写SQL语句并执行
$sql = "update ali_comment set cmt_state = '$name' where cmt_id = $id";
//die($sql);
mysql_query($sql);
//4.获取影响行数
$num = mysql_affected_rows($link);
echo ($num > 0)? 1 : 2;
/*if ($num > 0) {
	echo 1;
} else {
	echo 2;
}*/
?>