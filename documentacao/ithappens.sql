-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2019 às 06:11
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ithappens`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `ID_estoque` bigint(20) NOT NULL,
  `produto` varchar(100) DEFAULT NULL,
  `qtde` int(11) DEFAULT NULL,
  `valor_prod` varchar(50) DEFAULT NULL,
  `filial` bigint(20) DEFAULT NULL,
  `cod_barra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filial`
--

CREATE TABLE `filial` (
  `ID` bigint(20) NOT NULL,
  `Nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `ID` bigint(20) NOT NULL,
  `id_pedido` bigint(20) DEFAULT NULL,
  `id_produto` bigint(20) DEFAULT NULL,
  `qtde_pedido` varchar(50) DEFAULT NULL,
  `valor_un` varchar(50) DEFAULT NULL,
  `valor_total` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `ID` bigint(20) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `id_pag_pedido` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `ID` bigint(20) NOT NULL,
  `filial` bigint(20) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `observacao` text NOT NULL,
  `tipo_pedido` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`ID_estoque`),
  ADD UNIQUE KEY `cod_barra` (`cod_barra`),
  ADD KEY `tbl_estoque_fk0` (`filial`);

--
-- Índices para tabela `filial`
--
ALTER TABLE `filial`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbl_itens_pedido_fk0` (`id_pedido`),
  ADD KEY `tbl_itens_pedido_fk1` (`id_produto`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbl_forma_pag_fk0` (`id_pag_pedido`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbl_pedido_fk0` (`filial`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `ID_estoque` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `filial`
--
ALTER TABLE `filial`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `tbl_estoque_fk0` FOREIGN KEY (`filial`) REFERENCES `filial` (`ID`);

--
-- Limitadores para a tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `tbl_itens_pedido_fk0` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`ID`),
  ADD CONSTRAINT `tbl_itens_pedido_fk1` FOREIGN KEY (`id_produto`) REFERENCES `estoque` (`ID_estoque`);

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `tbl_forma_pag_fk0` FOREIGN KEY (`id_pag_pedido`) REFERENCES `pedido` (`ID`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `tbl_pedido_fk0` FOREIGN KEY (`filial`) REFERENCES `filial` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
