<?php
require_once("../db.php");
$ventas = $conn->query("SELECT SUM(total_venta) AS total FROM ventas")->fetch_assoc();
$gastos = $conn->query("SELECT SUM(monto) AS total FROM gastos")->fetch_assoc();
$utilidad = $ventas['total'] - $gastos['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resumen Financiero</title></head>
<body>
<h2>Resumen Financiero</h2>
<p>Total Ventas: $<?php echo number_format($ventas['total'], 2); ?></p>
<p>Total Gastos: $<?php echo number_format($gastos['total'], 2); ?></p>
<p><strong>Utilidad Neta: $<?php echo number_format($utilidad, 2); ?></strong></p>
</body>
</html>