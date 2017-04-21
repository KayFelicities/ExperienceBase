
-- 用户
CREATE TABLE `eb_users` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(32) default NULL,
  `password` varchar(64) default NULL,
  `mail` varchar(200) default NULL,
  `url` varchar(200) default NULL,
  `nickname` varchar(32) default NULL,
  `sx_id` char(9) default NULL,
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `last_login_tm` datetime default NULL,
  `group` varchar(16) default 'visitor',
  `department` varchar(128) default 'sx',
  `pic_url` varchar(128) default NULL,
  `birthday` datetime default NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 文章
CREATE TABLE `eb_contents` (
  `cid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `modify_tm` datetime default NULL,
  `modify_ip` char(16) default NULL,
  `content` mediumtext,
  `file_path` varchar(1024) default NULL,
  `uid` int(10) unsigned default '0',
  `status` char(16) default 'publish',
  `extype1` char(16) default NULL,
  `extype2` char(32) default NULL,
  `keywords` char(128) default NULL,
  `password` varchar(32) default NULL,
  `comment_num` int(10) unsigned default '0',
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;