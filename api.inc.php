<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('ROOT', dirname(__FILE__).'/');
define('TEMPLATE_ROOT', ROOT.'/template/');
define('SYS_KEY', 'authadmin');
session_start();
header('Content-Type: text/html; charset=UTF-8');

$version = "1.1";
$version_type = "Git";

$stop='<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head><link rel="shortcut icon" href="./res/api.ico"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">
html{background:#eee}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px "微软雅黑","Microsoft YaHei",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}
        </style>
    </head>
    <body id="error-page"><center>';
date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");

//加载360网站卫士
if(is_file(ROOT.'360safe/360webscan.php')){
    require_once(ROOT.'360safe/360webscan.php');
	require_once(ROOT.'360safe/360_safe.php');
}
require ROOT.'config.php';
$conf_rate="0.05";
if(!isset($port))$port='3306';
//连接数据库
include_once(ROOT."db.class.php");
$DB=new DB($host,$user,$pwd,$dbname,$port);
if(!$DB){die("[错误]连接数据库失败，请检查config.php是否配置正常");}
$all=@$DB->get_row("SELECT * from admin");
if(!$all){
echo '[错误]你还没安装程序！<a href="/install/">点此安装</a>';
exit(0);
}
if (!file_exists(ROOT . 'install/install.lock') && file_exists(ROOT . 'install/index.php')) {
echo('<h2>[错误]检测到无 install.lock 文件</h2><ul><li><font size="4">如果您尚未安装本程序，请<a href="./install/">前往安装</a></font></li><li><font size="4">如果您已经安装本程序，请手动放置一个空的 install.lock 文件到 /install 文件夹下，<b>为了您的转发服务器安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>为什么必须建立 install.lock 文件？</h4>它是程序的保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装程序。<br/><br/>');
exit(0);
}
$admin = $DB->get_row("SELECT * FROM `admin` limit 1");
$adminuser = $admin['username'];
$adminpass = $admin['password'];
$password_hash='!@#%!s!0';
include_once(ROOT."function.php");