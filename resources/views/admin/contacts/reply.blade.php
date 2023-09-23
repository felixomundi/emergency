@extends("layouts.dashboard")

@section("seo")
<title>Admin Reply Mail | {{config("app.name")}} </title>
@endsection

@section("content")
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reply Mail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reply Mail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            @include("layouts.messages")
            {{--  <a href="/contact" class="btn btn-primary btn-block mb-3">Compose</a>  --}}

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="/admin/contacts" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox
                      <span class="badge bg-primary float-right">12</span>
                    </a>
                  </li>


                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Read Mail</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5><b> Subject: </b> {{$contact->subject}}</h5>
                <h6>From: {{$contact->user->email}}
                  <span class="mailbox-read-time float-right"><b>Date:</b>  {{$contact->created_at->format("d M Y h:i A")}}</span></h6>
              </div>
              <!-- /.mailbox-read-info -->

              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
               <form method="post" action="/admin/contacts/{{$contact->slug}}/reply">
               @csrf
               @method("put")
                <div class="row">
                   <div class="form-group col-md-12 mb-4">
                     <label for="status">Status</label>
                    <select name="status" class="form-control @error("status") is-invalid  @enderror">
                    <option value="">Status</option>
                    <option value="Requested">Requested</option>
                    <option value="In Progress">In Progress</option>
                     <option value="Resolved">Resolved</option>
                     </select>
                    @error("status")
                    <span class="invalid-feedback" role="alert">
                    {{ $message }}
                    </span>
                    @enderror
                   </div>

                   <div class="form-group col-md-12">
                <label for="response">Response</label>
                    <textarea id="compose-textarea" name="response" class="form-control @error("response") is-invalid @enderror"  style="height: 300px">

                    </textarea>
                @error("response")
                <span class="invalid-feedback" role="alert">
                {{ $message }}
                </span>

                @enderror
                </div>
                </div>
                <div class="card-footer">
                <div class="float-right">

                <button type="submit" class="btn btn-primary"><i class="fas fa-reply"></i> Reply</button>
                </div>

                <!-- /.card-footer -->
                </div>
               </form>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->

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
@endsection
