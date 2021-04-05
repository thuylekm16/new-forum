<?php
require_once ('mysql.php');
$connect =  connect();

$connect->query('CREATE TABLE  IF NOT EXISTS db.users (
  id int unsigned auto_increment primary key,
  usertype int(1)  not null,
  fullname varchar(50)  not null ,
  birthday varchar(100) not null,
  sex int(1) not null,
  email varchar(255) null,
  password varchar(255) not null
)');
$connect->query('CREATE TABLE IF NOT EXISTS db.posts (
  id int unsigned auto_increment primary key,
  title varchar(255) not null,
    
  content longtext not null ,
  create_at datetime null,
  type_post int(1) not null,  
  user_id int unsigned not null,
  FOREIGN KEY (user_id) references users(id)
)');
?>