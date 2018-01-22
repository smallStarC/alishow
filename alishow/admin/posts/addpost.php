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
			//1.连接MySQL数据库
			include '../common/mysql_connect.php';
			//2.编写SQL语句
			$sql = "select * from ali_cate where cate_status =1";
			$res = mysql_query($sql);
		?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="addpost_deal.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="desc">描述</label>
            <textarea id="desc" class="form-control input-lg" name="desc" type="text" placeholder="文章描述"></textarea>
          </div>
          <div class="form-group">
            <label for="content">文章内容</label>
            <textarea id="content" name="content"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="文章别名">
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
              <?php while($row = mysql_fetch_assoc($res)):?>
              	<option value="<?=$row['cate_id']?>"><?=$row['cate_name']?></option>
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
              <option value="2">草稿</option>
              <option value="1">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="保存">
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
  <script>
  		var um = UM.getEditor('content', {
			initialContent:'请编辑文章内容!',    //初始化编辑器的内容,也可以通过textarea/script给值，看官网例子
	  	initialFrameWidth:850, //初始化编辑器宽度,默认500
	  	initialFrameHeight:300  //初始化编辑器高度,默认500
  	});
  </script>
</body>
</html>
