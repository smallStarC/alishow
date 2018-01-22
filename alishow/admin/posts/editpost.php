<?php
include '../common/checksession.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>Add new post &laquo; Admin</title>
	<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
	<link rel="stylesheet" href="/assets/css/admin.css">
	<script src="/assets/vendors/nprogress/nprogress.js"></script>
	<link href="/assets/Ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="/assets/Ueditor/third-party/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/assets/Ueditor/umeditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/assets/Ueditor/umeditor.min.js"></script>
	<script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
	<script>NProgress.start()</script>
  	<div class="main">
    <?php
		include '../common/nav.php';
		//1.接收post_id
		$id = $_GET['id'];
		//2.连接MySQL数据库
		include '../common/mysql_connect.php';
		//3.编写SQL语句(根据post_id查询数据表)
		$sql = "select * from ali_post where post_id = $id";
		$post_info_res = mysql_query($sql);
		$post_info_arr = mysql_fetch_assoc($post_info_res);
		$sql = "select * from ali_cate where cate_status =1";
		$cate_res = mysql_query($sql);
	?>
    <div class="container-fluid">
	  	<div class="page-title">
			<h1>修改文章</h1>
	  	</div>
      	<!-- 有错误信息时展示 -->
      	<!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      	</div> -->
      	<form class="row" action="editpost_deal.php" method="post" enctype="multipart/form-data">
      		<input type="hidden" name="id" value="<?=$post_info_arr['post_id']?>">
        	<div class="col-md-9">
	          	<div class="form-group">
		            <label for="title">标题</label>
		            <input id="title" class="form-control input-lg" name="title" type="text" value="<?=$post_info_arr['post_title']?>">
	          	</div>
	          	<div class="form-group">
		            <label for="desc">描述</label>
		            <textarea id="desc" class="form-control input-lg" name="desc" type="text"><?=$post_info_arr['post_desc']?></textarea>
	          	</div>
	          	<div class="form-group">
		            <label for="content">文章内容</label>
		            <textarea id="content" name="content"><?=$post_info_arr['post_content']?></textarea>
	          	</div>
        	</div>
        	<div class="col-md-3">
          		<div class="form-group">
		            <label for="slug">别名</label>
		            <input id="slug" class="form-control" name="slug" type="text" value="<?=$post_info_arr['post_slug']?>">
          		</div>
	          	<div class="form-group">
		            <label for="feature">特色图像</label>
		            <!-- show when image chose -->
		            <img class="help-block thumbnail" style="display: none">
		            <input id="feature" class="form-control" name="feature" type="file">
	          	</div>
	          	<div class="form-group">
		            <label for="category">所属分类</label>
		            <select id="category" class="form-control" name="category">
	              		<option value="0">--请选择--</option>
	              		<?php while($cate_row = mysql_fetch_assoc($cate_res)):?>
	              			<?php if($cate_row['cate_id'] == $post_info_arr['post_cateid']):?>
			            		<option value="<?=$cate_row['cate_id']?>" selected><?=$cate_row['cate_name']?></option>
			            	<?php else:?>
			            		<option value="<?=$cate_row['cate_id']?>"><?=$cate_row['cate_name']?></option>
			            	<?php endif;?>
			            <?php endwhile;?>
	            	</select>
	          	</div>
	          	<div class="form-group">
		            <label for="created">发布时间</label>
		            <input id="created" class="form-control" name="created" type="datetime-local">
	          	</div>
	          	<div class="form-group">
		            <label for="status">状态</label>
		            <select id="status" class="form-control" name="status">
	            		<option value="0">--请选择文章状态--</option>
	              		<?php if($post_info_arr['post_state'] == '2'):?>
	              			<option value="2" selected>草稿</option>
	              			<option value="1">已发布</option>
	              		<?php else:?>
	              			<option value="2">草稿</option>
	              			<option value="1" selected>已发布</option>
	              		<?php endif;?>
	            	</select>
	          	</div>
	          	<div class="form-group">
	            	<input class="btn btn-primary" type="submit" value="更新">
	          	</div>
        	</div>
      	</form>
  	</div>
  	</div>
  	<div class="aside">
    	<?php
    		include	'../common/common.php'
    	?>
  	</div>
  	<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  	<script>NProgress.done()</script>
  	<script>var um = UM.getEditor('content', {
		initialContent: '请编辑文章内容!', //初始化编辑器的内容,也可以通过textarea/script给值，看官网例子
		initialFrameWidth: 850, //初始化编辑器宽度,默认500
		initialFrameHeight: 300 //初始化编辑器高度,默认500
	});</script>
</body>
</html>
