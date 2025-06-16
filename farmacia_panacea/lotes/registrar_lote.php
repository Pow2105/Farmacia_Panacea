<?php
require_once("../db.php");

$proveedores = $conn->query("SELECT id_proveedor, nombre_empresa FROM proveedores ORDER BY nombre_empresa");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre_producto = $_POST["nombre_producto"];
  $numero_lote = $_POST["numero_lote"];
  $fecha_fabricacion = $_POST["fecha_fabricacion"];
  $fecha_vencimiento = $_POST["fecha_vencimiento"];
  $id_proveedor = $_POST["id_proveedor"];
  $total = $_POST["total"];
  $precio_total = $_POST["precio_total"];

  $stmt = $conn->prepare("INSERT INTO lotes_productos (nombre_producto, numero_lote, fecha_fabricacion, fecha_vencimiento, id_proveedor, total, precio_total) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssiid", $nombre_producto, $numero_lote, $fecha_fabricacion, $fecha_vencimiento, $id_proveedor, $total, $precio_total);

  if ($stmt->execute()) {
    $mensaje = "<div class='bg-green-100 text-green-800 px-4 py-2 rounded mb-4'>Lote registrado exitosamente.</div>";
  } else {
    $mensaje = "<div class='bg-red-100 text-red-800 px-4 py-2 rounded mb-4'>Error: {$stmt->error}</div>";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Lote de Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-indigo-700 mb-4">Registrar Lote de Producto</h2>
  <?php echo $mensaje; ?>
  <form method="post" class="space-y-4">
    <div>
      <label class="block font-medium mb-1">Nombre del Producto Comprado:</label>
      <input type="text" name="nombre_producto" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Número de Lote:</label>
      <input type="text" name="numero_lote" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Fecha de Fabricación:</label>
      <input type="date" name="fecha_fabricacion" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Fecha de Vencimiento:</label>
      <input type="date" name="fecha_vencimiento" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Proveedor:</label>
      <select name="id_proveedor" class="w-full border px-3 py-2 rounded" required>
        <option disabled selected value="">Seleccione un proveedor</option>
        <?php while ($pr = $proveedores->fetch_assoc()) { ?>
          <option value="<?= $pr['id_proveedor'] ?>"><?= $pr['id_proveedor'] . " - " . $pr['nombre_empresa'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label class="block font-medium mb-1">Cantidad Total del Lote:</label>
      <input type="number" name="total" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Precio Total del Lote ($):</label>
      <input type="number" step="0.01" name="precio_total" class="w-full border px-3 py-2 rounded" required>
    </div>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded w-full">Registrar Lote</button>
  </form>
</div>
</body>
</html>




