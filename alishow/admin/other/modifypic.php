<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收表单数据
$id = $_POST['id'];
$name = $_POST['name'];
//2.连接MySQL服务器
include '../common/mysql_connect.php';
//3.编写SQL语句
$sql = "update ali_pic set pic_state = '$name' where pic_id = $id";
mysql_query($sql);
//4.获取影响行数
$num = mysql_affected_rows($link);
echo ($num > 0)? 1:2;
?>