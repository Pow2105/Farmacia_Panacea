<?php
require_once("../db.php");
$resultado = $conn->query("SELECT v.id_venta, v.fecha_venta, v.hora_venta, c.nombre AS cliente, e.nombre AS empleado, v.total_venta, v.tipo_pago FROM ventas v JOIN clientes c ON v.id_cliente = c.id_cliente JOIN empleados e ON v.id_empleado = e.id_empleado ORDER BY v.fecha_venta DESC");
date_default_timezone_set('America/Bogota');
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ventas Realizadas</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-50 p-6">
<div class="max-w-6xl mx-auto">
  <h2 class="text-3xl font-bold text-yellow-700 mb-6">Historial de Ventas</h2>
  <table class="w-full table-auto border">
    <thead class="bg-yellow-100">
      <tr>
        <th class="px-3 py-2">ID</th>
        <th class="px-3 py-2">Fecha</th>
        <th class="px-3 py-2">Hora</th>
        <th class="px-3 py-2">Cliente</th>
        <th class="px-3 py-2">Empleado</th>
        <th class="px-3 py-2">Total</th>
        <th class="px-3 py-2">Pago</th>
      </tr>
    </thead>
    <tbody>
      <?php while($v = $resultado->fetch_assoc()) { ?>
      <tr class="border-t">
        <td class="px-3 py-2"><?php echo $v['id_venta']; ?></td>
        <td class="px-3 py-2"><?php echo $v['fecha_venta']; ?></td>
        <td class="px-3 py-2"><?php echo $v['hora_venta']; ?></td>
        <td class="px-3 py-2"><?php echo $v['cliente']; ?></td>
        <td class="px-3 py-2"><?php echo $v['empleado']; ?></td>
        <td class="px-3 py-2">$<?php echo number_format($v['total_venta'], 2); ?></td>
        <td class="px-3 py-2"><?php echo $v['tipo_pago']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>