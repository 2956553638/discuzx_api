<?php

/*
 * 注册接口
 */

//引入配置文件
require('config.php');

//获取请求数据
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

//验证Key
if ($key == md5($_POST['key'])) {
  $uid = uc_user_register($username, $password, $email);
  if ($uid >= 0) {
    //生成注册信息
    $regdate = time();
    $rand_password = md5(uniqid().rand(100000, 999999));
    $time = time();
    $regip = $_SERVER['SERVER_ADDR'];
    $regport = $_SERVER['REMOTE_PORT'];

    /*
     * 注意事项：
     * 请先自行到DiscuzX网站上注册一个正常账户，然后用软件连接数据库查看下列数据表
     *
     * 前缀_common_member
     * 前缀_common_member_field_forum
     * 前缀_common_member_field_home
     * 前缀_common_member_profile
     * 前缀_common_member_status
     *
     * 查看你刚才在DiscuzX网站上注册的那个账户的数据，然后填入下列变量中，如果为空则不填
     */

    //common_member 表
    //groupid 字段
    $groupid = "";
    //extgroupids 字段
    $extgroupids = "";
    //timeoffset 字段
    $timeoffset = "";

    //common_member_field_forum 表
    //medals 字段
    $medals = "";
    //sightml 字段
    $sightml = "";
    //groupterms 字段
    $groupterms = "";
    //groups 字段
    $groups = "";

    //common_member_field_home 表
    //videophoto 字段
    $videophoto = "";
    //spacename 字段
    $spacename = "";
    //spacedescription 字段
    $spacedescription = "";
    //domain 字段
    $domain = "";
    //theme 字段
    $theme = "";
    //spacecss 字段
    $spacecss = "";
    //blockposition 字段
    $blockposition = "";
    //recentnote 字段
    $recentnote = "";
    //spacenote 字段
    $spacenote = "";
    //privacy 字段
    $privacy = "";
    //feedfriend 字段
    $feedfriend = "";
    //acceptemail 字段
    $acceptemail = "";
    //magicgift 字段
    $magicgift = "";
    //stickblogs 字段
    $stickblogs = "";

    //common_member_profile 表
    //bio 字段
    $bio = "";
    //interest 字段
    $interest = "";
    //field1 字段
    $field1 = "";
    //field2 字段
    $field2 = "";
    //field3 字段
    $field3 = "";
    //field4 字段
    $field4 = "";
    //field5 字段
    $field5 = "";
    //field6 字段
    $field6 = "";
    //field7 字段
    $field7 = "";
    //field8 字段
    $field8 = "";

    //准备查询语句
    $sql_1 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member`(`uid`, `email`, `username`, `password`, `groupid`, `extgroupids`, `regdate`, `timeoffset`) VALUES ('$uid', '$email', '$username', '$rand_password', '$groupid', '$extgroupids', '$regdate', '$timeoffset')";
    $sql_2 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member_count`(`uid`) VALUES ('$uid')";
    $sql_3 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member_field_forum`(`uid`, `medals`, `sightml`, `groupterms`, `groups`) VALUES ('$uid', '$medals', '$sightml', '$groupterms', '$groups')";
    $sql_4 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member_field_home`(`uid`, `videophoto`, `spacename`, `spacedescription`, `domain`, `theme`, `spacecss`, `blockposition`, `recentnote`, `spacenote`, `privacy`, `feedfriend`, `acceptemail`, `magicgift`, `stickblogs`) VALUES ('$uid', '$videophoto', '$spacename', '$spacedescription', '$domain', '$theme', '$spacecss', '$blockposition', '$recentnote', '$spacenote', '$privacy', '$feedfriend', '$acceptemail', '$magicgift', '$stickblogs')";
    $sql_5 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member_profile`(`uid`, `bio`, `interest`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`) VALUES ('$uid', '$bio', '$interest', '$field1', '$field2', '$field3', '$field4', '$field5', '$field6', '$field7', '$field8')";
    $sql_6 = "INSERT INTO `$db_name`.`".$db_tablepre."common_member_status`(`uid`, `regip`, `lastip`, `port`, `lastvisit`, `lastactivity`, `profileprogress`) VALUES ('$uid', '$regip', '$regip', '$regport', '$time', '$time', '0')";
    //写入数据库
    if (mysqli_query($mysql, $sql_1) && mysqli_query($mysql, $sql_2) && mysqli_query($mysql, $sql_3) && mysqli_query($mysql, $sql_4) && mysqli_query($mysql, $sql_5) && mysqli_query($mysql, $sql_6)) {
      $json = array(
        "status" => true,
        "time" => time(),
        "message" => "注册成功"
      );
    } else {
      $json = array(
        "status" => false,
        "time" => time(),
        "message" => "数据库错误"
      );
    }
  } else {
    //注册失败
    $message = "";
    if($uid == -1) {
      $message = "用户名不合法";
    } elseif($uid == -2) {
      $message = "包含要允许注册的词语";
    } elseif($uid == -3) {
      $message = "用户名已经存在";
    } elseif($uid == -4) {
      $message = "Email 格式有误";
    } elseif($uid == -5) {
      $message = "Email 不允许注册";
    } elseif($uid == -6) {
      $message = "该 Email 已经被注册";
    } else {
      $message = "未定义";
    }
    $json = array(
      "status" => false,
      "time" => time(),
      "message" => $message
    );
  }
} else {
  //Key错误
  $json = array(
    "status" => false,
    "time" => time(),
    "message" => "Key错误"
  );
}

//输出Json
echo json_encode($json);

?>