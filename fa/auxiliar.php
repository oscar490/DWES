
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
function buscarPelicula(PDO $pdo, int $id, array & $error): array
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
    <a href="index.php">Volvel</a>
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
        <h3>Error: <?= h($error) ?></h3>
        <?php
    }
}

/**
 * Espaca una cadena como correctamente
 * @param  string $mensaje La cadena a escapar.
 * @return string          La cadena escapada.
 */
function h(string $mensaje )
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

    $pdo = conectar();

}

function comprobarAnyo(string $anyo, array & $error): void
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

function comprobarduracion (string $duracion, array & $error)
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

function comprobarErrores(array $error): void
{
    if (!empty($error)) {
        throw new Exception;
    }
}
