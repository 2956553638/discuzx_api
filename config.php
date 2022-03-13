<?php

/*
 * 配置文件
 */

//Header
header("content-type:application:json;charset=utf8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

//屏蔽报错 生产应用时应开启
//error_reporting(0);

//注意：如路径出错请自行修改路径
//引入DiscuzX配置文件
require('../config/config_global.php');
require('../config/config_ucenter.php');
//引入UCenter的配置文件
require('../uc_client/client.php');

//连接数据库
$mysql_server = $_config['db']['1']['dbhost'];
$mysql_username = $_config['db']['1']['dbuser'];
$mysql_password = $_config['db']['1']['dbpw'];
$mysql = mysqli_connect($mysql_server, $mysql_username, $mysql_password);

//设置数据库编码
mysqli_query($mysql,"set names utf8");

//获取数据库配置
$db_name = $_config['db']['1']['dbname'];
$db_tablepre =  $_config['db']['1']['tablepre'];

//API Key 填写API Key
$key = md5("XXXXXXXXXXXXXXXX");

?>