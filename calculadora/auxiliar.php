<?php

/**
 * Realiza una operación aritmética.
 * @param  float $op1 El primer operando
 * @param  float $op2 El segundo operando
 * @param  string $op  Representa el operador
 * @return float      Devuelve el número resultante de la operación.
 */
function calcula(float $op1, float $op2, string $op): float
{
  switch ($op) {
    case '+':
      $resultado = $op1 + $op2;
      break;

    case '-':
      $resultado = $op1 - $op2;
      break;

    case '*':
      $resultado = $op1 * $op2;
      break;

    case '/':
      $resultado = $op1 / $op2;
      break;

  }

  return $resultado;
}

function selected(string $v, ?string $o): string
{

    return $v == $o ? 'selected': '';
}


function compruebaParametros($op1, $op2, $op, array &$error): void
{

    if (isset($op1, $op2, $op)){
        return;
    }
    if ($op1 !== null || $op2 !== null || $op !== null){
        $error[] = 'Falta algún parámetro';
    }

    throw new Exception;

}

function compruebaOperador($op, array $lista, array &$error): void
{
    if (!in_array($op, $lista)) {
        $error[] = 'Operación no valida';
    }
}

function compruebaOperandos($op1, $op2, array &$error): void
{
    if (filter_var($op1, FILTER_VALIDATE_FLOAT) === false ||
        filter_var($op2, FILTER_VALIDATE_FLOAT) === false) {
    //      if (!is_numeric($op1) || !is_numeric($op2)) {
        $error[] = 'Los dos operandos deben ser numéricos';
    } elseif ($op1 < 0 || $op2 < 0) {
        $error[] = 'Los dos operandos deben ser positivos';
    }
}


function compruebaError(array $error): void
{
    if (!empty($error)) {
        throw new Exception;
    }
}




function mostrarErrores($error)
{
    foreach ($error as $e) {
    ?>
        <h3>Error: <?= $e ?>.</h3>
    <?php
    }
}

function mostrarOpciones(array $lista, $op)
{
    foreach ($lista as $v) {
      ?>
      <option value="<?= $v ?>" <?= selected("<?= $v ?>", $op) ?>><?= $v ?></option>
      <?php
    }
}


function dibujarFormulario($op1, $op2, $op, $lista): void
{
    ?>
        <form action="calculadora.php" method="get">
          <label for="op1">Primer operando</label>
          <input type="text" name="op1" id="op1" value="<?= htmlentities($op1) ?>"><br>
          <label for="op2">Segundo operando</label>
          <input type="text" name="op2" id="op2" value="<?= htmlentities($op2) ?>"><br>
          <select name="op">
            <?php mostrarOpciones($lista, $op) ?>
          </select>
          <input type="submit" value="Calcular">
        </form>
    <?php
}
