  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
<!--      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
           Status 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>-->

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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{route('index')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="treeview active menu-open">
          <a href="#"><i class="fa fa-paperclip"></i> <span>Master Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('index-customer')}}"><i class="fa fa-users"></i> Customer</a></li>
            <li><a href="{{route('index-machine')}}"><i class="fa fa-charging-station"></i> Machine</a></li>
            <li><a href="{{route('index-mould')}}"><i class="fa fa-hdd"></i> Mould</a></li>
            <li><a href="{{route('index-material')}}"><i class="fa fa-atom"></i> Material</a></li>
            <li><a href="{{route('index-material-group')}}"><i class="fa fa-layer-group"></i> Material Group</a></li>
            <li><a href="{{route('index-electricity')}}"><i class="fa fa-bolt"></i> Electricity</a></li>
            <li><a href="{{route('index-labour')}}"><i class="fa fa-people-carry"></i> Labour</a></li>
            <li><a href="{{route('index-fees')}}"><i class="fa fa-user-tie"></i> Management Fees</a></li>
          </ul>
        </li>
        <li class="treeview active menu-open">
          <a href="#"><i class="fa fa-paperclip"></i> <span>Main Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('index-product')}}"><i class="fa fa-cube"></i> Product</a></li>
            <li><a href="{{route('index-order')}}"><i class="fa fa-clipboard-list"></i> Order</a></li>
            <li><a href="{{route('index-calculation')}}"><i class="fa fa-money-check-alt"></i> Quick Calculation</a></li>
          </ul>
        </li>
        <li>
            <a href="{{route('index-nice')}}"><i class="fa fa-book"></i> <span>Nice</span></a>
        </li>
        @if(\Auth::user()->role == 'owner')
        <li>
            <a href="{{route('index-users')}}"><i class="fa fa-user-lock"></i> <span>Users Management</span></a>
        </li>
        @endif
        <li>
            <a href="{{route('index-currency')}}"><i class="fa fa-dollar-sign"></i> <span>Currency</span></a>
        </li>
<!--        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>-->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  
<script>
    $('.sidebar-menu ul li').find('a').each(function () {
        var link = new RegExp($(this).attr('href')); //Check if some menu compares inside your the browsers link
        if (link.test(document.location.href)) {
            if(!$(this).parents().hasClass('active')){
                $(this).parents('li').addClass('menu-open');
                $(this).parents().addClass("active");
                $(this).addClass("active"); //Add this too
            }
        }
    });
</script>