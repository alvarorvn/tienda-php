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

        <!-- Modal -->
        <div class="modal fade" id="actualizaHistorialModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualiza Historial</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmActualizaHistorial">
                            <input type="text" hidden="" id="log_id" name="log_id">
                            <label>Seleciona Cliente</label>
                            <br>
                            <select class="form-control input-sm" id="usuariosHistorial" name="usuariosHistorial" style="width: 250px">
                                <option value="A">Selecciona</option>
                                <?php
                                $sql = "SELECT id_usuario, email from usuarios";
                                $result = mysqli_query($conexion, $sql);
                                while ($usuario = mysqli_fetch_row($result)) :
                                ?>
                                    <option value="<?php echo $usuario[0] ?>"><?php echo $usuario[1] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <br>
                            <label>Acción</label>
                            <input type="text" class="form-control input-sm" name="log_accion" id="log_accion">
                            <label>Descripción</label>
                            <input type="text" class="form-control input-sm" name="log_descripcion" id="log_descripcion">
                            <label>Fecha</label>
                            <input type="text" class="form-control input-sm" name="log_fecha" id="log_fecha">
                            <label>Hora</label>
                            <input type="text" class="form-control input-sm" name="log_hora" id="log_hora">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizaHistorial" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Historial</button>
                    </div>
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
                            if (data == 0) {
                                $('#tablaHistorialLoad').load('historial/tablaHistorial.php');
                            }
                        }
                    })
                } else {
                    $('#tablaHistorialLoad').load('historial/tablaHistorial.php');
                }
            })

            $('#btnActualizaHistorial').click(function() {

                datos = $('#frmActualizaHistorial').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/historial/actualizaHistorial.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#tablaHistorialLoad').load('historial/tablaHistorial.php');
                            alertify.success("Historial actualizado");
                        } else {
                            alertify.error("Error al actualizar historial");
                        }
                    }
                });
            });
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