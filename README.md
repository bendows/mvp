mvp
=======

THe Model View Page Framework Installation Instructions

```shell

cd /home/documentroot && git clone https://github.com/insecureben/mvp.git .
cd /home/documentroot && install -o apache /dev/null php_error.log
cd /home/documentroot && install -o apache /dev/null messages.log 
cd /home/documentroot && chown apache html html/captcha

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
```
