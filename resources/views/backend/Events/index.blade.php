@extends('backend.master-layouts.main')

@section('contentHeader')

    <div class="col-sm-6">
    <h1 class="m-0 text-dark">Events</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{ route('events.create') }}" class="pull-right btn btn-info">Add New</a>
        </ol>
    </div>
@endsection

@section('content.wrapper')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="admin-datatable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                <tr>
                                  <td>{{ $event->name }}</td>
                                  <td>{{ $event->slug }}</td>
                                  <td>{{ date('d-m-Y',strtotime($event->created_at)) }}</td>
                                  <td>
                                    <form action="{{ route('events.destroy',$event->id) }}" method="POST">   
                                        <a href="{{ route('events.show', ['event' => $event->id]) }}" class="btn btn-success btn-xs">
                                            View
                                        </a>
                                            
                                        <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-success btn-xs">
                                            Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')      
                                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                    </form>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                                </tbody>
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
@endsection
