<?php
// Cargar el head
echo view('front/head');
?>

<body>

<?php
// Cargar el navbar
echo view('front/navbar2');
?>

<section class="contacto" id="contacto">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success text-center">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-sm-12 col-md-12 col-lg-6 parte-mapa">
                <h4 class="text-black">Contacta con nosotros de manera presencial</h4>
                <div id="map" style="width: 100%; height: 300px; border: 1px solid #ddd;"></div>
                <div class="contact-group mt-3">
                    <div class="address text-black">
                        <p>Roca 967, Corrientes Argentina.<br>
                        Titular: Lubke Hernán Rafael<br>
                        Siara Pet Shop.</p>
                    </div>
                    <div class="phone-email text-white d-flex flex-column">
                        <div class="phone mb-2">
                            <a href="https://wa.me/3794248565" target="_blank" class="btn btn-success btn-block">Whatsapp!</a>
                        </div>
                        <div class="email">
                            <a href="mailto:lubkehernan@gmail.com" class="btn btn-info btn-block">Mail!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 parte-formulario pt-5">
                <h3 class="text-black text-uppercase text-center">Dejanos tu mensaje y nos pondremos en contacto contigo
                    <?= $session->get('nombre'); ?>
                </h3>
                <div id="alert-div"></div>
                <form action="<?= base_url('consultaController/guardarConsulta'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="asunto" class="form-control" placeholder="Asunto" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-secondary btn-block">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Función para inicializar el mapa
    function initMap() {
        var ubicacion = { lat: -27.469590187381403, lng: -58.82278577309317 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: ubicacion
        });
        var marker = new google.maps.Marker({
            position: ubicacion,
            map: map
        });
    }
</script>

<!-- Enlace al API de Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCrcScPRaX1js0iaX9F-J1woVtatP2lw&callback=initMap" async defer></script>

<?php
// Cargar el footer
echo view('front/footer');
?>

</body>
</html>



