

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ route("dashboard") }}" class="brand-link">
<img src="{{ asset("logo/logo.jpg") }}" alt="Kadesea Agency" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">Admin Dashboard</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
{{-- @if(Auth::user()->image)
<img src="/users/{{ Auth::user()->image }} elevation-2" alt="{{Auth::user()->name}}">
@else
<img src="{{ asset("school/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2" alt="{{Auth::user()->name}}">
@endif --}}
</div>
<div class="info">
<a href="#" class="d-block">{{ Auth::user()->name }}</a>
</div>
</div>



<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<li class="nav-item">
<a href="{{ route("users") }}" class="nav-link">
<i class="nav-icon fa-solid fa-users"></i>
<p>
Users
</p>
</a>
</li>

<li class="nav-item">
<a href="/admin/areas-of-work" class="nav-link">
<i class="nav-icon fa-solid fa-location-dot"></i>
<p>
Areas of Work
</p>
</a>
</li>


<li class="nav-item">
<a href="/admin/departments" class="nav-link">
<i class="nav-icon fa-solid fa-code-branch"></i>
<p>
Departments
</p>
</a>
</li>




<li class="nav-item">
<a href="/admin/positions" class="nav-link">
<i class="nav-icon fa-solid fa-code-branch"></i>
<p>
Positions
</p>
</a>
</li>



<li class="nav-item">
<a href="/admin/manage-salary" class="nav-link">
<i class="nav-icon fa fa-list-check"></i>
<p>Manage Salary </p>
</a>
</li>


<li class="nav-item">
<a href="/admin/salary/types" class="nav-link">
<i class="nav-icon fa fa-coins"></i>
<p>Salary Types </p>
</a>
</li>

<li class="nav-item">
<a href="/admin/user_attendancies" class="nav-link">
<i class="nav-icon fa fa-clock"></i>
<p>Attendance </p>
</a>
</li>


<li class="nav-item">
<a href="/admin/user_deductions" class="nav-link">
<i class="fa fa-minus-circle nav-icon"></i>
<p>Deduction </p>
</a>
</li>


<li class="nav-item">
<a href="/admin/user_allowances" class="nav-link">
<i class="fa fa-comments-dollar nav-icon"></i>
<p>Allowance </p>
</a>
</li>



<li class="nav-item">
<a href="/admin/loans" class="nav-link">
<i class="fa fa-list nav-icon"></i>
<p>Loans</p>
</a>
</li>



<li class="nav-item">
<a href="/admin/advance" class="nav-link">
<i class="fa fa-list nav-icon"></i>
<p>Advance</p>
</a>
</li>


<li class="nav-item">
<a href="/admin/purpose" class="nav-link">
<i class="fa fa-list nav-icon"></i>
<p>Purpose</p>
</a>
</li>


<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-bag-shopping"></i>
<p>
Payments
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa fa-solid fa-calendar-days"></i>
<p>Loan</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="fa fa-calendar nav-icon"></i>
<p>Salary</p>
</a>
</li>


<li class="nav-item">
<a href="#" class="nav-link">
<i class="fa fa-calendar nav-icon"></i>
<p>Advance</p>
</a>
</li>
</ul>
</li>


<li class="nav-item">
<a href="#" class="nav-link">
<i class="fa fa-list nav-icon"></i>
<p>Payslips </p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-file"></i>
<p>
Reports
<i class="right fas fa-angle-left"></i>
</p>
</a>

<ul class="nav nav-treeview">

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fa fa-solid fa-calendar-days"></i>
<p>Monthly</p>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="fa fa-calendar nav-icon"></i>
<p>Yearly</p>
</a>
</li>

</ul>

</li>





<li class="nav-item">
<a href="/admin/contacts" class="nav-link">
<i class="fa fa-circle-question nav-icon text-danger"></i>
<p>Support Ticket</p>
</a>
</li>



<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-user"></i>
<p>
Account
<i class="right fas fa-angle-left"></i>
</p>
</a>

<ul class="nav nav-treeview">

<li class="nav-item">
<a href="/admin/change-password" class="nav-link bg-warning">
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

