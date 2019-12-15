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
        <title>usuarios</title>
        <?php require_once "menu.php"; ?>
    </head>

    <body>
        <div class="container">
            <h1>Historial de usuarios</h1>
            <div class="row">
                <div class="col-sm-12">
                    <input class="form-control input-sm" type="text" name="search_text" id="search_text" placeholder="Buscar...">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="tablaHistorialLoad"></div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <script>
        $(document).ready(function() {
            $('#tablaHistorialLoad').load('historial/tablaHistorial.php');

            $('#search_text').keyup(function() {
                var txt = $(this).val();
                if (txt != '') {
                    $.ajax({
                        url: '../procesos/historial/buscarHistorial.php',
                        method: 'POST',
                        data: {
                            search: txt
                        },
                        dataType: 'text',
                        success: function(data) {
                            $('#tablaHistorialLoad').html(data);
                            if(data == 0) {
                                $('#tablaHistorialLoad').load('historial/tablaHistorial.php');
                            }
                        }
                    })
                } else {
                    $('#tablaHistorialLoad').load('historial/tablaHistorial.php');
                }
            })
        })
    </script>

<?php
} else {
    header("location:../index.php");
}
?>