<?php
$mod='blank';
include("../api.inc.php");
$title='关于';
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
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>开发者</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="70" src="http://q.qlogo.cn/headimg_dl?dst_uin=2025226181&spec=640&img_type=jpg">
                        <div class="media-body">
                          <div class="media-right"><div class="text-primary">开发者</div></div>
                          <div class="media-title mb-1">JiuXia2025</div>
                          <div class="text-time">服务端开发</div>
                          <div class="media-links">
                            <a href="https://www.inekoxia.com/">主页</a>
                            <div class="bullet"></div>
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=2025226181&site=qq:2025226181&menu=yes">QQ</a>
                            <div class="bullet"></div>
                            <a href="https://github.com/JiuXia2025" class="text-dark">Github</a>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="70" src="http://q.qlogo.cn/headimg_dl?dst_uin=2676796446&spec=640&img_type=jpg">
                        <div class="media-body">
                          <div class="media-right"><div class="text-warning">开发者</div></div>
                          <div class="media-title mb-1">八月不落东方叶</div>
                          <div class="text-time">客户端开发</div>
                          <div class="media-links">
                            <a href="http://www.eastaug.top/">主页</a>
                            <div class="bullet"></div>
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=2676796446&site=qq:2676796446&menu=yes">QQ</a>
                            <div class="bullet"></div>
                            <a href="https://github.com/AugustMoons" class="text-dark">Github</a>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="70" src="http://q.qlogo.cn/headimg_dl?dst_uin=1269024821&spec=640&img_type=jpg">
                        <div class="media-body">
                          <div class="media-right"><div class="text-primary">设计</div></div>
                          <div class="media-title mb-1">HoronLee</div>
                          <div class="text-time">程序整体设计</div>
                          <div class="media-links">
                            <a href="https://www.horonlee.com/">主页</a>
                            <div class="bullet"></div>
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=1269024821&site=qq:1269024821&menu=yes">QQ</a>
                            <div class="bullet"></div>
                            <a href="https://github.com/HoronLee" class="text-dark">Github</a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>感谢</h4>
                  </div>
                  <div class="card-body">
                    <div class="list-unstyled list-unstyled-border mt-4">
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6>iKuaiForwardCore</h6>
                          <p>by <a href="https://www.inekoxia.com/">JiuXia2025</a> and <a href="https://www.ifoxhui.com/">iFoxHui(SKYRE)</a></p>
                        </div>
                      </div>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6>Stisla</h6>
                          <p>by <a href="https://github.com/stisla/stisla">Muhamad Nauval Azhar</a></p>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <?php include("./footer.php"); ?>