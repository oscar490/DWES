<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        $usuario = trim(filter_input(INPUT_POST, 'usuario'));
        $password = trim(filter_input(INPUT_POST, 'password'));


        if (!empty($_POST)) {
            $error = [];

            try {
                comprobarUsuario($usuario, $error);
                comprobarPassword($password, $error);
                comprobarErrores($error);
                $fila = buscarUsuario($usuario, $password, $error);
                $_SESSION['usuario'] = [
                    'id'=>$fila['id'],
                    'nombre'=>$fila['nombre'],
                ];

                header('Location: index.php');
            } catch (Exception $e) {
                mostrarErrores($error);
            }
        }

        ?>
        <form action="login.php" method="post">

          <label for="usuario">Usuario *</label>
          <input type="text" name='usuario' id="usuario" value="<?= h($usuario)?>" placeholder="Nombre de usuario">
          <br><br>

          <label for="exampleInputPassword1">Password</label>
          <input type="password" name='password' id='password' placeholder="Password"><br><br>

          <button type="submit" class="btn btn-primary">Login</button>
        </form>



    </body>
</html>
