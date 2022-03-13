<?php

/*
 * 修改密码
 */

//引入配置文件
require('config.php');

//获取请求数据
$username = $_POST['username'];
$new_password = $_POST['new_password'];
//强制修改密码（不需要旧密码验证）
$ignoreoldpw = 1;

//验证Key
if ($key == md5($_POST['key'])) {
  $result = uc_user_edit($username, "", $new_password, "",$ignoreoldpw);
  if ($result == 1) {
    $json = array(
      "status" => true,
      "time" => time(),
      "message" => "密码修改成功"
    );
  } else if ($result == 0 or $result == -7) {
    $json = array(
      "status" => true,
      "time" => time(),
      "message" => "没有做任何修改"
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