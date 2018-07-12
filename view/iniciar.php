<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- 
            https://www.cssscript.com/demo/minimal-notification-popup-pure-javascript/
            https://www.cssscript.com/minimal-notification-popup-pure-javascript/
         -->
        <link rel="stylesheet" href="../css/notifications.css">
        <script src="../js/notifications.js"></script>

        <!-- Bootstrap y jquery-->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- Bootstrap y jquery-->
    </head>
    <body onload="$('#rut').focus()">
        
        <div class="container">
            <h1 class="p-2">Iniciar</h1>
            <form action="../controller/iniciarSesion.php" method="post" class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="password" name="rut" id="rut" placeholder="Rut:">
                    </div>
                    <?php
                    if(isset($_REQUEST["m"])){
                        $m = $_REQUEST["m"];

                        if($m == 1){
                            echo "<div class='form-control alert alert-danger col-md-6'>Rut no encontrado!</div>";
                        }else if($m == 2){
                            echo "<div class='form-control alert alert-warning col-md-6'>La sesión expiró</div>";
                        }
                    }
                    ?>
                </div>
                
            </form>
            
        </div>
    </body>
</html>