-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2025 a las 15:18:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Abarrotes'),
(2, 'Bebidas'),
(3, 'Snacks'),
(4, 'Limpieza'),
(5, 'Frutas y Verduras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `direccion_cliente` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `email_cliente`, `telefono_cliente`, `direccion_cliente`) VALUES
(1, 'Juan Pérez', 'juanperez@gmail.com', '123-456-7890', 'Calle 1, Ciudad A'),
(2, 'María García', 'mariagarcia@gmail.com', '123-456-7891', 'Calle 2, Ciudad B'),
(3, 'Carlos Sánchez', 'carlossanchez@gmail.com', '123-456-7892', 'Calle 3, Ciudad C'),
(4, 'Ana López', 'analopez@gmail.com', '123-456-7893', 'Calle 4, Ciudad D'),
(5, 'Pedro González', 'pedrogonzalez@gmail.com', '123-456-7894', 'Calle 5, Ciudad E'),
(6, 'Luis Rodríguez', 'luisrodriguez@gmail.com', '123-456-7895', 'Calle 6, Ciudad F'),
(7, 'Sofía Martínez', 'sofia.martinez@gmail.com', '123-456-7896', 'Calle 7, Ciudad G'),
(8, 'Gabriel Fernández', 'gabrielfernandez@gmail.com', '123-456-7897', 'Calle 8, Ciudad H'),
(9, 'Laura Ruiz', 'laura.ruiz@gmail.com', '123-456-7898', 'Calle 9, Ciudad I'),
(10, 'Javier Pérez', 'javier.perez@gmail.com', '123-456-7899', 'Calle 10, Ciudad J'),
(11, 'Teresa Díaz', 'teresadiaz@gmail.com', '123-456-7900', 'Calle 11, Ciudad K'),
(12, 'Juanita Jiménez', 'juanitajimenez@gmail.com', '123-456-7901', 'Calle 12, Ciudad L'),
(13, 'Antonio Martínez', 'antonio.martinez@gmail.com', '123-456-7902', 'Calle 13, Ciudad M'),
(14, 'Marina Ruiz', 'marinaruiz@gmail.com', '123-456-7903', 'Calle 14, Ciudad N'),
(15, 'Roberto Gómez', 'robertogomez@gmail.com', '123-456-7904', 'Calle 15, Ciudad O'),
(16, 'Patricia López', 'patricialopez@gmail.com', '123-456-7905', 'Calle 16, Ciudad P'),
(17, 'Alberto Torres', 'alberto.torres@gmail.com', '123-456-7906', 'Calle 17, Ciudad Q'),
(18, 'Elena Fernández', 'elenaf@gmail.com', '123-456-7907', 'Calle 18, Ciudad R'),
(19, 'Ricardo González', 'ricardogonzalez@gmail.com', '123-456-7908', 'Calle 19, Ciudad S'),
(20, 'Susana Herrera', 'susana.herrera@gmail.com', '123-456-7909', 'Calle 20, Ciudad T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad_stock`, `id_categoria`) VALUES
(1, 'Arroz', 'Arroz de grano largo', 15.50, 100, 1),
(2, 'Frijoles', 'Frijoles negros', 12.00, 150, 1),
(3, 'Aceite', 'Aceite vegetal', 35.00, 200, 1),
(4, 'Azúcar', 'Azúcar granulada', 20.00, 300, 1),
(5, 'Sal', 'Sal de mesa', 5.00, 500, 1),
(6, 'Cereal', 'Cereal de maíz', 50.00, 180, 3),
(7, 'Galletas', 'Galletas dulces', 30.00, 400, 3),
(8, 'Jugo', 'Jugo de naranja', 45.00, 350, 2),
(9, 'Leche', 'Leche entera', 40.00, 220, 2),
(10, 'Sopa', 'Sopa de fideos', 18.00, 120, 1),
(11, 'Manteca', 'Manteca de cerdo', 25.00, 180, 1),
(12, 'Chocolate', 'Chocolate en polvo', 70.00, 250, 1),
(13, 'Tomates', 'Tomates frescos', 12.00, 500, 5),
(14, 'Paprika', 'Paprika en polvo', 35.00, 150, 1),
(15, 'Café', 'Café molido', 75.00, 180, 1),
(16, 'Harina Maíz', 'Harina de maíz', 18.00, 200, 1),
(17, 'Galletas saladas', 'Galletas saladas', 28.00, 350, 3),
(18, 'Pasta', 'Pasta de trigo', 15.00, 450, 1),
(19, 'Coca-Cola', 'Bebida gaseosa', 20.00, 100, 2),
(20, 'Cerveza', 'Cerveza artesanal', 55.00, 150, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_venta` date NOT NULL,
  `total_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `fecha_venta`, `total_venta`) VALUES
(1, 1, '2025-05-01', 320.50),
(2, 2, '2025-05-02', 450.00),
(3, 3, '2025-05-03', 150.00),
(4, 4, '2025-05-04', 180.00),
(5, 5, '2025-05-05', 400.00),
(6, 6, '2025-05-06', 250.00),
(7, 7, '2025-05-07', 130.00),
(8, 8, '2025-05-08', 500.00),
(9, 9, '2025-05-09', 270.00),
(10, 10, '2025-05-10', 350.00),
(11, 11, '2025-05-11', 430.00),
(12, 12, '2025-05-12', 320.00),
(13, 13, '2025-05-13', 270.00),
(14, 14, '2025-05-14', 380.00),
(15, 15, '2025-05-15', 450.00),
(16, 16, '2025-05-16', 250.00),
(17, 17, '2025-05-17', 390.00),
(18, 18, '2025-05-18', 330.00),
(19, 19, '2025-05-19', 270.00),
(20, 20, '2025-05-20', 400.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
