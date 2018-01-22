<?php
	include 'admin/common/mysql_connect.php';
	$sql = "select * from ali_cate where cate_show = 1";
	$cate_res = mysql_query($sql);
?>
<div class="header">
	<h1 class="logo">
		<a href="index.php">
			<img src="assets/img/logo.png" alt="">
		</a>
	</h1>
	<ul class="nav">
		<?php while ($row = mysql_fetch_assoc($cate_res)):?>
		<li>
			<a href="list.php?id=<?=$row['cate_id'];?>&name=<?=$row['cate_name'];?>">
				<i class="fa <?=$row['cate_class']?>"></i>
				<?=$row['cate_name'];?>
			</a>
		</li>
		<?php endwhile;?>
	</ul>
	<div class="search">
		<form>
			<input type="text" class="keys" placeholder="输入关键字">
			<input type="submit" class="btn" value="搜索">
		</form>
	</div>
	<div class="slink">
		<a href="http://www.baidu.com" target="_blank">
			百度一下
		</a>
		|
		<a href="http://www.weather.com.cn/" target="_blank">
			今日天气
		</a>
	</div>
</div>
<div class="aside">
	<div class="widgets">
		<h4>搜索</h4>
		<div class="body search">
			<form>
				<input type="text" class="keys" placeholder="输入关键字">
				<input type="submit" class="btn" value="搜索">
			</form>
		</div>
	</div>
	<div class="widgets">
		<h4>随机推荐</h4>
		<?php
			//随机获取5条数据
			//order by：排序
			$sql = "select * from ali_post order by rand() limit 0,5";	
			$rand_res = mysql_query($sql);
		?>
		<ul class="body random">
			<?php while ($row = mysql_fetch_assoc($rand_res)):?>
			<li>
				<a href="detail.php?id=<?=$row['post_id']?>;">
					<p class="title">
						<?=$row['post_title']?>
					</p>
					<p class="reading">
						阅读(<?=$row['post_click']?>)
					</p>
					<div class="pic">
						<img src="/admin/upload/<?=$row['post_file']?>" alt="">
					</div>
				</a>
			</li>
			<?php endwhile;?>
		</ul>
	</div>
	<div class="widgets">
		<h4>最新评论</h4>
		<?php
			$sql = "select member_nickname, cmt_time, cmt_content from ali_comment as c
					join ali_member as m on m.member_id = c.cmt_memid 
					order by cmt_time desc limit 0,6";
			$cmt_res = mysql_query($sql);
		?>
		<ul class="body discuz">
			<?php while ($row = mysql_fetch_assoc($cmt_res)):?>
			<li>
				<a href="javascript:;">
					<div class="avatar">
						<img src="uploads/avatar_1.jpg" alt="">
					</div>
					<div class="txt">
						<p>
							<span><?=$row['member_nickname']?></span>9个月前(<?=date('m-d', $row['cmt_time']);?>)说:
						</p>
						<p>
							<?=$row['cmt_content']?>
						</p>
					</div>
				</a>
			</li>
			<?php endwhile;?>
		</ul>
	</div>
</div>