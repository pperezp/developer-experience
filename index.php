<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Experience</title>
        <!-- 
            https://www.cssscript.com/demo/minimal-notification-popup-pure-javascript/
            https://www.cssscript.com/minimal-notification-popup-pure-javascript/
         -->
        <link rel="stylesheet" href="css/notifications.css">
        <script src="js/notifications.js"></script>

        <!-- Bootstrap y jquery-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Bootstrap y jquery-->

        <script>
        /*Defino las constantes para ver si subio o no de nivel*/
        const MANTUVO_NIVEL  = 0;
        const SUBIO_NIVEL    = 1;
        const BAJO_NIVEL     = 2; 
        /*Defino las constantes para ver si subio o no de nivel*/

        $(document).ready(function(){
            $("#puntos").keyup(function(event){
                if(event.which == 13){ // si es enter
                    registrarPuntos();    
                }
            });

            $("#nombre").keyup(function(event){
                if(event.which == 13){ // si es enter
                    $("#puntos").focus();
                }
            });

            $("#top").keyup(function(event){
                if(event.which == 13){ // si es enter
                    if($("#top").val() != ""){ // si el top es distinto de vacío
                        /*Este if esta demás porque el html es number.*/ 
                        /*if($.isNumeric($("#top").val())){}*/
                        if($("#top").val() > 0){
                            loadTop();
                        }else{
                            limpiarTopDevelopers();
                        }
                    }else{
                        limpiarTopDevelopers();
                    }
                }
            });
        });

        function limpiarTopDevelopers(){
            $("#titulo_top").html("");
            $("#res").html("");
        }

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
                    $("#titulo_top").html("Top "+num+" developers");
                    $("#res").html(res);
                });
            }
        }

        /*Esta funcion se llama cuando presiono enter en los puntos de index*/
        function registrarPuntos(){
            var nombre = $("#nombre").val();
            var puntos = $("#puntos").val();

            $.ajax({
                type: 'POST',
                url: 'http://localhost/experience/controller/regPuntos.php',
                data: {
                    nombre: nombre,
                    puntos: puntos
                }
            }).done(function (estado_nivel) {
                $("#nombre").val("");
                $("#puntos").val("");
                $("#nombre").focus();
                loadTop();
                procesarNivel(nombre,estado_nivel);
            });
        }

        /*Esta función se llama cuando presiono los botones pre establecidos.*/ 
        function regPuntos(nombre, puntos){
            $.ajax({
                type: 'POST',
                url: 'http://localhost/experience/controller/regPuntos.php',
                data: {
                    nombre: nombre,
                    puntos: puntos
                }
            }).done(function (estado_nivel) {
                loadTop();
                procesarNivel(nombre,estado_nivel);
            });
        }

        function procesarNivel(nombre,res){
            res = res.split("/");
            
            estado_nivel    = parseInt(res[0]);
            puntos          = parseInt(res[1]);

            switch(estado_nivel){
                case MANTUVO_NIVEL:
                    console.log("Mantuvo el nivel");

                    if(puntos > 0){
                        reproducir("media/point_up.mp3");
                        /*https://www.cssscript.com/demo/minimal-notification-popup-pure-javascript/*/
                        window.createNotification({
                            closeOnClick: true,
                            displayCloseButton: false,
                            positionClass: 'nfc-top-right',
                            showDuration: 3500,
                            theme: 'info'
                        })({
                            title: "Subiendo puntos!",
                            message: nombre+" +"+puntos
                        });
                    }else{
                        reproducir("media/point_down.wav");
                        window.createNotification({
                            closeOnClick: true,
                            displayCloseButton: false,
                            positionClass: 'nfc-top-right',
                            showDuration: 3500,
                            theme: 'warning'
                        })({
                            title: "Bajando puntos!",
                            message: nombre+" -"+puntos
                        });
                    }

                    break;
                case SUBIO_NIVEL:
                    console.log("Subió el nivel");
                    reproducir("media/level_up.wav");

                    window.createNotification({
                        closeOnClick: true,
                        displayCloseButton: false,
                        positionClass: 'nfc-top-right',
                        showDuration: 5500,
                        theme: 'success'
                    })({
                        title: "Subió de nivel!",
                        message: "¡"+nombre+" ha subido de nivel!"
                    });
                    break;
                case BAJO_NIVEL:
                    console.log("Bajó el nivel");    
                    reproducir("media/level_down.ogg");
                    window.createNotification({
                        closeOnClick: true,
                        displayCloseButton: false,
                        positionClass: 'nfc-top-right',
                        showDuration: 5500,
                        theme: 'error'
                    })({
                        title: "Bajó de nivel!",
                        message: "¡"+nombre+" ha bajado de nivel!"
                    });
                    break;
            }
        }

        function reproducir(archivo){
            var audio = new Audio(archivo);
            audio.play();
        }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row p-3">
                <h1>Developer Experience</h1>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input class="form-control" list="nombres" id="nombre" placeholder="Nombre:" require>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="number"  id="puntos" placeholder="Puntos:" require>
                            </div>
                        </div>
                        
                        <!-- <input type="button" value="Asignar Puntos" onclick="regPuntos()"> -->

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
                </div>
            </div>
            
            <div class="row">
                <div class="col-3">
                    <input class="form-control form-group" type="number" id="top" name="top" placeholder="Top:" require>
                </div>
                <div class="col-3">
                    <button class="form-control btn btn-success" onclick="loadTop()">Top</button>
                </div>
                <div class="col-6">
                    <a class="form-control btn btn-info" href="crearAlumno.php">Crear alumno</a>
                </div>
            </div>
            
            <div class="p-4">
                <h3 id="titulo_top"></h3>
                <div id="res"></div>
            </div>
        </div>
    </body>
</html>