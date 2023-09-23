@extends("layouts.app")
@section("seo")
<title>Contact Support Page | Kadesea Agency</title>
@endsection
@section("content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compose</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Compose</li>
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
            <a href="/inbox" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

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
                    <a href="/inbox" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox

                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/sent" class="nav-link">
                      <i class="far fa-envelope"></i> Sent
                    </a>
                  </li>

                </ul>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>

              <!-- /.card-header -->
              <form method="post" action="/contact" autocomplete="off">
              @csrf
              <div class="card-body">
                <div class="form-group">
                <label for"subject">Subject</label>
                  <input class="form-control @error("subject") is-invalid @enderror"  name="subject" placeholder="Subject:">
               @error("subject")
               <span class="invalid-feedback" role="alert">
                {{ $message }}
               </span>

               @enderror
                </div>


                <div class="form-group">
                <label for"priority">Priority</label>
                <select class="form-control @error("priority") is-invalid @enderror"  name="priority" placeholder="Priority">
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                </select>
                @error("priority")
                <span class="invalid-feedback" role="alert">
                {{ $message }}
                </span>

                @enderror
                </div>


                <div class="form-group">
                <label for="message">Message</label>
                    <textarea id="compose-textarea" name="message" class="form-control @error("message") is-invalid @enderror"  style="height: 300px">

                    </textarea>
                @error("message")
                <span class="invalid-feedback" role="alert">
                {{ $message }}
                </span>

                @enderror
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  {{--  <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>  --}}
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>

              </div>
              <!-- /.card-footer -->
               </form>
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
@endsection

@section("scripts")

@endsection
