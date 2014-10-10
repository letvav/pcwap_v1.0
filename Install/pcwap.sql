
CREATE TABLE IF NOT EXISTS `az_ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adurl` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `adpic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `adremak` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `isshow` smallint(1) unsigned DEFAULT '1',
  `time` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `az_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `az_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reply` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `infoid` int(11) DEFAULT NULL,
  `time` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `az_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `catetitle` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `catekey` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `catedesc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `catetemp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `infotemp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `catepage` int(4) unsigned  DEFAULT NULL,
  `catelogo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `catetype` int(10) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT '0',
  `sort` int(6) DEFAULT '100',
  `menu` smallint(1) unsigned NOT NULL DEFAULT '1',
  `outurl` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `az_diy` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) NOT NULL,
  `diykey` varchar(20) CHARACTER SET utf8 NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 DEFAULT ' ',
  `status` smallint(1) NOT NULL DEFAULT '1',
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `az_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `cid` int(4) unsigned NOT NULL,
  `istop` smallint(1) unsigned DEFAULT '0',
  `isrec` smallint(1) unsigned DEFAULT '0',
  `isshow` smallint(1) unsigned DEFAULT '0',
  `isrev` smallint(1) DEFAULT '0',
  `ispic` smallint(1) DEFAULT '0',
  `pic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hits` int(11) unsigned DEFAULT '0',
  `author` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `revs` int(11) unsigned DEFAULT '0',
  `pcs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `temp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`) USING BTREE,
  KEY `isshow` (`isshow`) USING BTREE,
  FULLTEXT KEY `infoname` (`name`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `az_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `remak` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sort` int(10) unsigned DEFAULT NULL,
  `isshow` smallint(1) DEFAULT '1',
  `time` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `az_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `time` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `az_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hits` int(10) unsigned DEFAULT '1',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `az_weixin_appid` (
  `appid` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `secret` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `az_weixin_appid` (`appid`, `secret`, `id`) VALUES
('465465', '654654', 1);


CREATE TABLE IF NOT EXISTS `az_weixin_gz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leixin` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sorts` int(11) DEFAULT NULL,
  `star` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `az_weixin_huifu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leixin` tinyint(1) DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sorts` int(11) DEFAULT NULL,
  `star` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `az_weixin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leixin` tinyint(1) DEFAULT '2',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keys` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `sorts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



