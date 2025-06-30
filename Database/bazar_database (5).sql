-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci贸n: 30-06-2025 a las 07:52:47
-- Versi贸n del servidor: 10.4.32-MariaDB
-- Versi贸n de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bazar_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`) VALUES
(0, 'toci333', 'isaactole333@gmail.com', 'Captura de pantalla 2025-06-29 222323.png', '$2y$10$w7B4hEBE6coCM1Qp7q7wK./cTDZ/jKxH0GJiXcqg/h1t7OqL4lAlS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Fender'),
(2, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `card_details`
--

CREATE TABLE `card_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `card_details`
--

INSERT INTO `card_details` (`product_id`, `ip_address`, `quantity`) VALUES
(-1221709778, '0.1�\0\0	\0', -2145910748),
(-1221709778, '0.1�\0\0	\0', -2145386460),
(-1221709778, '0.1�\0\0	\0', -2144862166),
(1, '127.0.0.1', 1),
(5, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`category_id`, `categoria`) VALUES
(1, 'Instrumentos'),
(2, 'Ropa Mujer'),
(3, 'Ropa Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 312346784, 1, 3, 'pending'),
(2, 1, 312346784, 2, 1, 'pending'),
(3, 1, 312346784, 4, 1, 'pending'),
(4, 1, 1918753782, 3, 2, 'pending'),
(5, 1, 351837813, 1, 2, 'pending');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(120) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image_uno` varchar(255) NOT NULL,
  `product_image_dos` varchar(255) NOT NULL,
  `product_image_tres` varchar(255) NOT NULL,
  `product_precio` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image_uno`, `product_image_dos`, `product_image_tres`, `product_precio`, `date`, `status`) VALUES
(1, 'Guitarra semihueca vintage', 'Guitarra el茅ctrica semihueca color negro con golpeador perla.', 'guitarra,semihueca,vintage,negra', 1, 1, 'assets/images/instrumento1.jpg', '', '', 15000, '2025-06-29 18:23:50', 'active'),
(2, 'Guitarra el茅ctrica s贸lida Sunburst', 'Guitarra el茅ctrica de cuerpo s贸lido con acabado sunburst.', 'guitarra,el茅ctrica,s贸lida,sunburst', 1, 1, 'assets/images/instrumento2.jpg', '', '', 18000, '2025-06-29 18:23:50', 'active'),
(3, 'Bajo el茅ctrico 4 cuerdas', 'Bajo el茅ctrico de 4 cuerdas con acabado mate negro.', 'bajo,el茅ctrico,4 cuerdas,negro', 1, 1, 'assets/images/instrumento3.jpg', '', '', 17000, '2025-06-29 18:23:50', 'active'),
(4, 'Abrigo largo de cuero caramelo', 'Abrigo largo color caramelo con botones grandes.', 'abrigo,cuero,caramelo,hombre', 3, 2, 'assets/images/prenda1h.jpg', '', '', 250, '2025-06-29 18:23:50', 'active'),
(5, 'Chaqueta de antelina verde', 'Chaqueta de antelina verde con forro naranja y botones rojos.', 'chaqueta,antelina,verde,hombre', 3, 2, 'assets/images/prenda2h.jpg', '', '', 180, '2025-06-29 18:23:50', 'active'),
(6, 'Chaqueta de ante con flecos', 'Chaqueta de ante marr贸n con flecos estilo boho.', 'chaqueta,ante,flecos,hombre', 3, 2, 'assets/images/prenda3h.jpg', '', '', 200, '2025-06-29 18:23:50', 'active'),
(7, 'Abrigo mostaza con borrego', 'Abrigo mostaza con cuello de borrego marr贸n.', 'abrigo,mostaza,borrego,hombre', 3, 2, 'assets/images/prenda4h.jpg', '', '', 220, '2025-06-29 18:23:50', 'active'),
(8, 'Vestido sin mangas verde agua', 'Vestido sin mangas color verde agua corte evas茅.', 'vestido,verde,agua,mujer', 2, 2, 'assets/images/prenda1m.jpg', '', '', 75, '2025-06-29 18:23:50', 'active'),
(9, 'Blusa retro naranja', 'Blusa sin mangas con estampado geom茅trico naranja.', 'blusa,retro,naranja,mujer', 2, 2, 'assets/images/prenda2m.jpg', '', '', 65, '2025-06-29 18:23:50', 'active'),
(10, 'Vestido mostaza casual', 'Vestido mostaza de manga corta, estilo informal.', 'vestido,mostaza,mujer', 2, 2, 'assets/images/prenda3m.jpg', '', '', 50, '2025-06-29 18:23:50', 'active'),
(11, 'Vestido vintage geom茅trico', 'Vestido de manga corta con estampado geom茅trico y botones rosas.', 'vestido,geometrico,vintage,mujer', 2, 2, 'assets/images/prenda4m.jpg', '', '', 95, '2025-06-29 18:23:50', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 1160, 312346784, 3, '2023-10-22 21:31:20', 'paid'),
(2, 1, 760, 1918753782, 1, '2023-10-24 06:25:10', 'pending'),
(3, 1, 240, 351837813, 1, '2023-10-25 00:41:02', 'pending');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(0, 'toci333', 'isaactole@gmail.com', '$2y$10$cGZHISA5WOl/zhDeSetuOe5vbm58M605/4npiSxV.18VSGAwnACsW', '5470402300000002.png', '127.0.0.1', 'Fresno Mz.1 Lt1', '5562823120');

--
-- 脥ndices para tablas volcadas
--

--
-- Indices de la tabla `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indices de la tabla `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
