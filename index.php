<?php
    $header_extra = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhRXyrySdaevwUwTC4Vm_wugu8f917dQU&sensor=true">
        </script>';
    include("_header.php")
?>

    <div id="map_canvas">
        <p class="loading">Carregando mapa</p>
    </div>

    <div class="helper">
        <p class="helper-title">legenda</p>
        <ul class="helper-content">
            <li>
                <p><img src="img/marker-floater.png" alt="">estação flutuante</p>
            </li>
            <li>
                <p><img src="img/marker-portable.png" alt="">estação fixo</p>
            </li>
            <li>
                <p><img src="img/marker-settled.png" alt="">estação portátil</p>
            </li>
        </ul>
    </div>

<?php
    $footer_extra = '
    <script src="js/geoPosition.js"></script>
    <script src="js/map.js"></script>';
    include("_footer.php")
?>