<?php
include("../api.inc.php");
$title='用户数据编辑';
include './head.php';
$id=$_SESSION['id'];
include './nav.php';
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$user=$all['user'];
$id=@$_GET['id'];
$all=$DB->get_row("SELECT * from app_multirouter WHERE id='$id' AND user='$user'");
if(!$all){die("[失败]您没有编辑权");}
$xg=@$_GET['fs'];
if($xg=="1")
{
$ip=$_POST['ip'];
$ipcd=iconv_strlen($ip,"utf-8");
if($ipcd<1 || $ipcd>100000){exit("<script language='javascript'>alert('文本长度不符合规定');history.go(-1);</script>");}
$sqls1=$DB->query("update  `app_multirouter` set ip='$ip' where  id='$id' AND user='$user'");
if($sqls1)
{
exit("<script language='javascript'>alert('修改成功~');history.go(-2);</script>");
}
else{
exit("<script language='javascript'>alert('修改失败！！');history.go(-2);</script>");
}		
}



$ip=$all['ip'];



?>
               <div class="card">
                  <div class="card-header">
                    <h4>修改网关地址（ID：<?php echo"$id"; ?>）</h4>
                  </div>
                <form action="./modify_gateway.php?fs=1&id=<?php echo"$id"; ?>" method="POST" class="form" role="form">
                  <div class="card-body">
                    <div class="form-group">
                      <label>网关地址</label>
                      <input type="text" name="ip" value="<?php echo"$ip"; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">修改</button>
                  </div>
                  </form> 
	<a href="./MultiRouter.php" class="btn btn-default btn-block"> >>> 返回网关列表 <<< </a>	