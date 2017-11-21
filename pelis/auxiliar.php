<?php

function mostrarErrores(Exception $e)
{
  ?>
  <h1><?= $e->getMessage() ?> </h1>

  <?php
}

function conectar()
{
  return new PDO('pgsql:host=localhost;dbname=pelis', 'pelis', 'pelis');
}

function comprobarParametro($parametro): void
{
    if (is_null($parametro)){
      throw new Exception("Parámetro incorrecto");
    }
}

function comprobarPelicula(string $titulo, PDO $pdo): array
{
    $sent = $pdo->prepare('SELECT *
                             FROM peliculas
                             WHERE titulo = :titulo');

    $sent->execute(["titulo"=>$titulo]);


    if ($sent->rowCount() == 0) {
      throw new  Exception('No existe la película indicada');
    }

    return $sent->fetchAll();

}

function buscarPelicula(string $titulo, PDO $pdo)
{
    $sent = $pdo->prepare('SELECT p.id, titulo, anyo, duracion, sinopsis,
                                  g.nombre
                            FROM peliculas p
                            JOIN generos g
                              ON p.genero_id = g.id
                           WHERE lower(titulo) LIKE lower(:titulo)');

    $sent->execute([":titulo" => "%$titulo%"]);


    return $sent->fetchAll();
}

function borrarPelicula($titulo, $pdo): void
{
    $sent = $pdo->prepare("DELETE FROM peliculas
                                 WHERE titulo = :titulo");

    $sent->execute(["titulo" => $titulo]);

    if ($sent->rowCount() == 0) {
        throw new Exception("Ha ocurrido un error al eliminar la película");
    }
}

function getInformacion($titulo, $pdo)
{
    $sent = $pdo->prepare('SELECT titulo, anyo, argumento, g.nombre as genero
                           FROM (peliculas p JOIN peliculas_generos pg
                            ON p.id = pg.pelicula_id) c JOIN generos g
                            ON c.genero_id = g.id
                            WHERE titulo = :titulo');
    $sent->execute(["titulo" => $titulo]);

    return $sent-> fetchAll();

}

function mostrarInformacion(array $fila)
{


      foreach ($fila as $valor) {
        ?>
        <h1 align="center"><?= $titulo = $valor['titulo'] ?></h1>
        <h2>Año: <?= $valor['anyo'] ?></h2>
        <h2>Argumento: <?= $valor['argumento'] ?></h2>
        <h2>Género</h2>
        <ul>
        <?php
        break;
      }

      foreach ($fila as $valor) {

        ?>
        <li><h3><?= $valor['genero'] ?></h3></li>
        <?php
      }
      ?>
    </ul>
    <?php
    volver();

}

function h($salida): string
{

    return htmlspecialchars($salida);

}

function volver()
{
   ?>
   <a href="pelis.php">Volver</a>
   <?php
}
