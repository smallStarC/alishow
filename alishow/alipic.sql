#设置字符集
set names gbk;
#创建数据库
create database alishow;
#使用数据库
use alishow;
#创建轮播图片表
create table ali_pic(
	pic_id int unsigned auto_increment primary key,
	pic_path varchar(100) not null comment '上传文件保存路径',
	pic_txt varchar(20) not null comment '文本标题',
	pic_link varchar(20) not null comment '文章的链接地址',
	pic_state enum('显示', '不显示') not null default '不显示'
);