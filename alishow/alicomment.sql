#设置字符集
set names gbk;
#创建数据库
create database alishow;
#使用数据库
use alishow;
#创建评论表
create table ali_comment(
	cmt_id int(10) unsigned auto_increment primary key,
	cmt_content varchar(200) not null comment '评论内容',
	cmt_memid int(10) unsigned not null comment '评论人id,和member表的member_id对应',
	cmt_userid int(10) unsigned not null comment '审核人id,和user表的user_id对应',
	cmt_postid int(10) unsigned not null comment '文章id,和post表中的post_id对应',
	cmt_time int(10) unsigned not null comment '评论时间',
	cmt_state enum('批准','驳回') not null default '驳回' comment '评论的审核状态'
);
#添加数据
insert  into `ali_comment`(`cmt_id`,`cmt_content`,`cmt_memid`,`cmt_userid`,`cmt_postid`,`cmt_time`,`cmt_state`) values (1,'好！！！！',1,2,1,1256849521,'批准'),(2,'666',2,3,2,1354854565,'驳回'),(3,'哈哈哈哈',1,3,2,1236548545,'驳回'),(4,'嘿嘿嘿',3,4,4,1526354853,'批准'),(5,'2逼',3,5,3,1352415622,'驳回'),(6,'楼主好人',2,4,1,1452364523,'批准'),(7,'带你装逼带你飞',6,6,6,1425685452,'驳回'),(8,'城会玩',5,6,6,1325464585,'驳回'),(9,'大王叫我来巡山',6,6,6,1352458542,'驳回'),(10,'李时珍的皮',5,3,2,1245896546,'批准'),(11,'厉害了word哥',6,4,1,1458978323,'驳回'),(12,'微笑中透露着mmp',6,6,8,1584563245,'批准'),(13,'太没有灵性了',4,1,3,1325684589,'驳回'),(14,'爸爸们，赞我',5,5,6,1358878965,'批准'),(15,'我，秦始皇，打钱',6,6,6,1358458755,'批准'),(16,'然并卵',5,3,6,1654258543,'驳回');

