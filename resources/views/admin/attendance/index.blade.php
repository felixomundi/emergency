@extends("layouts.dashboard")

@section("seo")
<title>All User Attendance | {{config("app.name")}} </title>
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
            <h1>User Attendance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
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
                <a href="/admin/user_attendancies/create" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Attendance</a>
                </h3>
              </div>

          @include("layouts.messages")

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>User</th>
                <th>Served By</th>
                <th>Attendance Date</th>
                <th>Status</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                   @forelse ($attendances as $key => $attendance )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>@if ($attendance->server)  {{$attendance->server->name }} @else <p class="text-danger">No Creator Found</p> @endif</td>
                    <td>{{$attendance->attendance_date }}</td>
                    <td>@if ($attendance->status == 0)
                        <label class="badge badge-primary">Present</label>
                    @else
                    <label class="badge badge-danger">Absent</label>
                    @endif</td>
                    <td>
                    <a href="#" onclick="return confirm('Are you sure you need to delete this attendance ? Remember action may be undone')"><i class="fa fa-trash text-danger"></i></a>
                    <a href="/admin/user_attendancies/edit/{{ $attendance->id}}" ><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="6" class="text-center">No User Attendance  Found</td></tr>
                  @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                <th>User</th>
                <th>Served By</th>
                <th>Attendance Date</th>
                <th>Status</th>
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
