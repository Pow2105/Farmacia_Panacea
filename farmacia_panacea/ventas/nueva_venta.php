<?php
require_once("../db.php");
$clientes = $conn->query("SELECT id_cliente, nombre, apellido FROM clientes ORDER BY nombre");
$empleados = $conn->query("SELECT id_empleado, nombre, apellido FROM empleados ORDER BY nombre");
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id_cliente = $_POST['id_cliente'];
  $id_empleado = $_POST['id_empleado'];
  $fecha = $_POST['fecha'];
  $hora = $_POST['hora'];
  $tipo_pago = $_POST['tipo_pago'];
  $total_venta = $_POST['total_venta'];

  $stmt = $conn->prepare("CALL sp_insert_venta(?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("iisssd", $id_cliente, $id_empleado, $fecha, $hora, $tipo_pago, $total_venta);

  if ($stmt->execute()) {
    $res = $conn->query("SELECT MAX(id_venta) as id_venta FROM ventas WHERE id_cliente = $id_cliente AND fecha_venta = '$fecha'");
    $row = $res->fetch_assoc();
    $id_venta = $row['id_venta'];
    if ($tipo_pago === 'Crédito') {
    $estado = 'Pendiente';
    $fecha_otorgamiento = $fecha;
    $plazo_dias = (int) $_POST['plazo_dias'];
    $fecha_vencimiento = date('Y-m-d', strtotime("$fecha +$plazo_dias days"));
    $stmt_credito = $conn->prepare("INSERT INTO creditos_clientes (id_cliente, id_venta, monto_credito, estado_credito, fecha_otorgamiento, fecha_vencimiento_pago) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_credito->bind_param("iissss", $id_cliente, $id_venta, $total_venta, $estado, $fecha_otorgamiento, $fecha_vencimiento);
      $stmt_credito->execute();
      $stmt_credito->close();
      $mensaje = "<div class='bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-4'>Venta registrada como <strong>crédito</strong>. Crédito creado correctamente.</div>";
    } else {
      $mensaje = "<div class='bg-green-100 text-green-800 px-4 py-3 rounded mb-4'>Venta registrada correctamente.</div>";
    }
  } else {
    $mensaje = "<div class='bg-red-100 text-red-800 px-4 py-3 rounded mb-4'>Error: " . $stmt->error . "</div>";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Nueva Venta</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-50 p-6">
<div class="max-w-xl mx-auto">
<h2 class="text-2xl font-bold text-yellow-600 mb-4">Registrar Venta</h2>
<?php echo $mensaje; ?>
<form action="" method="post" class="space-y-4">
  <div>
    <label class="block font-medium">Cliente:</label>
    <select name="id_cliente" class="w-full border px-3 py-2 rounded" required>
      <option disabled selected>Seleccione un cliente</option>
      <?php while($c = $clientes->fetch_assoc()) { ?>
        <option value="<?php echo $c['id_cliente']; ?>">
          <?php echo $c['id_cliente'] . " (" . $c['nombre'] . " " . $c['apellido'] . ")"; ?>
        </option>
      <?php } ?>
    </select>
  </div>
  <div>
    <label class="block font-medium">Empleado:</label>
    <select name="id_empleado" class="w-full border px-3 py-2 rounded" required>
      <option disabled selected>Seleccione un empleado</option>
      <?php while($e = $empleados->fetch_assoc()) { ?>
        <option value="<?php echo $e['id_empleado']; ?>">
          <?php echo $e['id_empleado'] . " (" . $e['nombre'] . " " . $e['apellido'] . ")"; ?>
        </option>
      <?php } ?>
    </select>
  </div>
  <input type="hidden" name="fecha" value="<?php echo $fecha_actual; ?>">
  <input type="hidden" name="hora" value="<?php echo $hora_actual; ?>">
  <div>
    <label class="block font-medium">Tipo de Pago:</label>
    <select name="tipo_pago" class="w-full border px-3 py-2 rounded" required>
      <option disabled selected>Seleccione tipo de pago</option>
      <option value="Contado">Contado</option>
      <option value="Crédito">Crédito</option>
    </select>
  </div>
  <div>
    <label class="block font-medium">Monto Total:</label>
    <input type="number" name="total_venta" step="0.01" class="w-full border px-3 py-2 rounded" required>
  </div>
  <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Crear Venta</button>
  <div id="plazo_credito" style="display:none;">
    <label class="block font-medium">Plazo del crédito (días):</label>
    <select name="plazo_dias" class="w-full border px-3 py-2 rounded">
      <option value="7">7 días</option>
      <option value="15">15 días</option>
      <option value="30">30 días</option>
    </select>
  </div>
</form>
<script>
  document.querySelector('select[name="tipo_pago"]').addEventListener('change', function () {
    document.getElementById('plazo_credito').style.display = this.value === 'Crédito' ? 'block' : 'none';
  });
</script>
</div>
</body>
</html>






