<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="/home"><i class="fa fa-link"></i> <span>首页</span></a></li>
      @if ($authority == 0)
        <li><a href="/user"><i class="fa fa-link"></i> <span>用户管理</span></a></li>
      @endif
      <li><a href="/spider"><i class="fa fa-link"></i> <span>爬虫管理</span></a></li>
      <li><a href="/fetch"><i class="fa fa-link"></i> <span>数据采集</span></a></li>
      <li><a href="/query"><i class="fa fa-link"></i> <span>数据查询</span></a></li>
      <li><a href="/company"><i class="fa fa-link"></i> <span>企业数据统计</span></a></li>
      <li><a href="/time"><i class="fa fa-link"></i> <span>时间数据统计</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
