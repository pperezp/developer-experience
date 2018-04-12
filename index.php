<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Experience</title>
        <script src="js/jquery.min.js"></script>

        <script>
        function getTop(){
            var num = $("#top").val();
            num = parseInt(num);
            console.log(num);
            
            $.ajax({
                type: 'POST',
                url: 'http://localhost/experience/view/getTablaNiveles.php',
                data: {
                    top: num
                }
            }).done(function (res) {
                $("#res").html(res);
            });
        }
        </script>
    </head>
    <body>
        <h1>Experience developer</h1>
        <form action="controller/regPuntos.php" method="post">
            <input list="nombres" name="nombre" placeholder="Nombre:" require>
            <input type="number" name="puntos" placeholder="Puntos:" require>
            <input type="submit" value="Asignar Puntos">

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
        <button onclick="getTop()">Click</button>

        <div id="res"></div>
    </body>
</html>