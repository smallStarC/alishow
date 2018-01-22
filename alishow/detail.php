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
			//接收文章id(post_id)
			$id = $_GET['id'];
			$sql = "SELECT post_id,post_title,post_desc,post_updtime,post_click,post_good,post_file,post_content,  
					user_id,num,user_nickname,cate_name from ali_post as p 
					join ali_user as u on p.post_author = u.user_id 
					join ali_cate as c on p.post_cateid = c.cate_id 
					left join (select cmt_postid,COUNT(*) as num from ali_comment GROUP BY cmt_postid) as tmp 
					on tmp.cmt_postid = p.post_id 
					where post_id = $id";
			$post_res = mysql_query($sql);
			$post_arr = mysql_fetch_assoc($post_res);
			//var_dump($post_arr);die;
			?>
			<div class="content">
				<div class="article">
					<div class="breadcrumb">
						<dl>
							<dt>
							当前位置：
							</dt>
							<dd>
								<a href="javascript:;">
									<?=$post_arr['cate_name'];?>
								</a>
							</dd>
							<dd>
								前往<?=$post_arr['cate_name'];?>分类
							</dd>
						</dl>
					</div>
					<h2 class="title">
						<a href="javascript:;">
							<?=$post_arr['post_title'];?>
						</a>
					</h2>
					<div class="meta">
						<span><?=$post_arr['user_nickname'];?> 发布于 <?=date('Y-m-d', $post_arr['post_updtime']);?></span>
						<span>分类:
							<a href="javascript:;">
								<?=$post_arr['cate_name'];?>
							</a>
						</span>
						<span>阅读: (<?=$post_arr['post_click'];?>)</span>
						<span>评论: (<?=$post_arr['num'];?>)</span>
					</div>
					<div>
						<?=htmlspecialchars_decode($post_arr['post_content']);?>
					</div>
				</div>
				<div class="panel hots">
					<?php
						$sql = "select * from ali_post order by post_click desc,post_good desc limit 0,4";
						$hot_res = mysql_query($sql);
					?>
					<h3>热门推荐</h3>
					<ul>
						<?php while ($row = mysql_fetch_assoc($hot_res)):?>
						<li>
							<a href="detail.php?id=<?=$row['post_id']?>">
								<img src="/admin/upload/<?=$row['post_file'];?>" alt="">
								<span><?=$row['post_title'];?></span>
							</a>
						</li>
						<?php endwhile;?>
					</ul>
				</div>
			</div>
			<div class="footer">
				<p>
					© 2016 XIU主题演示 本站主题由 themebetter 提供
				</p>
			</div>
		</div>
	</body>
</html>
