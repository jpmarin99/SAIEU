@extends('layout')
@section('dashboard-content')

    @if(Session::get('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" rule="alert" id="gone">
            <strong> {{ Session::get('deleted') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('delet-failed'))
        <div class="alert alert-warning alert-dismissible fade show" rule="alert" id="gone">
            <strong> {{ Session::get('delet-failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <div class="row">
          <div class="col-sm">
          </div>
          <a href="{{URL::to('get-notification-form')}}">
          <button type="button" class="btn btn-primary">+ Send New Notification</button>
          </a>
        </div>
      </div>
    <br>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            All Sliders</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th style="width: 35%">Message</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th> Title</th>
                        <th> Message</th>
                        <th> Image</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($push_notifications as $push_notification)

                        <tr>
                            <td>{{ $push_notification->title }} </td>
                            <td>{!! $push_notification->body !!} </td>
                            @if($push_notification->img != null)
                            <td> <img src="{{ $push_notification->img}} " width="100" height="100"></td>
                            @else
                               <td><img src="noImage.png" width="100" height="100" /> </td>
                            @endif
                            <td>{{ date('d-m-Y', strtotime($push_notification->created_at)) }}</td>

                            <td>
                                <a href="{{ URL::to('delete-notification') }}/{{ $push_notification->id }}" class="btn btn-outline-danger btn-sm" onclick="return checkDelete()">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>

    <script>
        function checkDelete() {
            var check = confirm('Are you sure you want to delete this?');
            if(check){
                return true;
            }
            return false;
        }
    </script>

@stop
