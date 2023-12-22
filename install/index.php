<?php
error_reporting(0);
session_start();
@header('Content-Type: text/html; charset=UTF-8');
$go=isset($_GET['go'])?$_GET['go']:'0';
if(file_exists('install.lock')){
	$installed=true;
	$do='0';
}

function checkfunc($f,$m = false) {
	if (function_exists($f)) {
		return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}

function checkclass($f,$m = false) {
	if (class_exists($f)) {
		return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}

function clearpack() {
	$array=glob('../swapmoon_release_*');
	foreach($array as $dir){
		unlink($dir);
	}
	$array=glob('../swapmoon_update_*');
	foreach($array as $dir){
		unlink($dir);
	}
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}
?>


<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>轮月转发控制器</title>
<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/components.css">
</head>
<body>
<div class="container" style="padding-top:60px;">
    <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">

<?php if($go=='0'){
$_SESSION['checksession']=1;
?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>安装向导</h4>
                  </div>
                  <div class="card-body">
                    <p><iframe frameborder="0" src="../readme.txt" style="width:100%;height:465px;"></iframe></p>
		<?php if($installed){ ?>
		<div class="alert alert-warning">您已经安装过，如需重新安装请删除 install/install.lock 文件后再安装！</div>
		<?php }else{?>
		<p align="center"><a class="btn btn-primary" href="index.php?go=1">开始安装</a></p>
		<?php }?>
                  </div>
                </div>
              </div>

<?php }elseif($go=='1'){?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-success">
                  <div class="card-header">
                    <h4>环境检查</h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped">
	<thead>
		<tr>
			<th style="width:15%">函数</th>
			<th style="width:10%">状态</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>PHP 7.2+</td>
			<td><?php echo phpversion(); ?></td>
		</tr>
		<tr>
			<td>curl_exec()</td>
			<td><?php echo checkfunc('curl_exec',true); ?></td>
		</tr>
		<tr>
			<td>file_get_contents()</td>
			<td><?php echo checkfunc('file_get_contents',true); ?></td>
		</tr>
		<tr>
			<td>session</td>
			<td><?php echo $_SESSION['checksession']==1?'<font color="green">可用</font>':'<font color="red">不支持</font>'; ?></td>
		</tr>
	</tbody>
</table>
<p><span><a class="btn btn-primary" href="index.php?go=0"><<上一步</a></span>
<span style="float:right"><a class="btn btn-primary" href="index.php?go=2" align="right">下一步>></a></span></p>
</div>

                  </div>
                </div>
              </div>

<?php }elseif($go=='2'){?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-warning">
                  <div class="card-header">
                    <h4>数据库配置</h4>
                  </div>
                  <div class="card-body">
                   	<?php
if(defined("SAE_ACCESSKEY"))
echo <<<HTML
检测到您使用的是SAE空间，支持一键安装，请点击 <a href="?go=3">下一步</a>
HTML;
else
echo <<<HTML
		<form action="?go=3" class="form-sign" method="post">
		<label for="name">数据库地址:</label>
		<input type="text" class="form-control" name="db_host" value="localhost">
		<label for="name">数据库端口:</label>
		<input type="text" class="form-control" name="db_port" value="3306">
		<label for="name">数据库用户名:</label>
		<input type="text" class="form-control" name="db_user">
		<label for="name">数据库密码:</label>
		<input type="text" class="form-control" name="db_pwd">
		<label for="name">数据库名:</label>
		<input type="text" class="form-control" name="db_name">
		<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
		</form><br/>
		（如果已事先填写好ins_config.php相关数据库配置，请 <a href="?go=3&jump=1">点击此处</a> 跳过这一步！）
HTML;
?>

                  </div>
                </div>
              </div>
              

<?php }elseif($go=='3'){
?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>保存数据库</h4>
                  </div>
                  <div class="card-body">
                    <?php
require './db.class.php';
if(defined("SAE_ACCESSKEY") || $_GET['jump']==1){
	include_once '../ins_config.php';
	if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
		echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	} else {
		if(!$con=DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port'])){
			if(DB::connect_errno()==2002)
				echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
			elseif(DB::connect_errno()==1045)
				echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
			elseif(DB::connect_errno()==1049)
				echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
			else
				echo '<div class="alert alert-warning">连接数据库失败，['.DB::connect_errno().']'.DB::connect_error().'</div>';
		}else{
			echo '<div class="alert alert-success">数据库配置文件保存成功！</div>';
			if(DB::query("SELECT * from admin")==FALSE)
				echo '<p align="right"><a class="btn btn-primary btn-block" href="?go=4">创建数据表>></a></p>';
			else
				echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过轮月转发控制器</div>
				<div class="list-group-item">
					<a href="?go=6" class="btn btn-block btn-info">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?go=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
		}
	}
}else{
	$db_host=isset($_POST['db_host'])?$_POST['db_host']:NULL;
	$db_port=isset($_POST['db_port'])?$_POST['db_port']:NULL;
	$db_user=isset($_POST['db_user'])?$_POST['db_user']:NULL;
	$db_pwd=isset($_POST['db_pwd'])?$_POST['db_pwd']:NULL;
	$db_name=isset($_POST['db_name'])?$_POST['db_name']:NULL;
	if($db_host==null || $db_port==null || $db_user==null || $db_pwd==null || $db_name==null){
		echo '<div class="alert alert-danger">保存错误,请确保每项都不为空<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	} else {
	//导入安装后配置文件
    $config = file_get_contents('base_config.php');
    $config = str_replace('{$db_host}', $db_host, $config);
    $config = str_replace('{$db_port}', $db_port, $config);
    $config = str_replace('{$db_user}', $db_user, $config);
    $config = str_replace('{$db_pwd}', $db_pwd, $config);
    $config = str_replace('{$db_name}', $db_name, $config);
$insconfig="<?php
/*安装时配置*/
\$dbconfig=array(
	'host' => '{$db_host}', //数据库服务器
	'port' => {$db_port}, //数据库端口
	'user' => '{$db_user}', //数据库用户名
	'pwd' => '{$db_pwd}', //数据库密码
	'dbname' => '{$db_name}', //数据库名
);
?>";
		if(!$con=DB::connect($db_host,$db_user,$db_pwd,$db_name,$db_port)){
			if(DB::connect_errno()==2002)
				echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
			elseif(DB::connect_errno()==1045)
				echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
			elseif(DB::connect_errno()==1049)
				echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
			else
				echo '<div class="alert alert-warning">连接数据库失败，['.DB::connect_errno().']'.DB::connect_error().'</div>';
		}elseif(file_put_contents('../ins_config.php',$insconfig)){
            //写入config.php
            $fwconfig = file_put_contents('../config.php',$config);
			echo '<div class="alert alert-success">数据库配置文件保存成功！</div>';
			if(DB::query("SELECT * from admin")==FALSE)
				echo '<p align="right"><a class="btn btn-primary btn-block" href="?go=4">创建数据表>></a></p>';
			else
				echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过轮月转发控制器</div>
				<div class="list-group-item">
					<a href="?go=6" class="btn btn-block btn-info">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?go=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
		}else
			echo '<div class="alert alert-danger">保存失败，请确保网站根目录有写入权限<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	}
}
?>
	</div>
</div>
<?php }elseif($go=='4'){?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>创建数据表</h4>
                  </div>
                  <div class="card-body">
                    <?php
include_once '../ins_config.php';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
	echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
} else {
	require './db.class.php';
	$sql=file_get_contents("install.sql");
	$sql=explode(';',$sql);
	$cn = DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
	if (!$cn) die('err:'.DB::connect_error());
	//先清库后导入SQL
	DB::query("DROP TABLE `admin`, `app_account`, `app_multirouter`, `app_sid`, `app_singlerouter`;");
	DB::query("set sql_mode = ''");
	DB::query("set names utf8");
	$t=0; $e=0; $error='';
	for($i=0;$i<count($sql);$i++) {
		if ($sql[$i]=='')continue;
		if(DB::query($sql[$i])) {
			++$t;
		} else {
			++$e;
			$error.=DB::error().'<br/>';
		}
	}
	date_default_timezone_set("PRC");
	$date = date("Y-m-d");
}
if($e==1) {
	echo '<div class="alert alert-success">安装成功！<br/>SQL成功'.$t.'句/失败'.$e.'句</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?go=5">下一步>></a></p>';
} else {
	echo '<div class="alert alert-danger">安装失败<br/>SQL成功'.$t.'句/失败'.$e.'句<br/>错误信息：'.$error.'</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?go=4">点此进行重试</a></p>';
}
?>
                  </div>
                </div>
              </div>

<?php }elseif($go=='5'){?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>安装完成</h4>
                  </div>
                  <div class="card-body">
                    <?php
	@file_put_contents("install.lock",'JiuXia2025');
	clearpack();
	echo '<font color="green">安装完成！管理账号和密码是:admin/admin</font><br/><br/><a href="../admin/">>>后台管理</a><hr/>为了安全请登录后台修改密码与接口加密SID值<br/><br/><font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font>';
?>
                  </div>
                </div>
              </div>
              
<?php }elseif($go=='6'){?>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>安装完成</h4>
                  </div>
                  <div class="card-body">
                    <?php
	@file_put_contents("install.lock",'JiuXia2025');
	clearpack();
	echo '<font color="green">安装完成！管理账号和密码是:admin/admin</font><br/><br/><a href="../admin/">>>后台管理</a><hr/>为了安全请登录后台修改密码与接口加密SID值<br/><br/><font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font>';
?>
                  </div>
                </div>
              </div>

<?php }?>

</div>
</body>
</html>