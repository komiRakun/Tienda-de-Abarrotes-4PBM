<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "almacen";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$clientes = $conn->query("SELECT * FROM clientes");

if (isset($_POST['agregar'])) {
    $id_cliente = intval($_POST['id_cliente']);
    $fecha = $conn->real_escape_string($_POST['fecha_venta']);
    $total = floatval($_POST['total_venta']);

    $conn->query("INSERT INTO ventas (id_cliente, fecha_venta, total_venta)
                  VALUES ($id_cliente, '$fecha', $total)");
    header("Location: ventas.php");
    exit();
}

if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM ventas WHERE id_venta = $id");
    header("Location: ventas.php");
    exit();
}

if (isset($_POST['editar'])) {
    $id = intval($_POST['id_venta']);
    $id_cliente = intval($_POST['id_cliente']);
    $fecha = $conn->real_escape_string($_POST['fecha_venta']);
    $total = floatval($_POST['total_venta']);

    $conn->query("UPDATE ventas SET 
        id_cliente = $id_cliente,
        fecha_venta = '$fecha',
        total_venta = $total
        WHERE id_venta = $id");
    header("Location: ventas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Ventas</title>
    <style>
        :root {
            --azul: #007BFF;
            --azul-oscuro: #0056b3;
            --amarillo: #FFD93D;
            --amarillo-oscuro: #F4C900;
            --gris: #f4f6f8;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--gris);
            margin: 0;
            padding: 30px 20px;
            text-align: center;
        }

        h1 {
            color: var(--azul-oscuro);
            margin-bottom: 30px;
        }

        h2 {
            color: var(--azul);
            margin-top: 40px;
            margin-bottom: 15px;
        }

        form {
            background-color: #fff;
            padding: 25px;
            margin: 0 auto 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            max-width: 500px;
        }

        select, input[type="date"], input[type="number"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: var(--amarillo);
            color: #222;
            font-weight: bold;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--amarillo-oscuro);
        }

        table {
            width: 95%;
            max-width: 1000px;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: var(--azul);
            color: white;
            padding: 14px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .btn-link {
            color: var(--azul);
            text-decoration: none;
            font-weight: 500;
        }

        .btn-link:hover {
            color: var(--azul-oscuro);
            text-decoration: underline;
        }

        .volver {
            display: inline-block;
            margin-top: 40px;
            text-decoration: none;
            background: var(--azul-oscuro);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        .volver:hover {
            background-color: #004999;
        }

        hr {
            border: none;
            height: 1px;
            background-color: #ccc;
            margin: 40px 0;
        }

        @media (max-width: 600px) {
            form, table, select, input {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<h1>Ventas</h1>

<?php if (isset($_GET['editar'])):
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM ventas WHERE id_venta = $id");
    $venta = $res->fetch_assoc(); ?>
    <h2>Editar Venta</h2>
    <form method="post">
        <input type="hidden" name="id_venta" value="<?= $venta['id_venta'] ?>">
        <select name="id_cliente" required>
            <option value="">Seleccione cliente</option>
            <?php
            $clientes->data_seek(0);
            while ($cli = $clientes->fetch_assoc()) {
                $sel = ($cli['id_cliente'] == $venta['id_cliente']) ? 'selected' : '';
                echo "<option value='{$cli['id_cliente']}' $sel>{$cli['nombre_cliente']}</option>";
            }
            ?>
        </select>
        <input type="date" name="fecha_venta" value="<?= $venta['fecha_venta'] ?>" required>
        <input type="number" step="0.01" name="total_venta" value="<?= $venta['total_venta'] ?>" required>
        <input type="submit" name="editar" value="Actualizar">
    </form>
<?php else: ?>
    <h2>Agregar Nueva Venta</h2>
    <form method="post">
        <select name="id_cliente" required>
            <option value="">Seleccione cliente</option>
            <?php
            $clientes->data_seek(0);
            while ($cli = $clientes->fetch_assoc()) {
                echo "<option value='{$cli['id_cliente']}'>{$cli['nombre_cliente']}</option>";
            }
            ?>
        </select>
        <input type="date" name="fecha_venta" required>
        <input type="number" step="0.01" name="total_venta" placeholder="Total" required>
        <input type="submit" name="agregar" value="Agregar">
    </form>
<?php endif; ?>

<h2>Lista de Ventas</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Total</th>
        <th>Acciones</th>
    </tr>
    <?php
    $res = $conn->query("SELECT v.*, c.nombre_cliente FROM ventas v
                         LEFT JOIN clientes c ON v.id_cliente = c.id_cliente");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_venta']}</td>
                <td>{$row['nombre_cliente']}</td>
                <td>{$row['fecha_venta']}</td>
                <td>\${$row['total_venta']}</td>
                <td>
                    <a class='btn-link' href='ventas.php?editar={$row['id_venta']}'>Editar</a> |
                    <a class='btn-link' href='ventas.php?eliminar={$row['id_venta']}' onclick='return confirm(\"¿Eliminar esta venta?\")'>Eliminar</a>
                </td>
              </tr>";
    }
    ?>
</table>

<a href="index.php" class="volver">← Volver al inicio</a>

</body>
</html>

