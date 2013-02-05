mvp
=======

THe Model View Page Framework Installation Instructions

```shell

cd /home/documentroot && git clone https://github.com/insecureben/mvp.git .
cd /home/documentroot && install -o apache /dev/null php_error.log
cd /home/documentroot && install -o apache /dev/null messages.log 
cd /home/documentroot && mkdir html html/captcha
cd /home/documentroot && chown apache html html/captcha

cat <<EOF> app/conf/sessiondb.php
<?
$lar=array (
  'dbhost'=>"db-host-or-ip[:port]",
  'dbname'=>"dbname",
  'dbuser'=>"dbuser",
  'dbpwd'=>"dbpassword"
); ?>
EOF

cat <<EOF> app/conf/sitedb.php
<?
$lar=array (
  'dbhost'=>"db-host-or-ip[:port]",
  'dbname'=>"dbname",
  'dbuser'=>"dbuser",
  'dbpwd'=>"dbpassword"
); ?>
EOF
```

```sql

CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(32) NOT NULL,
  `ipaddr` char(15) NOT NULL DEFAULT '1.2.3.4',
  `cipaddr` char(15) NOT NULL DEFAULT '1.2.3.4',
  `http_host` varchar(255) NOT NULL DEFAULT '--',
  `created` int(11) unsigned NOT NULL DEFAULT '0',
  `updated` int(11) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  `sessname` varchar(255) NOT NULL DEFAULT 'not set',
  PRIMARY KEY (`id`),
  KEY `sessid` (`sessid`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(200) NOT NULL,
  `pwd` varchar(150) NOT NULL,
  `ipaddr` varchar(30) NOT NULL,
  `handle` varchar(255) NOT NULL,
  `typeid` int(10) unsigned NOT NULL,
  `disabled` tinyint(3) unsigned NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `pvt1` varchar(255) NOT NULL,
  `pvt2` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `euid` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `registered` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `loggedin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`uid`),
  UNIQUE KEY `euid` (`euid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

```
