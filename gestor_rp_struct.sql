-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Abr-2022 às 02:25
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestor_rp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `erros`
--

CREATE TABLE `erros` (
  `id` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_caixas`
--

CREATE TABLE `estoque_caixas` (
  `id_caixa` int(10) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_pedidos`
--

CREATE TABLE `estoque_pedidos` (
  `id_pedido` int(10) NOT NULL,
  `codigo` int(10) DEFAULT NULL,
  `nome_cliente` varchar(500) DEFAULT NULL,
  `id_caixa` int(10) DEFAULT NULL,
  `observacoes` varchar(1000) DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `data_saida_baixa` date DEFAULT NULL,
  `taxa_comissao` decimal(10,2) DEFAULT NULL,
  `valor_pedido` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `erros`
--
ALTER TABLE `erros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estoque_caixas`
--
ALTER TABLE `estoque_caixas`
  ADD PRIMARY KEY (`id_caixa`);

--
-- Índices para tabela `estoque_pedidos`
--
ALTER TABLE `estoque_pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `erros`
--
ALTER TABLE `erros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque_caixas`
--
ALTER TABLE `estoque_caixas`
  MODIFY `id_caixa` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque_pedidos`
--
ALTER TABLE `estoque_pedidos`
  MODIFY `id_pedido` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
