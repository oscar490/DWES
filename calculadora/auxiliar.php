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
