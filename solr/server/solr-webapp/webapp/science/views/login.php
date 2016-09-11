<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academy Recommend | Log in</title>
    <?php
    session_start();
    include('../include/css_assets.php');
    include ('../include/config.php');
    include ('../include/functions.php');

    if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['sess_ID'])) {
        //Header('Location: main.php');
        header('Location: main.php');
    }


    ?>
</head>
<body>
<div class="container margin-top-large">
    <h1 class="academic-title text-center margin-bottom-large">
        Vincci Academy
    </h1>
    <div class="container-login margin-top-large">
        <h4 class="text-center">Iniciar Sesión</h4>

        <div class="form-group">
            <form action="../aux/log_in.php" method="post">
                <div class="inner-addon left-addon input-login margin-bottom-small ">
                <i class="glyphicon glyphicon-user"></i>
                <input type="text" name = "email" class="form-control full-width" placeholder="Dirección de E-mail" />
                </div>
                <div class="inner-addon left-addon margin-bottom-small input-login">
                    <i class="glyphicon glyphicon-lock"></i>
                    <input type="password" class="form-control full-width" name="password" placeholder="Contraseña" />
                </div>
                <div class="input-login margin-bottom-medium">
                    <input type="submit" name="init_session" class=" full-width btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>