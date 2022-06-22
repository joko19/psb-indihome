<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="{{asset('images/indihome.png')}}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8"> -->
        <!-- <span class="brand-text font-weight-light text-red">Indihome</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('data-order')}}" class="nav-link">
                                <p>Data Order</p>
                            </a>
                        </li>
                        @if (auth()->user()->level == "admin")
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Schedule</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->level == "teknisi")
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Timer</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Report</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                <a href="/data-order" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>