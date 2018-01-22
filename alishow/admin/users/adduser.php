<?php
	include '../common/checksession.php';	
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>Users &laquo; Admin</title>
		<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
		<link rel="stylesheet" href="/assets/css/admin.css">
		<script src="/assets/vendors/nprogress/nprogress.js"></script>
	</head>
	<body>
		<script>NProgress.start()</script>
		<div class="main">
			<?php
				include '../common/nav.php';
			?>
			<div class="container-fluid">
				<div class="page-title">
					<h1>用户页面</h1>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<div class="row">
					<div class="col-md-4">
						<form action="adduser_deal.php" method="post">
							<h2>添加新用户</h2>
							<div class="form-group">
								<label for="email">邮箱</label>
								<input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
							</div>
							<div class="form-group">
								<label for="slug">别名</label>
								<input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
							</div>
							<div class="form-group">
								<label for="nickname">昵称</label>
								<input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
							</div>
							<div class="form-group">
								<label for="password">密码</label>
								<input id="password" class="form-control" name="password" type="password" placeholder="密码">
							</div>
							<div class="form-group">
								<label for="status">激活状态</label>
								<input id="status" name="status" type="radio" value="1" checked>
								激活
								<input id="status" name="status" type="radio" value="0">
								未激活
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" value="添加">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="aside">
			<?php
				include	'../common/common.php';
			?>
		</div>
		<script src="/assets/vendors/jquery/jquery.js"></script>
		<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script>NProgress.done()</script>
	</body>
</html>
