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
    .tooltip {
      position: relative;
    }
    .tooltip:hover::after {
      content: attr(data-tooltip);
      position: absolute;
      left: 100%;
      top: 0;
      margin-left: 12px;
      white-space: nowrap;
      background-color: #1e3a8a;
      color: white;
      padding: 6px 10px;
      border-radius: 4px;
      font-size: 12px;
      z-index: 10;
    }
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen overflow-hidden">
    <!-- Barra lateral -->
    <aside class="w-64 bg-blue-800 text-white p-6 space-y-4 flex-shrink-0">
  <h2 class="text-2xl font-bold mb-6">Farmacia Panacea</h2>
  <a href="clientes/registrar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Registrar un nuevo cliente">Registrar Cliente</a>
  <a href="empleados/registrar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Registrar un nuevo empleado">Registrar Empleado</a>
  <a href="empleados/consultar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver y editar empleados registrados">Consultar Empleados</a>
  <a href="productos/registrar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Añadir un producto al inventario">Registrar Producto</a>
  <a href="productos/consultar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver y gestionar los productos">Consultar Productos</a>
  <a href="proveedores/registrar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Agregar un proveedor de productos">Registrar Proveedor</a>
  <a href="proveedores/consultar_proveedores.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Consultar proveedores registrados">Consultar Proveedores</a>
  <a href="lotes/registrar_lote.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Registrar lote de producto de un proveedor">Registrar Lote</a>
  <a href="lotes/consultar_lotes_productos.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver historial de lotes recibidos">Consultar Lotes</a>
  <a href="ventas/nueva_venta.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Crear una nueva venta">Nueva Venta</a>
  <a href="ventas/consultar.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver el historial de ventas realizadas">Consultar Ventas</a>
  <a href="creditos/consultar_creditos.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver estado de créditos">Consultar Créditos</a>
  <a href="creditos/registrar_pago_credito.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Registrar un cobro a un crédito">Registrar Pago de Crédito</a>
  <a href="reportes/productos_proximos_vencer.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Ver productos próximos a vencer">Productos por Vencer</a>
  <a href="reportes/resumen_financiero.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Resumen financiero de ingresos y gastos">Resumen Financiero</a>
  <a href="reportes/ventas_por_fecha.php" target="contenido" class="tooltip block hover:bg-blue-700 p-2 rounded" data-tooltip="Consultar ventas por rango de fechas">Ventas por Fecha</a>
</aside>



    <!-- Contenido principal -->
    <main class="flex-1 bg-white">
      <iframe name="contenido" src="" class="w-full h-full"></iframe>
    </main>
  </div>
</body>
</html>