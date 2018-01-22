<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>阿里百秀-发现生活，发现美!</title>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
	</head>
	<body>
		<div class="wrapper">
			<?php
				include 'left.php';	
				//接收id和name
				$id = $_GET['id'];
				$name = $_GET['name'];
			?>
			<div class="content">
				<div class="panel new">
					<h3><?=$name;?></h3>
					<?php
						$sql = "SELECT post_id,post_title,post_desc,post_updtime,post_click,post_good,post_file,
								user_id,num,user_nickname,cate_name from ali_post as p 
								join ali_user as u on p.post_author = u.user_id 
								join ali_cate as c on p.post_cateid = c.cate_id 
								left join (select cmt_postid,COUNT(*) as num from ali_comment GROUP BY cmt_postid) as tmp 
								on tmp.cmt_postid = p.post_id 
								where cate_id = $id 
								ORDER BY post_updtime DESC limit 0,4";	
						$post_res = mysql_query($sql);
					?>
					<?php while($row = mysql_fetch_assoc($post_res)):?>
					<div class="entry">
						<div class="head">
							<a href="detail.php?id=<?=$row['post_id'];?>"><?=$row['post_title'];?></a>
						</div>
						<div class="main">
							<p class="info">
								<?=$row['user_nickname'];?> 发表于 <?=date('Y-m-d', $row['post_updtime']);?></p>
							<p class="brief">
								<?=htmlspecialchars_decode($row['post_desc']);?>
							</p>
							<p class="extra">
								<span class="reading">阅读(<?=$row['post_click'];?>)</span>
								<span class="comment">评论(<?=$row['num'];?>)</span>
								<a href="javascript:;" class="like">
									<i class="fa fa-thumbs-up"></i>
									<span>赞(<?=$row['post_good'];?>)</span>
								</a>
								<a href="javascript:;" class="tags">
									分类：<span><?=$row['cate_name']?></span>
								</a>
							</p>
							<a href="javascript:;" class="thumb">
								<img src="/admin/upload/<?=$row['post_file'];?>" alt="">
							</a>
						</div>
					</div>
					<?php endwhile;?>
				</div>
			</div>
			<div class="footer">
				<p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
			</div>
		</div>
	</body>
</html>