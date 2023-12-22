<?php
/**
 * @package MoonSwapPanel
 * @module iKuaiForwardCore
 * @author JiuXia2025 & iFoxHui(SKYRE)
 * @version 1.0
 * @link https://www.inekoxia.com/
 */
ini_set("display_errors", "Off");
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET');
include("../api.inc.php");
$id=@$_GET['id'];
$key=@$_GET['key'];
$username=@$_GET['username'];
$passwd=@$_GET['passwd'];
if(!$key){die("[失败]无管理员标识");}
$all=@$DB->get_row("SELECT * from admin WHERE user='$key' ");
$idkey=@$all['id'];
if(!$idkey){die("[失败]管理员不存在");}
$sidsql=$DB->get_row("SELECT * from app_sid WHERE user='$key' ");
if(!$sidsql){die("[失败]后台无SID配置");}
$sidc=@$sidsql['c'];
$sidj=@$sidsql['j'];
$sid=@$_GET['sid'];
$timei=@date('i');
if(!$sid){die("[失败]SID错误，错误码<$timei>-01");}
$timea=@date('y');
$timeb=@date('d');
$xtkey=$timea.$timeb.$timei;
$xtsid=$xtkey*$sidc+$sidj;
if($xtsid!=$sid){die("[失败]SID错误，错误码<$timei>-02");}
$all=$DB->get_row("SELECT * from app_multirouter WHERE user='$key' && id='$id' ");
if(!$all){die("[失败]网关ID错误");}
$ip=$all['ip'];
$loginrequest="http://".$ip."/Action/login";
$callrequest="http://".$ip."/Action/call";
$post = '{"username":"' . $username . '","passwd":"' . md5($passwd) . '","pass":"' . base64_encode('salt_11' . $passwd) . '","remember_password":false}';
list($head, $body) = explode("\r\n\r\n", curl($loginrequest, null, $post), 2);
$ErrMsg = json_decode($body, true)['ErrMsg'];
if ($ErrMsg == 'Success') {
    foreach (explode("\r\n", $head) as $singleHead) {
        if (strpos($singleHead, 'Set-Cookie:') === 0) {
            $cookie = trim(explode(':', $singleHead, 2)[1]);
            break;
        }
    }
    $headers = [
        'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.0.0',
        'Cookie:username=' . $username . '; login=1;' . $cookie
    ];
    $post = '{"func_name":"dnat","action":"show","param":{"TYPE":"total,data","limit":"0,99999999","ORDER_BY":"","ORDER":""}}';
    list($head, $body) = explode("\r\n\r\n", curl($callrequest, $headers, $post), 2);
    header('content-type:application/json;charset=utf-8');
    exit($body);
}

function curl($url, $headers, $post)
{
    if (empty($headers)) { $headers = ['User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.0.0']; }
    $curl = curl_init((string)$url);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if (!empty($post)) { curl_setopt($curl, CURLOPT_POSTFIELDS, $post); }
    curl_setopt($curl, CURLOPT_TIMEOUT, 5000);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>