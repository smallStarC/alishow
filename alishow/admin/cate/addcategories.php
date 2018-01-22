<?php
	include '../common/checksession.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>Categories &laquo; Admin</title>
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
					<h1>分类目录</h1>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<div class="row">
					<div class="col-md-4">
						<form action="addcate_deal.php" method="post">
							<h2>添加新分类目录</h2>
							<div class="form-group">
								<label for="name">名称</label>
								<input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
							</div>
							<div class="form-group">
								<label for="slug">别名</label>
								<input id="slug" class="form-control" name="slug" type="text" placeholder="别名">
							</div>
							<div class="form-group">
								<label for="icon">图标</label>
								<input id="icon" class="form-control" name="icon" type="text" placeholder="图标">
							</div>
							<div class="form-group">
								<label for="status">是否启用</label>
								<input id="status" name="status" type="radio" value="1">
								启用
								<input id="status" name="status" type="radio" value="0">
								禁用
							</div>
							<div class="form-group">
								<label for="show">是否显示</label>
								<input id="show" name="show" type="radio" value="1">
								显示
								<input id="show" name="show" type="radio" value="0">
								不显示
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
			include '../common/common.php';
			?>
		</div>
		<script src="/assets/vendors/jquery/jquery.js"></script>
		<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script>NProgress.done()</script>
	</body>
</html>
