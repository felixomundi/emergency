@extends("layouts.dashboard")
@section("seo")
<title>Admin All Users  | {{config("app.name")}}</title>
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
            <h1>All System Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">System Users</li>
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
          @include("layouts.messages")

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <a href="/admin/users/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create New User</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th></th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  @forelse ($users as $key => $user )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>

                    @if ($user->role_as == "1")
                    <label class="badge badge-primary">Admin</label>
                  @elseif ($user->role_as == "2")
                   <label class="badge badge-info">Accountant</label>
                    @elseif ($user->role_as == "3")
                   <label class="badge badge-success">Manager</label>
                    @elseif ($user->role_as == "0")
                   <label class="badge badge-warning">User</label>
                    @endif
                    </td>
                     <td> @if ($user->status == "0")
                    <label class="badge badge-primary">Active</label>
                    @else
                     <label class="badge badge-danger">Inactive</label>
                    @endif</td>

                    <td>
                    @if ($user->created_at)
                    {{ $user->created_at->format("d M Y h:i A") }}
                    @endif</td>
                    <td><button  class="btn btn-danger deleteuser" data-id="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                        <a href="/admin/users/{{ $user -> id }}/edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="7" class="text-center">No Users Found</td></tr>
                  @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                   <th>ID</th>
                    <th>Name</th>
                     <th>Email</th>
                      <th>Role</th>
                    <th>Status</th>
                    <th>Date Created</th>
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
@include("layouts.tables");
@endsection
