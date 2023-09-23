

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ url("manager/dashboard") }}" class="brand-link">
<img src="{{ asset("logo/logo.jpg") }}" alt="{{config('app.name') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">Manager Dashboard</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
@if (Auth::user()->image)
<img src="/users/{{ Auth::user()->image }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}" style="width:30px;height:30px">
@else
<img src="{{ asset("school/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}" style="height:30px;width:30px">
@endif

</div>
<div class="info">
<a href="/manager/profile" class="d-block">{{ Auth::user()->name }}</a>
</div>

</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-users"></i>
<p>
Students
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-plus-circle"></i>
<p>Manage Students</p>
</a>
</li>

<li class="nav-item">
<a href="/manager/attendance" class="nav-link">
<i class="nav-icon fa-solid fa-clock"></i>
<p>Student Attendance</p>
</a>
</li>
</ul>
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
<a href="{{url('/manager/profile')}}" class="nav-link">
<i class="fa fa-eye nav-icon"></i>
<p>View Profile</p>
</a>
</li>


<li class="nav-item">
<a href="{{ url("manager/change_password") }}" class="nav-link">
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
