create database digilib;

create table users(
id int not null auto_increment primary key,
username varchar(255) not null,
firstname varchar(255) not null,
lastname varchar(255),
pwd varchar(255) not null,
email varchar(255),
contact varchar(255),
gender enum('male','female'),
about text(65535),
country varchar(255),
province varchar(255),
city varchar(255),
landmark varchar(255),
street varchar(255),
dob date,
img varchar(255) default "img/avatar.jpg",
lastaccess datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table files(
id int not null auto_increment primary key,
name varchar(255) not null,
location varchar(255) not null,
category enum('book','article','research','presentation','journal','other'),
author varchar(255),
size int,
downloads int,
uid int not null,
foreign key(uid) references users(id)
);

create table links(
id int not null auto_increment primary key,
url varchar(255) not null,
description varchar(255),
uid int not null,
foreign key(uid) references users(id)
);

create table posts(
id int not null auto_increment primary key,
content text(65535),
stamp datetime default current_timestamp,
uid int not null,
foreign key(uid) references users(id)
);

create table topics(
id int not null auto_increment primary key,
name varchar(255) not null,
field varchar(255)
);

create table follows(
uid int not null,
fid int not null,
foreign key(uid) references users(id),
foreign key(fid) references users(id)
);

create table upvotes(
uid int not null,
pid int not null,
foreign key(uid) references users(id),
foreign key(pid) references posts(id)
);

create table interests(
uid int not null,
tid int not null,
foreign key(uid) references users(id),
foreign key(tid) references topics(id)
);

create table tags(
uid int not null
pid int not null,
foreign key(uid) references users(id),
foreign key(pid) references posts(id)
);

create table related(
fid int not null,
tid int not null,
foreign key(fid) references files(id),
foreign key(tid) references topics(id)
);