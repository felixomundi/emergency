

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ url("/") }}" class="brand-link">
<img src="{{ asset('logo/logo.jpg') }}" alt="{{config('app.name')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light" style="font-size: 15px;font-weight:400;">{{config('app.name')}}</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->


@if (Auth::user())
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="info">
<a href="/" class="d-block">{{ Auth::user()->name }}</a>
</div>
</div>
@endif
<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

@guest

@if (Route::has('login'))

<li class="nav-item">
<a href="{{ route('login') }}" class="nav-link">
<i class="fas fa-external-link-alt text-danger nav-icon" aria-hidden="true"></i>
<p>
{{ __('Login') }}
</p>
</a>
</li>

@endif

@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else


@if(Auth::user()->status == 1)
<li class="nav-item">
<a class="nav-link" href="/contact"><i class="fa fa-envelope nav-icon"></i> Contact Us</a>
</li>
@elseif (Auth::user()->role_as == 1 && Auth::user()->status == 0)
<li class="nav-item"><a class="nav-link" href="/admin/dashboard"><i class="fa fa-dashboard nav-icon"></i> Admin Dashboard</a></li>
@elseif(Auth::user()->role_as == 3 && Auth::user()->status == 0)
<li class="nav-item"><a class="nav-link" href="/manager/dashboard"><i class="fa fa-dashboard nav-icon"></i> Manager Dashboard</a></li>
@elseif(Auth::user()->role_as == 2 && Auth::user()->status == 0)
<li class="nav-item"><a class="nav-link" href="/accounts/dashboard"><i class="fa fa-dashboard nav-icon"></i> Account Dashboard</a></li>

@elseif(Auth::user()->role_as == 0 && Auth::user()->status == 0)
<li class="nav-item"><a class="nav-link" href="/user/dashboard"><i class="fa fa-dashboard nav-icon"></i> User Dashboard</a></li>
@endif


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


@endguest

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
