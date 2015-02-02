CREATE TABLE su_user(
`uid` INTEGER UNSIGNED PRIMARY KEY,
`uname` VARCHAR(40) NOT NULL UNIQUE,
`password` VARCHAR(200) NOT NULL,
`flags` INTEGER UNSIGNED) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `su_user` (
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `flags` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `su_log` (
  `id` varchar(200) NOT NULL,
  `num` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `source` varchar(200) NOT NULL,
  `refer` varchar(200) DEFAULT NULL,
  `country` char(2) NOT NULL DEFAULT 'XA',
  PRIMARY KEY (`id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

