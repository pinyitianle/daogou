<?php

//需修改----------
//本地服务器配置
define('SERVERNAME','127.0.0.1');         		//数据库服务器，一般为localhost无需修改
define('DBNAME','test');			        //数据库名
define('DBPSW','12345');           	  		//数据库密码
define('DBUSERNAME','root');		      		//数据库用户名
define('SiteUrl','http://localhost/');		//网站的域名

//以下无需修改-------------------
define('PREFIX','fstk_');	              //数据表前缀


$conn=mysql_connect(SERVERNAME,DBUSERNAME,DBPSW) or die ("数据库连接失败,请修改根目录下的conn.php中的参数后再进行操作");
$db_selected=mysql_select_db(DBNAME,$conn);
if(!$db_selected){
	mysql_query("create database wanrenwang DEFAULT CHARACTER SET utf8 COLLATE utf8",$conn);
	$new_db_selected=mysql_select_db(DBNAME,$conn);
}else{
	mysql_query("set names utf8");
}
