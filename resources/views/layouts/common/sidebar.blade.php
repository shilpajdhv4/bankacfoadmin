
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="image" style="text-align: center;">
          <img src="{{ asset ('dist/img/logo.png') }}" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>iPing Data Labs</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{url('home')}}">
            <i class="fa fa-dashboard"></i> <span>Home
          </a>
        </li>
        @can('users')
        <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Manage Users</a></li>
        @endcan
        @can('role-list')
        <li><a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i>Manage Role</a></li>
        @endcan
        @can('vertical')
        <li><a class="nav-link" href="{{ url('vertical') }}"><i class="fa fa-circle-o"></i>Vertical</a></li>
        @endcan
        @can('category')
        <li><a class="nav-link" href="{{ url('category') }}"><i class="fa fa-circle-o"></i>Category</a></li>
        @endcan
        @can('services')
        <li><a class="nav-link" href="{{ url('services') }}"><i class="fa fa-circle-o"></i>Subscription</a></li>               
        @endcan
        @can('user_subscrbed_field')
        <li><a class="nav-link" href="{{ url('user_subscrbed_field') }}"><i class="fa fa-circle-o"></i>User Subscribes Field</a></li>               
        @endcan
        @can('quotation_request')
        <li><a class="nav-link" href="{{ url('quotation_request')}}"><i class="fa fa-circle-o"></i>Quotation Request</a></li>
        @endcan
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>