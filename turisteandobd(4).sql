-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 08:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turisteandobd`
--

-- --------------------------------------------------------

--
-- Table structure for table `alojamiento`
--

CREATE TABLE `alojamiento` (
  `idalojamiento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `precio` int(11) NOT NULL,
  `moneda` text NOT NULL,
  `fechaentrada` date NOT NULL,
  `fechasalida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alojamiento`
--

INSERT INTO `alojamiento` (`idalojamiento`, `nombre`, `direccion`, `precio`, `moneda`, `fechaentrada`, `fechasalida`) VALUES
(1, 'The Randolph Hotel', 'Beaumont Street, Oxford OX1 2LN, Reino Unido', 10000, 'libra', '2025-06-20', '2025-07-20'),
(2, 'The Grand Hotel & Spa', 'Station Rise, York YO1 6GD, Reino Unido', 20000, 'libra', '2025-10-10', '2025-11-10'),
(3, 'Le Maison', 'Francia-Paris-Le Mour 1777', 700, 'Euro', '2025-06-21', '2025-06-28'),
(4, 'Le Maison', 'Francia - París - Le Mour 1777', 700, 'Euro', '2025-06-21', '2025-06-28'),
(5, 'Hotel Roma Bella', 'Italia - Roma - Via Veneto 45', 680, 'Euro', '2025-07-01', '2025-07-08'),
(6, 'Sunset Beach Resort', 'México - Cancún - Blvd. Kukulcán Km 12', 850, 'Dolar', '2025-07-10', '2025-07-17'),
(7, 'Andes Lodge', 'Chile - Santiago - Av. Providencia 912', 530, 'Dolar', '2025-08-05', '2025-08-12'),
(8, 'Patagonia Suites', 'Argentina - Bariloche - Av. Bustillo 12345', 600, 'Dolar', '2025-07-15', '2025-07-22'),
(9, 'Royal Garden Hotel', 'Inglaterra - Londres - Kensington Rd 61', 920, 'Libra', '2025-08-20', '2025-08-27'),
(10, 'Blue Horizon Inn', 'Brasil - Río de Janeiro - Rua Atlântica 1980', 700, 'Dolar', '2025-09-01', '2025-09-08'),
(11, 'El Caminante Hostal', 'Perú - Cusco - Av. Sol 222', 410, 'Dolar', '2025-10-03', '2025-10-10'),
(12, 'Tokyo Capsule Hotel', 'Japón - Tokio - Shinjuku 5-2-10', 490, 'Yen', '2025-09-12', '2025-09-19'),
(13, 'The Manhattan Stay', 'EE.UU - Nueva York - 5th Avenue 891', 1100, 'Dolar', '2025-11-01', '2025-11-08'),
(14, 'La Posada del Viento', 'Argentina - Salta - Zuviría 445', 450, 'Dolar', '2025-06-30', '2025-07-06'),
(15, 'Golden Palace', 'Tailandia - Bangkok - Sukhumvit 29', 520, 'Dolar', '2025-12-01', '2025-12-08'),
(16, 'Hotel Neve', 'Suiza - Zermatt - Bahnhofstrasse 66', 970, 'Franco Suizo', '2025-12-20', '2025-12-27'),
(17, 'Casa Colonial', 'Colombia - Cartagena - Calle de la Media Luna 8', 580, 'Dolar', '2025-07-18', '2025-07-25'),
(18, 'Refugio Austral', 'Argentina - El Calafate - Roca 115', 500, 'Dolar', '2025-08-14', '2025-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido`, `contraseña`, `email`, `telefono`) VALUES
(23, 'Esteban', 'Lumovich', '54321', 'esteban@gmail.com', 237854);

-- --------------------------------------------------------

--
-- Table structure for table `cobro`
--

CREATE TABLE `cobro` (
  `idcobro` int(11) NOT NULL,
  `montopagado` int(11) NOT NULL,
  `metodopago` varchar(255) NOT NULL,
  `estadopago` varchar(255) NOT NULL,
  `fechacobro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `idemail` int(11) NOT NULL,
  `destinatario` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `cuerpo` varchar(255) NOT NULL,
  `fechaenvio` datetime NOT NULL,
  `estadoenvio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jefeventas`
--

CREATE TABLE `jefeventas` (
  `idjefeventas` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jefeventas`
--

INSERT INTO `jefeventas` (`idjefeventas`, `nombre`, `apellido`, `cargo`, `email`, `contraseña`) VALUES
(4, 'Admin', 'Admin', 'jefe', 'admin@gmail.com', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE `paquete` (
  `idpaquete` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `moneda` text NOT NULL,
  `fechaida` date NOT NULL,
  `fechavuelta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`idpaquete`, `nombre`, `descripcion`, `precio`, `moneda`, `fechaida`, `fechavuelta`) VALUES
(4, 'Francia - París: La ciudad del amor', 'Paquete incluye: 1 mes en París / Para 2 personas / Hotel 4 estrellas / All inclusive / Transporte aéreo incluido.', 4500, 'Dolar', '2025-06-21', '2025-07-21'),
(5, 'Italia - Venecia: Romance sobre el agua', 'Incluye 10 noches / Para 2 personas / Hotel boutique frente al canal / Paseos en góndola / Desayuno incluido.', 3200, 'Dolar', '2025-07-05', '2025-07-15'),
(6, 'España - Barcelona: Arte y playa', 'Incluye: 2 semanas / Hotel céntrico / Tours por Gaudí / Acceso a playas y tapas / Transporte local.', 3600, 'Dolar', '2025-08-01', '2025-08-14'),
(7, 'Grecia - Santorini: Paraíso azul y blanco', 'Incluye 12 días / Villa con vista al mar / Traslados internos / Tour por islas volcánicas / Cena romántica.', 4100, 'Dolar', '2025-09-10', '2025-09-22'),
(8, 'México - Cancún: Caribe total', 'Paquete all inclusive / 7 días / Resort frente al mar / Excursión a Chichén Itzá / Bebidas y comidas ilimitadas.', 2800, 'Dolar', '2025-07-20', '2025-07-27'),
(9, 'Argentina - Mendoza: Ruta del vino', 'Incluye: 5 días / Hotel 3 estrellas / Catas en bodegas / Cena gourmet / Traslados incluidos.', 1200, 'Dolar', '2025-08-10', '2025-08-15'),
(10, 'Brasil - Río de Janeiro: Samba y playa', '8 días / Hotel en Copacabana / Excursión al Cristo Redentor / Desayuno incluido / Show de samba.', 2200, 'Dolar', '2025-09-01', '2025-09-08'),
(11, 'Perú - Cusco y Machu Picchu', '10 días / Tour guiado completo / Trenes y entradas / Hotel + desayuno / Transporte interno incluido.', 2400, 'Dolar', '2025-07-25', '2025-08-04'),
(12, 'EE.UU - Nueva York: La gran manzana', 'Incluye 1 semana / Hotel 4 estrellas / City pass con atracciones / Traslados desde JFK.', 3800, 'Dolar', '2025-10-05', '2025-10-12'),
(13, 'Tailandia - Bangkok y Phi Phi', '14 días / Aéreos incluidos / Hoteles en ciudad y playa / Visitas a templos / Tour en barco.', 4300, 'Dolar', '2025-11-01', '2025-11-15'),
(14, 'Colombia - Cartagena: Sol y historia', '7 noches / Hotel colonial / City tour / Playa y vida nocturna / Desayuno buffet.', 1900, 'Dolar', '2025-08-18', '2025-08-25'),
(15, 'Chile - Patagonia Austral', 'Paquete de aventura: 6 días / Trekking en Torres del Paine / Camping + refugios / Guías incluidos.', 1700, 'Dolar', '2025-12-01', '2025-12-07'),
(16, 'Egipto - El Cairo y Luxor', 'Incluye 12 noches / Vuelos internos / Crucero por el Nilo / Visitas a pirámides y templos / Pensión completa.', 4600, 'Dolar', '2025-10-10', '2025-10-22'),
(17, 'Turquía - Estambul y Capadocia', '10 días / Paseo en globo / Hoteles boutique / Tours históricos / Transporte interno incluido.', 4000, 'Dolar', '2025-09-15', '2025-09-25'),
(18, 'Argentina - El Calafate y Ushuaia', 'Paquete sur argentino: 7 días / Vuelos domésticos / Hotel 3* / Glaciar + Tren del Fin del Mundo.', 1600, 'Dolar', '2025-07-10', '2025-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idjefeventas` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idemail` int(11) NOT NULL,
  `idcobro` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `idalojamiento` int(11) NOT NULL,
  `idtransporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `moneda` text NOT NULL,
  `fechaida` date DEFAULT NULL,
  `fechavuelta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `codigo`, `descripcion`, `precio`, `moneda`, `fechaida`, `fechavuelta`) VALUES
(15, 'Brasil - Sao Paulo', '1', 'Disfrutá de unas vacaciones hermosas en Sao Paulo con playas, cultura y compras.', 1100, 'Dolar', '2025-06-21', '2025-07-01'),
(16, 'Chile - Santiago', '2', 'Descubrí la moderna ciudad de Santiago y la cordillera de los Andes.', 950, 'Dolar', '2025-07-10', '2025-07-17'),
(17, 'Uruguay - Punta del Este', '3', 'Relax y lujo frente al mar en la exclusiva Punta del Este.', 1250, 'Dolar', '2025-08-01', '2025-08-08'),
(18, 'Perú - Cusco y Machu Picchu', '4', 'Viví una experiencia mística en los Andes visitando Machu Picchu.', 1350, 'Dolar', '2025-09-05', '2025-09-12'),
(19, 'México - Cancún', '5', 'Playas paradisíacas, ruinas mayas y fiestas en el Caribe mexicano.', 1600, 'Dolar', '2025-07-20', '2025-07-30'),
(20, 'España - Madrid', '6', 'Recorré la capital española entre historia, arte y tapas.', 1800, 'Dolar', '2025-08-15', '2025-08-25'),
(21, 'Italia - Roma', '7', 'La Ciudad Eterna te espera con ruinas, gastronomía y arte.', 1850, 'Dolar', '2025-09-10', '2025-09-20'),
(22, 'Argentina - Bariloche', '8', 'Lagos, montañas y chocolate en el sur argentino.', 950, 'Dolar', '2025-07-05', '2025-07-12'),
(23, 'Bolivia - Salar de Uyuni', '9', 'Explorá el desierto blanco más grande del mundo.', 1050, 'Dolar', '2025-10-01', '2025-10-09'),
(24, 'Colombia - Cartagena', '10', 'Colonial, colorida y caribeña: una joya para tus vacaciones.', 1200, 'Dolar', '2025-07-22', '2025-07-29'),
(25, 'Francia - París', '11', 'Romance, arte y moda en la Ciudad Luz.', 2100, 'Dolar', '2025-08-10', '2025-08-20'),
(26, 'Grecia - Atenas y Santorini', '12', 'Historia antigua y playas de postal en el Egeo.', 1950, 'Dolar', '2025-09-01', '2025-09-11'),
(27, 'Brasil - Río de Janeiro', '13', 'Subí al Cristo Redentor y relajate en Copacabana.', 1300, 'Dolar', '2025-07-15', '2025-07-25'),
(28, 'Panamá - Ciudad de Panamá', '14', 'Modernidad, canal histórico y playas cerca.', 1100, 'Dolar', '2025-10-15', '2025-10-22'),
(29, 'Argentina - El Calafate', '15', 'Visitá el imponente Glaciar Perito Moreno en la Patagonia.', 1250, 'Dolar', '2025-11-05', '2025-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `transporte`
--

CREATE TABLE `transporte` (
  `idtransporte` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` text NOT NULL,
  `precio` int(11) NOT NULL,
  `moneda` text NOT NULL,
  `fechareserva` date NOT NULL,
  `fechadevolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transporte`
--

INSERT INTO `transporte` (`idtransporte`, `nombre`, `ubicacion`, `precio`, `moneda`, `fechareserva`, `fechadevolucion`) VALUES
(18, 'Toyota Corolla', 'Argentina - Buenos Aires - Tandil - Moreno 1947', 75, 'Dolar', '2025-06-21', '2025-07-01'),
(19, 'Chevrolet Onix', 'Argentina - Córdoba - Villa Carlos Paz - Av. Libertad 125', 65, 'Dolar', '2025-07-05', '2025-07-12'),
(20, 'Ford Ka', 'Argentina - Mendoza - Godoy Cruz - San Martín 850', 60, 'Dolar', '2025-08-01', '2025-08-08'),
(21, 'Volkswagen Gol', 'Argentina - Salta - Salta Capital - Caseros 301', 58, 'Dolar', '2025-09-10', '2025-09-17'),
(22, 'Renault Sandero', 'Argentina - Santa Fe - Rosario - Bv. Oroño 2100', 62, 'Dolar', '2025-07-15', '2025-07-22'),
(23, 'Fiat Cronos', 'Argentina - Jujuy - San Salvador - Güemes 550', 64, 'Dolar', '2025-06-28', '2025-07-04'),
(24, 'Peugeot 208', 'Argentina - Neuquén - Neuquén Capital - Ruta 22 KM 1230', 70, 'Dolar', '2025-08-10', '2025-08-18'),
(25, 'Honda Fit', 'Argentina - Tucumán - San Miguel - 25 de Mayo 1345', 66, 'Dolar', '2025-07-03', '2025-07-10'),
(26, 'Citroën C3', 'Argentina - Chubut - Puerto Madryn - Belgrano 911', 68, 'Dolar', '2025-07-20', '2025-07-27'),
(27, 'Nissan Versa', 'Argentina - La Pampa - Santa Rosa - Alsina 435', 73, 'Dolar', '2025-09-01', '2025-09-09'),
(28, 'Volkswagen Polo', 'Argentina - Misiones - Posadas - Bolívar 1333', 72, 'Dolar', '2025-10-05', '2025-10-12'),
(29, 'Toyota Yaris', 'Argentina - Río Negro - Bariloche - Av. de los Pioneros 300', 76, 'Dolar', '2025-11-01', '2025-11-10'),
(30, 'Ford Fiesta', 'Argentina - Entre Ríos - Paraná - Echagüe 899', 61, 'Dolar', '2025-06-25', '2025-07-02'),
(31, 'Chevrolet Prisma', 'Argentina - San Luis - Merlo - Av. del Sol 220', 67, 'Dolar', '2025-08-15', '2025-08-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alojamiento`
--
ALTER TABLE `alojamiento`
  ADD PRIMARY KEY (`idalojamiento`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cobro`
--
ALTER TABLE `cobro`
  ADD PRIMARY KEY (`idcobro`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`idemail`);

--
-- Indexes for table `jefeventas`
--
ALTER TABLE `jefeventas`
  ADD PRIMARY KEY (`idjefeventas`);

--
-- Indexes for table `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`idpaquete`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indexes for table `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`idtransporte`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alojamiento`
--
ALTER TABLE `alojamiento`
  MODIFY `idalojamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cobro`
--
ALTER TABLE `cobro`
  MODIFY `idcobro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `idemail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jefeventas`
--
ALTER TABLE `jefeventas`
  MODIFY `idjefeventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idpaquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transporte`
--
ALTER TABLE `transporte`
  MODIFY `idtransporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
