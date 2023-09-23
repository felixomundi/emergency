<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ @$payments[0]['user']['name'] }} Payment Receipt | Kadesea Agency</title>
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
                    {{-- <small class="float-right">Date: 2/10/2014</small> --}}
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
                 <strong>
                   SALES RECEIPT
                 </strong>
                  </h4>
                  <p>Sales Receipt#  SR-{{ str_pad ( @$payments[0]["id"] , 5, "0", STR_PAD_LEFT) }}</p>
                </div>

                 <div class="col-12 mt-2">
                  <div class="row">
                   <div class="col">

                    <h5><strong>Bill To</strong></h5>
                    <h5><strong>{{ @$payments[0]["user"]["name"] }}</strong></h5>

                  </div>
                  <div class="col mb-3">
                   <div class="table-responsive">
                    <table class="table no-border">
                      <tr>
                        <th style="width:50%">Receipt Date:</th>
                        <td>{{ @$payments[0]["payment_date"] }}</td>
                      </tr>
                      <tr>
                        <th>Reference </th>
                        <td><p class="text-uppercase">{{ @$payments[0]["reference_number"] }}</p></td>
                      </tr>
                    </table>
                  </div>

                  </div>

                  </div>
                </div>
            </div>


              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Item & Description </th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($payments  as $key => $payment)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $payment->course->title ?? "" }}</td>
                      <td>{{ $payment->course->course_duration ?? "" }}</td>
                      <td>{{ number_format($payment->amount_paid,2) ?? "" }}</td>
                      <td>{{ number_format($payment->amount_paid,2) ?? "" }}</td>
                    </tr>
                    @empty
                    <tr> </tr>
                    @endforelse

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <div class="card p-3">
                    <p class="lead">Payment Details:</p>

                    {{--  --}}
                 <div class="table-responsive">
                    <table class="table no-border">
                      <tr>
                        <th style="width:50%">Payment Mode:</th>
                        <td><strong >{{ @$payments[0]["payment_mode"]}}</strong></td>
                      </tr>
                      <tr>
                        <th>Reference</th>
                        <td><strong class="text-uppercase"> {{ @$payments[0]["reference_number"]}}</strong></td>
                      </tr>
                    </table>
                  </div>

                {{--  --}}


                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Sub Total:</th>
                        <td>Ksh. {{ number_format(@$payments[0]["amount_paid"], 2)}}</td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td>Ksh. {{ number_format(@$payments[0]["amount_paid"], 2)}}</td>
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
