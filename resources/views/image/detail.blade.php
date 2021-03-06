@extends('layouts.app')
<title>Detalle del aviso</title>
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (session('message'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Acción realizada correctamente!',
                            timer: 10000,
                        })
                    </script>
                @endif


                <div class="card">
                    <div class="card-header">
                        <div class="col-md-12">
                            <div class="row">
                                @if($image->user->image)
                                    <div class="col-md-2">
                                        <img src="{{$image->user->image }}" alt="" class="col-md-12 mx-auto" style="max-width:60px;">
                                    </div>
                                @endif
                                <div class="col-md-10">

                                    <span style="color: #cca;">
                                    {{'@'.$image->user->name}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Detalles de la imagen --}}
                    <div class="main_image">
                        <div class="card-body">
                            <img src="{{$image->image}}" alt="" class="col-md-12">
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-11"><span style="color:#A0ADC2;">{{'@'.$image->user->name}} | {{$image->created_at}}</span>
                                        <br>
                                    </div>
                                    {{-- Lógica de Likes --}}
                                    <div class="col-md-1 float-right">
                                        @php
                                            $is_liked = false
                                        @endphp
                                        @foreach ($image->likes as $like)
                                            @if($like->user_id == Auth::user()->user_id)
                                                @php
                                                    $is_liked = true
                                                @endphp
                                            @else
                                                @php
                                                    $is_liked = false
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if($is_liked == true)
                                            <img   class="like" src="{{asset('images/like.png')}}" data-id="{{$image->id}}" alt="" style="max-width: 20px">
                                        @else
                                            <img class="dislike" src="{{asset('images/unlike.png')}}" data-id="{{$image->id}}" alt="" style="max-width: 20px">
                                        @endif
                                        <span  id="contador" data-value="({{count($image->likes)}})" style="color:#A0ADC2;" > ({{count($image->likes)}}) </span>
                                    </div>
                                    {{-- Fin lógica de likes --}}
                                </div>

                                <p>{{$image->body}}</p>
                                <div class="col-md-12">
                                    <p style="color:#949393; font-size: 14px;" class="float-right"></p>
                                </div>

                                {{-- Botones para editar o borrar la imagen depende de si el usuario es el dueño del aviso --}}
                                @if(Auth::user() && Auth::user()->id == $image->user->id)
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- Boton para editar la imagen --}}
                                            <a href="{{action('ImageController@edit',['id' => $image->id])}}" title="Editar Aviso" class="btn btn-sm btn-primary float-right">
                                                <i class="fa fa-pencil" style="font-size: 12pt;"></i></a>

                                        {{-- Modal para preguntar si realmente queremos borrar el aviso --}}
                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger"  title="Eliminar Aviso" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    {{-- Título del modal --}}
                                                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas borrarlo?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {{-- Cuerpo del modal --}}
                                                <div class="modal-body">
                                                    {{-- Mensaje del modal --}}
                                                    Si eliminas este aviso nunca podras recuperarlo
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- Boton de cancelar la eliminación --}}
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                    {{-- Boton para borrar definitivamente la imagen --}}
                                                    <a href="{{action('ImageController@destroy',['id'=>$image->id])}}" class="btn btn-danger float-right">Borrar definitivamente</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Fina del modal --}}
                                @endif
                                <br>
                                <br>
                                {{-- Enviar nuevo comentario --}}
                                <div class="send_comment col-md-12">
                                    <form method="POST" action="{{action('ComentarioController@store')}}" enctype="multipart/form-data" >
                                        @csrf

                                        <input name="user_id" id="user_id" type="hidden" value="{{Auth::user()->id}}">
                                        <input name="post_id" id="post_id" type="hidden" value="{{$image->id}}">
                                        <div class="form-group row ">
                                            <div class="col-md-12 align-content-center">
                                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Escribe tu comentario..." ></textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>

                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-success">
                                                    Comentar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <br>
                                    {{-- Fin del formulario para enviar un nuevo comentario --}}
                                    {{-- Listar todos los comentarios --}}
                                    <div class="col-md-12">
                                        @foreach ($image->comments as $comment)

                                            <div class="cold-md-12 card" style="padding: 20px;">
                                                <p>By: {{$comment->user->name.'  '}}<span style="color:#A0ADC2;" class="float-right">{{  '@'.$comment->user->name}}</span></p>

                                                <div class="col-md-12">
                                                    <p> {{$comment->comment}}</p><span class="float-right" style="font-size:14px; color:#A0ADC2; ">{{  $comment->created_at}}</span>
                                                </div>
                                                {{-- Mostramos el boton de borrar comentario en caso de que el usuario sea dueño del aviso o sino es dueño del post que sea dueño del comentario --}}

                                                @if($comment->user_id == Auth::user()->id)
                                                    <div class="col-md-2">
                                                        <a class="btn btn-sm btn-danger" href="{{action('ComentarioController@destroy', ['id'=> $comment->id])}}" title="Eliminar Comentario" >
                                                        <i class="fa fa-trash"></i></a>
                                                    </div>
                                                @endif
                                                {{-- Final de la condicion   --}}
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                    {{-- Listar todos los comentarios --}}
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
