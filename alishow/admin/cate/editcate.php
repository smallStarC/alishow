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
	<?php
		//1.接收数据
		$id = $_GET['id'];
		var_dump($id);
		//2.连接数据库
		include_once '../common/mysql_connect.php';
		//3.拼接SQL语句
		$sql = "select * from ali_cate where cate_id=$id";
		//die($sql);
		//4.执行SQL语句
		$res = mysql_query($sql);
		//5.
		$cateInfo = mysql_fetch_assoc($res);
	?>
	<body>
		<script>NProgress.start()</script>
		<div class="main">
			<?php
				include	'../common/nav.php';
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
						<form action="editcate_deal.php" method="post">
							<input type="hidden" name="id" value="<?=$cateInfo['cate_id']?>">
							<h2>修改新分类目录</h2>
							<div class="form-group">
								<label for="name">名称</label>
								<input id="name" class="form-control" name="name" type="text" value="<?=$cateInfo['cate_name']?>">
							</div>
							<div class="form-group">
								<label for="slug">别名</label>
								<input id="slug" class="form-control" name="slug" type="text" value="<?=$cateInfo['cate_slug']?>">
							</div>
							<div class="form-group">
								<label for="icon">图标</label>
								<input id="icon" class="form-control" name="icon" type="text" value="<?=$cateInfo['cate_class']?>">
							</div>
							<div class="form-group">
								<label for="status">是否状态</label>
								<input id="status" name="status" type="radio" value="1" <?=$cateInfo['cate_status'] == '1'?'checked':''?>>启用
								<input id="status" name="status" type="radio" value="0" <?=$cateInfo['cate_status'] != '1'?'checked':''?>>禁用
							</div>
							<div class="form-group">
								<label for="show">是否显示</label>
								<input id="show" name="show" type="radio" value="1" <?=$cateInfo['cate_show'] == '1'?'checked':''?>>显示
								<input id="show" name="show" type="radio" value="0" <?=$cateInfo['cate_show'] != '1'?'checked':''?>>不显示
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" value="修改">
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
