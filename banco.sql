-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22-Jan-2025 às 09:56
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jk_informatica1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
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
-- Extraindo dados da tabela `clientes`
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
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idEquipamento` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `numeroSerie` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`idEquipamento`, `idCliente`, `tipo`, `marca`, `modelo`, `numeroSerie`) VALUES
(1, 1, 'Telemóvel', 'Apple', 'iPhone X', 'SN-APL-100'),
(2, 2, 'Laptop', 'HP', 'Pavilion 15', 'SN-HP-200'),
(3, 3, 'Tablet', 'Samsung', 'Galaxy Tab S6', 'SN-SSG-300'),
(4, 4, 'Telemóvel', 'Xiaomi', 'Redmi Note 10', 'SN-XMI-400'),
(5, 5, 'Console', 'Sony', 'PlayStation 4', 'SN-PS4-500'),
(6, 6, 'Laptop', 'Asus', 'ZenBook UX430', 'SN-ASU-600'),
(7, 7, 'Smart TV', 'LG', 'SmartTV 43\"', 'SN-LG-700'),
(8, 8, 'Telemóvel', 'Huawei', 'P30 Lite', 'SN-HUW-800'),
(9, 9, 'Desktop', 'Dell', 'OptiPlex 3070', 'SN-DELL-900'),
(10, 10, 'Laptop', 'Lenovo', 'IdeaPad 320', 'SN-LNV-1000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_estado`
--

