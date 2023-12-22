<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo"$user"; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title"><?php echo"$user"; ?></div>
              <a href="./password.php" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> 修改密码
              </a>
              <div class="dropdown-divider"></div>
              <a href="./login.php?logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> 退出登录
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">控制面板</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">JX</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">控制台</li>
            <li class="dropdown">
              <a class="nav-link" href="./index.php"><i class="fa fa-paper-plane"></i> <span>主页</span></a>
             </li>
            <li class="menu-header">系统</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-desktop"></i> <span>系统</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./SingleRouter.php">单网关转发</a></li>
                <li><a class="nav-link" href="./MultiRouter.php">多网关转发</a></li>
                <li><a class="nav-link" href="./account.php">路由账号设置</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fa fa-shield-alt"></i> <span>安全</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="./sid.php">接口加密设置</a></li>
                <li><a class="nav-link" href="./password.php">修改后台密码</a></li>
              </ul>
            </li>
            <li class="menu-header">关于</li>
            <li class="dropdown">
                <a class="nav-link" href="./about.php"><i class="fa fa-info-circle"></i> <span>关于</span></a>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> 文档中心
            </a>
          </div>        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Console</h1>
          </div>