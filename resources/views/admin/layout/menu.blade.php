<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets')}}/images/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
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
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Sản phẩm</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('admin.index') }}"><i class="fa fa-circle-o"></i>Quản lý sản phẩm</a></li>
                  <li><a href="{{ route('admin.add-sp') }}"><i class="fa fa-circle-o"></i>Thêm sản phẩm</a></li>
              </ul>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Voucher</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('voucher.index') }}"><i class="fa fa-circle-o"></i>Quản lý voucher</a></li>
                  <li><a href="{{ route('voucher.get_add_voucher') }}"><i class="fa fa-circle-o"></i>Thêm voucher</a></li>
              </ul>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Đơn Hàng</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('get_don_hang') }}"><i class="fa fa-circle-o"></i>Chi tiết đơn hàng</a></li>
              </ul>
          </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
