@extends('backend.master-layouts.main')
@section('contentHeader')
<div class="col-sm-6">
   <h1 class="m-0 text-dark">Event Master</h1>
</div>
@endsection
@section('content.wrapper')
<section class="content">
   <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
         <div class="card-header">
            <h3 class="card-title">Update Event</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <form class="form-horizontal" action="{{ route('events.update', ['event' => $event->id ]) }}" method="post">
               @csrf
               @method('PUT')
               <input type="hidden" name="event_id" value="{{ $event->id }}">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control"  value="{{ $event->name }}" name="name" id="names">
                         @error('name')
                        <span class="invalids-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}.</strong>
                        </span>
                        @enderror
                     </div>
                     <!-- /.form-group -->
                  </div>
                  <!-- / .col -->
               </div>
               <div class="row">
                  <div class="col-12">
                     <input type="submit" value="Save" class="btn btn-success float-right">
                     <a href="{{ route('events.index') }}" class="btn btn-secondary float-right" style="margin-right: 5px;">Back</a>
                  </div>
               </div>
            </form>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
@endsection