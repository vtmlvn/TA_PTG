<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sekolah Bogor</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #map{
                position:relative;
                top:5%;
                height:90%;
                width:100%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div id="map"></div>            
        </div>
        <script>
        function initMap() {
            var options = {
                zoom : 16, 
                center:{lat:-6.59768, lng:106.799574}
            }
            var map = new
            google.maps.Map(document.getElementById('map'), options);

            // var marker = new google.maps.Marker({
            //     position:{lat:-6.5971, lng:106.8060},
            //     map:map,

            // });

            //var infoWindow = new google.maps.InfoWindow({
            //     content:'<h1>Bogor</h1>'
            // });

            // marker.addListener('click', function(){
            //     infoWindow.open(map,marker);
            // });

            //Listen for click on map
            google.maps.event.addListener(map, 'click', 
            function(event){
                //Marker
                addMarker({coords:event.latLng});
            });

            // addMarker({
            //     coords:{lat:-6.59768, lng:106.799574},
            //     content:{
            //         nama: '<h1>Kebun Raya Bogor</h1>'
            //         },
                
            //     });
            
            function addMarker(props){
                var marker = new google.maps.Marker({
                    position:props.coords,
                    map:map,
                });
                if(props.content){
                    var infoWindow = new google.maps.InfoWindow({
                    content:props.content.nama,
                });
                marker.addListener('click', function(){
                    infoWindow.open(map,marker);
                });

                }
            }
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4N3qMrudto-MtdxZPmkd_O9EspD2A_PQ&callback=initMap"
        async defer>
        </script>
    </body>
</html>