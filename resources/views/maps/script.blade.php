<script>
    function initMap() {
        var options = {
            zoom : 14, 
            center:{lat:-6.59768, lng:106.799574}
        }
        var map = new
        google.maps.Map(document.getElementById('map'), options);

        
        //Listen for click on map
        google.maps.event.addListener(map, 'click', 
        function(event){
            //Marker
            addMarker({coords:event.latLng});
        });

        var S_marker=[];
        var i=0;

        @foreach($sekolahan as $data)
            var x = {{$data->x}};
            var y = {{$data->y}};
            // var namaS = "{{$data->nama_sekolah}}";
            S_marker[i] = new google.maps.Marker({
                position:{lat:x,lng:y},
                map:map,
                icon:"http://maps.google.com/mapfiles/kml/pal2/icon2.png",
            });
            var infoWindow = new google.maps.InfoWindow({
                content:"{{$data->nama_sekolah}}",
            });
            addLIW(S_marker[i], infoWindow);
            i++;
        @endforeach

            function addLIW(mark, info){
                mark.addListener('click', function(){
                    info.open(map,mark);
                });
            }
        addMarker({
            coords:{lat:-6.59768, lng:106.799574},
            content:{
                nama: '<h1>Kebun Raya Bogor</h1>'
                },
            
            });

        // function schoolMarker(){
        //     for (var i=0; i<myLatlng.lenght; i++){
        //         marker[i] = new google.maps.Marker({
        //         position: myLatlng[i],
        //         map: map,
        //         // title: myS[i]
        //     });
        //     }
        // };
        
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzilZ4qd_1RF8BgiprKGu-NOi05AkRDDw&callback=initMap"
async defer>
</script>