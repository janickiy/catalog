  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        
        <li <?= $menu == 'dashboard' ? ' class="active"' : ''?>>
          <a href="{{url('/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>


        <li class="treeview <?= $menu == 'user' ? 'active' : ''?>">
          
          <a href="#">
            <i class="fa fa-cog"></i> <span>Users Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
          
          @if(Helpers::has_permission(Auth::user()->id, 'manage_user'))
            <li <?= isset($sub_menu) && $sub_menu == 'user_list' ? ' class="active"' : ''?>><a href="{{url('admin/user/list')}}"><i class="fa fa-users"></i> User List</a></li>
          @endif

          @if(Helpers::has_permission(Auth::user()->id, 'manage_role'))
            <li <?= isset($sub_menu) && $sub_menu == 'role_list' ? ' class="active"' : ''?>><a href="{{url('admin/role/list')}}"><i class="fa fa-users"></i> User Role</a></li>
          @endif

          </ul>
        </li>

      </ul>
    </section>
  </aside>