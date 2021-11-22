@extends('layouts.app')

@section('content')
    <script>
    Toast.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No hay internet!'

    })
    // Detectar cambios de conexión
    //Online() {
    //
    //vigator.onLine ) {
    //tenemos conexión
    //console.log('online');
    //dtoast('Online', {
    // interaction: true,
    // interactionTimeout: 1000,
    // actionText: 'OK!'
    //
    //
    //
    //
    //No tenemos conexión
    //dtoast('Offline', {
    // interaction: true,
    // actionText: 'OK',
    // type: 'warning'
    //
    //
    //
    //
    //
    //ventListener('online', isOnline );
    //ventListener('offline', isOnline );
    //
    //
    </script>
    <h1>No tiene conexion a internet intente de nuevo mas tarde.</h1>
    <img src="images/png/SAIEU.png" alt="" class="w-100 light-shape default-shape">
@endsection
