@extends('backend.master-layouts.main')
@section('contentHeader')
<div class="col-sm-6">
   <h1 class="m-0 text-dark">Location Master</h1>
</div>
@endsection
@section('content.wrapper')
<section class="content">
   <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
         <!-- /.card-header -->
         <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name : {{ $event->name }}</label>
                     </div>
                     <!-- /.form-group -->
                  </div>
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>slug: {{ $event->slug }}</label>
                     </div>
                     <!-- /.form-group -->
                  </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Date : {{ date('d-m-Y',strtotime($event->created_at)) }}</label>
                     </div>
                     <!-- /.form-group -->
                  </div>
                  <!-- / .col -->
               </div>
               <div class="row">
                  <div class="col-12">
                     <a href="{{ route('events.index') }}" class="btn btn-secondary float-right" style="margin-right: 5px;">Back</a>
                  </div>
               </div>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
