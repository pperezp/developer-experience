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
        <link rel="stylesheet" href="../css/notifications.css">
        <script src="../js/notifications.js"></script>

        <!-- Bootstrap y jquery-->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- Bootstrap y jquery-->

        <script>
        $(document).ready(function(){
            loadTop();
        });

        function loadTop(){
            $.ajax({
                type: 'POST',
                url: 'http://localhost/experience/view/listadoAlumnos.php',
                data: {
                    top: 200
                }
            }).done(function (res) {
                $("#titulo_top").html("Top developers");
                $("#res").html(res);
            });
        }

        </script>
    </head>
    <body>
        <div class="container">
            <div class="row p-3">
                <h1 class="col-6">Developer Experience</h1>
            </div>
            
            <div class="p-4">
                <h3 id="titulo_top"></h3>
                <div id="res"></div>
            </div>
        </div>
    </body>
</html>