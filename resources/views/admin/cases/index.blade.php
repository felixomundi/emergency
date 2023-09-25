@extends("layouts.dashboard")
@section("seo")
<title>Cases | {{config("app.name")}}</title>
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
            <h1>Cases</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cases</li>
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
                <!-- <a href="/admin/cases" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Report New Case</a> -->
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>County</th>
                <th>Sub County</th>
                <th>Title</th>
                <th>Message</th>                
                <th>Status</th>
                <th>Date Created</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                @forelse ($cases as $key => $case )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{$case->subcounty->county->name}}</td>
                    <td>{{$case->subcounty->name}}</td>
                    <td>{{ $case->title }}</td>
                    <td>{{ $case->message }}</td>
                    <td> {{$case->status}}  </td>                                
                    <td>
                    @if ($case->created_at)
                    {{ $case->created_at->format("d M Y h:i A") }}
                    @endif</td>
                    <td> <a onclick="myFunction(event,{{$case->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    <a href="/admin/cases/edit/{{$case->id}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  </td>
                    
                  </tr>
                  @empty
                  <tr><td colspan="8" class="text-center">No reported case yet</td></tr>
                  @endforelse
               
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                <th>County</th>
                <th>Sub County</th>
                <th>Title</th>
                <th>Message</th>                
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

<script src="/js/notify.js"></script>
    <script>
    function myFunction(event,id) {
    let text = "Do you need to delete this case remember action may not be undone";
    if (confirm(text) == true) {
        event.preventDefault();
       $.ajax({
        url:"/admin/cases/delete/"+id,
        method:"GET",
        success:function(response){
            if(response.status == "200"){
                $.notify(response.message, "success");
                complete();
            }
            if(response.status == "404"){
                $.notify(response.message, "error");
                complete();
            }
        },
        error: function (error) {
            complete();
        },

       });
    }

    }

    function complete() {
        setTimeout(function () {
        location.reload();
        }, 2000)
    }
    </script>
@endsection
