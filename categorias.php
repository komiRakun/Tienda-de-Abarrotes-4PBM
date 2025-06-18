<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "almacen";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar categoría
if (isset($_POST['agregar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre_categoria']);
    $conn->query("INSERT INTO categorias (nombre_categoria) VALUES ('$nombre')");
    header("Location: categorias.php");
    exit();
}

// Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM categorias WHERE id_categoria = $id");
    header("Location: categorias.php");
    exit();
}

// Editar categoría
if (isset($_POST['editar'])) {
    $id = intval($_POST['id_categoria']);
    $nombre = $conn->real_escape_string($_POST['nombre_categoria']);
    $conn->query("UPDATE categorias SET nombre_categoria = '$nombre' WHERE id_categoria = $id");
    header("Location: categorias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Categorías</title>
    <style>
        :root {
            --azul: #007BFF;
            --azul-oscuro: #0056b3;
            --amarillo: #FFD93D;
            --amarillo-oscuro: #F4C900;
            --gris-claro: #f5f7fa;
            --gris-borde: #ccc;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--gris-claro);
            padding: 40px 20px;
            margin: 0;
            text-align: center;
        }

        h1 {
            color: var(--azul-oscuro);
            margin-bottom: 30px;
        }

        h2 {
            color: var(--azul);
            margin-top: 50px;
            margin-bottom: 20px;
        }

        table {
            margin: 0 auto 40px;
            border-collapse: collapse;
            width: 90%;
            max-width: 700px;
            background-color: #fff;
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
            border-bottom: 1px solid var(--gris-borde);
        }

        tr:last-child td {
            border-bottom: none;
        }

        form {
            margin-bottom: 40px;
        }

        input[type="text"] {
            padding: 10px;
            width: 260px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 25px;
            background-color: var(--amarillo);
            color: #222;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--amarillo-oscuro);
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
            background-color: #003c8a;
        }

        @media (max-width: 600px) {
            table, input[type="text"] {
                width: 95%;
            }

            input[type="submit"] {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<h1>Administración de Categorías</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre de Categoría</th>
        <th>Acciones</th>
    </tr>
    <?php
    $res = $conn->query("SELECT * FROM categorias");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_categoria']}</td>
                <td>{$row['nombre_categoria']}</td>
                <td>
                    <a class='btn-link' href='categorias.php?editar={$row['id_categoria']}'>Editar</a> |
                    <a class='btn-link' href='categorias.php?eliminar={$row['id_categoria']}' onclick='return confirm(\"¿Eliminar esta categoría?\")'>Eliminar</a>
                </td>
              </tr>";
    }
    ?>
</table>

<?php if (isset($_GET['editar'])): 
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM categorias WHERE id_categoria = $id");
    $cat = $res->fetch_assoc();
?>
    <h2>Editar Categoría</h2>
    <form method="post">
        <input type="hidden" name="id_categoria" value="<?= $cat['id_categoria'] ?>">
        <input type="text" name="nombre_categoria" value="<?= $cat['nombre_categoria'] ?>" required><br>
        <input type="submit" name="editar" value="Actualizar">
    </form>
<?php else: ?>
    <h2>Agregar Nueva Categoría</h2>
    <form method="post">
        <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required><br>
        <input type="submit" name="agregar" value="Agregar">
    </form>
<?php endif; ?>

<a href="index.php" class="volver">← Volver al inicio</a>

</body>
</html>


