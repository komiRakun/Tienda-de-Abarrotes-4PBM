<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "almacen";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar producto
if (isset($_POST['agregar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre_producto']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['cantidad_stock']);
    $categoria = intval($_POST['id_categoria']);
    $conn->query("INSERT INTO productos (nombre_producto, descripcion, precio, cantidad_stock, id_categoria)
                  VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria)");
    header("Location: productos.php");
    exit();
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM productos WHERE id_producto = $id");
    header("Location: productos.php");
    exit();
}

// Editar producto
if (isset($_POST['editar'])) {
    $id = intval($_POST['id_producto']);
    $nombre = $conn->real_escape_string($_POST['nombre_producto']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['cantidad_stock']);
    $categoria = intval($_POST['id_categoria']);
    $conn->query("UPDATE productos SET 
        nombre_producto = '$nombre',
        descripcion = '$descripcion',
        precio = $precio,
        cantidad_stock = $stock,
        id_categoria = $categoria
        WHERE id_producto = $id");
    header("Location: productos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 40px 20px;
            text-align: center;
        }

        h1, h2 {
            color: #0056b3;
        }

        form {
            background: #fff;
            max-width: 500px;
            margin: 20px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        input, select, textarea {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea { height: 60px; resize: vertical; }

        input[type="submit"] {
            background-color: #FFD93D;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            width: 95%;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .btn-link {
            color: #007BFF;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .volver {
            display: inline-block;
            margin-top: 40px;
            text-decoration: none;
            background: #0056b3;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        .volver:hover {
            background-color: #004999;
        }
    </style>
</head>
<body>

<h1>Productos</h1>

<?php
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM productos WHERE id_producto = $id");
    $prod = $res->fetch_assoc(); ?>
    <h2>Editar Producto</h2>
    <form method="post">
        <input type="hidden" name="id_producto" value="<?= $prod['id_producto'] ?>">
        <input type="text" name="nombre_producto" value="<?= $prod['nombre_producto'] ?>" required>
        <textarea name="descripcion"><?= $prod['descripcion'] ?></textarea>
        <input type="text" name="precio" value="<?= $prod['precio'] ?>" required>
        <input type="text" name="cantidad_stock" value="<?= $prod['cantidad_stock'] ?>" required>
        <select name="id_categoria" required>
            <?php
            $categorias = $conn->query("SELECT * FROM categorias");
            while ($cat = $categorias->fetch_assoc()) {
                $selected = ($cat['id_categoria'] == $prod['id_categoria']) ? "selected" : "";
                echo "<option value='{$cat['id_categoria']}' $selected>{$cat['nombre_categoria']}</option>";
            }
            ?>
        </select>
        <input type="submit" name="editar" value="Actualizar">
    </form>
<?php } else { ?>
    <h2>Agregar Nuevo Producto</h2>
    <form method="post">
        <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        <input type="text" name="precio" placeholder="Precio" required>
        <input type="text" name="cantidad_stock" placeholder="Cantidad en stock" required>
        <select name="id_categoria" required>
            <option value="">-- Categoría --</option>
            <?php
            $categorias = $conn->query("SELECT * FROM categorias");
            while ($cat = $categorias->fetch_assoc()) {
                echo "<option value='{$cat['id_categoria']}'>{$cat['nombre_categoria']}</option>";
            }
            ?>
        </select>
        <input type="submit" name="agregar" value="Agregar">
    </form>
<?php } ?>

<h2>Lista de Productos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>
    <?php
    $res = $conn->query("SELECT productos.*, categorias.nombre_categoria 
                         FROM productos 
                         LEFT JOIN categorias ON productos.id_categoria = categorias.id_categoria");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_producto']}</td>
                <td>{$row['nombre_producto']}</td>
                <td>{$row['descripcion']}</td>
                <td>\${$row['precio']}</td>
                <td>{$row['cantidad_stock']}</td>
                <td>{$row['nombre_categoria']}</td>
                <td>
                    <a class='btn-link' href='productos.php?editar={$row['id_producto']}'>Editar</a> |
                    <a class='btn-link' href='productos.php?eliminar={$row['id_producto']}' onclick='return confirm(\"¿Eliminar este producto?\")'>Eliminar</a>
                </td>
              </tr>";
    }
    ?>
</table>

<a href="index.php" class="volver">← Volver al inicio</a>

</body>
</html>