CREATE TABLE `historico_estado` (
  `idHistorico` int(11) NOT NULL,
  `idReparacao` int(11) NOT NULL,
  `dataMudanca` datetime NOT NULL,
  `estadoAnterior` varchar(50) DEFAULT NULL,
  `estadoNovo` varchar(50) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historico_estado`
--

INSERT INTO `historico_estado` (`idHistorico`, `idReparacao`, `dataMudanca`, `estadoAnterior`, `estadoNovo`, `observacoes`, `idUser`) VALUES
(1, 1, '2024-11-02 10:00:00', 'Em análise', 'A reparar', 'Ecrã encomendado', 2),
(2, 1, '2024-11-03 15:30:00', 'A reparar', 'Pronto', 'Finalizada a substituição do ecrã', 2),
(3, 2, '2024-11-02 09:00:00', 'Em análise', 'A reparar', 'Início de reparação das portas USB', 3),
(4, 3, '2024-11-03 18:00:00', 'Em análise', 'Orçamento', 'Orçamento enviado ao cliente', 3),
(5, 4, '2024-11-05 11:00:00', 'Em análise', 'A reparar', 'Placa mãe encomendada', 6),
(6, 8, '2024-11-08 12:00:00', 'A reparar', 'Pronto', 'Ecrã tátil substituído com sucesso', 8),
(7, 6, '2024-11-07 14:00:00', 'Em análise', 'A reparar', 'Teclado novo a ser instalado', 2),
(8, 7, '2024-11-08 09:30:00', 'Em análise', 'Orçamento', 'Orçamento enviado ao cliente', 9),
(9, 5, '2024-11-07 17:00:00', 'Em análise', 'A reparar', 'Substituição drive Blu-ray', 2),
(10, 10, '2024-11-11 16:00:00', 'Em análise', 'A reparar', 'Ventoinha encomendada', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
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

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`idPagamento`, `idReparacao`, `dataPagamento`, `valorPago`, `metodoPagamento`, `detalhes`, `idUser`) VALUES
(1, 1, '2024-11-03', 120.50, 'Multibanco', 'Pagamento integral', 2),
(2, 2, '2024-11-11', 80.00, 'Dinheiro', 'Pago na loja', 4),
(3, 3, '2024-11-15', 45.00, 'MB Way', 'Cliente aprovou tarde', 3),
(4, 4, '2024-11-12', 100.00, 'Cartão', 'Pagamento final', 6),
(5, 5, '2024-11-10', 75.00, 'Dinheiro', 'Pago na receção', 2),
(6, 6, '2024-11-16', 60.00, 'Multibanco', 'Cliente levantou dia 16', 3),
(7, 7, '2024-11-14', 40.00, 'Cartão', 'Orçamento aprovado', 9),
(8, 8, '2024-11-09', 110.00, 'Dinheiro', 'Pago aquando entrega', 8),
(9, 9, '2024-11-21', 50.00, 'MB Way', 'Cliente fez MB Way', 4),
(10, 10, '2024-11-18', 70.00, 'Transferência', 'Comprovativo bancário', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reparacoes`
--

CREATE TABLE `reparacoes` (
  `idReparacao` int(11) NOT NULL,
  `idEquipamento` int(11) NOT NULL,
  `dataEntrada` date NOT NULL,
  `dataPrevisao` date DEFAULT NULL,
  `problema` text DEFAULT NULL,
  `orcamento` decimal(10,2) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `reparacoes`
--

INSERT INTO `reparacoes` (`idReparacao`, `idEquipamento`, `dataEntrada`, `dataPrevisao`, `problema`, `orcamento`, `estado`, `observacoes`) VALUES
(1, 1, '2024-11-01', '2024-11-05', 'Ecrã partido', 120.50, 'Em análise', 'Cliente reportou queda ao chão'),
(2, 2, '2024-11-02', '2024-11-10', 'Portas USB avariadas', 80.00, 'A reparar', 'Técnico confirmou oxidação'),
(3, 3, '2024-11-03', '2024-11-06', 'Bateria descarrega rápido', 45.00, 'Orçamento', 'Aguardando aprovação do cliente'),
(4, 4, '2024-11-04', '2024-11-12', 'Não liga', 100.00, 'Em análise', 'Possível problema placa mãe'),
(5, 5, '2024-11-05', '2024-11-10', 'Leitor de discos não funciona', 75.00, 'A reparar', 'Substituir drive Blu-ray'),
(6, 6, '2024-11-06', '2024-11-15', 'Teclado com teclas soltas', 60.00, 'A reparar', 'Teclado novo encomendado'),
(7, 7, '2024-11-07', '2024-11-14', 'Não emparelha Wi-Fi', 40.00, 'Orçamento', 'Cliente vai confirmar'),
(8, 8, '2024-11-08', '2024-11-09', 'Ecrã tactil não responde', 110.00, 'Pronto', 'Reparado e testado'),
(9, 9, '2024-11-09', '2024-11-20', 'Falhas de arranque do Windows', 50.00, 'Em análise', 'Pode precisar formatação'),
(10, 10, '2024-11-10', '2024-11-18', 'Aquecimento excessivo', 70.00, 'A reparar', 'Substituir ventoinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
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
-- Extraindo dados da tabela `users`
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
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idEquipamento`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Índices para tabela `historico_estado`
--
ALTER TABLE `historico_estado`
  ADD PRIMARY KEY (`idHistorico`),
  ADD KEY `idReparacao` (`idReparacao`),
  ADD KEY `idUser` (`idUser`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`idPagamento`),
  ADD KEY `idReparacao` (`idReparacao`),
  ADD KEY `idUser` (`idUser`);

--
-- Índices para tabela `reparacoes`
--
ALTER TABLE `reparacoes`
  ADD PRIMARY KEY (`idReparacao`),
  ADD KEY `idEquipamento` (`idEquipamento`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idEquipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `historico_estado`
--
ALTER TABLE `historico_estado`
  MODIFY `idHistorico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `idPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `reparacoes`
--
ALTER TABLE `reparacoes`
  MODIFY `idReparacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD CONSTRAINT `equipamentos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);

--
-- Limitadores para a tabela `historico_estado`
--
ALTER TABLE `historico_estado`
  ADD CONSTRAINT `historico_estado_ibfk_1` FOREIGN KEY (`idReparacao`) REFERENCES `reparacoes` (`idReparacao`),
  ADD CONSTRAINT `historico_estado_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`idReparacao`) REFERENCES `reparacoes` (`idReparacao`),
  ADD CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Limitadores para a tabela `reparacoes`
--
ALTER TABLE `reparacoes`
  ADD CONSTRAINT `reparacoes_ibfk_1` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamentos` (`idEquipamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- Estrutura da tabela `Estado`
CREATE TABLE IF NOT EXISTS `Estado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Extraindo dados da tabela `Estado`
INSERT INTO `Estado` (`idEstado`, `descricao`) VALUES
(1, 'Orçamento'),
(2, 'A reparar'),
(3, 'Pronto'),
(4, 'Em análise'),
(5, 'Cancelado')
ON DUPLICATE KEY UPDATE descricao=VALUES(descricao);


-- Alterar a tabela `reparacoes` para adicionar a coluna `idEstado`
ALTER TABLE `reparacoes` ADD COLUMN `idEstado` int(11) NOT NULL AFTER `observacoes`;

-- Atualizar a tabela `reparacoes` para usar a coluna `idEstado`
UPDATE `reparacoes` SET `idEstado` = 1 WHERE `estado` = 'Orçamento';
UPDATE `reparacoes` SET `idEstado` = 2 WHERE `estado` = 'A reparar';
UPDATE `reparacoes` SET `idEstado` = 3 WHERE `estado` = 'Pronto';
UPDATE `reparacoes` SET `idEstado` = 4 WHERE `estado` = 'Em análise';
UPDATE `reparacoes` SET `idEstado` = 5 WHERE `estado` = 'Cancelado';

-- Remover a coluna `estado` da tabela `reparacoes`
ALTER TABLE `reparacoes` DROP COLUMN `estado`;

-- Adicionar chave estrangeira para `idEstado`
ALTER TABLE `reparacoes` ADD CONSTRAINT `fk_estado` FOREIGN KEY (`idEstado`) REFERENCES `Estado`(`idEstado`);