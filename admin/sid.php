<?php
$mod='blank';
include("../api.inc.php");
$title='SID设置';
include './head.php';
$id=$_SESSION['id'];
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './nav.php';
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$user=$all['user'];

$all=@$DB->get_row("SELECT * from app_sid WHERE user='$user'");
if(!$all){
$sql=$DB->query("insert into `app_sid` (`user`,`c`,`j`) values ('".$user."','1','0')");
if(!$sql){die("系统bug");}
header("location:./sid.php");
}
$c=$all['c'];
$j=$all['j'];



$xc=@$_POST['c'];
$xj=@$_POST['j'];

if($xc){
if($xc<1 || $xc>999){exit("<script language='javascript'>alert('SID1太大或太小');history.go(-1);</script>");}
if($xj<1 || $xj>999){exit("<script language='javascript'>alert('SID2太大或太小');history.go(-1);</script>");}
$sqls=$DB->query("update `app_sid` set c='$xc',j='$xj' where `user`='$user'");
exit("<script language='javascript'>alert('修改成功！');history.go(-1);</script>");
}

//计算Key
$presid=$c*$j;
$endkey=md5($user.$presid)
?>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>接口加密设置</h4>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-info">
                      SID值变更后，原有的APIKey将会被销毁，动态签名算法也会跟随失效
                    </div>
                    <div class="form-group">
                      <label>APIKey</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo"$endkey"; ?>">
                      <small id="passwordHelpInline" class="text-muted">
                          随着管理员用户名与SID数值自动变化，暂不支持修改
                        </small>
                    </div>
                    <form action="./sid.php" method="post" class="form" role="form">
                    <div class="form-group">
                      <label>SID1 C</label>
                      <input type="text" name="c" value="<?php echo"$c"; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>SID2 J</label>
                      <input type="text" name="j" value="<?php echo"$j"; ?>" class="form-control">
                        <small id="passwordHelpInline" class="text-muted">
                          自定义SID值不得大于999，SID1与SID2尽量避免相同
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