<?php
	//1.连接数据库
	include_once '../common/mysql_connect.php';
	//2.拼接SQL语句
	$id = $_SESSION['user_info']['user_id'];
	$sql = "select * from ali_user where user_id=$id";
	//3.执行SQL语句
	$res = mysql_query($sql);
	$userInfo = mysql_fetch_assoc($res);
	$pic = $userInfo['user_pic'];
	$nickname = $userInfo['user_nickname'];	
?>
<div class="profile">
	<!--<img class="avatar" src="/uploads/avatar.jpg">-->
	<img class="avatar" src="<?=empty($pic)?'/assets/img/default.png':$pic?>">
	<h3 class="name"><?=$nickname?></h3>
</div>
<ul class="nav">
	<li>
		<a href="/admin/other/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
	</li>
	<li class="active">
		<a href="#menu-posts" data-toggle="collapse">
			<i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
		</a>
		<ul id="menu-posts" class="collapse in">
			<li>
				<a href="/admin/posts/posts.php">所有文章</a>
			</li>
			<li>
				<a href="/admin/posts/addpost.php">写文章</a>
			</li>
			<li class="active">
				<a href="/admin/cate/categories.php">分类目录</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="/admin/comments/comments.php"><i class="fa fa-comments"></i>评论</a>
	</li>
	<li>
		<a href="/admin/users/users.php"><i class="fa fa-users"></i>用户</a>
	</li>
	<li>
		<a href="#menu-settings" class="collapsed" data-toggle="collapse">
			<i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
		</a>
		<ul id="menu-settings" class="collapse">
			<li>
				<a href="nav-menus.html">导航菜单</a>
			</li>
			<li>
				<a href="/admin/other/slides.php">图片轮播</a>
			</li>
			<li>
				<a href="/admin/other/settings.php">网站设置</a>
			</li>
		</ul>
	</li>
</ul>