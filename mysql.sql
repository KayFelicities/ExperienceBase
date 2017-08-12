
-- 用户
CREATE TABLE `eb_users` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(32) default NULL,
  `nickname` varchar(32) default NULL,
  `fakename` varchar(32) default NULL,
  `sx_id` char(9) default NULL,
  `password` varchar(64) default NULL,
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `last_login_tm` datetime default NULL,
  `mail` varchar(200) default NULL,
  `group` varchar(16) default 'visitor',
  `department` varchar(128) default 'sx',
  `pic_url` varchar(128) default NULL,
  `birthday` datetime default NULL,
  `collet_pids` varchar(512) default NULL,
  `notice_tags` varchar(512) default NULL,
  `notice_uids` varchar(512) default NULL,
  `power` int(2) unsigned default '1',
  `unread_num` int(2) unsigned default '0',
  `last_read_tm` datetime default NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `sx_id` (`sx_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 注册匹配检查
CREATE TABLE `eb_signup` (
  `sx_id` char(9) default NULL,
  `nickname` varchar(32) default NULL,
  PRIMARY KEY  (`sx_id`),
  UNIQUE KEY `sx_id` (`sx_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 文章
CREATE TABLE `eb_passages` (
  `pid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `modify_tm` datetime default NULL,
  `modify_ip` char(16) default NULL,
  `last_tm` datetime default NULL,
  `content` mediumtext,
  `mentioned_uids` varchar(128) default NULL,
  `file_name` varchar(1024) default NULL,
  `author_id` int(10),
  `status` char(16) default 'publish',
  `extype1` char(16) default NULL,
  `extype2` char(32) default NULL,
  `tags` char(128) default NULL,
  `password` varchar(32) default NULL,
  `comment_num` int(10) unsigned default '0',
  `like_num` int(10) unsigned default '0',
  `priority` int(1) unsigned default '0',
  `img1` varchar(64) default NULL,
  `img2` varchar(64) default NULL,
  PRIMARY KEY  (`pid`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 评论
CREATE TABLE `eb_comments` (
  `cid` int(10) unsigned NOT NULL auto_increment,
  `c_author_id` int(10),
  `pid` int(10) unsigned default '0',
  `p_author_id` int(10),
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `status` char(16) default 'publish',
  `type` char(16) default 'comment',
  `comment` text,
  `mentioned_uids` varchar(128) default NULL,
  `parent_cid` int(10) unsigned default '0',
  `parent_c_author_id` int(10) unsigned default '0',
  PRIMARY KEY  (`cid`),
  KEY `pid` (`pid`),
  KEY `c_author_id` (`c_author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 留言板
CREATE TABLE `eb_message_board` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `parent_mid` int(10) unsigned default '0',
  `create_tm` datetime default NULL,
  `create_ip` char(16) default NULL,
  `name` varchar(64) default 'visitor',
  `email` varchar(64) default NULL,
  `m_author_id` int(10),
  `status` char(16) default 'publish',
  `type` char(16) default 'message',
  `comment` text,
  `mentioned_uids` varchar(128) default NULL,
  `priority` int(1) unsigned default '0',
  PRIMARY KEY  (`mid`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 杂项
CREATE TABLE `eb_others` (
  `name` varchar(64) default NULL,
  `content` mediumtext,
  `modify_user` char(32) default NULL,
  `modify_ip` char(16) default NULL,
  `modify_tm` datetime default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;