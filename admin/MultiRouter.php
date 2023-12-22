<?php
$mod='blank';
include("../api.inc.php");
$title='路由列表';
include './head.php';
$id=$_SESSION['id'];
if($id<>""){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './nav.php';
$all=$DB->get_row("SELECT * from admin WHERE id='$id'");
$user=$all['user'];
$numrows=$DB->count("SELECT count(*) from app_multirouter WHERE user='$user'");
$ip=@$_POST['ip'];
if($ip){
$ipcd=iconv_strlen($ip,"utf-8");
if($ipcd<1 || $ipcd>20){exit("<script language='javascript'>alert('IP长度不符合规定');history.go(-1);</script>");}
if($numrows>='20'){exit("<script language='javascript'>alert('最多20个网关');history.go(-1);</script>");}
$sql=$DB->query("insert into `app_multirouter` (`user`,`ip`) values ('$user','$ip')");
if($sql){
exit("<script language='javascript'>alert('成功');history.go(-1);</script>");	
}else{
exit("<script language='javascript'>alert('失败');history.go(-1);</script>");	
}

}


?>
<?php
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='del'){
$id=$_GET['id'];
$sql=$DB->query("DELETE FROM app_multirouter WHERE id='$id' AND user='$user' ");
if($sql){exit("<script language='javascript'>alert('删除成功');history.go(-1);</script>");}
else{exit("<script language='javascript'>alert('失败');history.go(-1);</script>");}
}
?>

<div class="card">
     <div class="card-header">
             <h4>多网关模式</h4>
                  </div>
                  <div class="card-body">
                  <form action="./MultiRouter.php" method="post" class="form" role="form">
                    <div class="form-group">
                      <label>添加网关地址</label>
                      <input type="text" name="ip" value="" class="form-control">
                      <small id="passwordHelpInline" class="text-muted">
                          多网关模式可转发多台路由，在这里新增网关IP
                        </small>
                        <br/>
                         <input type="submit" value="添加" class="btn btn-primary form-control"/>
                         <br/>
                    </div>
                  </form>
                   <div class="table-responsive">
<table class="table table-striped">
<thead><tr><th>ID</th><th>IP</th><th>操作</th></tr></thead>
<tbody>
<?php
$rs=$DB->query("SELECT * FROM app_multirouter WHERE user='$user' ");
while($res = $DB->fetch($rs))
{
header("Content-Type:text/html; charset=utf-8");
$ip=substr($res['ip'],0,10);
//$ip=$ip.'...';
echo '<tr><td><b>'.$res['id'].'</b></td><th>'.$ip.'</th><td><a class="btn btn-xs btn-primary" style="margin-right:10px;" href="./modify_gateway.php?id='.$res['id'].'">修改</a><a href="./MultiRouter.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除吗？\');">删除</a></td></tr>';
}
?>
</tbody>
</table>
</div>
</div>

                  </div>
                  </div>
                  <?php include("./footer.php"); ?>