-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2018 a las 08:48:28
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saparicio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `idAlmacen` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ciEmpleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idAlmacen`, `descripcion`, `ubicacion`, `ciEmpleado`) VALUES
(1, 'A1 Principal', '--', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL,
  `cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idCargo`, `cargo`, `estado`) VALUES
(1, 'Gerente', 1),
(2, 'Promotor', 1),
(3, 'Almacenero', 1),
(4, 'Chofer', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ci` int(11) NOT NULL,
  `fechaUnion` date DEFAULT NULL,
  `tipo` varchar(3) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ci`, `fechaUnion`, `tipo`, `estado`) VALUES
(910, '2018-06-27', 'Vip', 'Activo'),
(911, '2018-06-27', 'Med', 'Activo'),
(912, '2018-06-27', 'Vip', 'Activo'),
(913, '2018-06-27', 'Sta', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE `cuota` (
  `idCuota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `montoCuota` float DEFAULT NULL,
  `idIngreso` int(11) DEFAULT NULL,
  `idTipoPago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentradaproducto`
--

CREATE TABLE `detalleentradaproducto` (
  `idEntrada` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleingreso`
--

CREATE TABLE `detalleingreso` (
  `cantidad` int(11) DEFAULT NULL,
  `precioCompra` float DEFAULT NULL,
  `precioVenta` float DEFAULT NULL,
  `idProd` int(11) NOT NULL,
  `idIngreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesalidaproducto`
--

CREATE TABLE `detallesalidaproducto` (
  `idSalidaProducto` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `idDir` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `obs` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idZona` int(11) DEFAULT NULL,
  `ci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`idDir`, `direccion`, `obs`, `idZona`, `ci`) VALUES
(1, 'Los penocos', 'casa amarilla #24', 4, 910),
(2, 'los andes', 'casa azul #10', 4, 910),
(3, 'surita vegas', 'alado de hotel palmeiras', 3, 912),
(4, 'los toritos #43', 'frente al surtidor moragrande', 3, 911),
(5, 'los sauces', 'alado de riveplas', 4, 911),
(6, 'los penocos del suro', 'alado del hotel rusia', 4, 913);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ci` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `estado` tinyint(10) DEFAULT '1',
  `idCargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ci`, `codigo`, `estado`, `idCargo`) VALUES
(110, 1100111, 1, 2),
(111, 111111, 1, 2),
(510, 510015, 1, 4),
(511, 511115, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradaproducto`
--

CREATE TABLE `entradaproducto` (
  `idEntrada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `obs` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciEmpleado` int(11) DEFAULT NULL,
  `idTipoEntrada` int(11) DEFAULT NULL,
  `idAlmacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idIngreso` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `tipoComprobante` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serieComprobante` varchar(7) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numComprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `idTipoCompra` int(11) DEFAULT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `impuesto` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idAlmacen` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `maxStock` int(11) NOT NULL,
  `minStock` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idAlmacen`, `idProd`, `maxStock`, `minStock`, `stock`) VALUES
