<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Eyenet</span></a>
          </div>

          <div class="clearfix"></div>

          <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <!-- <li><a href="client.php"><i class="fa fa-users"></i> Clients </a>
                </li> -->
                {{-- <li><a href="{{ url('users') }}"><i class="fa fa-user"></i> Users </a> --}}
                <li><a href="{{ url('report') }}"><i class="fa fa-folder-open-o"></i> Reports</a></li>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
