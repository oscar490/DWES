
<?php

/**
 * Crea una conexión a la base de datos y la devuelve.
 * @return PDO          La instacia de la clase PDO que representa la conexión.
 * @throws PDOException Si se produce algún error que impide la conexión.
 */
function conectar(): PDO
{
    try {
        return new PDO('pgsql:host=localhost;dbname=fa','fa','fa');
    } catch (PDOException $e) {
        ?>
        <h1>Error característico de base de datos: no se puede continuar</h1>
        <?php
        throw $e;
    }
}

/**
 * Busca una película a partir de su id.
 * @param  PDO      $pdo   La conexión a la base de datos.
 * @param  int      $id    El ID de la película.
 * @param  array    $error array de errores.
 * @return array           La fila que contiene los datos de la película.
 * @throws Exception       Si la película no existe.
 */
function buscarPelicula(PDO $pdo, int $id, array &$error): array
{
    $sent = $pdo->prepare("SELECT *
                             FROM peliculas
                            WHERE id = :id");

    $sent->execute([":id" => $id]);
    $fila = $sent->fetch();

    if (empty($fila)) {
        $error[] = 'La pelicula no existe';
        throw new Exception;
    }

    return $fila;
}

/**
 * Borra una película a partir de su id.
 * @param  PDO       $pdo   La conexión a la base de datos.
 * @param  int       $id    El ID de la película.
 * @param  array     $error array de errores
 * @throws Exception Si ha habido algún problema al borrar la película.
 */
function borrarPelicula(PDO $pdo, int $id, array &$error): void
{
    $sent = $pdo->prepare("DELETE FROM peliculas
                                  WHERE id = :id");
    $sent->execute([':id' => $id]);

    if ($sent->rowCount() !== 1) {
        $error[] = 'Ha ocurrido un error al eliminar la pelicula.';
        throw new Exception;
    }
}

/**
 * Comprueba si un parámetro es correcto.
 *
 * Un parámetro se considera correcto si ha superado los filtros de validación
 * de filter_input(). Si el parámetro no existe, entendemos que su valor
 * también es false, con lo cual sólo tenemos que comprobar si el valor no
 * es false.
 * @param  mixed     $param Parámetro a comprobar.
 * @param  array     $error array de errores.
 * @throws Exception        Si el parámetro no es correcto.
 */
function comprobarParametro($param, array &$error): void
{
    if ($param === false) {
        $error[] = 'Parámetro incorrecto';
        throw new Exception;
    }

}

/**
 * Muestra un enlace al la página principal index.php con el texto 'volver'.
 */
function volver(): void
{
    ?>
    <a href="index.php">Volver</a>
    <?php
}

/**
 * Muestra en pantalla los mensajes de error capturados hasta el
 * momento
 * @param array $error Mensajes capturado
 */
function mostrarErrores(array &$error): void
{
    foreach ($error as $v) {
        ?>
        <h3>Error: <?= h($v) ?></h3>
        <?php
    }
}

/**
 * Escapa una cadena como correctamente
 * @param  string $mensaje La cadena a escapar.
 * @return string          La cadena escapada.
 */
function h(?string $mensaje )
{
    return htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE);
}

function comprobarTitulo(string $titulo, array &$error): void
{
    if ($titulo === '') {
        $error[] = 'El título es obligatorio';
        return;
    }
    if (mb_strlen($titulo) > 255) {
        $error[] = 'El título es demasiado largo';
    }

}

function comprobarAnyo(string $anyo, array &$error): void
{
    if ($anyo === '') {
        return;
    }
    $filtro = filter_var($anyo, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 0,
            'max_range' => 9999,
        ],
    ]);

    if ($filtro === false) {
        $error[] = 'No es un año válido';
    }
}

function comprobarDuracion (string $duracion, array &$error)
{
    if ($duracion === '') {
        return;
    }
    $filtro = filter_var($duracion, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 0,
            'max_range' => 32767,
        ]
    ]);

    if ($filtro === false) {
        $error[] = 'No es una duración máxima';
    }
}

function comprobarGenero(PDO $pdo, $genero_id, array &$error): void
{
    if ($genero_id === '') {
        $error[] = 'El Género es obligatorio';
        return;
    }
    $filtro = filter_var($genero_id, FILTER_VALIDATE_INT);

    if ($filtro === false) {
        $error[] = 'El Género debe ser un ńumero.';
        return;
    }

    $sent = $pdo->prepare('SELECT COUNT(*)
                      FROM generos
                     WHERE id = :genero_id');
    $sent->execute([":genero_id"=> $genero_id]);

    if ($sent->fetchColumn() === 0) {
        $error[] = 'El Género no existe';
    }
}

/**
 * Comprueba si hay algún error almacenado en el array de errores. Si existe
 * alguno, se dispara una excepcion.
 * @param array $error Array de errores.
 */
function comprobarErrores(array $error): void
{
    if (!empty($error)) {
        throw new Exception;
    }
}

/**
 * Busca una película dado su título en un buscador.
 * @param  PDO    $pdo    Instancia de la conexión con la base de datos.
 * @param  string $titulo Título de la película
 * @return array          Array que representa las películas encontradas.
 */
function buscarPeliculaInicio($pdo, $titulo)
{
    $sent = $pdo->prepare('SELECT *
                            FROM peliculas
                            WHERE lower(titulo) LIKE lower(:titulo)');

    $sent->execute([':titulo' =>"%$titulo%"]);

    return $sent->fetchAll();
}

function insertar(PDO $pdo, array $valores) : void
{
        $cols = array_keys($valores);
        $vals = array_fill(0, count($valores), '?');
        $sql = 'INSERT INTO peliculas (' . implode(',', $cols) . ')'
                            . 'VALUES (' . implode(', ', $vals) . ')';
        $sent = $pdo->prepare($sql);
        $sent->execute(array_values($valores));



}

function modificar(PDO $pdo, int $id, array $valores): void
{
    $buenos = array_filter($valores);
    $malos = array_diff($valores, $buenos);
    $sets = [];
    foreach($buenos as $k => $v) {
        $sets[] = "$k = ?";
    }

    foreach($malos as $k => $v) {
        $sets[] = "$k = DEFAULT";
    }
    $set = implode(', ', $sets);

    $sql = "UPDATE peliculas
               SET $set
             WHERE id = ?";

    $exec = array_filter(array_values($valores));
    $exec[] = $id;
 }
