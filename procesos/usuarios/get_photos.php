<?php
$directory = dirname(__DIR__, 2) . "/faces";
$dirint = dir($directory);
$listImages = [];
while (($archivo = $dirint->read()) !== false) {
    if (preg_match('/.png/i', $archivo)) {
        //$obj = {'path': $directory . "/" . $archivo};
        array_push($listImages, array(
            "id" => explode("_", $archivo)[1],
            "name" => $archivo,
            "path" => $directory . "/" . $archivo
        ));
    }
}
//print_r($listImages);
echo json_encode($listImages);
$dirint->close();
