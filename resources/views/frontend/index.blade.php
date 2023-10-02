@extends("layouts.app")

@section("seo")
<title>{{config("app.name")}}</title>
@endsection

@section("styles")
<style>
.carousel-control-next,
.carousel-control-prev /*, .carousel-indicators */ {
    filter: invert(100%);
}
</style>
@endsection

@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">User Home</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
        @if(Auth::user())
          <h3 class="card-title">{{ Auth::user()->name}}</h3>
         @endif
        </div>
        <div class="card-body">
        Welcome
        <br>
          @if(Auth::user() && Auth::user()->status == 1)
          You are not allowed to access our site please click this link <a href="/contact">Contact Us</a> for any help
          @endif


        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

        {{--  carousel  --}}
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="/logo/police.jpeg"  height="500px" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="/logo/police-2.jpeg" height="500px"  alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="/logo/logo.jpg" height="500px"  alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        {{--  carousel  --}}

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
