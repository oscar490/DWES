<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de Peliculas</title>
        <style type="text/css">
            #buscar {
                margin-bottom: 12px;
            }

            #tabla {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        $titulo = trim(filter_input(INPUT_GET, 'titulo')) ?? '';
        ?>
        <div id="buscar">
          <fieldset>
              <legend>Buscar</legend>
            <form action="index.php" method="get">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo"
                    value="<?= $titulo ?>"/>
                <input type="submit" name="" value="Buscar" />
            </form>
          </fieldset>
        </div>


        <?php
        require 'auxiliar.php';

        $pdo = conectar();
        $sent = $pdo->prepare('SELECT *
                                FROM peliculas
                                WHERE lower(titulo) LIKE lower(:titulo)');

        $sent->execute([':titulo' =>"%$titulo%"]);
        ?>
        <div class="">
            <table border="1" id="tabla">
                <thead>

                    <th>Título</th>
                    <th>Año</th>
                    <th>Sinopsis</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th>Operaciones</th>
                </thead>
                    <?php foreach($sent as $fila): ?>
                        <tr>

                            <td><?= $fila['titulo']?></td>
                            <td><?= $fila['anyo']?></td>
                            <td><?= $fila['sinopsis']?></td>
                            <td><?= $fila['duracion']?></td>
                            <td><?= $fila['genero_id']?></td>
                            <td>
                                <a href="borrar.php?id=<?= $fila['id']?>">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <tbody>

                </tbody>
            </table>
        </div>


    </body>
</html>
