#设置字符集
set names gbk;
#创建数据库
create database alishow;
#使用数据库
use alishow;
#创建用户表
create table ali_user(
	user_id int unsigned auto_increment primary key,
	user_email varchar(30) not null unique comment '用户名/邮箱',
	user_slug varchar(20) not null unique comment '别名唯一',
	user_nickname varchar(30) not null comment '用户昵称，建议唯一',
	user_pwd char(32) not null comment '用户密码',
	user_pic varchar(100) not null default '' comment '用户头像',
	user_state tinyint(4) not null default '1' comment '用户状态：1.激活，0.未激活'	
);
desc ali_user;
select * from ali_user;
insert into ali_user values (null,'123@qq.com','xss','小星星','123','',1);
insert into ali_user values (null,'abc@qq.com','xme','小木耳',md5('abc'),'',1);
insert into ali_user values (null,'foot@163.com','foot','小牛牛',md5('foot'),'',0),
							(null,'heh@qq.com','hehe','呵呵',md5('foot'),'',1),
							(null,'ainiuniu@qq.com','ainiuniu','哎牛牛',md5('ainiuniu'),'',1),
							(null,'php@qq.com','php','PHP',md5('php'),'',''),
							(null,'sky@qq.com','sky','天空蓝',md5('sky'),'',0),
							(null,'youyaya@163.com','youyaya','呦呀呀',md5('youyaya'),'',''),
							(null,'guanguan@qq.com','guanguan','官官',md5('guanguan'),'',1);
insert into ali_user values (null,'lala@163.com','lala','啦啦啦',md5('lala'),'',0),
							(null,'green@qq.com','green','绿绿',md5('green'),'',1),
							(null,'qiaoqiao@qq.com','qiaoqiao','乔乔',md5('qiaoqiao'),'',1),
							(null,'lingling@qq.com','lingling','玲玲',md5('lingling'),'',''),
							(null,'Java@qq.com','Java','Java',md5('Java'),'',0),
							(null,'mengmeng@163.com','mengmeng','梦梦',md5('mengmeng'),'',''),
							(null,'ruru@qq.com','ruru','茹茹',md5('ruru'),'',1);
insert into ali_user values (null,'junjun@163.com','junjun','君君',md5('junjun'),'',0),
							(null,'weiwei@qq.com','weiwei','薇薇',md5('weiwei'),'',1),
							(null,'yuer@qq.com','yuer','玉儿',md5('yuer'),'',1),
							(null,'ranran@qq.com','ranran','苒苒',md5('ranran'),'',''),
							(null,'JS@qq.com','JS','JS',md5('JS'),'',0),
							(null,'chaochao@163.com','chaochao','晁晁',md5('chaochao'),'',''),
							(null,'qianqian@qq.com','qianqian','倩倩',md5('qianqian'),'',1);