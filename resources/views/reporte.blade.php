<html>
<head>
<meta http-equiv="Content-Type" content="php/html; charset=utf-8"/>
<title>TABLA DE ANUNCIOS</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    @page {
        margin: 0cm 0cm;
        font-size: 1em;
    }

    body {
        margin: 3cm 2cm 2cm;
    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 30px;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 35px;
    }
</style>
</head>
<body>
<header>
    <img src="./images/l8/png/baner_UT-230_blanco.png" alt="">
</header>
<main>
    <div class="container">
        <h5 style="text-align: center"><strong>Ultimos avisos publicados</strong></h5>
        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descripción</th>
                <th scope="col">Grupo</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
    <!-- Obtener todos los avisos de la bd -->
    @foreach ($images as $image)
        <tr>
        <th scope="row" >{{ $image->id_image }}</th>

        <td>{{ $image->description }}</td>

        <td>{{ $image->grupo }}</td>

        <td>{{$image->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
</main>
<footer>
    <p><strong>Elaborado por {{ Auth::user()->name }} el {{$now->format('d-m-Y H:i:s')}}</strong></p>
</footer>
</body>
</html>
