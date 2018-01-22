#设置字符集
set names gbk;
#使用数据库
use alishow;
#创建文章表
create table ali_post(
	post_id int unsigned auto_increment primary key,
	post_title varchar(30) unique not null comment '文章标题',
	post_slug varchar(30) unique not null comment '文章别名',
	post_desc varchar(255) not null comment '文章摘要',
	post_content text not null comment '文章内容',
	post_author int not null comment '作者id，和user表中的user_id字段关联',
	post_cateid int not null comment '分类id，和cate表中的cate_id字段关联',
	post_file varchar(100) not null default '' comment '文章封面图片路径',
	post_addtime int unsigned not null comment '文章发布时间',
	post_updtime int unsigned not null comment '文章修改时间',
	post_click int unsigned not null comment '点击量',
	post_good int unsigned not null comment '赞数量',
	post_bad int unsigned not null comment '踩数量',
	post_state tinyint not null default '1' comment '文章状态:1已发布，2草稿'
)ENGINE=INNODB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPRESSED;
#添加文章
insert into ali_post values (null, '$title', '$slug', '$desc', '$content', $author, $category, 
'$upfile_path', $created, $updtime, $click, $good, $bad, '$status')；
#多表查询
select post_id,post_title,user_nickname,cate_name,post_updtime,post_state from ali_post as p 
join ali_user as u on p.post_author=u.user_id 
join ali_cate as c on p.post_cateid=c.cate_id;
#三表查询
select post_id,post_title,user_nickname,cate_name,post_updtime,post_state 
from ali_post as p 
join ali_user as u on p.post_author=u.user_id 
join ali_cate as c on p.post_cateid=c.cate_id
where cate_id = 4 and post_state = 1;

