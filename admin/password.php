<?php
$mod='blank';
include("../api.inc.php");
$title='';
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
		exit("<script language='javascript'>alert('密码修改成功！');history.go(-1);</script><script language='javascript'>window.location.href='./login.php';</script>");
	}else{
		exit("<script language='javascript'>alert('密码修改失败！');history.go(-1);</script>");
	}
}
include './nav.php';
?>
               <div class="card">
                  <div class="card-header">
                    <h4>修改密码</h4>
                  </div>
  <form method="POST" class="form">
                  <div class="card-body">
                    <div class="form-group">
                      <label>旧密码</label>
                      <input type="text" name="pass" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>新密码</label>
                      <input type="text" name="newpass" class="form-control">
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">修改</button>
                  </div>
  </form>
  </div>
  </div>
  <?php include("./footer.php"); ?>