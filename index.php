<?php
    $header_extra = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBhRXyrySdaevwUwTC4Vm_wugu8f917dQU&sensor=true">
        </script>';
    include("_header.php")
?>
    $footer_extra = '
    <script type="text/json" src="exemplo.json"></script>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/geoPosition.js"></script>
    <script src="js/map.js"></script>';
    include("_footer.php")
?>