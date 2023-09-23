<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $course->title }} Fees Structure | Kadesea Agency</title>
  <link rel="icon" href="/logo/logo.jpg" size="32*32">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset("school/plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("school/dist/css/adminlte.min.css") }}">
</head>
<body>
 <div class="wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

        @include("layouts.messages")

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                   <strong>KADESEA AGENCY LIMITED</strong>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <address>
                    PIN: P051762398V<br>
                    Safina Plaza 3rd Floor<br>
                    Ronald Ngala Street<br>
                    Eldoret UASIN GISHU 30100<br>
                    Kenya
                  </address>
                </div>
                <!-- /.col -->

                <div class="col-sm-6 invoice-col">
                  <img src="/logo/logo.jpg" class="img-fluid" style="width:150px; height:150px;float:end;">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            <hr>
            <div class="row">
            <div class="col-12">
                  <h4>
                 <strong class="text-uppercase">
             {{$course->title}}      FEES STRUCTURE
                 </strong>
                  </h4>
                  {{--  <p>Sales Receipt#  SR-{{ str_pad ( @$payments[0]["id"] , 5, "0", STR_PAD_LEFT) }}</p>  --}}
                </div>


            </div>


              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Fee Category</th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($feestructures as $key => $fee)
                    <tr>
                    <td>{{$key+1}}</td>
                     <td>{{$fee->fee_category_name->name}}</td>
                     <td>1</td>
                    <td>{{number_format($fee->amount, 2)}}</td>
                    <td>{{number_format($fee->amount, 2)}}</td>
                    </tr>

                    @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">

                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Sub Total:</th>
                        <td>Ksh. {{ number_format($sum, 2)}}</td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td>Ksh. {{ number_format($sum, 2)}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
