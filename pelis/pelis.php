<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Videoclub</title>
    </head>
    <body>
      <?php

      require 'auxiliar.php';

      try {
        $titulo = filter_input(INPUT_GET, 'titulo') ?? '';
        $pdo = conectar();


        $sent = buscarPelicula($titulo, $pdo);
        
      } catch (Exception $e) {
        mostrarErrores($e);
      }


      ?>
      <form action="pelis.php" method="get">
        <div >
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo"
            value="<?= $titulo ?>">
        </div><br>

        <div >
            <input type="submit" value="Consultar">
        </div>
      </form>

      <table border='1' align='center'>
        <thead>
          <th>Título</th>
          <th>Año</th>
          <th>Duración</th>
          <th>Sinopsis</th>
          <th>Género</th>
          <th>Operaciones</th>
        </thead>
        <tbody>
          <?php foreach ($sent as $fila): ?>
            <tr>
              <td><?= h($fila['titulo'])?></td>
              <td><?= h($fila['anyo'])?></td>
              <td><?= h($fila['duracion'])?></td>
              <td><?= h($fila['sinopsis'])?></td>
              <td><?= h($fila['nombre'])?></td>
              <td><a href="borrado.php?titulo=<?= h($fila['titulo']) ?>">Borrar</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


    </body>
</html>
