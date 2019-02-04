-- mysql -u root

-- create database db_bbs
-- grant all on db_bbs.* to dbuser@localhost identified by '$6Ydnt7p';


drop table if exists threads;
drop table if exists comments;
drop table if exists users;
create table threads (
  id int not null auto_increment primary key,
  user_id int,
  title text,
  delflag tinyint(1) default 0,
  created DATETIME,
  modified DATETIME
);

create table comments (
  id int not null auto_increment primary key,
  thread_id int,
  comment_num int,
  user_id int,
  content text,
  delflag tinyint(1) default 0,
  created DATETIME,
  modified DATETIME
);

create table users (
  id int not null auto_increment primary key,
  username varchar(255),
  email varchar(255),
  password varchar(255),
  delflag tinyint(1) default 0,
  created DATETIME,
  modified DATETIME
);

insert into threads (user_id,title,created,modified) values (1,'掲示板タイトル1',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,1,1,'コメント1コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,2,1,'コメント2コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,3,1,'コメント3コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,4,1,'コメント4コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,5,1,'コメント5コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,6,1,'コメント6コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,7,1,'コメント7コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,8,1,'コメント8コメントコメントコメント',now(),now());
insert into comments (thread_id,comment_num,user_id,content,created,modified) values (1,9,1,'コメント9コメントコメントコメント',now(),now());
insert into users (username,email,password,created,modified) values ('hanai','hanaiyu22@gmail.com','1111',now(),now());
