@extends('layouts.app')
<title>Nuevo Aviso</title>
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Subir nuevo aviso</div>

                    <div class="card-body">

                        <form method="POST" action="{{action('ImageController@store')}}" enctype="multipart/form-data">
                            @csrf

                            <input name="id_user" id="id_user" type="hidden" value="{{Auth::user()->id_user}}">

                            <div class="form-group row">

                                <label for="image" class="col-md-3 col-form-label text-md-right"><i class="fa fa-image fa-fw"></i> Imagen</label>

                                <span>


                            </span>
                                <div class="col-md-7">
                                    <input id="image" name="image"  type="file" class="form-control @error('image') is-invalid @enderror" required>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label for="body" class="col-md-3 col-form-label text-md-right"><i class="far fa-edit"></i>Descripción</label>

                                <div class="col-md-7">
                                    <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" required></textarea>
                                    @error('body')
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Hay un error al publicar el aviso!',
                                            timer: 10000,
                                        })
                                    </script>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i> Publicar
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
