<?php
include '../common/checksession.php';
//1.连接数据库
include_once '../common/mysql_connect.php';
//2.拼接SQL语句
$id = $_SESSION['user_info']['user_id'];
$sql = "select * from ali_user where user_id=$id";
//3.执行SQL语句
$res = mysql_query($sql);
$userInfo = mysql_fetch_assoc($res);
$email = $userInfo['user_email'];
$pic = $userInfo['user_pic'];
//die($pic);
$slug = $userInfo['user_slug'];
$nickname = $userInfo['user_nickname'];
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
		<style>
			.img {
				width: 150px;
	            height: 150px;
	            /*border: 1px solid skyblue;
	            border-radius: 50%;*/
			}
		</style>
	</head>
	<body>
		<script>NProgress.start()</script>
		<div class="main">
			<?php
				include '../common/nav.php';
			?>
			<div class="container-fluid">
				<div class="page-title">
					<h1>我的个人资料</h1>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<form class="form-horizontal" action="updateprofile.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>">
					<div class="form-group">
						<label class="col-sm-3 control-label">头像</label>
						<div class="col-sm-6">
							<label class="form-image">
								<!--onchange="changeImg()"-->
							<input id="pic" type="file" name="pic">
							<input type="hidden" name="pic" value="<?=$pic?>">
							<!--<img src="../../assets/img/default.png" id="img" class="img">-->
							<img src="<?php echo empty($pic)?'../../assets/img/default.png':$pic?>" id="img" class="img">
							<i class="mask fa fa-upload"></i> </label>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">邮箱</label>
						<div class="col-sm-6">
							<input id="email" class="form-control" name="email" type="type" value="<?=$email?>" placeholder="邮箱" readonly>
							<p class="help-block">
								登录邮箱不允许修改
							</p>
						</div>
					</div>
					<div class="form-group">
						<label for="slug" class="col-sm-3 control-label">别名</label>
						<div class="col-sm-6">
							<input id="slug" class="form-control" name="slug" type="type" value="<?=$slug?>" placeholder="slug">
						</div>
					</div>
					<div class="form-group">
						<label for="nickname" class="col-sm-3 control-label">昵称</label>
						<div class="col-sm-6">
							<input id="nickname" class="form-control" name="nickname" type="type" value="<?=$nickname?>" placeholder="昵称">
							<p class="help-block">
								限制在 2-16 个字符
							</p>
						</div>
					</div>
					<div class="form-group">
						<label for="bio" class="col-sm-3 control-label">简介</label>
						<div class="col-sm-6">
							<textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6">MAKE IT BETTER!</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<input type="submit" class="btn btn-primary" value="更新">
							<a class="btn btn-link" href="/admin/users/password-reset.php">
								修改密码
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="aside">
			<?php
				include	'../common/common.php';
			?>
		</div>
		<script src="../../assets/vendors/jquery/jquery.js"></script>
		<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
			var input = document.querySelector("#pic");
			input.onchange = function() {
				//1.创建文件读取对象
				var reader = new FileReader();
				//2.读取文件，获取DataURL
				var pic = document.querySelector("#pic").files;	
				console.log(pic);
				reader.readAsDataURL(pic[0]);
				//3.获取数据
				reader.onload = function () {
					//展示
					document.querySelector("#img").src = reader.result;
				}
			}
			//jQuery写法
			/*$("#pic").change(function(){ 
			var file = this.files;   
			for(var i = 0; i < file.length;i++) {
			    var reader = new FileReader();
			    reader.readAsDataURL(file[i]);
			    reader.onload = function (e) {
			        $("#img")[0].src = e.target.result;
			        };
			    }
			});*/
		</script>
		<script>NProgress.done()</script>
	</body>
</html>
