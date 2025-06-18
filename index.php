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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Abarrotes - Inicio</title>
    <style>
        :root {
            --azul: #007BFF;
            --azul-oscuro: #0056b3;
            --amarillo: #FFD93D;
            --amarillo-oscuro: #F4C900;
            --blanco: #ffffff;
            --gris-suave: #f5f7fa;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--blanco), var(--gris-suave));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(to right, var(--azul), var(--azul-oscuro));
            color: var(--blanco);
            text-align: center;
            padding: 40px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 42px;
            letter-spacing: 1px;
        }

        .container {
            flex-grow: 1;
            padding: 50px 20px;
            text-align: center;
            animation: fadeIn 1s ease-in;
        }

        .container p {
            font-size: 20px;
            color: #333;
            margin-bottom: 50px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        .btn {
            background-color: var(--amarillo);
            color: #222;
            padding: 18px 40px;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:hover {
            background-color: var(--amarillo-oscuro);
            transform: translateY(-3px);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin: 40px 20px 20px;
            color: var(--azul-oscuro);
            font-size: 22px;
            font-weight: 600;
        }

        .admin-list {
            text-align: center;
            margin-bottom: 60px;
        }

        .admin-list a {
            display: inline-block;
            margin: 8px 12px;
            color: var(--azul);
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .admin-list a:hover {
            color: var(--azul-oscuro);
            text-decoration: underline;
        }

        footer {
            background-color: var(--azul-oscuro);
            color: var(--blanco);
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 28px;
            }

            .btn {
                width: 80%;
                font-size: 16px;
            }

            .admin-list a {
                display: block;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Tienda de Abarrotes 4PBM</h1>
</header>

<div class="container">
    <p>Selecciona una sección para administrar los datos:</p>

    <div class="button-container">
        <a href="categorias.php" class="btn">Categorías</a>
        <a href="clientes.php" class="btn">Clientes</a>
        <a href="productos.php" class="btn">Productos</a>
        <a href="ventas.php" class="btn">Ventas</a>
        <a href="https://www.canva.com/design/DAGqo74OIW8/2XZTB_j8dwmDIDlbxoOHDQ/edit?utm_content=DAGqo74OIW8&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" class="btn" target="_blank">Manual</a>
    </div>
</div>

<h2>Administradores
    (siguenos en insta)
</h2>

<div class="admin-list">
    
    <a href="https://www.instagram.com/p.ao__r/?next=%2F">Rufino Rojas Renta Paola</a>
    <a href="https://www.instagram.com/komi_rakun_27?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">San Agustín Martínez Aurora</a>
    <a href="https://www.instagram.com/cirilinx_95/">Sánchez López Irad Cirilo</a>
    <a href="https://www.instagram.com/carlamedina.21/">Sánchez Medina Carla María</a>

<footer>
    &copy; <?php echo date('Y'); ?> Tienda de Abarrotes - Todos los derechos reservados.
</footer>

</body>
</html>