(1, 1, 2133, 32, 232),
(1, 3, 150, 20, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idMarca`, `nombre`, `estado`) VALUES
(1, 'Cocacola', 1),
(2, 'Mendocina', 1),
(3, 'Paceña', 1),
(4, 'Real', 1),
(5, 'Real', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `idMedida` int(11) NOT NULL,
  `medida` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`idMedida`, `medida`, `estado`) VALUES
(1, '3lt', 1),
(2, '2lt', 1),
(3, '350ML', 1),
(4, '600ML', 1),
(5, '330ml', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(57, '2014_10_12_000000_create_users_table', 1),
(58, '2014_10_12_100000_create_password_resets_table', 1),
(59, '2015_01_20_084450_create_roles_table', 1),
(60, '2015_01_20_084525_create_role_user_table', 1),
(61, '2015_01_24_080208_create_permissions_table', 1),
(62, '2015_01_24_080433_create_permission_role_table', 1),
(63, '2015_12_04_003040_add_special_role_column', 1),
(64, '2017_10_17_170735_create_permission_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `idPaquete` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`idPaquete`, `cantidad`, `descripcion`, `estado`) VALUES
(1, 12, '--', 1),
(2, 48, '--', 1),
(3, 15, 'YES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Navegar zona empleado', 'personal.zonaempleado.index', 'Lista y navega todos los zona empleado del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(2, 'Ver detalle de un zona empleado', 'personal.zonaempleado.show', 'Ve en detalle cada zona empleado del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(3, 'Creación de zona empleado', 'personal.zonaempleado.create', 'Podría crear nuevos zona empleado en el sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(4, 'Edición de zona empleado', 'personal.zonaempleado.edit', 'Podría editar cualquier dato de un zona empleado del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(5, 'Eliminar zona empleado', 'personal.zonaempleado.destroy', 'Podría eliminar cualquier zona empleado del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(6, 'Navegar usuarios', 'users.index', 'Lista y navega todos los usuarios del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(7, 'Ver detalle de usuario', 'users.show', 'Ve en detalle cada usuario del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(8, 'Edición de usuarios', 'users.edit', 'Podría editar cualquier dato de un usuario del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(9, 'Eliminar usuario', 'users.destroy', 'Podría eliminar cualquier usuario del sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(10, 'Creación de usuario', 'users.create', 'Podría crear nuevos usuario en el sistema', '2018-06-28 02:02:05', '2018-06-28 02:02:05'),
(11, 'Navegar roles', 'roles.index', 'Lista y navega todos los roles del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(12, 'Ver detalle de un rol', 'roles.show', 'Ve en detalle cada rol del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(13, 'Creación de roles', 'roles.create', 'Podría crear nuevos roles en el sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(14, 'Edición de roles', 'roles.edit', 'Podría editar cualquier dato de un rol del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(15, 'Eliminar roles', 'roles.destroy', 'Podría eliminar cualquier rol del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(16, 'Navegar cargo', 'personal.cargo.index', 'Lista y navega todos los cargo del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(17, 'Ver detalle de un cargo', 'personal.cargo.show', 'Ve en detalle cada cargo del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(18, 'Creación de cargo', 'personal.cargo.create', 'Podría crear nuevos cargo en el sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(19, 'Edición de cargo', 'personal.cargo.edit', 'Podría editar cualquier dato de un cargo del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(20, 'Eliminar cargo', 'personal.cargo.destroy', 'Podría eliminar cualquier cargo del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(21, 'Navegar usuario-personal', 'personal.user.index', 'Lista y navega todos los usuario-personal del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(22, 'Ver detalle de un usuario-personal', 'personal.user.show', 'Ve en detalle cada usuario-personal del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(23, 'Creación de usuario-personal', 'personal.user.create', 'Podría crear nuevos usuario-personal en el sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(24, 'Edición de usuario-personal', 'personal.user.edit', 'Podría editar cualquier dato de un usuario-personal del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(25, 'Eliminar usuario-personal', 'personal.user.destroy', 'Podría eliminar cualquier usuario-personal del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(26, 'Navegar zona', 'ventas.zona.index', 'Lista y navega todos las zona del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(27, 'Ver detalle de un zona', 'ventas.zona.show', 'Ve en detalle cada zona del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(28, 'Creación de zona', 'ventas.zona.create', 'Podría crear nuevas zona en el sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(29, 'Edición de zona', 'ventas.zona.edit', 'Podría editar cualquier dato de un zona del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(30, 'Eliminar zona', 'ventas.zona.destroy', 'Podría eliminar cualquier zona del sistema', '2018-06-28 02:02:06', '2018-06-28 02:02:06'),
(31, 'Navegar cliente', 'ventas.cliente.index', 'Lista y navega todos las cliente del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(32, 'Ver detalle de un cliente', 'ventas.cliente.show', 'Ve en detalle cada cliente del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(33, 'Creación de cliente', 'ventas.cliente.create', 'Podría crear nuevas cliente en el sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(34, 'Edición de cliente', 'ventas.cliente.edit', 'Podría editar cualquier dato de un cliente del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(35, 'Eliminar cliente', 'ventas.cliente.destroy', 'Podría eliminar cualquier cliente del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(36, 'Navegar pedido', 'ventas.pedido.index', 'Lista y navega todos las pedido del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(37, 'Ver detalle de un pedido', 'ventas.pedido.show', 'Ve en detalle cada pedido del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(38, 'Creación de pedido', 'ventas.pedido.create', 'Podría crear nuevas pedido en el sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(39, 'Edición de pedido', 'ventas.pedido.edit', 'Podría editar cualquier dato de un pedido del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(40, 'Eliminar pedido', 'ventas.pedido.destroy', 'Podría eliminar cualquier pedido del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(41, 'Navegar entrega', 'ventas.entrega.index', 'Lista y navega todos las entrega del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(42, 'Ver detalle de un entrega', 'ventas.entrega.show', 'Ve en detalle cada entrega del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(43, 'Creación de entrega', 'ventas.entrega.create', 'Podría crear nuevas entrega en el sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(44, 'Edición de entrega', 'ventas.entrega.edit', 'Podría editar cualquier dato de un entrega del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(45, 'Eliminar entrega', 'ventas.entrega.destroy', 'Podría eliminar cualquier entrega del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(46, 'Navegar proveerdor', 'compras.proveedor.index', 'Lista y navega todos las proveerdor del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(47, 'Ver detalle de un proveerdor', 'compras.proveedor.show', 'Ve en detalle cada proveerdor del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(48, 'Creación de proveerdor', 'compras.proveedor.create', 'Podría crear nuevas proveerdor en el sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(49, 'Edición de proveerdor', 'compras.proveedor.edit', 'Podría editar cualquier dato de un proveerdor del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(50, 'Eliminar proveerdor', 'compras.proveedor.destroy', 'Podría eliminar cualquier proveerdor del sistema', '2018-06-28 02:02:07', '2018-06-28 02:02:07'),
(51, 'Navegar tipocompra', 'compras.tipocompra.index', 'Lista y navega todos las tipocompra del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(52, 'Ver detalle de un tipocompra', 'compras.tipocompra.show', 'Ve en detalle cada tipocompra del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(53, 'Creación de tipocompra', 'compras.tipocompra.create', 'Podría crear nuevas tipocompra en el sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(54, 'Edición de tipocompra', 'compras.tipocompra.edit', 'Podría editar cualquier dato de un tipocompra del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(55, 'Eliminar tipocompra', 'compras.tipocompra.destroy', 'Podría eliminar cualquier tipocompra del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(56, 'Navegar ingreso', 'compras.ingreso.index', 'Lista y navega todos las ingreso del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(57, 'Ver detalle de un ingreso', 'compras.ingreso.show', 'Ve en detalle cada ingreso del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(58, 'Creación de ingreso', 'compras.ingreso.create', 'Podría crear nuevas ingreso en el sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(59, 'Edición de ingreso', 'compras.ingreso.edit', 'Podría editar cualquier dato de un ingreso del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(60, 'Eliminar ingreso', 'compras.ingreso.destroy', 'Podría eliminar cualquier ingreso del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(61, 'Navegar marca', 'inventario.marca.index', 'Lista y navega todos las marca del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(62, 'Ver detalle de un marca', 'inventario.marca.show', 'Ve en detalle cada marca del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(63, 'Creación de marca', 'inventario.marca.create', 'Podría crear nuevas marca en el sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(64, 'Edición de marca', 'inventario.marca.edit', 'Podría editar cualquier dato de un marca del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(65, 'Eliminar marca', 'inventario.marca.destroy', 'Podría eliminar cualquier sabor del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(66, 'Navegar sabores', 'inventario.sabor.index', 'Lista y navega todos los sabores del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(67, 'Ver detalle de un sabores', 'inventario.sabor.show', 'Ve en detalle cada sabor del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(68, 'Creación de sabores', 'inventario.sabor.create', 'Podría crear nuevos sabors en el sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(69, 'Edición de sabores', 'inventario.sabor.edit', 'Podría editar cualquier dato de un sabor del sistema', '2018-06-28 02:02:08', '2018-06-28 02:02:08'),
(70, 'Eliminar sabor', 'inventario.sabor.destroy', 'Podría eliminar cualquier sabor del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(71, 'Navegar medida', 'inventario.medida.index', 'Lista y navega todos los medida del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(72, 'Ver detalle de un medida', 'inventario.medida.show', 'Ve en detalle cada medida del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(73, 'Creación de medida', 'inventario.medida.create', 'Podría crear nuevos medida en el sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(74, 'Edición de medida', 'inventario.medida.edit', 'Podría editar cualquier dato de un medida del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(75, 'Eliminar medida', 'inventario.medida.destroy', 'Podría eliminar cualquier medida del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(76, 'Navegar paquete', 'inventario.paquete.index', 'Lista y navega todos los paquete del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(77, 'Ver detalle de un paquete', 'inventario.paquete.show', 'Ve en detalle cada paquete del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(78, 'Creación de paquete', 'inventario.paquete.create', 'Podría crear nuevos paquete en el sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(79, 'Edición de paquete', 'inventario.paquete.edit', 'Podría editar cualquier dato de un paquete del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(80, 'Eliminar paquete', 'inventario.paquete.destroy', 'Podría eliminar cualquier paquete del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(81, 'Navegar tipoenvase', 'inventario.tipoenvase.index', 'Lista y navega todos los tipoenvase del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(82, 'Ver detalle de un tipoenvase', 'inventario.tipoenvase.show', 'Ve en detalle cada tipoenvase del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(83, 'Creación de tipoenvase', 'inventario.tipoenvase.create', 'Podría crear nuevos tipoenvase en el sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(84, 'Edición de tipoenvase', 'inventario.tipoenvase.edit', 'Podría editar cualquier dato de un sabor del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(85, 'Eliminar tipoenvase', 'inventario.tipoenvase.destroy', 'Podría eliminar cualquier sabor del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(86, 'Navegar tipos de bebidas', 'inventario.tipobebida.index', 'Lista y navega todos los tipos de bebidas del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(87, 'Ver detalle de un tipos de bebidas', 'inventario.tipobebida.show', 'Ve en detalle cada tipos de bebidas del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(88, 'Creación de tipos de bebidas', 'inventario.tipobebida.create', 'Podría crear nuevos tipos de bebidas en el sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(89, 'Edición de tipos de bebidas', 'inventario.tipobebida.edit', 'Podría editar cualquier dato de un tipos de bebidas del sistema', '2018-06-28 02:02:09', '2018-06-28 02:02:09'),
(90, 'Eliminar tipos de bebidas', 'inventario.tipobebida.destroy', 'Podría eliminar cualquier tipos de bebidas del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(91, 'Navegar producto', 'inventario.producto.index', 'Lista y navega todos los producto del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(92, 'Ver detalle de un producto', 'inventario.producto.show', 'Ve en detalle cada producto del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(93, 'Creación de producto', 'inventario.producto.create', 'Podría crear nuevos producto en el sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(94, 'Edición de producto', 'inventario.producto.edit', 'Podría editar cualquier dato de un producto del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(95, 'Eliminar producto', 'inventario.producto.destroy', 'Podría eliminar cualquier producto del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(96, 'Navegar inventario', 'inventario.index', 'Lista y navega todos los inventario del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(97, 'Ver detalle de un inventario', 'inventario.show', 'Ve en detalle cada inventario del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(98, 'Creación de inventario', 'inventario.create', 'Podría crear nuevos inventario en el sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(99, 'Edición de inventario', 'inventario.edit', 'Podría editar cualquier dato de un inventario del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(100, 'Eliminar inventario', 'inventario.destroy', 'Podría eliminar cualquier inventario del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(101, 'Navegar almacen', 'inventario.almacen.index', 'Lista y navega todos los almacen del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(102, 'Ver detalle de un almacen', 'inventario.almacen.show', 'Ve en detalle cada almacen del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(103, 'Creación de almacen', 'inventario.almacen.create', 'Podría crear nuevos almacen en el sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(104, 'Edición de almacen', 'inventario.almacen.edit', 'Podría editar cualquier dato de un almacen del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10'),
(105, 'Eliminar almacen', 'inventario.almacen.destroy', 'Podría eliminar cualquier almacen del sistema', '2018-06-28 02:02:10', '2018-06-28 02:02:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 31, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(2, 32, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(3, 33, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(4, 34, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(5, 36, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(6, 37, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(7, 38, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(8, 39, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(9, 40, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(10, 91, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(11, 92, 2, '2018-06-28 02:22:56', '2018-06-28 02:22:56'),
(12, 31, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(13, 32, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(14, 41, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(15, 42, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(18, 45, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(19, 91, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(20, 92, 3, '2018-06-28 02:25:52', '2018-06-28 02:25:52'),
(21, 1, 4, '2018-06-28 02:28:58', '2018-06-28 02:28:58'),
(22, 2, 4, '2018-06-28 02:28:58', '2018-06-28 02:28:58'),
(23, 3, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(24, 4, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(25, 5, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(26, 6, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(27, 7, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(28, 8, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(29, 9, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(30, 10, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(31, 11, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(32, 12, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(33, 13, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(34, 14, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(35, 15, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(36, 16, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(37, 17, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(38, 18, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(39, 19, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(40, 20, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(41, 21, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(42, 22, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(43, 23, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(44, 24, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(45, 25, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(46, 26, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(47, 27, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(48, 28, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(49, 29, 4, '2018-06-28 02:28:59', '2018-06-28 02:28:59'),
(50, 30, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(51, 31, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(52, 32, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(53, 33, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(54, 34, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(55, 35, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(56, 36, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(57, 37, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(58, 40, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(59, 41, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(60, 42, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(61, 46, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(62, 47, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(63, 48, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(64, 49, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(65, 50, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(66, 51, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(67, 52, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(68, 53, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(69, 54, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(70, 55, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(71, 56, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(72, 57, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(73, 58, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(74, 59, 4, '2018-06-28 02:29:00', '2018-06-28 02:29:00'),
(75, 60, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(76, 61, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(77, 62, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(78, 63, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(79, 64, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(80, 65, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(81, 66, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(82, 67, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(83, 68, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(84, 69, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(85, 70, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(86, 71, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(87, 72, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(88, 73, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(89, 74, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(90, 75, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(91, 76, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(92, 77, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(93, 78, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(94, 79, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(95, 80, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(96, 81, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(97, 82, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(98, 83, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(99, 84, 4, '2018-06-28 02:29:01', '2018-06-28 02:29:01'),
(100, 85, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(101, 86, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(102, 87, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(103, 88, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(104, 89, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(105, 90, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(106, 91, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(107, 92, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(108, 93, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(109, 94, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(110, 95, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(111, 96, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(112, 97, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(113, 98, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(114, 99, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(115, 100, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(116, 101, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(117, 102, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(118, 103, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(119, 104, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(120, 105, 4, '2018-06-28 02:29:02', '2018-06-28 02:29:02'),
(121, 36, 5, '2018-06-28 02:31:34', '2018-06-28 02:31:34'),
(122, 37, 5, '2018-06-28 02:31:34', '2018-06-28 02:31:34'),
(123, 46, 5, '2018-06-28 02:31:34', '2018-06-28 02:31:34'),
(124, 47, 5, '2018-06-28 02:31:34', '2018-06-28 02:31:34'),
(125, 48, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(126, 49, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(127, 50, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(128, 96, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(129, 97, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(130, 98, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(131, 99, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35'),
(132, 100, 5, '2018-06-28 02:31:35', '2018-06-28 02:31:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ci` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `paterno` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `materno` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ci`, `nombre`, `paterno`, `materno`, `sexo`, `fechaNac`, `telefono`) VALUES
(110, 'Juan', 'Tola', 'Tola', 'M', NULL, 1100),
(111, 'Fernando', 'chavez', 'chavez', 'M', NULL, 1110),
(510, 'Mario', 'baracos', 'baracos', 'M', NULL, 5100),
(511, 'marcelo', 'tinelli', 'tinelli', 'M', NULL, 5110),
(910, 'Mario', 'Balotelli', 'Colque', 'M', NULL, 910019),
(911, 'Asunto', 'Solucionado', 'Duran', 'M', NULL, 911119),
(912, 'Maria', 'Lexemas ', 'Torrico', 'F', NULL, 912219),
(913, 'Solomeo', 'Duran', 'quijote', 'M', NULL, 913319);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProd` int(11) NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish2_ci DEFAULT '1',
  `idSabor` int(11) DEFAULT NULL,
  `idMedida` int(11) NOT NULL,
  `idPaquete` int(11) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL,
  `idTipoEnvase` int(11) DEFAULT NULL,
  `idTipoBebida` int(11) DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProd`, `descripcion`, `precio`, `estado`, `idSabor`, `idMedida`, `idPaquete`, `idMarca`, `idTipoEnvase`, `idTipoBebida`, `imagen`) VALUES
(1, 'mendocina', 45, 'Activo', 1, 2, 1, 2, 1, 2, 'Portada-Malta2.jpg'),
(2, 'bueno', 100, 'Activo', 1, 1, 1, 1, 2, 1, 'Portada-Sinalco1.jpg'),
(3, 'Coca 2.0', 10, 'Activo', 1, 1, 1, 1, 1, 1, 'Portada-Mendocina.jpg'),
(4, 'Agua pres', 10, 'Activo', 4, 2, 1, 2, 2, 1, 'Portada-Agua-Mendocina.jpg'),
(5, 'Real pro', 8, 'Activo', 4, 2, 2, 4, 2, 3, 'Portada-Real.jpg'),
(6, 'express', 10, 'Activo', 4, 4, 1, 4, 1, 3, 'Portada-Real.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `limiteCredito` float DEFAULT NULL,
  `debe` float DEFAULT NULL,
  `haber` float DEFAULT NULL,
  `estado` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `limiteCredito`, `debe`, `haber`, `estado`) VALUES
(1, 'BEBIDAS BOLIVIANAS BBO', 1000000, 0, 1000000, 1),
(2, 'PACEÑA SRL', 200000, 0, 200000, 1),
(3, 'FRUT SRL', 50000, 0, 50000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `special`) VALUES
(1, 'admin', 'admin', 'acceso total', NULL, NULL, 'all-access'),
(2, 'R_Promotor', 'rol.promotor', 'tendra acceso vista de productos, crear cliente, tomar y eliminar pedidos', '2018-06-28 02:22:56', '2018-06-28 02:22:56', NULL),
(3, 'R_chofer', 'rol.chofer', 'permite registrar una entrega ver productos ver clientes', '2018-06-28 02:25:51', '2018-06-28 02:25:51', NULL),
(4, 'R_gerente', 'rol.gerente', 'tendra acceso especial', '2018-06-28 02:28:58', '2018-06-28 02:28:58', NULL),
(5, 'R_almacenero', 'rol.almacenero', 'tendra acceso al inventario ', '2018-06-28 02:31:34', '2018-06-28 02:31:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 20, NULL, NULL),
(2, 2, 34, '2018-06-28 02:37:36', '2018-06-28 02:37:36'),
(3, 2, 35, '2018-06-28 02:38:17', '2018-06-28 02:38:17'),
(4, 3, 36, '2018-06-28 02:38:56', '2018-06-28 02:38:56'),
(5, 3, 37, '2018-06-28 02:39:16', '2018-06-28 02:39:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabor`
--

CREATE TABLE `sabor` (
  `idSabor` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sabor`
--

INSERT INTO `sabor` (`idSabor`, `nombre`, `estado`) VALUES
(1, 'Cola', 1),
(2, 'Naranja', 1),
(3, 'Papaya', 1),
(4, 'sin sabor', 1),
(5, 'guarana', 1),
(6, 'pomelo', 1),
(7, 'manzana', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidaproducto`
--

CREATE TABLE `salidaproducto` (
  `idSalidaProducto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `obs` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciEmpleado` int(11) DEFAULT NULL,
  `idAlmacen` int(11) DEFAULT NULL,
  `idTipoSalida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectoralmacen`
--

CREATE TABLE `sectoralmacen` (
  `idSector` int(11) NOT NULL,
  `idAlmacen` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `idTel` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `ci` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipobebida`
--

CREATE TABLE `tipobebida` (
  `idTipoBebida` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipobebida`
--

INSERT INTO `tipobebida` (`idTipoBebida`, `tipo`, `estado`) VALUES
(1, 'Agua', 1),
(2, 'Gaseosa', 1),
(3, 'Cerveza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocompra`
--

CREATE TABLE `tipocompra` (
  `idTipoCompra` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipocompra`
--

INSERT INTO `tipocompra` (`idTipoCompra`, `descripcion`) VALUES
(1, 'al contado'),
(2, 'cuota'),
(3, 'al contado'),
(4, 'cuota'),
(5, 'al contado'),
(6, 'cuota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoentrada`
--

CREATE TABLE `tipoentrada` (
  `idTipoEntrada` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoenvase`
--

CREATE TABLE `tipoenvase` (
  `idTipoEnvase` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipoenvase`
--

INSERT INTO `tipoenvase` (`idTipoEnvase`, `tipo`, `estado`) VALUES
(1, 'Retornable', 1),
(2, 'No Retornable', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idTipoPago` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposalida`
--

CREATE TABLE `tiposalida` (
  `idTipoSalida` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ci` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `ci`) VALUES
(20, 'Luis Perez', 'perez@gmail.com', '$2y$10$UkVII8L6XjfgJ8fAvDUew.z7xzM9jWdz/.2CJz8BecTDTAu/EsLHK', 'cfmw7JSySyjrxnlbAT9pQ38yT9PJrZmThDLXE84PLIac9HUN36hndjVtIGxr', '2018-05-30 01:50:20', '2018-06-28 03:22:29', 0),
(34, 'JUAN TOLA TOLA', 'juan@gmail.com', '$2y$10$vfMU6lvwfDq0soedGryWYuh.fpAlVpWxoZLEFBR9sWQMML97vG2tS', 'cp5jZGG297JuA0p62rGbOqtYur3rYIQKcxlYPpvwFpxrrbVWAzZBQ3tGdYs0', '2018-06-27 20:35:08', '2018-06-28 04:01:22', 110),
(35, 'FERNANDO CHAVEZ CHAVEZ', 'fernando@gmail.com', '$2y$10$obxzAH7VrEuM3VHs8DLgPOkIb6JoBPWlW1MXOk/Zv3Yn1I0V7XW4u', 'rVwEZxdEornUY3YnsZDzoB50LRQYPhqFHYmau9UDXGihHDqxBKSbAOdYSzcK', '2018-06-27 20:37:05', '2018-06-28 05:32:07', 111),
(36, 'MARIO BARACOS BARACOS', 'mario@gmail.com', '$2y$10$Q9z1jBE4vo70qHWMpdCFju98EF4vnwKm6dZopG2kgMk9nCst1Mx1u', 'CQitQYS1KyZ2XGOt3c3aplnsld7rkJzmNZfYxq9t0mcQnetn3QrY0AlxzXPK', '2018-06-27 20:38:59', '2018-06-28 04:26:43', 510),
(37, 'MARCELO TINELLI TINELLI', 'marcelo@gmail.com', '$2y$10$NrEE2xF0xeWd0kF3AJOyAOPTT3VNaaseUtK8uBdpthnvD/uNIxt.u', 'zXcDMth5j5IaEmEJIHosYbnStmyLZ4CBgawjdWUWy7A9EOsEjD3HI7y00Hfl', '2018-06-27 20:42:23', '2018-06-28 04:29:49', 511);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciCliente` int(11) DEFAULT NULL,
  `ciPromotor` int(11) DEFAULT NULL,
  `ciChofer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `fecha`, `total`, `estado`, `ciCliente`, `ciPromotor`, `ciChofer`) VALUES
(1, '2018-06-27', 0, 'Aceptado', 910, 110, 510),
(2, '2018-06-28', 0, 'Entregado', 910, 111, 511),
(3, '2018-06-28', 0, 'Aceptado', 913, 111, 511);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaproducto`
--

CREATE TABLE `ventaproducto` (
  `idVenta` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float DEFAULT NULL,
  `importe` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ventaproducto`
--

INSERT INTO `ventaproducto` (`idVenta`, `idProd`, `cantidad`, `precio`, `importe`) VALUES
(1, 1, 2, 43, NULL),
(2, 3, 12, -11, NULL),
(2, 2, 2, 98, NULL),
(3, 5, 21, 12, NULL),
(3, 4, 2, 22, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `idZona` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`idZona`, `nombre`, `estado`) VALUES
(1, 'los poso', 1),
(2, 'la cuchilla', 1),
(3, 'las vegas', 1),
(4, 'valparaizo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonaempleado`
--

CREATE TABLE `zonaempleado` (
  `ci` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `dias` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `zonaempleado`
--

INSERT INTO `zonaempleado` (`ci`, `idZona`, `dias`) VALUES
(110, 3, ' Lunes Miercoles Viernes'),
(111, 4, ' Lunes Miercoles Viernes'),
(510, 3, ' Lunes Miercoles Viernes'),
(511, 4, ' Lunes Miercoles Viernes');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`idAlmacen`),
  ADD KEY `ciEmpleado` (`ciEmpleado`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ci`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`idCuota`),
  ADD KEY `idIngreso` (`idIngreso`),
  ADD KEY `idTipoPago` (`idTipoPago`);

--
-- Indices de la tabla `detalleentradaproducto`
--
ALTER TABLE `detalleentradaproducto`
  ADD PRIMARY KEY (`idEntrada`,`idProd`),
  ADD KEY `idProd` (`idProd`),
  ADD KEY `idEntrada` (`idEntrada`);

--
-- Indices de la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD PRIMARY KEY (`idProd`,`idIngreso`) USING BTREE,
  ADD KEY `idIngreso` (`idIngreso`),
  ADD KEY `idProd` (`idProd`);

--
-- Indices de la tabla `detallesalidaproducto`
--
ALTER TABLE `detallesalidaproducto`
  ADD PRIMARY KEY (`idSalidaProducto`,`idProd`),
  ADD KEY `idProd` (`idProd`),
  ADD KEY `idSalidaProducto` (`idSalidaProducto`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`idDir`),
  ADD KEY `idZona` (`idZona`),
  ADD KEY `ci` (`ci`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `idCargo` (`idCargo`);

--
-- Indices de la tabla `entradaproducto`
--
ALTER TABLE `entradaproducto`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `idAlmacen` (`idAlmacen`),
  ADD KEY `idTipoEntrada` (`idTipoEntrada`),
  ADD KEY `ciEmpleado` (`ciEmpleado`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idIngreso`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idTipoCompra` (`idTipoCompra`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idAlmacen`,`idProd`),
  ADD KEY `idProd` (`idProd`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idMedida`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`idPaquete`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ci`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProd`),
  ADD KEY `idMedida` (`idMedida`),
  ADD KEY `idPaquete` (`idPaquete`),
  ADD KEY `idSabor` (`idSabor`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idTipoBebida` (`idTipoBebida`),
  ADD KEY `idTipoEnvase` (`idTipoEnvase`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `sabor`
--
ALTER TABLE `sabor`
  ADD PRIMARY KEY (`idSabor`);

--
-- Indices de la tabla `salidaproducto`
--
ALTER TABLE `salidaproducto`
  ADD PRIMARY KEY (`idSalidaProducto`),
  ADD KEY `idAlmacen` (`idAlmacen`),
  ADD KEY `ciEmpleado` (`ciEmpleado`),
  ADD KEY `idTipoSalida` (`idTipoSalida`);

--
-- Indices de la tabla `sectoralmacen`
--
ALTER TABLE `sectoralmacen`
  ADD PRIMARY KEY (`idSector`,`idAlmacen`),
  ADD KEY `idAlmacen` (`idAlmacen`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`idTel`),
  ADD KEY `ci` (`ci`);

--
-- Indices de la tabla `tipobebida`
--
ALTER TABLE `tipobebida`
  ADD PRIMARY KEY (`idTipoBebida`);

--
-- Indices de la tabla `tipocompra`
--
ALTER TABLE `tipocompra`
  ADD PRIMARY KEY (`idTipoCompra`);

--
-- Indices de la tabla `tipoentrada`
--
ALTER TABLE `tipoentrada`
  ADD PRIMARY KEY (`idTipoEntrada`);

--
-- Indices de la tabla `tipoenvase`
--
ALTER TABLE `tipoenvase`
  ADD PRIMARY KEY (`idTipoEnvase`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idTipoPago`);

--
-- Indices de la tabla `tiposalida`
--
ALTER TABLE `tiposalida`
  ADD PRIMARY KEY (`idTipoSalida`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `ciCliente` (`ciCliente`),
  ADD KEY `ciPromotor` (`ciPromotor`);

--
-- Indices de la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD KEY `idProd` (`idProd`),
  ADD KEY `idVenta` (`idVenta`) USING BTREE;

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`idZona`);

--
-- Indices de la tabla `zonaempleado`
--
ALTER TABLE `zonaempleado`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `idZona` (`idZona`,`ci`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `idAlmacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
  MODIFY `idCuota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `idDir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `entradaproducto`
--
ALTER TABLE `entradaproducto`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `idMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idPaquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sabor`
--
ALTER TABLE `sabor`
  MODIFY `idSabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salidaproducto`
--
ALTER TABLE `salidaproducto`
  MODIFY `idSalidaProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectoralmacen`
--
ALTER TABLE `sectoralmacen`
  MODIFY `idSector` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `idTel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipobebida`
--
ALTER TABLE `tipobebida`
  MODIFY `idTipoBebida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipocompra`
--
ALTER TABLE `tipocompra`
  MODIFY `idTipoCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipoentrada`
--
ALTER TABLE `tipoentrada`
  MODIFY `idTipoEntrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoenvase`
--
ALTER TABLE `tipoenvase`
  MODIFY `idTipoEnvase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `idTipoPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposalida`
--
ALTER TABLE `tiposalida`
  MODIFY `idTipoSalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `idZona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`ciEmpleado`) REFERENCES `empleado` (`ci`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`);

--
-- Filtros para la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`idIngreso`) REFERENCES `ingreso` (`idIngreso`),
  ADD CONSTRAINT `cuota_ibfk_2` FOREIGN KEY (`idTipoPago`) REFERENCES `tipopago` (`idTipoPago`);

--
-- Filtros para la tabla `detalleentradaproducto`
--
ALTER TABLE `detalleentradaproducto`
  ADD CONSTRAINT `detalleentradaproducto_ibfk_1` FOREIGN KEY (`idEntrada`) REFERENCES `entradaproducto` (`idEntrada`),
  ADD CONSTRAINT `detalleentradaproducto_ibfk_2` FOREIGN KEY (`idProd`) REFERENCES `producto` (`idProd`);

--
-- Filtros para la tabla `detalleingreso`
--
ALTER TABLE `detalleingreso`
  ADD CONSTRAINT `detalleingreso_ibfk_1` FOREIGN KEY (`idProd`) REFERENCES `producto` (`idProd`),
  ADD CONSTRAINT `detalleingreso_ibfk_2` FOREIGN KEY (`idIngreso`) REFERENCES `ingreso` (`idIngreso`);

--
-- Filtros para la tabla `detallesalidaproducto`
--
ALTER TABLE `detallesalidaproducto`
  ADD CONSTRAINT `detallesalidaproducto_ibfk_1` FOREIGN KEY (`idSalidaProducto`) REFERENCES `salidaproducto` (`idSalidaProducto`),
  ADD CONSTRAINT `detallesalidaproducto_ibfk_2` FOREIGN KEY (`idProd`) REFERENCES `producto` (`idProd`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`idZona`) REFERENCES `zona` (`idZona`),
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`ci`) REFERENCES `cliente` (`ci`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`);

--
-- Filtros para la tabla `entradaproducto`
--
ALTER TABLE `entradaproducto`
  ADD CONSTRAINT `entradaproducto_ibfk_1` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`idAlmacen`),
  ADD CONSTRAINT `entradaproducto_ibfk_2` FOREIGN KEY (`idTipoEntrada`) REFERENCES `tipoentrada` (`idTipoEntrada`),
  ADD CONSTRAINT `entradaproducto_ibfk_3` FOREIGN KEY (`ciEmpleado`) REFERENCES `empleado` (`ci`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`),
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`idTipoCompra`) REFERENCES `tipocompra` (`idTipoCompra`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`idAlmacen`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`idProd`) REFERENCES `producto` (`idProd`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idMedida`) REFERENCES `medida` (`idMedida`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idPaquete`) REFERENCES `paquete` (`idPaquete`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idSabor`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`),
  ADD CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`idTipoBebida`) REFERENCES `tipobebida` (`idTipoBebida`),
  ADD CONSTRAINT `producto_ibfk_6` FOREIGN KEY (`idTipoEnvase`) REFERENCES `tipoenvase` (`idTipoEnvase`);

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `salidaproducto`
--
ALTER TABLE `salidaproducto`
  ADD CONSTRAINT `salidaproducto_ibfk_1` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`idAlmacen`),
  ADD CONSTRAINT `salidaproducto_ibfk_2` FOREIGN KEY (`ciEmpleado`) REFERENCES `empleado` (`ci`),
  ADD CONSTRAINT `salidaproducto_ibfk_3` FOREIGN KEY (`idTipoSalida`) REFERENCES `tiposalida` (`idTipoSalida`);

--
-- Filtros para la tabla `sectoralmacen`
--
ALTER TABLE `sectoralmacen`
  ADD CONSTRAINT `sectoralmacen_ibfk_1` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`idAlmacen`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`ciCliente`) REFERENCES `cliente` (`ci`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`ciPromotor`) REFERENCES `empleado` (`ci`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`ciPromotor`) REFERENCES `empleado` (`ci`);

--
-- Filtros para la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD CONSTRAINT `ventaproducto_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`),
  ADD CONSTRAINT `ventaproducto_ibfk_2` FOREIGN KEY (`idProd`) REFERENCES `producto` (`idProd`);

--
-- Filtros para la tabla `zonaempleado`
--
ALTER TABLE `zonaempleado`
  ADD CONSTRAINT `zonaempleado_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `empleado` (`ci`),
  ADD CONSTRAINT `zonaempleado_ibfk_2` FOREIGN KEY (`idZona`) REFERENCES `zona` (`idZona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
