<?php
$mod='blank';
include("../api.inc.php");
$title='主页';
include './head.php';
$id=$_SESSION['id'];
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$adminuser=$all['user'];
if($_POST['pass'] && $_POST['newpass']){
	$pass = $_POST['pass'];
	$newpass = $_POST['newpass'];
	$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
	$endpass=$all['pass'];
	if($pass!=$endpass){exit("<script language='javascript'>alert('旧密码错误');history.go(-1);</script>");}
	$newpasscd=strlen($newpass);
if($newpasscd<1 || $newpasscd>16){exit("<script language='javascript'>alert('密码过长或太短');history.go(-1);</script>");}
	if($DB->query("update `admin` set `pass` ='$newpass' where `id`='$id'  limit 1")){
		$_SESSION['id']='';
		exit("<script language='javascript'>alert('密码修改成功！');history.go(-1);</script>");
	}else{
		exit("<script language='javascript'>alert('密码修改失败！');history.go(-1);</script>");
	}
}
include './nav.php';
?>

<div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('../assets/img/unsplash/andre-benz-1214056-unsplash.jpg');">
                  <div class="hero-inner">
                    <h2>欢迎使用</h2>
                    <p class="lead">点击左上角侧边栏以配置路由信息</p>
                    <div class="mt-4">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <?php include("./footer.php"); ?>