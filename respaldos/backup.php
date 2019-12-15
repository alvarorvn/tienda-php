<?php


$db_host = 'localhost';
$db_name = 'tienda';
$db_user = 'root';
$db_password = '';

$fecha = date('Ymd-His');

$salida_sql = $db_name . '_' . $fecha . '.sql';

$dump = dirname(__DIR__, 3) . "\mysql\bin\mysqldump.exe --user=" . $db_user . " --password=" . $db_password .
    " --host=" . $db_host . " " . $db_name . " > " . $salida_sql;

exec($dump);
