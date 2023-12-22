<?php
$mod='blank';
include("../api.inc.php");
$title='账号管理';
include './head.php';
$id=$_SESSION['id'];
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './nav.php';
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$user=$all['user'];
$all=@$DB->get_row("SELECT * from app_account WHERE user='$user'");
if(!$all){
$sql=$DB->query("insert into `app_account` (`user`,`system`,`passwd`,`account`) values ('".$user."','iKuai','defaultpasswd','user')");
if(!$sql){die("系统bug");}
header("location:./account.php");
}
$system=$all['system'];
$account=$all['account'];
$passwd=$all['passwd'];



$xsystem=@$_POST['system'];
$xaccount=@$_POST['account'];
$xpasswd=@$_POST['passwd'];

if($xsystem){
	
$systemcd=strlen($xsystem);
$xzcd=strlen($xaccount);
$xpasswdcd=strlen($xpasswd);
if($xpasswdcd<1 || $xpasswdcd>300){exit("<script language='javascript'>alert('路由密码过长');history.go(-1);</script>");}
if($systemcd<1 || $systemcd>8){exit("<script language='javascript'>alert('路由系统名过长');history.go(-1);</script>");}
if($xzcd<1 || $xzcd>100){exit("<script language='javascript'>alert('路由账号过长');history.go(-1);</script>");}
$sqls=$DB->query("update `app_account` set passwd='$xpasswd',system='$xsystem',account='$xaccount' where `user`='$user'");
if($sqls){exit("<script language='javascript'>alert('修改成功！');history.go(-1);</script>");}else{
	exit("<script language='javascript'>alert('修改失败');history.go(-1);</script>");
}
}

?>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>路由账号设置</h4>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-info">
                      在这里设置单网关转发模式的账号，多网关模式的路由账号请在转发客户端上设置
                    </div>
                    <form action="./account.php" method="post" class="form" role="form">
                    <div class="form-group">
                      <label>路由系统</label>
                      <input type="text" name="system" class="form-control" readonly="" value="iKuai">
                      <small id="passwordHelpInline" class="text-muted">
                          此处选择路由系统，当前仅支持iKuai
                        </small>
                    </div>
                    <div class="form-group">
                      <label>路由账号</label>
                      <input type="text" name="account" value="<?php echo"$account"; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>路由密码</label>
                      <input type="text" name="passwd" value="<?php echo"$passwd"; ?>" class="form-control">
                        <small id="passwordHelpInline" class="text-muted">
                        </small>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">修改</button>
                  </div>
                </div>
                </form>
                </div>
                </div>
                </div>
                <?php include("./footer.php"); ?>