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
		<style>
			.myimg{
				height: 40px !important;
			}
		</style>
	</head>
	<?php
	//1.连接数据库
	include_once '../common/mysql_connect.php';
	//2.编写SQL语句
	//$pageno = 1;//当前页码
	//判断是否存在通过GET请求传来的$pageno，没有页码默认为第1页
	$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
	//每页显示条数
	$pagesize = 5;
	//起始位置
	$start = ($pageno - 1) * $pagesize;
	$sql = "select * from ali_user limit $start,$pagesize";
	//die($sql);
	//3.执行SQL语句
	$res = mysql_query($sql);
	//分页显示部分
	//1.获取总条数
	$sql = "select count(*) as num from ali_user";
	$result = mysql_query($sql);
	$tmp = mysql_fetch_assoc($result);
	$count = $tmp['num'];
	//2.计算总页数
	$pages = ceil($count / $pagesize);
	//3.判断上一页，下一页
	$prev = ($pageno <= 1) ? 1 : ($pageno - 1);
	$next = ($pageno >= $pages) ? $pages : ($pageno + 1);
	?>
	<body>
		<script>NProgress.start()</script>
		<div class="main">
			<?php
				include '../common/nav.php';
			?>
			<div class="container-fluid">
				<div class="page-title">
					<h1>用户</h1>
					<a href="./adduser.php">添加新用户</a>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<div class="row">
					<div class="col-md-8">
						<div class="page-action">
							<!-- show when multiple checked -->
							<a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">
								批量删除
							</a>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center" width="40">
										<input type="checkbox">
									</th>
									<th class="text-center" width="80">头像</th>
									<th>邮箱</th>
									<th>别名</th>
									<th>昵称</th>
									<th>状态</th>
									<th class="text-center" width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php while($row = mysql_fetch_assoc($res)):?>
									<tr>
										<td class="text-center">
											<input type="checkbox">
										</td>
										<td class="text-center">
											<img class="avatar myimg" src="<?php echo empty($row['user_pic'])?'../../assets/img/default.png':$row['user_pic']?>">
										</td>
										<td><?=$row['user_email'] ?></td>
										<td><?=$row['user_slug'] ?></td>
										<td><?=$row['user_nickname'] ?></td>
										<td><?=($row['user_state'] == 1) ? '激活' : '未激活'; ?></td>
										<td class="text-center">
											<a href="edituser.php?id=<?=$row['user_id']?>" class="btn btn-default btn-xs">
												编辑
											</a>
											<a href="javascript:;" data-userid="<?=$row['user_id'] ?>" class="deluser btn btn-danger btn-xs">
												删除
											</a></td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
						<ul class="pagination pagination-sm pull-right">
							<li><a href="users.php?pageno=1">首页</a></li>
							<?php
							/*if($pageno <= 1) {
							 $prev = 1;
							 }	else {
							 $prev = $pageno - 1;
							 }*/
							/*if ($pageno >= $pages) {
							 $next = $pages;
							 } else {
							 $next = $pageno + 1;
							 }*/
							?>
				          <!--<li><a href="users.php?pageno=<?=$prev?>">上一页</a></li>-->
				          <li><a href="users.php?pageno=<?=$prev ?>">上一页</a></li>
				          <li><a href="users.php?pageno=<?=$pageno ?>"><?='当前为第'.$pageno.'页' ?></a></li>
				          <?php for($i=1; $i<=$pages; $i++):?>
				          <li><a href="users.php?pageno=<?=$i ?>"><?=$i ?></a></li>
				          <?php endfor; ?>   	
				          <!--<li><a href="users.php?pageno=<?=$next?>">下一页</a></li>-->
				          <li><a href="users.php?pageno=<?=$next ?>">下一页</a></li>
				          <li><a href="users.php?pageno=<?=$pages ?>">尾页</a></li>
				        </ul>
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
		<script>
			$('.deluser').click(function() {
				if(confirm('确定删除吗？')) {
					var userid = $(this).attr('data-userid');
					that = this;
					$.ajax({
						url:'deleteuser.php',
						data:{id:userid},
						type:'post',
						dataType:'text',
						success:function(data) {
							if (data == 1) {
								alert('删除用户成功');
								$(that).parent().parent().remove();
							} else {
								alert('删除用户失败');
							}
						}
					});
				}
			});
		</script>
	</body>
</html>

	