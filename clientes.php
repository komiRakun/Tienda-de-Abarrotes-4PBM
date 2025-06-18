<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "almacen";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['agregar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre_cliente']);
    $email = $conn->real_escape_string($_POST['email_cliente']);
    $telefono = $conn->real_escape_string($_POST['telefono_cliente']);
    $direccion = $conn->real_escape_string($_POST['direccion_cliente']);

    $conn->query("INSERT INTO clientes (nombre_cliente, email_cliente, telefono_cliente, direccion_cliente)
                  VALUES ('$nombre', '$email', '$telefono', '$direccion')");
    header("Location: clientes.php");
    exit();
}

if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM clientes WHERE id_cliente = $id");
    header("Location: clientes.php");
    exit();
}

if (isset($_POST['editar'])) {
    $id = intval($_POST['id_cliente']);
    $nombre = $conn->real_escape_string($_POST['nombre_cliente']);
    $email = $conn->real_escape_string($_POST['email_cliente']);
    $telefono = $conn->real_escape_string($_POST['telefono_cliente']);
    $direccion = $conn->real_escape_string($_POST['direccion_cliente']);

    $conn->query("UPDATE clientes SET 
        nombre_cliente = '$nombre',
        email_cliente = '$email',
        telefono_cliente = '$telefono',
        direccion_cliente = '$direccion'
        WHERE id_cliente = $id");
    header("Location: clientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Clientes</title>
    <style>
        :root {
            --azul: #007BFF;
            --azul-oscuro: #0056b3;
            --amarillo: #FFD93D;
            --amarillo-oscuro: #F4C900;
            --gris: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--gris);
            padding: 30px 20px;
            margin: 0;
            text-align: center;
        }

        h1 {
            color: var(--azul-oscuro);
            margin-bottom: 20px;
        }

        h2 {
            color: var(--azul);
            margin: 40px 0 20px;
        }

        form {
            background-color: #fff;
            margin: 0 auto 30px;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        input[type="text"], input[type="email"], textarea {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            resize: vertical;
            height: 60px;
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
            margin: 0 auto;
            border-collapse: collapse;
            width: 95%;
            max-width: 1000px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
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
            text-decoration: none;
            color: var(--azul);
            font-weight: 500;
        }

        .btn-link:hover {
            text-decoration: underline;
            color: var(--azul-oscuro);
        }

        .volver {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background: var(--azul-oscuro);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .volver:hover {
            background-color: #004a99;
        }

        hr {
            border: none;
            height: 1px;
            background-color: #ccc;
            margin: 40px 0;
        }

        @media (max-width: 600px) {
            table, input, textarea {
                width: 100%;
            }

            form {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<h1>Clientes</h1>

<?php if (isset($_GET['editar'])):
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM clientes WHERE id_cliente = $id");
    $cli = $res->fetch_assoc(); ?>
    <h2>Editar Cliente</h2>
    <form method="post">
        <input type="hidden" name="id_cliente" value="<?= $cli['id_cliente'] ?>">
        <input type="text" name="nombre_cliente" value="<?= $cli['nombre_cliente'] ?>" required>
        <input type="email" name="email_cliente" value="<?= $cli['email_cliente'] ?>" required>
        <input type="text" name="telefono_cliente" value="<?= $cli['telefono_cliente'] ?>">
        <textarea name="direccion_cliente"><?= $cli['direccion_cliente'] ?></textarea>
        <input type="submit" name="editar" value="Actualizar">
    </form>
<?php else: ?>
    <h2>Agregar Nuevo Cliente</h2>
    <form method="post">
        <input type="text" name="nombre_cliente" placeholder="Nombre" required>
        <input type="email" name="email_cliente" placeholder="Email" required>
        <input type="text" name="telefono_cliente" placeholder="Teléfono">
        <textarea name="direccion_cliente" placeholder="Dirección"></textarea>
        <input type="submit" name="agregar" value="Agregar">
    </form>
<?php endif; ?>

<hr>

<h2>Lista de Clientes</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    <?php
    $res = $conn->query("SELECT * FROM clientes");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_cliente']}</td>
                <td>{$row['nombre_cliente']}</td>
                <td>{$row['email_cliente']}</td>
                <td>{$row['telefono_cliente']}</td>
                <td>{$row['direccion_cliente']}</td>
                <td>
                    <a class='btn-link' href='clientes.php?editar={$row['id_cliente']}'>Editar</a> |
                    <a class='btn-link' href='clientes.php?eliminar={$row['id_cliente']}' onclick='return confirm(\"¿Eliminar este cliente?\")'>Eliminar</a>
                </td>
              </tr>";
    }
    ?>
</table>

<a href="index.php" class="volver">← Volver al inicio</a>

</body>
</html>

