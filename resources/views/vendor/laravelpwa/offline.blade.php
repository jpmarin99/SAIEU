@extends('layouts.app')

@section('content')
    <script src="./js/push.min.js"></script>
    <head>
        <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
        </style>
    </head>
    <body>

    <h3>Mi ubicación en Google Maps!</h3>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
        function geoloc() {
            d=document.getElementById("demo");
            if (navigator.geolocation){
                d.innerHTML="<p>Tu dispositivo soporta la geolocalización.</p>";
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            }
            else {
                d.innerHTML="<p>Lo sentimos, tu dispositivo no admite la geolocaización.</p>";
            }
        }
        function showPosition(position){
            latitud=position.coords.latitude;
            longitud=position.coords.longitude;
            d.innerHTML+="<p>Latitud: "+latitud+"</p>";
            d.innerHTML+="<p>Longitud: "+longitud+"</p>";
            latlon=latitud+","+longitud;



            // The location of Uluru
            var chetumal = {lat:latitud , lng: longitud};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 18.75, center: chetumal});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: chetumal, map: map});
        }

        let chetumal;
        var mapOptions = {
            zoom: 18.75,
            center: chetumal,
            mapTypeId: 'satelite'
        };


        function showError(error){
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    d.innerHTML+="<p>El usuario ha denegado el permiso a la localización.</p>"
                    break;
                case error.POSITION_UNAVAILABLE:
                    d.innerHTML+="<p>La información de la localización no está disponible.</p>"
                    break;
                case error.TIMEOUT:
                    d.innerHTML+="<p>El tiempo de espera para buscar la localización ha expirado.</p>"
                    break;
                case error.UNKNOWN_ERROR:
                    d.innerHTML+="<p>Ha ocurrido un error desconocido.</p>"
                    break;
            }
        }
        var p = navigator.mediaDevices.getUserMedia({ audio: true, video: true });

        p.then(function(mediaStream) {
            var video = document.querySelector('video');
            video.src = window.URL.createObjectURL(mediaStream);
            video.onloadedmetadata = function(e) {
                // Do something with the video here.
            };
        });

        p.catch(function(err) { console.log(err.name); }); // always check for errors at the end.

        function notifyMe() {
            var permission = Notification.permission;
            // Comprobamos si el navegador soporta las notificaciones
            if (!("Notification" in window)) {
                console.log("Este navegador no es compatible con las notificaciones de escritorio");
            }

            // Comprobamos si los permisos han sido concedidos anteriormente
            else if (Notification.permission === "granted") {
                // Si es correcto, lanzamos una notificación
                var notification = new Notification("Hola!");
            }

            // Si no, pedimos permiso para la notificación
            else if (Notification.permission !== 'denied' || Notification.permission === "default") {
                Notification.requestPermission(function (permission) {
                    // Si el usuario nos lo concede, creamos la notificación
                    if (permission === "granted") {
                        var notification = new Notification("Hola!");
                    }
                });
            }

            // Por último, si el usuario ha denegado el permiso, y quieres ser respetuoso, no hay necesidad de molestarlo.
        }


    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5mjCwx1TRLuBAjwQw84WE6h5ErSe7Uj8&callback=showPosition">
    </script>
    <script>
        Toast.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No hay internet!'

        })

    </script>
    <script>
        const camara = new Camara( $('#player')[0] );




    </script>

    <div id="geo1">
        <button class="btn btn-primary" onclick="geoloc()">Ver geolocalización.</button><br/>
        <div id="demo"></div>
    </div>
    <!-- Botón de notificaciones -->
    <button class="oculto btn-noti-activadas">Notificaciones Activadas</button>
    <button class="oculto btn-noti-desactivadas">Notificaciones Desactivadas</button>
    <!-- Fin de boton de notificaciones -->
    <h1>No tiene conexion a internet intente de nuevo mas tarde.</h1>
    <img src="{{asset('images/png/SAIEU.png')}}" alt="" class="w-100 light-shape default-shape">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/libs/plugins/mdtoast.min.js"></script>
    </body>

@endsection

