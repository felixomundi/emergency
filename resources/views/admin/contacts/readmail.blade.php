@extends("layouts.dashboard")

@section("seo")
<title>Admin Read Mail | Kadesea Agency </title>
@endsection


@section("content")
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Read Mail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Read Mail</li>
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
              <h6><b>Message</b></h6>
                <p> {{ $contact->message }}</p>
                <h5 style="font-weight:900;">All Replies</h5>
                <hr class="border-success"/>

             @if ($contact->emailreplies->count()>0)
                    @foreach ($contact->emailreplies as $key => $reply)
                        <h6><b>Reply {{$key + 1 }}</b> <span class="float-right"> {{$reply->created_at->format("d M Y h:i A")}}</span></h6>
                        <p> {{ $reply->response }}</p>
                        <hr class="border-dark"/>
                    @endforeach
              @else
                         {{--  <div class="mailbox-read-message">  --}}
                        <h6>No Reply Exists</h6>

                        {{--  </div>  --}}
                        <!-- /.mailbox-read-message -->
               @endif

            <h5><b>Current Status :</b> {{$contact->status }} </h5>
              </div>


            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
            {{--  <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>  --}}
            <!-- /.card-footer -->
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
  <!-- /.content-wrapper -->
@endsection
