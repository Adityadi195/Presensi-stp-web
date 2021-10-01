<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Presensi PT. Sugih Teknik Perkasa</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' /> --}}
</head>

<body class="hold-transition login-page">
    @yield('content')
    {{-- {{ isset($slot) ? $slot : null }} --}}

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script> --}}
    @stack('scripts')

    {{-- <script>
        mapboxgl.accessToken =
            'pk.eyJ1IjoiZmF0YWtodWxhZmkiLCJhIjoiY2tiZ2hwdnZhMHhoeTJ4bnlsYzNwZnVlMiJ9.MkJvbmyoVfcbgjO9yzcuoA';
        var map = new mapboxgl.Map({
            container: 'mapLokasiTempat', // container ID
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [112.1833003, -7.541166], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });
        map.addControl(new mapboxgl.NavigationControl());

        map.on('click', addMarker);

        var currentMarkers = [];
        if (latTempatEdit != '' && longTempatEdit != '') {
            new mapboxgl.Marker({
                    color: 'red'
                })
                .setLngLat([longTempatEdit, latTempatEdit])
                .addTo(map);
        }

        function addMarker(e) {
            var marker = new mapboxgl.Marker({
                    color: 'green'
                })
                .setLngLat([e.lngLat.lng, e.lngLat.lat])
                .addTo(map);

            if (currentMarkers.length >= 1) {
                currentMarkers[0].remove();
                currentMarkers[currentMarkers.length - 1].remove();
            }
            currentMarkers.push(marker);
            document.querySelector(".lat_tempat").value = e.lngLat.lat;
            document.querySelector(".long_tempat").value = e.lngLat.lng;

        }
    </script> --}}
</body>

</html>
