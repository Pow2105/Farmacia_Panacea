<?php
require_once("../db.php");

$resultado = $conn->query("SELECT nombre, stock_actual FROM productos WHERE stock_actual <= 10");

while ($fila = $resultado->fetch_assoc()) {
  echo "<div class='bg-yellow-100 text-yellow-800 px-4 py-2 rounded mb-2 border border-yellow-300'>
          ⚠ El producto <strong>{$fila['nombre']}</strong> está por agotarse. Stock actual: <strong>{$fila['stock_actual']}</strong>
        </div>";
}
?>
