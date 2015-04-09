<?php
$username	= 	'pits';
$host			=	'localhost';
$password	=	'MaranzaPits1';
$db			=	'pits_hoja';
$con 			=	mysql_connect($host,$username,$password) or die("Unable to connect to MySQL");
$db_select	=	mysql_select_db($db,$con);
