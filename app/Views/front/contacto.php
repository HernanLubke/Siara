<!-- Aquí va tu contenido principal -->
<div class="container mt-5">
    <div class="row">
        <!-- Mapa de ubicación -->
        <div class="col-md-6 mb-4">
            <h2>Ubicación</h2>
            <div id="map" style="width: 100%; height: 25rem; margin-bottom: 2rem;"></div>
        </div>

        <!-- Formulario de contacto -->
        <div class="col-md-6 mb-4">
            <h2>Formulario de Contacto</h2>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>





<script>
    // Función para inicializar el mapa
    function initMap() {
        // Coordenadas de la ubicación (sustituye con tus coordenadas)
        var ubicacion = { lat: -27.469590187381403, lng: -58.82278577309317 };
        // Crear mapa en el div "map"
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: ubicacion
        });
        // Marcador en la ubicación
        var marker = new google.maps.Marker({
            position: ubicacion,
            map: map
        });
    }
</script>
<!-- Enlace al API de Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCrcScPRaX1js0iaX9F-J1woVtatP2lw&callback=initMap" async defer></script>
</body>
</html>
