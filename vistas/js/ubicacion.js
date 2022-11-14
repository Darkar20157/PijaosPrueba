function ubicame(){
    if(!"geolocation" in navigator){
        alert("error");
    }else{
        let ubicacion = navigator.geolocation.getCurrentPosition(
            success =>{
                let coordenadas = success.coords;
                document.getElementById("myGPS").innerText = "Mi ubicacion: "+
                coordenadas.latitude+" "+coordenadas.longitude;
                let div = document.getElementById("map");
                let map = new google.maps.Map(div, {
                    center: { lat: coordenadas.latitude , lng: coordenadas.longitude },
                    zoom: 15
                });
                /*=====================================================================
                                                MARCADORES
                =======================================================================*/
                
                let marker = new google.maps.Marker({
                    position:{ lat: coordenadas.latitude , lng: coordenadas.longitude },
                    map: map,
                    icon: {
                        path: "M16,2C9.53,2,4.28,7.25,4.28,13.72c0,12.19,11.25,16.17,11.36,16.22C15.76,29.98,15.87,30,16,30c0.12,0,0.24-0.02,0.35-0.06  c0.12-0.04,11.37-4.02,11.37-16.22C27.72,7.25,22.46,2,16,2z M16,19.87c-3.43,0-6.21-2.79-6.21-6.2c0-3.43,2.79-6.21,6.21-6.21  c3.42,0,6.2,2.79,6.2,6.21C22.2,17.08,19.42,19.87,16,19.87z",
                        fillColor: "red",
                        fillOpacity: 1,
                        strokeWeight: 0,
                        rotation: 0,
                        scale: 1,
                        anchor: new google.maps.Point(5, 10),
                    },
                    title: "¡Estoy aqui!"
                })
                let arrayMaps = {
                    "activo": 0
                }
                $.ajax({
                    type: "POST",
                    url: "/puntosganagana/ajax/pdv.php",
                    data: arrayMaps,
                    success: function(response){
                        let coordenadasPDV = JSON.parse(response);
                        console.log(coordenadasPDV);
                        for (let i = 0; i < coordenadasPDV.length; i++) {
                            let coordenadasX = coordenadasPDV[i].CX;
                            let coordenadasY = coordenadasPDV[i].CY;
                            crearMarcador(coordenadasX, coordenadasY, map);
                            i = i + 1;
                        }
                    }
                })
            },
            error =>{
                alert(Object.values(error.message));
            },
            options =>{
                enableHighAccuracy: true
                maximumAge: 0
                timeout: 10000
            }
        );
        
    }
}
function crearMarcador(coordenadasX, coordenadasY, map){
    let marker = new google.maps.Marker({
        position: { lat: parseFloat(coordenadasX) , lng: parseFloat(coordenadasY) },
        map: map,
        icon: {
            path: "M16,2C9.53,2,4.28,7.25,4.28,13.72c0,12.19,11.25,16.17,11.36,16.22C15.76,29.98,15.87,30,16,30c0.12,0,0.24-0.02,0.35-0.06  c0.12-0.04,11.37-4.02,11.37-16.22C27.72,7.25,22.46,2,16,2z M16,19.87c-3.43,0-6.21-2.79-6.21-6.2c0-3.43,2.79-6.21,6.21-6.21 c3.42,0,6.2,2.79,6.2,6.21C22.2,17.08,19.42,19.87,16,19.87z",
            fillColor: "yellow",
            fillOpacity: 1,
            strokeWeight: 0,
            rotation: 0,
            scale: 0.5,
            anchor: new google.maps.Point(2, 5),
        },
        title: "¡Estoy aqui!"
    })
}
