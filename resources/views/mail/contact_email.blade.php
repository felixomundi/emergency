
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">New Email</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Subject: {{$contact->subject }}</h5>
                 @if ($contact->user)
                  <h6>From: {{$contact->user->email ?? "No Email"}}
                  <span class="mailbox-read-time float-right"> </span></h6>
                  <h6>Name: {{ $contact->user->name ?? "No Name" }}</h6>
                  <h6>Phone: {{$contact->user->phone ?? "No Phone"}}</h6>
                 @endif
              </div>
              <!-- /.mailbox-read-info -->

              <div class="mailbox-read-message">


                <p>{{ $contact->message }}.</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->

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
    <strong>Copyright &copy; {{ date("Y")}}<a href="https://www.kadesea.co.ke"> Kadesea Agency Limited</a>.</strong> All rights reserved.
  </footer>


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
