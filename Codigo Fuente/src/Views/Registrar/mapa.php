<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Uso de Google Maps</title>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAiq3xISXSZYgkd9GDAOdajy4NK2d3L7dY"></script>
    <script>
        function loadMap() {

            var mapOptions = {
                center:new google.maps.LatLng(-34.6686986,-58.5614947),
                zoom:12,
                panControl: false,
                zoomControl: false,
                scaleControl: false,
                mapTypeControl:false,
                streetViewControl:true,
                overviewMapControl:true,
                rotateControl:true,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(-34.6686986,-58.5614947),
                map: map,
                draggable:true,
             
            });
               var info = new google.maps.InfoWindow({
                content:"ubicacion del producto"
            });

            info.open(map,marker);

            google.maps.event.addListener(marker, "click", function (event) {
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();
                alert( latitude + ', ' + longitude );
            });

        }
    </script>
</head>
<body onload="loadMap()">
<br/>
<br/>

<ul>
    <li>Ejemplo nro 11. Capturar la latitud y la longitud de un marcador.</li>

</ul>
<div id="mapa" style="width:500px; height:400px;"></div>
<br/>
<b>Pasos</b><br/>
<ul>
    <li></li>
</ul>
<img src="imagenes/ejemplo11.png">
<br/>
<br/>
<a href="index12.html">Siguiente </a>
<br/>





</body>
</html>