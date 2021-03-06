@extends('layouts.app')
<title>Usuarios</title>
@section('content')




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    <br>
                @endif
                <h1>Usuarios</h1>
                <br>

                <br>
                @foreach ($users as $user)
                    <div class="data-user">
                        <div class="col-md-12" >
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{$user->image}}" alt="" class="col-md-6 float-center rounded-circle">
                                </div>
                                <div class="col-md-8">
                                    <h3> {{$user->name}}
                                        {{$user->email}}</h3>


                                    <h6 style="color:#ccc;" class="float-right">Se unió el: {{$user->created_at}}</h6>
                                </div>
                                <a class="mx-auto btn btn-sm btn-success" href="{{action('UserController@profile',['id' => $user->id])}}">Ver perfil</a>
                            </div>
                        </div>
                        <hr>
                        <br>
                    </div>
                    <br>

                @endforeach

                <br>
                <br>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

