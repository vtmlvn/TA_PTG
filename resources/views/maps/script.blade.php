<script>
    function initMap() {
        var circles=[], markerPin = [], globalLatlng;
        var options = {
            zoom : 14, 
            center:{lat:-6.59768, lng:106.799574}
        }
        var map = new
        google.maps.Map(document.getElementById('map'), options);

        
        //Listen for click on map
        google.maps.event.addListener(map, 'click', function(event) {
            console.log('f_in');
            // marker.setMap(null);
            deleteMarker();
            addMarker({coords:event.latLng});
            
        });

        function deleteMarker(){
            for (var i=0; i<markerPin.length; i++){
                markerPin[i].setMap(null);
                circles[i].setMap(null);
            }
            markerPin=[];
            circles=[]
        }
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

        function addMarker(props){
            var marker = new google.maps.Marker({
                position:props.coords,
                map:map,
                icon:props.icon,
            });

            markerPin.push(marker);
            if(props.content){
                var infoWindow = new google.maps.InfoWindow({
                content:props.content.nama,
            });
            marker.addListener('click', function(){
                infoWindow.open(map,marker);
            // console.log('f_in');
                error_log('This is some useful information.');
                });
            }
            circle = new google.maps.Circle({
                map: map,
                center: props.coords,
                radius: 3000,
                strokeColor: '#07A8BD',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#07A8BD',
                fillOpacity: 0.1,
                clickable: false
            });
            circles.push(circle);
        }

        function mapNul(){
        var banyak = S_marker.length;
        for (var i=0; i<banyak; i++){
            S_marker[i].setMap(null);
        }
        circle.setMap(null);
        markerPin.setMap(null);
        S_marker = [];
    }
        function getDistanceFromLatLonInKm(lat2,lon2) {
            var lat1 = globalLatlng.lat();
            var lon1 = globalLatlng.lng();
            var R = 6371; // Radius of the earth in km
            var dLat = deg2rad(lat2-lat1);  // deg2rad below
            var dLon = deg2rad(lon2-lon1); 
            var a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2)
                ; 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            var d = R * c; // Distance in km
            return d;
        }
        function deg2rad(deg) {
            return deg * (Math.PI/180)
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzilZ4qd_1RF8BgiprKGu-NOi05AkRDDw&callback=initMap"
async defer>
</script>