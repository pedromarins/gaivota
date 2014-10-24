<?php
    $header_extra = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBhRXyrySdaevwUwTC4Vm_wugu8f917dQU&sensor=true">
        </script>';
    include("_header.php")
?>

    <main>
        <div id="map_canvas">
            <p class="loading">Carregando mapa</p>
        </div>

    </main>
    <div class="helper">
        <p class="helper-title">legenda</p>
        <ul class="helper-content">
            <li>
                <p>boia</p>
            </li>
            <li>
                <p>fixa</p>
            </li>
            <li>
                <p>móvel</p>
            </li>
        </ul>
    </div>

<?php
    $footer_extra = '
    <script type="text/json" src="exemplo.json"></script>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/geoPosition.js"></script>
    <script src="js/map.js"></script>';
    include("_footer.php")
?>