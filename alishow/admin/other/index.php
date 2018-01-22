<?php
	include '../common/checksession.php';	
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>Dashboard &laquo; Admin</title>
		<link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
		<link rel="stylesheet" href="../../assets/css/admin.css">
		<script src="../../assets/vendors/nprogress/nprogress.js"></script>
	</head>
	<body>
		<script>NProgress.start()</script>
		<div class="main">
			<?php
				include '../common/nav.php';
			?>
			<div class="container-fluid">
				<div class="jumbotron text-center">
					<h1>欢迎进入阿里百秀管理系统</h1>
					<p>
						阿里百秀-发现生活，发现美!
					</p>
					<p>
						<a class="btn btn-primary btn-lg" href="/admin/posts/addpost.php" role="button">
							写文章
						</a>
					</p>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">站点内容统计：</h3>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<strong>10</strong>篇文章（<strong>2</strong>篇草稿）
								</li>
								<li class="list-group-item">
									<strong>6</strong>个分类
								</li>
								<li class="list-group-item">
									<strong>5</strong>条评论（<strong>1</strong>条待审核）
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>
		<div class="aside">
			<?php
				include_once '../common/common.php';
			?>
		</div>
		<script src="../../assets/vendors/jquery/jquery.js"></script>
		<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script>NProgress.done()</script>
	</body>
</html>
