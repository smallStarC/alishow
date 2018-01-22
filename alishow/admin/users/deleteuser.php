<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';	
//1.接收数据
$id = $_POST['id'];
//2.连接数据库
include_once '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "delete from ali_user where user_id = $id";
//4.执行SQL语句
mysql_query($sql);
//5.获取影响行数
$num = mysql_affected_rows($link);
//6.判断影响行数
echo ($num > 0)? 1 : 0;
?>