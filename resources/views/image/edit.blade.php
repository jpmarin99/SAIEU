@extends('layouts.app')
<title>Editar Aviso</title>
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar aviso</div>

                    <div class="card-body">

                        <div class="col-md-5 text-center mx-auto">
                            <img src="{{$image->image}}" alt="" class="col-md-12">
                        </div>
                        <br>

                        <form method="POST" action="{{action('ImageController@update')}}" enctype="multipart/form-data">
                            @csrf

                            <input name="post_id" id="post_id" type="hidden" value="{{$image->id}}">


                            <div class="form-group row">

                                <label for="body" class="col-md-3 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-7">
                                    <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" required>{{$image->body}}</textarea>
                                    @error('body')
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Hay un error al editar el aviso!',
                                            timer: 10000,
                                        })
                                    </script>

                                    @enderror
                                </div>
                                </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar cambios!
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
