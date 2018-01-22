<?php
header("content-type:text/html;charset=utf8");
include '../common/checksession.php';
//1.接收前台发送的数据
$ids = $_POST['ids'];
//die($ids);
//2.连接MySQL服务器
include '../common/mysql_connect.php';
//3.拼接SQL语句
$sql = "update ali_comment set cmt_state = '批准' where cmt_id in ($ids)";
//die($sql);
mysql_query($sql);
//4.获取影响行数
$num = mysql_affected_rows($link);
echo ($num > 0)? 1 : 2;
?>