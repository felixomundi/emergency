<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/school/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/school/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">

              </div><!-- /.card-header -->
              <div class="card-body">
                  <div  id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="/users/{{$user->image}}" alt="{{$user->name}}">
                        <span class="username">
                          <a href="#">{{$user->name}}</a>
                        </span>
                        <span class="description">New Student Admission - {{$user->created_at->format("d M Y h:i A")}} </span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Dear {{ $user->name }} thank you for studying with us. Your enrollment for {{$course_name}} course was successful. Your new admission number is {{ $user->student->admission_number}}. Moreover an account has been created our website and you can now login with your provided password: <b>{{ $password}}</b>
                        in case you have any login issues feel free to share us an email via info@kadesea.co.ke
                      </p>
                    <h1>  <a href="https://manageschool.kadesea.co.ke" class="btn btn-primary">Login Now</a></h1>
                     <h5>Thanks Regards: <br>
                     Kadesea Agency
                     </h5>
                    </div>
                    <!-- /.post -->

                  </div>

                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date("Y")}} <a href="https://manageschool.kadesea.co.ke"> Manageschool Kadesea Agency</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/school/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/school/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/school/dist/js/adminlte.min.js"></script>
</body>
</html>
