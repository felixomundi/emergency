@extends("layouts.dashboard")

@section("seo")
<title>All User Allowances | {{config("app.name")}} </title>
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
            <h1>User Allowances</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Allowances</li>
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
                <a href="/admin/user_allowances/create" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Allowance</a>
                </h3>
              </div>

          @include("layouts.messages")

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Allowance Name</th>
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

                   @forelse ($allowances as $key => $allowance )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $allowance->allowance_name }}</td>
                    <td> @if ($allowance->status == "0")
                    <label class="badge badge-primary">Active</label>
                    @else
                     <label class="badge badge-danger">Inactive</label>
                    @endif</td>
                    <td>{{ $allowance->user->name }}</td>
                    <td>@if ($allowance->server)  {{$allowance->server->name }} @else <p class="text-danger">No Creator Found</p> @endif</td>
                    <td>{{$allowance->effective_date}} </td>
                    <td>{{$allowance->closing_date }}</td>
                    <td>{{$allowance->amount }}</td>
                    <td>
                    <a href="#" onclick="return confirm('Are you sure you need to delete this allowance ? Remember action may be undone')"><i class="fa fa-trash text-danger"></i></a>
                    <a href="/admin/user_allowances/edit/{{ $allowance->id}}" ><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="9" class="text-center">No User Allowance  Found</td></tr>
                  @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                <th>ID</th>
                <th>Allowance Name</th>
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
