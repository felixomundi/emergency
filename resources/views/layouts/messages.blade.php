<div class="m-1">
@if (session("error"))
<div class="alert alert-danger ms-3 mt-3"> {{ session("error") }}</div>
@endif

@if (session("message"))
<div class="alert alert-success ms-3 mt-3"> {{ session("message") }}</div>
@endif


@if (session("warning"))
<div class="alert alert-warning ms-3 mt-3"> {{ session("warning") }}</div>
@endif


@if (session("info"))
<div class="alert alert-info ms-3 mt-3"> {{ session("info") }}</div>
@endif

@if (session("success"))
<div class="alert alert-success ms-3 mt-3"> {{ session("success") }}</div>
@endif


</div>
