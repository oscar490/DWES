<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $op1 = $op2 = $op  = null;
    extract($_GET, EXTR_IF_EXISTS);
    define('OPERACIONES', ['+', '-', '/', '*']);
    $error = [];
    require 'auxiliar.php';
    try {
        compruebaParametros($op1, $op2, $op, $error);
        compruebaOperador($op, OPERACIONES, $error);
        compruebaOperandos($op1, $op2, $error);
        compruebaError($error);
        $op1 = eval("return $op1 $op $op2 ;");
    } catch (Exception $e) {
        mostrarErrores($error);
    }


      ?>

      <form action="calculadora.php" method="get">

        <label for="op1">Primer operando</label>
        <input type="text" name="op1" id="op1" value="<?= $op1 ?>"><br>

        <label for="op2">Segundo operando</label>
        <input type="text" name="op2" id="op2" value="<?= $op2 ?>"><br>


        <select name="op">

          <option value="+" <?= selected("+", $op) ?> >Suma</option>
          <option value="-" <?= selected("-", $op) ?> >Resta</option>
          <option value="*" <?= selected("*", $op) ?> >Multiplicar</option>
          <option value="/" <?= selected("/", $op) ?> >Dividir</option>
        </select>

        <input type="submit" value="Calcular">

      </form>

  </body>
</html>
