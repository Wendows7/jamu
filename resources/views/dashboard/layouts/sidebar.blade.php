<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/dashboard">Jamu Niswah</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">JNW</a>
      </div>
      <ul class="sidebar-menu">
          <li class={{ Request::is('dashboard/admin/users')? 'active' : '' }}><a class="nav-link" href="{{route('admin.users')}}"><i class="far fa-user"></i> <span>Users</span></a></li>
          <li class="dropdown {{ Request::is('dashboard/admin/data/*')? 'active' : '' }}">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-database"></i> <span>Data</span></a>
            <ul class="dropdown-menu">
        <li class={{ Request::is('dashboard/admin/products')? 'active' : '' }}><a class="nav-link" href="{{route('admin.products')}}"><i class="fa fa-database"></i> <span>Products</span></a></li>
        <li class={{ Request::is('dashboard/admin/category')? 'active' : '' }}><a class="nav-link" href="{{route('admin.category')}}"><i class="fa fa-database"></i> <span>Categories</span></a></li>
        <li class={{ Request::is('dashboard/admin/orders')? 'active' : '' }}><a class="nav-link" href="{{route('admin.orders')}}"><i class="fa fa-database"></i> <span>Orders</span></a></li>
      </ul>
    </aside>
  </div>
