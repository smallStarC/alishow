<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>Comments &laquo; Admin</title>
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
			include '../common/checksession.php';
			include '../common/nav.php';
			include '../common/mysql_connect.php';
			//编写SQL语句
			$sql = "select cmt_id, cmt_content, cmt_time, cmt_state, member_nickname, post_title from ali_comment as c
					join ali_member as m on c.cmt_memid = m.member_id
					join ali_post as p on c.cmt_postid = p.post_id";
			$res = mysql_query($sql);
			?>
			<div class="container-fluid">
				<div class="page-title">
					<h1>所有评论</h1>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<div class="page-action">
					<!-- show when multiple checked -->
					<div class="btn-batch" style="display: block">
						<button id="allow" class="btn btn-info btn-sm">
						批量批准
						</button>
						<button class="btn btn-warning btn-sm">
						批量拒绝
						</button>
						<button class="btn btn-danger btn-sm">
						批量删除
						</button>
					</div>
					<ul class="pagination pagination-sm pull-right">
						<li>
							<a href="#">
								上一页
							</a>
						</li>
						<li>
							<a href="#">
								1
							</a>
						</li>
						<li>
							<a href="#">
								2
							</a>
						</li>
						<li>
							<a href="#">
								3
							</a>
						</li>
						<li>
							<a href="#">
								下一页
							</a>
						</li>
					</ul>
				</div>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center" width="40">
								<input type="checkbox">
							</th>
							<th>作者</th>
							<th>评论</th>
							<th>评论在</th>
							<th>提交于</th>
							<th>状态</th>
							<th class="text-center" width="100">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; while($row = mysql_fetch_assoc($res)){ $i++;?>
						<tr class="<?=($i%2 == 0)?'':'danger';?>">
							<td class="text-center">
								<input type="checkbox" value="<?=$row['cmt_id'];?>">
							</td>
							<td><?=$row['member_nickname'];?></td>
							<td><?=$row['cmt_content'];?></td>
							<td><?=$row['post_title'];?></td>
							<td><?=date('Y/m/d', $row['cmt_time']);?></td>
							<td class="state"><?=$row['cmt_state'];?></td>
							<td class="text-center">
								<?php if ($row['cmt_state'] == '批准'):?>
								<a href="javascript:;" data="<?=$row['cmt_id'];?>" class="btncmt btn btn-warning btn-xs">驳回</a>
								<?php else:?>
								<a href="javascript:;" data="<?=$row['cmt_id'];?>" class="btncmt btn btn-info btn-xs">批准</a>	
								<?php endif;?>
								<a href="javascript:;" class="btn btn-danger btn-xs">
									删除
								</a>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="aside">
		<?php
			include '../common/common.php';
		?>
		</div>
		<script src="../../assets/vendors/jquery/jquery.js"></script>
		<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script>NProgress.done()</script>
		<script>
			//1.获取批准/驳回按钮，并绑定点击事件
			$('.btncmt').click(function() {			
				that = $(this);
				//2.获取当前行的cmt_id
				var id = $(this).attr('data');
				//3.获取按钮上的文字
				var name = $(this).html();
				//4.发送ajax请求
				$.post('modifycmt.php', {id:id, name:name}, function(data) {
					if (data == 1) {
						//修改成功：将页面状态栏的文字修改为按钮上的文字，再将按钮上的文字修改成状态栏的文字，还要修改按钮的css样式
						//提示修改成功
						that.parent().parent().find('.state').html(name);
						if (name == '批准') {
							that.removeClass('btn-info');
							that.addClass('btn-warning');
							that.html('驳回');
						} else {
							that.removeClass('btn-warning');
							that.addClass('btn-info');
							that.html('批准');
						}
						alert('修改成功');
					} else {
						alert('修改失败');
					}
				});
			});
			$('#allow').click(function() {
				//获取所有已经选中的复选框的value值
				//$(':checkbox'):获取当前页面上所有的复选框
				//:checked':在已选中的复选框中找到已勾选的复选框
				var checkbox_list = $(':checkbox:checked');
				//element是一个html标签对象
				//定义一个字符串，用来拼接所有选中的复选框的cmt_id
				var str = '';
				checkbox_list.each(function(index, element) {
					str += element.value + ',';
				});
				//alert(str);//1,2,3,
				//去掉最后一个','
				str = str.substr(0, str.length - 1);
				$.post('modifycmts.php', {ids:str}, function(data) {
					if (data == 1) {
						//数据修改成功，修改页面状态栏和按钮文字、样式
						//循环checkbox，找到tr下的状态栏和按钮
						checkbox_list.each(function() {
							//将状态栏的内容改为批准
							$(this).parent().parent().find('.state').html('批准');
							//将按钮文字改为驳回，样式改为btn_warning
							var tmp = $(this).parent().parent().find('.btncmt');
							tmp.removeClass('btn-info');
							tmp.addClass('btn-warning');
							tmp.html('驳回');
							$(this).removeAttr('checked');//去掉元素前面选中的对号
						});
						alert('批量修改成功');
					} else {
						alert('批量修改失败');					
					}
				});
			});
		</script>
	</body>
</html>
