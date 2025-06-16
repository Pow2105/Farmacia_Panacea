<?php
require_once("../db.php");
$lotes = $conn->query("SELECT l.id_lote, l.numero_lote, p.nombre AS producto, l.fecha_vencimiento FROM lotes_productos l JOIN productos p ON l.id_producto = p.id_producto ORDER BY l.fecha_vencimiento");
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_lote = $_POST['id_lote'];
  $categoria = $_POST['categoria'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio_venta'];
  $stock = $_POST['stock'];

  // Obtener info del lote para completar el producto
  $res = $conn->query("SELECT id_producto FROM lotes_productos WHERE id_lote = $id_lote");
  $lote = $res->fetch_assoc();
  $id_producto = $lote['id_producto'];

  $stmt = $conn->prepare("INSERT INTO productos (id_producto, categoria, descripcion, precio_venta, stock_actual) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("isssd", $id_producto, $categoria, $descripcion, $precio, $stock);

  if ($stmt->execute()) {
    $mensaje = "<div class='bg-green-100 text-green-800 px-4 py-2 rounded mb-4'>Producto registrado exitosamente.</div>";
  } else {
    $mensaje = "<div class='bg-red-100 text-red-800 px-4 py-2 rounded mb-4'>Error: " . $stmt->error . "</div>";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-green-700 mb-4">Registrar Producto desde Lote</h2>
  <?php echo $mensaje; ?>
  <form method="post" class="space-y-4">
    <div>
      <label class="block font-medium mb-1">Lote Disponible:</label>
      <select name="id_lote" class="w-full border px-3 py-2 rounded" required>
        <option disabled selected value="">Seleccione un lote de producto</option>
        <?php while($l = $lotes->fetch_assoc()) { ?>
          <option value="<?= $l['id_lote'] ?>">
            <?= "#{$l['id_lote']} - {$l['producto']} - Lote: {$l['numero_lote']} (Vence: {$l['fecha_vencimiento']})" ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label class="block font-medium mb-1">Categoría:</label>
      <input type="text" name="categoria" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Descripción:</label>
      <textarea name="descripcion" class="w-full border px-3 py-2 rounded"></textarea>
    </div>
    <div>
      <label class="block font-medium mb-1">Precio de Venta:</label>
      <input type="number" step="0.01" name="precio_venta" class="w-full border px-3 py-2 rounded" required>
    </div>
    <div>
      <label class="block font-medium mb-1">Stock Inicial:</label>
      <input type="number" name="stock" class="w-full border px-3 py-2 rounded" required>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Registrar Producto</button>
  </form>
</div>
</body>
</html>
