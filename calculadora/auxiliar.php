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
    if (!is_numeric($op1) || !is_numeric($op2)) {
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
