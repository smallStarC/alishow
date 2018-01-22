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
				$sql = "select * from ali_pic where pic_state = '显示'";
				$pic_res = mysql_query($sql);
			?>
			<div class="content">
				<div class="swipe">
					<ul class="swipe-wrapper">
						<?php while($row = mysql_fetch_assoc($pic_res)):?>
						<li>
							<a href="#">
								<img src="/admin/upload/<?=$row['pic_path']?>">
								<span><?=$row['pic_txt']?></span>
							</a>
						</li>
						<?php endwhile;?>
					</ul>
					<p class="cursor">
						<span class="active"></span><span></span><span></span><span></span>
					</p>
					<a href="javascript:;" class="arrow prev">
						<i class="fa fa-chevron-left"></i>
					</a>
					<a href="javascript:;" class="arrow next">
						<i class="fa fa-chevron-right"></i>
					</a>
				</div>
				<div class="panel focus">
					<?php 
						$sql = "select * from ali_post where post_file != 'null' and post_hot = '推荐' 
						order by post_updtime desc limit 0,5";
						$hot_res = mysql_query($sql);
						$num = 0;
					?>
					<h3>焦点关注</h3>
					<ul>
						<?php while ($row = mysql_fetch_assoc($hot_res)):?>
						<?php if ($num == 0):?>
						<li class="large">
						<?php else:?>
						<li>
						<?php endif;?>
							<a href="detail.php?id=<?=$row['post_id']?>">
								<img src="/admin/upload/<?=$row['post_file'];?>" alt="">
								<span><?=$row['post_title'];?></span>
							</a>
						</li>
						<?php $num++; endwhile;?>											
					</ul>
				</div>
				<div class="panel top">
					<?php
						$sql = "select * from ali_post order by post_updtime desc,post_click desc limit 0,5";
						$click_res = mysql_query($sql);
						$num = 1;	
					?>
					<h3>一周热门排行</h3>
					<ol>
						<?php while ($row = mysql_fetch_assoc($click_res)):?>
						<li>
							<i><?=$num;?></i>
							<a href="detail.php?id=<?=$row['post_id']?>">
								<?=$row['post_title'];?>
							</a>
							<a href="javascript:;" class="like">
								赞(<?=$row['post_good'];?>)
							</a>
							<span>阅读 (<?=$row['post_click'];?>)</span>
						</li>
						<?php $num++; endwhile;?>
					</ol>
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
				<div class="panel new">
					<?php
						$sql = "SELECT post_id,post_title,post_desc,post_updtime,post_click,post_good,post_file,
								user_id,num,user_nickname,cate_name from ali_post as p 
								join ali_user as u on p.post_author = u.user_id 
								join ali_cate as c on p.post_cateid = c.cate_id 
								left join (select cmt_postid,COUNT(*) as num from ali_comment GROUP BY cmt_postid) as tmp 
								on tmp.cmt_postid = p.post_id 
								ORDER BY post_updtime DESC limit 0,8";
						$news_res = mysql_query($sql);
					?>
					<h3>最新发布</h3>
					<?php while($row = mysql_fetch_assoc($news_res)):?>
					<div class="entry">
						<div class="head">
							<span class="sort"><?=$row['cate_name']?></span>
							<a href="detail.php?id=<?=$row['post_id']?>">
								<?=$row['post_title'];?>
							</a>
						</div>
						<div class="main">
							<p class="info">
								<?=$row['user_nickname'];?> 发表于 <?=date('Y-m-d', $row['post_updtime']);?>
							</p>
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
				<p>
					© 2016 XIU主题演示 本站主题由 themebetter 提供
				</p>
			</div>
		</div>
		<script src="assets/vendors/jquery/jquery.js"></script>
		<script src="assets/vendors/swipe/swipe.js"></script>
		<script>//
			var swiper = Swipe(document.querySelector('.swipe'), {
				auto: 3000,
				transitionEnd: function(index) {
					// index++;
			
					$('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
				}
			});
			// 上/下一张
			$('.swipe .arrow').on('click', function() {
				var _this = $(this);
			
				if(_this.is('.prev')) {
					swiper.prev();
				} else if(_this.is('.next')) {
					swiper.next();
				}
			});
		</script>
	</body>
</html>
