#设置字符集
set names gbk;
#创建数据库
create database alishow;
#使用数据库
use alishow;
#创建分类表
create table ali_cate(
	cate_id int unsigned auto_increment primary key,
	cate_name varchar(10) not null unique,
	cate_slug varchar(10) comment '别名',
	cate_class varchar(20) unique comment '字体字体图标',
	cate_status tinyint default 1 comment '分类状态：1.启用，0.禁用',
	cate_show tinyint default 1 comment '是否显示：1.显示，0.不显示'
);
desc ali_cate;
select * from ali_cate;
insert into ali_cate values (null,'潮科技','tec','fa-phone',1,1);
insert into ali_cate values (null,'奇趣事','qxs','fa-glass',1,0);
