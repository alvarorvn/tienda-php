<?php
session_start();
require_once "../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

if (isset($_SESSION['usuario']) and $_SESSION['usuario'] == 'admin') {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Rastreo de IP</title>
        <?php require_once "menu.php"; ?>
    </head>

    <body>
        <div class="container">
            <h1>Rastreo de IP</h1>
            <div class="row">
                <div class="col-sm-12">
                    <input class="form-control input-sm" type="text" name="search_text" id="search_text" placeholder="Buscar...">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="tablaIpLoad"></div>
                </div>
            </div>
        </div>

    </body>

    </html>

    <script>
        $(document).ready(function() {
            $('#tablaIpLoad').load('historial/tablaIP.php');

            $('#search_text').keyup(function() {
                var txt = $(this).val();
                if (txt != '') {
                    $.ajax({
                        url: '../procesos/historial/buscarIP.php',
                        method: 'POST',
                        data: {
                            search: txt
                        },
                        dataType: 'text',
                        success: function(data) {
                            $('#tablaIpLoad').html(data);
                            if (data == 0) {
                                $('#tablaIpLoad').load('historial/tablaIP.php');
                            }
                        }
                    })
                } else {
                    $('#tablaIpLoad').load('historial/tablaIP.php');
                }
            })
        })
    </script>

    <script>
        function agregaDatosHistorial(log_id) {

            $.ajax({
                type: "POST",
                data: "log_id=" + log_id,
                url: "../procesos/historial/obtenDatosHistorial.php",
                success: function(r) {
                    dato = jQuery.parseJSON(r);

                    $('#log_accion').val(dato['log_accion']);
                    $('#log_fecha').val(dato['log_fecha']);
                    $('#log_hora').val(dato['log_hora']);
                    $('#log_id').val(dato['log_id']);
                    $('#log_descripcion').val(dato['log_descripcion']);
                    $("#usuariosHistorial").val(dato['usuario_id']).change();
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#usuariosHistorial').select2();
        });
    </script>

<?php
} else {
    header("location:../index.php");
}
?>