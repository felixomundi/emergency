
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ url('user/dashboard') }}" class="brand-link">
<img src="{{ asset('logo/logo.jpg') }}" alt="{{config('app.name')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">User Dashboard</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">

<div class="info">
<a href="/user/profile" class="d-block">{{ Auth::user()->name }}</a>
</div>

</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



<li class="nav-item">
<a href="/user/cases" class="nav-link">
<i class="nav-icon fa-solid fa-file"></i>
<p>Cases</p>
</a>
</li>




<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa fa-user"></i>
<p>
Account
<i class="right fas fa-angle-left"></i>
</p>
</a>

<ul class="nav nav-treeview">
<li class="nav-item">
<a href="/user/profile" class="nav-link">
<i class="fa fa-eye nav-icon"></i>
<p>View Profile</p>
</a>
</li>


<li class="nav-item">
<a href="/user/change-password" class="nav-link">
<i class="fa fa-lock nav-icon"></i>
<p>Update Password</p>
</a>
</li>
</ul>
</li>


<li class="nav-item">
<a href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();" class="nav-link bg-danger">
<i class="nav-icon fas fa-power-off"></i>
<p>Logout</p>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
</li>


</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
