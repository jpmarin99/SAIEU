@extends('layouts.app')
<title>Dashboard</title>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1700,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Bienvenido  {{ Auth::user()->name }}  al sistema'
                    })
                </script>
                @if (session('message'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Aviso publicado correctamente!',
                            timer: 10000,
                        })
                    </script>
                    <br>
                @endif

                @foreach ($images as $image)
                    @include('includes.image')
                @endforeach

                <br>
                <br>
                {{ $images->links() }}
            </div>
        </div>
    </div>
@endsection
