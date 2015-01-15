<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/sql.func.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/function.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/conn.php');
$sql1="
CREATE TABLE IF NOT EXISTS `fstk_ad` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`cat` tinyint(2) NOT NULL DEFAULT '0',
`src` varchar(200) NOT NULL,
`link` text NOT NULL,
`rank` tinyint(3) NOT NULL DEFAULT '10',
`st` date NOT NULL,
`et` date NOT NULL,
`remark` text NOT NULL,
`title` text,
`target` tinyint(1) NOT NULL DEFAULT '0',
`type` tinyint(4) NOT NULL DEFAULT '0',
`click_num` int(11) NOT NULL DEFAULT '0',
`oprice` float DEFAULT NULL,
`nprice` float DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
$a = mysql_query($sql1,$conn);
$sql3="	
CREATE TABLE IF NOT EXISTS `fstk_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `oprice` float(7,1) NOT NULL,
  `nprice` float(7,1) NOT NULL,
  `pic` text NOT NULL,
  `st` date NOT NULL,
  `et` date NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `cat` int(3) NOT NULL,
  `ischeck` tinyint(1) NOT NULL DEFAULT '0',
  `link` text NOT NULL,
  `rank` int(5) NOT NULL DEFAULT '500',
  `num` int(5) NOT NULL DEFAULT '0',
  `slink` text,
  `ww` varchar(100) NOT NULL DEFAULT 'admin',
  `snum` int(11) NOT NULL DEFAULT '0',
  `xujf` int(11) NOT NULL DEFAULT '0',
  `postdt` datetime NOT NULL,
  `zk` float NOT NULL,
  `iid` varchar(20) DEFAULT NULL,
  `volume` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `remark` text,
  `nick` varchar(200) DEFAULT NULL,
  `reason` text,
  `carriage` tinyint(1) NOT NULL DEFAULT '0',
  `recommend` varchar(100) DEFAULT NULL,
  `commission_rate` float DEFAULT '-1',
  `last_modify` datetime DEFAULT NULL,
  `click_num` int(11) DEFAULT '0',
  `tj` tinyint(1) NOT NULL DEFAULT '0',
  `phone` bigint(11) DEFAULT NULL, 
  `issourcedb` int(11) DEFAULT NULL,
  `ismanual` int(11) DEFAULT NULL,  
  `site_from` varchar(250) DEFAULT NULL,  
  `act_from` tinyint(4) DEFAULT '1',
  `shopshow` tinyint(1) DEFAULT NULL,
  `shopv` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iid` (`iid`),
  KEY `iid_2` (`iid`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
mysql_query($sql3);
$sql2="
CREATE TABLE IF NOT EXISTS `fstk_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `src` text NOT NULL,
  `rank` int(3) NOT NULL DEFAULT '50',
  `remark` text,
  `type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
mysql_query($sql2);

$sql8="
CREATE TABLE IF NOT EXISTS `fstk_taocode` (
	`id`  int(11) NOT NULL AUTO_INCREMENT ,
	`isusing`  int(2) NOT NULL ,
	`taocode`  varchar(50000) NULL ,
	PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
mysql_query($sql8);





$sql7="
CREATE TABLE IF NOT EXISTS `fstk_siteinfoone` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`content`  varchar(10000) NULL ,
`type`  int(11) NOT NULL ,
PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
mysql_query($sql7);

$row2=get_list_count('siteinfoone','');
if($row2<1){
  $i_sql="
			INSERT INTO `fstk_siteinfoone` (`content`,`type`) VALUES
					('请记住我们的永久域名XXX.uz.taobao.com或者按 ctrl+D 收藏我们，下次直接来哦。 ', 1),
					('旺旺', 2),
					('http://xxx.uz.taobao.com', 3),
					('admin',4),
					('123456',5),
					('万人网', 8),
					('http://img01.taobaocdn.com/imgextra/i1/1749462706/TB2pd42aFXXXXacXpXXXXXXXXXX_!!1749462706.png', 6),
					('1',9);
			";
  mysql_query($i_sql);
}
$row3=get_list_count('ad','');
if($row3<1){
  $i_sql="
			INSERT INTO `fstk_ad` (`cat`, `src`, `link`, `rank`, `st`, `et`, `remark`, `title`) VALUES
							(101,'http://img03.taobaocdn.com/imgextra/i3/1743725167/TB2kSVAapXXXXbgXXXXXXXXXXXX_!!1743725167.png','/front/list.php?type=2',1,'2014-01-01','2029-01-01','1','1'),
							(101,'http://img01.taobaocdn.com/imgextra/i1/1743725167/TB2fOlBapXXXXXgXXXXXXXXXXXX_!!1743725167.png','/front/list.php?cat=27',2,'2014-01-01','2029-01-01','2','2'),
							(101,'http://img03.taobaocdn.com/imgextra/i3/1743725167/TB2j5RtapXXXXaSXpXXXXXXXXXX_!!1743725167.png','/front/list.php?cat=28',3,'2014-01-01','2029-01-01','3','3'),
							(101,'http://img01.taobaocdn.com/imgextra/i1/1743725167/TB2HuXBapXXXXcpXXXXXXXXXXXX_!!1743725167.png','/front/list.php?type=4',4,'2014-01-01','2029-01-01','4','4'),
							(104,'http://img04.taobaocdn.com/imgextra/i4/1743725167/TB22O0sapXXXXXzXpXXXXXXXXXX_!!1743725167.jpg','/front/list.php?type=2',1,'2014-01-01','2029-01-01','1','1'),
							(104,'http://img04.taobaocdn.com/imgextra/i4/1743725167/TB2BjBsapXXXXbvXXXXXXXXXXXX_!!1743725167.jpg','/front/list.php?cat=27',2,'2014-01-01','2029-01-01','2','2'),
							(104,'http://img01.taobaocdn.com/imgextra/i1/1743725167/TB2NRNtapXXXXaaXXXXXXXXXXXX_!!1743725167.jpg','/front/list.php?cat=25',3,'2014-01-01','2029-01-01','3','3');
							";
  mysql_query($i_sql);

}

$row4=get_list_count('taocode','');
if($row4<1){
  $i_sql="
			INSERT INTO `fstk_taocode` (`id`, `isusing`, `taocode`) VALUES
							(1,2,'无');
							";
  mysql_query($i_sql);

}
$row5=get_list_count('link','');
if($row5<1){
  $i_sql="
			INSERT INTO `fstk_link` (`link`, `src`, `rank`) VALUES
							('http://www.tejialegou.com','特价乐购','1'),
							('http://www.12345r.com','万人网','2');";
  mysql_query($i_sql);

}
echo "<script>window.location.href='index.php'</script>";








