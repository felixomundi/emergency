@extends("layouts.dashboard")

@section("seo")
<title>All User Advances | {{config("app.name")}} </title>
@endsection


@section("styles")

@endsection

@section("content")


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Advances</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advances</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <a href="/admin/advance/create" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Advance</a>
                </h3>
              </div>

          @include("layouts.messages")

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>User</th>
                <th>Served By</th>
                <th>Effective Date</th>
                <th>Closing Date</th>
                <th>Amount</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                @forelse ($advances as $key => $advance )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>@if ($advance->purpose)
                    {{ $advance->purpose->name }}
                    @else

                    @endif</td>
                    <td>
                    @if ($advance->status == "0")
                    <label class="badge badge-primary">Approved</label>
                    @elseif ($advance->status === "1")
                    <label class="badge badge-warning">Pending</label>
                    @elseif ($advance->status === "2")
                    <label class="badge badge-secondary">Under Consideration</label>
                    @elseif($advance->status === "3")
                     <label class="badge badge-danger">Cancelled</label>
                    @endif</td>
                    <td>{{ $advance->user->name }}</td>
                    <td>@if ($advance->server)  {{$advance->server->name }} @else <p class="text-danger">No Creator Found</p> @endif</td>
                    <td>{{$advance->effective_date}} </td>
                    <td>{{$advance->closing_date }}</td>
                    <td>{{$advance->amount }}</td>
                    <td>
                    <a href="#" onclick="return confirm('Are you sure you need to delete this allowance ? Remember action may be undone')"><i class="fa fa-trash text-danger"></i></a>
                    <a href="/admin/advance/edit/{{ $advance->id}}" ><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="9" class="text-center">No User Allowance  Found</td></tr>
                  @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                <th>ID</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>User</th>
                <th>Served By</th>
                <th>Effective Date</th>
                <th>Closing Date</th>
                <th>Amount</th>
                 <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->




          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
@section("scripts")
@include("layouts.tables")


@endsection
