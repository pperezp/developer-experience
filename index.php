<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Experience</title>
        <script src="js/jquery.min.js"></script>

        <script>
        function loadTop(){
            var num = $("#top").val();

            if(num != ""){
                num = parseInt(num);
                
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/experience/view/cargarNiveles.php',
                    data: {
                        top: num
                    }
                }).done(function (res) {
                    $("#res").html(res);
                });
            }
        }

        function regPuntos(){
            var nombre = $("#nombre").val();
            var puntos = $("#puntos").val();

            $.ajax({
                type: 'POST',
                url: 'http://localhost/experience/controller/regPuntos.php',
                data: {
                    nombre: nombre,
                    puntos: puntos
                }
            }).done(function (res) {
                $("#nombre").val("");
                $("#puntos").val("");
                $("#nombre").focus();
                loadTop();
            });
        }
        </script>
    </head>
    <body>
        <h1>Developer Experience</h1>
        <form>
            <input list="nombres" id="nombre" placeholder="Nombre:" require>
            <input type="number" id="puntos" placeholder="Puntos:" require>
            <input type="button" value="Asignar Puntos" onclick="regPuntos()">

            <datalist id="nombres">
            <?php
                require_once("model/Data.php");

                $d = new Data();

                foreach($d->getAlumnos() as $a){
                    echo "<option value='".$a->getNombre()."'>";
                }
            ?>
            </datalist>
        </form>

        <a href="crearAlumno.php">Crear alumno</a>
        <input type="number" id="top" name="top" placeholder="Top:" require>
        <button onclick="loadTop()">Top</button>

        <div id="res"></div>
    </body>
</html>