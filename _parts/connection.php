<?php
define('DATABASE', 'es_homework');
define('USER', 'es_admin');
define('PASS', '123456');

$mysql_connection = mysql_connect("localhost", USER, PASS);
$database = mysql_select_db(DATABASE, $mysql_connection);