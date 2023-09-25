@extends("layouts.user")
@section("seo")
<title>Completed Cases | {{config("app.name")}}</title>
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
            <h1>Completed Cases</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Completed Cases</li>
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
                <a href="/user/cases" class="btn btn-primary"> <i class="fa fa-backward"></i> Back To Cases Dashboard</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Message</th>                
                <th>Status</th>
                <th>Date Created</th>
                  </tr>
                  </thead>
                  <tbody>

                @forelse ($cases as $key => $case )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $case->title }}</td>
                    <td>{{ $case->message }}</td>
                    <td> {{$case->status}}  </td>                                
                    <td>
                    @if ($case->created_at)
                    {{ $case->created_at->format("d M Y h:i A") }}
                    @endif</td>
                    
                  </tr>
                  @empty
                  <tr><td colspan="5" class="text-center">You have no completed case</td></tr>
                  @endforelse
               
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                <th>Title</th>
                <th>Message</th>                
                <th>Status</th>
                <th>Date Created</th>
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
