<?php
/**
 * 登录
**/
$mod='blank';
include("../api.inc.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	if($_POST['user']=='' || $_POST['pass']==''){exit("<script language='javascript'>alert('账号或密码为空');history.go(-1);</script>");}
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$row = $DB->get_row("SELECT * FROM admin WHERE user='$user' ");
	$dlid=$row['id'];
	if($user==$row['user'] && $pass==$row['pass']) {
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		//setcookie("ol_token", $token, time() + 604800);
		$row = $DB->get_row("SELECT * FROM admin WHERE user='$user' limit 1");
		$dlid=$row['id'];
		$_SESSION['id']=$dlid;
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登录后台成功！');window.location.href='./';</script>");
	}elseif ($pass != $row['pass']) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("ol_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='MYCloud Api';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>登录到 管理面板</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>登录</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">账号</label>
                    <input id="username" type="text" class="form-control" name="user" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      请输入你的控制台账号
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">密码</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          忘记密码？
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" required>
                    <div class="invalid-feedback">
                      请输入你的密码
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">记住密码</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      登录
                    </button>
                  </div>
                </form>
               </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; JiuXia2025
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>
</html>