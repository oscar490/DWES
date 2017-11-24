<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
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
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <form action="login.php" method="post">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Usuario *</label>
                        <input type="text" class="form-control"
                        id="usuario" aria-describedby="emailHelp"
                        name="usuario"
                        value="<?= h($usuario)?>"
                        placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Check me out
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
          </div>
      </div>
    </body>
</html>
