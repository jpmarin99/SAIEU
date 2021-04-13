@extends('layout')
@section('dashboard-content')
<div class="container">
    <div class="row">
      <div class="col-sm">
      </div>
      <a href="{{URL::to('all-notifications')}}">
      <button type="button" class="btn btn-primary"> All Notification</button>
      </a>
    </div>
  </div>
<br>
    <h2>Send Push Notification</h2><br><br>

    @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('success') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{route('bulksend')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Title" name="title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Message</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Description" name="body" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image Url</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image link" name="img">
        </div>

        <button type="submit" class="btn btn-primary">Send Notification</button>
    </form>
    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@stop
