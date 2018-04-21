<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- Bootstrap y jquery-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Bootstrap y jquery-->

        <script>
        $(document).ready(function(){
            $("#nombre").keyup(function(event){
                if(event.which == 13){ // si es enter
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/experience/controller/crearAlumno.php',
                        data: {
                            nombre: $("#nombre").val()
                        }
                    }).done(function (res) {
                        $("#nombre").val("")
                        $("#nombre").focus();
                    });
                }
            });
        });
        </script><menu type="context"></menu>
    </head>
    <body>
        <div class="container">
            <div class="row p-3">
                <h1>Developer Experience</h1>
            </div>
            
            <div class="row form-group">
                <div class="col-6">
                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre alumno:">
                </div>
            </div>
            
            <div class="row">
                <div class="col-3">
                    <a class="form-control btn btn-info" href="experience.php">Volver</a>
                </div>
            </div>
        </div>
    </body>
</html>