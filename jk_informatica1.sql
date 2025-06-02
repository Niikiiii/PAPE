-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 12:53 PM
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
-- Database: `jk_informatica1`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telemovel` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nif` varchar(20) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `telemovel`, `email`, `nif`, `morada`) VALUES
(1, 'João Silva', '+351910000001', 'joao@cliente.com', '123456789', 'Rua A, nº 10, Lisboa'),
(2, 'Maria Oliveira', '+351910000002', 'maria@cliente.com', '987654321', 'Rua B, nº 20, Porto'),
(3, 'Carlos Pereira', '+351910000003', 'carlos@cliente.com', '159753456', 'Av. C, nº 30, Braga'),
(4, 'Sofia Santos', '+351910000004', 'sofia@cliente.com', '357159456', 'Rua D, nº 40, Coimbra'),
(5, 'Luís Fernandes', '+351910000005', 'luis@cliente.com', '456123789', 'Av. E, nº 50, Faro'),
(6, 'Ana Matos', '+351910000006', 'ana@cliente.com', '789456123', 'Rua F, nº 60, Évora'),
(7, 'Pedro Martins', '+351910000007', 'pedro@cliente.com', '246813579', 'Trav. G, nº 70, Gaia'),
(8, 'Helena Alves', '+351910000008', 'helena@cliente.com', '135792468', 'Rua H, nº 80, Aveiro'),
(9, 'Ricardo Cunha', '+351910000008', 'ricardo@cliente.com', '987321654', 'Av. I, nº 90, Viseu'),
(10, 'Diana Correia', '+351910000010', 'diana@cliente.com', '321654987', 'Lg. J, nº 100, Leiria');

-- --------------------------------------------------------

--
-- Table structure for table `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idEquipamento` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `numeroSerie` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipamentos`
--

INSERT INTO `equipamentos` (`idEquipamento`, `idCliente`, `tipo`, `marca`, `modelo`, `numeroSerie`, `estado`) VALUES
(1, 1, 'Telemóvel', 'Apple', 'iPhone X', 'SN-APL-100', NULL),
(2, 2, 'Laptop', 'HP', 'Pavilion 15', 'SN-HP-200', NULL),
(3, 3, 'Tablet', 'Samsung', 'Galaxy Tab S6', 'SN-SSG-300', NULL),
(4, 4, 'Telemóvel', 'Xiaomi', 'Redmi Note 10', 'SN-XMI-400', NULL),
(5, 5, 'Console', 'Sony', 'PlayStation 4', 'SN-PS4-500', NULL),
(6, 6, 'Laptop', 'Asus', 'ZenBook UX430', 'SN-ASU-600', NULL),
(7, 7, 'Smart TV', 'LG', 'SmartTV 43\"', 'SN-LG-700', NULL),
(8, 8, 'Telemóvel', 'Huawei', 'P30 Lite', 'SN-HUW-800', NULL),
(9, 9, 'Desktop', 'Dell', 'OptiPlex 3070', 'SN-DELL-900', NULL),
(10, 10, 'Laptop', 'Lenovo', 'IdeaPad 320', 'SN-LNV-1000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`idEstado`, `descricao`) VALUES
(1, 'Orçamento'),
(2, 'A reparar'),
(3, 'Pronto'),
(4, 'Em análise'),
(5, 'Cancelado');

-- --------------------------------------------------------

--
-- Table structure for table `pagamentos`
--

CREATE TABLE `pagamentos` (
  `idPagamento` int(11) NOT NULL,
  `idReparacao` int(11) NOT NULL,
  `dataPagamento` date NOT NULL,
  `valorPago` decimal(10,2) NOT NULL,
  `metodoPagamento` varchar(50) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reparacoes`
--

CREATE TABLE `reparacoes` (
  `idReparacao` int(11) NOT NULL,
  `idEquipamento` int(11) NOT NULL,
  `dataEntrada` date NOT NULL,
  `dataPrevisao` date DEFAULT NULL,
  `problema` text DEFAULT NULL,
  `orcamento` decimal(10,2) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomeCompleto` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tipoUtilizador` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `password`, `nomeCompleto`, `email`, `tipoUtilizador`) VALUES
(1, 'admin', '1', 'Administrador do Sistema', 'admin@exemplo.com', 'Admin'),
(2, 'tecnico1', 'hash2', 'Carlos Teixeira', 'carlos@exemplo.com', 'Tecnico'),
(3, 'tecnico2', 'hash3', 'Ana Manso', 'ana@exemplo.com', 'Tecnico'),
(4, 'recep1', 'hash4', 'Pedro Soares', 'pedro@exemplo.com', 'Rececionista'),
(5, 'recep2', 'hash5', 'Marta Santos', 'marta@exemplo.com', 'Rececionista'),
(6, 'tecnico3', 'hash6', 'Fábio Costa', 'fabio@exemplo.com', 'Tecnico'),
(7, 'admin2', 'hash7', 'Sónia Gomes', 'sgomes@exemplo.com', 'Admin'),
(8, 'tecnico4', 'hash8', 'João Rocha', 'joao@exemplo.com', 'Tecnico'),
(9, 'recep3', 'hash9', 'Raquel Silva', 'raquel@exemplo.com', 'Rececionista'),
(10, 'estagiario', 'hash10', 'Tiago Marques', 'tiago@exemplo.com', 'Tecnico');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idEquipamento`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indexes for table `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`idPagamento`),
  ADD KEY `idReparacao` (`idReparacao`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `reparacoes`
--
ALTER TABLE `reparacoes`
  ADD PRIMARY KEY (`idReparacao`),
  ADD KEY `idEquipamento` (`idEquipamento`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idEquipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `idPagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reparacoes`
--
ALTER TABLE `reparacoes`
  MODIFY `idReparacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD CONSTRAINT `fk_equipamentos_cliente` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `fk_pagamentos_reparacao` FOREIGN KEY (`idReparacao`) REFERENCES `reparacoes` (`idReparacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pagamentos_user` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reparacoes`
--
ALTER TABLE `reparacoes`
  ADD CONSTRAINT `fk_reparacoes_equipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamentos` (`idEquipamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reparacoes_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
