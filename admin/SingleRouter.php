<?php
$mod='blank';
include("../api.inc.php");
$title='单网关模式';
include './head.php';
$id=$_SESSION['id'];
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './nav.php';
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$user=$all['user'];
$all=@$DB->get_row("SELECT * from app_singlerouter WHERE user='$user'");
if(!$all){
$sql=$DB->query("insert into `app_singlerouter` (`user`,`ip`) values ('".$user."','172.16.0.1')");
if(!$sql){die("系统bug");}
header("location:./SingleRouter.php");
}


$ip=$all['ip'];




$xip=@$_POST['ip'];
if($xip){
$xipcd=strlen($xip);

if($xipcd<1 || $xipcd>20){exit("<script language='javascript'>alert('IP过长或太短');history.go(-1);</script>");}
$sqls=$DB->query("update `app_singlerouter` set ip='$xip' where `user`='$user'");
exit("<script language='javascript'>alert('修改成功！');history.go(-1);</script>");
}





?>
<div class="card">
                  <div class="card-header">
                    <h4>单网关模式</h4>
                  </div>
                <form action="./SingleRouter.php" method="POST" class="form" role="form">
                  <div class="card-body">
                    <div class="form-group">
                      <label>网关地址</label>
                      <input type="text" name="ip" value="<?php echo"$ip"; ?>" class="form-control">
                      <small id="passwordHelpInline" class="text-muted">
                          单网关模式仅可转发一个路由，在这里设置IP
                        </small>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">修改</button>
                  </div>
                  </form>
                  </div>
                  </div>
                  <?php include("./footer.php"); ?>