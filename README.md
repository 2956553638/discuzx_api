DiscuzX API 使用说明

前言

此API 解决了自建网站与 DiscuzX 不同数据库之间的账户问题，即使用相同的账号密码就可登入这两个站点。示例：用户在你的网站注册了一个账户，你的网站后端接收数据后，调用此API 同时注册 DiscuzX/UCenter 账户，实现账户互通。

此API 由 LF_Mcxixif_ 开发QQ 2398441549

测试环境

Server：IIS PHP：7.4

Mysql：5.7.18 DiscuzX：3.4

安装

1.解压缩后将 discuzx_api 文件夹移动到 DiscuzX 根目录。

2.打开 config.php 查看 15-20、35-36 行，按需修改。

3.打开 register.php 查看 26~107 行，按照 26~37 行的注释修改内容。

使用

注册接口
请求地址：http(s)://DiscuzX 网站/discuzx_api/register.php 请求方式：POST

请求参数：

参数	key	username	email	password
含义	KEY	用户名	邮箱	密码

返回参数：

参数	status	time	message
含义	状态	时间戳	消息

返回参数示例：
{
“status”:true, “time”:1623175509,
“message”:“注册成功”
}



修改密码接口
请求地址：http(s)://DiscuzX 网站/discuzx_api/change_password.php 请求方式：POST
请求参数：

参数	key	username	new_password
含义	KEY	用户名	新密码
返回参数：

参数	status	time	message
含义	状态	时间戳	消息
返回参数示例：
{
“status”:true, “time”:1623175975,
“message”:“密码修改成功”
}
