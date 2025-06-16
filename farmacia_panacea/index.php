<?php
// Proyecto web completo para la farmacia Panacea con Tailwind CSS y barra lateral con contenido dinámico

// db.php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "farmacia_panacea";
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Farmacia Panacea</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Estilos del iframe para que ocupe todo el espacio */
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <aside class="w-64 bg-blue-800 text-white p-6 space-y-4 flex-shrink-0 overflow-y-auto">
      <h2 class="text-2xl font-bold mb-6">Farmacia Panacea</h2>
      <a href="clientes/registrar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Cliente</a>
      <a href="empleados/registrar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Empleado</a>
      <a href="empleados/consultar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Empleados</a>
      <a href="productos/registrar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Producto</a>
      <a href="productos/consultar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Productos</a>
      <a href="proveedores/registrar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Proveedor</a>
      <a href="proveedores/consultar_proveedores.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Proveedores</a>
      <a href="lotes/registrar_lote.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Lote</a>
      <a href="lotes/consultar_lotes_productos.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Lotes</a>
      <a href="ventas/nueva_venta.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Nueva Venta</a>
      <a href="ventas/consultar.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Ventas</a>
      <a href="creditos/consultar_creditos.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Consultar Créditos</a>
      <a href="creditos/registrar_pago_credito.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Registrar Pago de Crédito</a>
      <a href="reportes/productos_proximos_vencer.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Productos por Vencer</a>
      <a href="reportes/resumen_financiero.php" target="contenido" class="block hover:bg-blue-700 p-2 rounded">Resumen Financiero</a>
    </aside>

    <main class="flex-1 bg-white">
      <iframe name="contenido" src="" class="w-full h-full"></iframe>
    </main>
  </div>
</body>
</html>