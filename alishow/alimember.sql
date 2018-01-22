#设置字符集
set names gbk;
#创建数据库
create database alishow;
#使用数据库
use alishow;
#创建会员表
create table ali_member(
	member_id int unsigned auto_increment primary key,
	member_name varchar(30) unique not null comment '会员名,用来登录',
	member_nickname varchar(30) unique not null comment '会员昵称',
	member_pwd char(32) not null comment '会员密码'
);
#添加数据
insert  into `ali_member`(`member_id`,`member_name`,`member_nickname`,`member_pwd`) values (1,'Ashe','寒冰射手','123'),(2,'Jax','武器大师','123'),(3,'Xin Zhao','德邦总管','123'),(4,'lux','光辉女郎','123'),(5,'Yi','无极剑圣','123'),(6,'Jinx','暴走萝莉','123');