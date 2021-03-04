-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 01-Set-2018 às 15:05
-- Versão do servidor: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notificacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `codcontato` int(11) NOT NULL,
  `codpessoa` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`codcontato`, `codpessoa`, `mensagem`, `dtcadastro`) VALUES
(1, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 19:05<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>Hsjsush<br>', '2018-08-28 19:05:56'),
(2, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 20:08<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>Jdjsjdj<br>', '2018-08-28 20:08:03'),
(3, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 20:16<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>rrrrrrrrrrrrrrrr<br>', '2018-08-28 20:16:17'),
(4, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 20:19<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>eeeeeeeeeeeeee<br>', '2018-08-28 20:19:50'),
(5, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 20:19<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>eeeeeeeeeeeeee<br>', '2018-08-28 20:19:58'),
(6, 1, '-------------Contato enviado via APP-----------------<br><strong>Data envio:</strong> 28/08/2018 20:20<br><strong>Nome:</strong> Thyago Henrique Pache<br><strong>E-mail:</strong> <a href=\'mailto: thyago.pacher@gmail.com\'>thyago.pacher@gmail.com</a><br><strong>Mensagem:</strong><br>eeeeeeeeeeeeeedddddddd<br>', '2018-08-28 20:20:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `codempresa` int(11) NOT NULL,
  `razao` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dtatualiza` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`codempresa`, `razao`, `email`, `telefone`, `celular`, `dtcadastro`, `dtatualiza`) VALUES
(1, 'thyago henrique pacher', 'thyago.pacher@gmail.com', '(42)3222-1365', '(66)66666-6666', '2018-08-28 15:59:57', '2018-08-28 20:07:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `codmensagem` int(11) NOT NULL,
  `assunto` varchar(150) NOT NULL,
  `texto` text NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codfuncionario` int(11) NOT NULL,
  `paraquem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`codmensagem`, `assunto`, `texto`, `dtcadastro`, `codfuncionario`, `paraquem`) VALUES
(1, 'wwwwwwww', 'wwwwwwwwwwwww', '2018-08-26 14:52:39', 0, 0),
(2, 'wwwwwwwwwww', 'wwwwwwwwwww', '2018-08-26 14:53:38', 0, 0),
(3, 'wwwwwwwwww', 'wwwwdddddddddd', '2018-08-26 14:55:09', 1, 0),
(5, 'teste1', 'texto do teste 1', '2018-08-27 15:45:20', 1, 1),
(6, 'ddddddddddddd', 'sssssssss', '2018-08-27 15:46:07', 1, 2),
(7, 'teste', 'teste', '2018-08-28 13:33:52', 1, 1),
(8, 'Comissão 10%', 'Comissão 10% venda de bravecto', '2018-08-28 13:42:06', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `codpessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(150) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` set('a','i','n') NOT NULL DEFAULT 'i',
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`codpessoa`, `nome`, `dtcadastro`, `email`, `senha`, `status`, `imagem`) VALUES
(1, 'Thyago Henrique Pache', '2018-08-24 18:58:06', 'thyago.pacher@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'a', 'data-2018-08-281535466699.jpg'),
(2, 'pessoa 2', '2018-08-24 21:27:22', 'exemplo@gmail.com', '58f9f2f6ba8b7c20da92b78e5d009d22', 'a', ''),
(4, 'joao ribeiro', '2018-08-30 21:06:00', 'joao@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'animal.jpg'),
(5, 'ana ribeiro', '2018-08-30 21:11:06', 'ana.ribeiro@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'angularjs.png'),
(6, 'anapolis', '2018-08-30 21:11:48', 'anapolis@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', '1427725497.png'),
(7, 'branco polar', '2018-08-30 21:14:53', 'branco@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'data-2018-08-301535663693.jpg'),
(8, 'polar', '2018-08-30 21:16:04', 'polar@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'data-2018-08-301535663764.jpg'),
(9, 'bia', '2018-08-30 21:20:28', 'bia@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'data-2018-08-301535664028.png'),
(10, 'nnnnnnn', '2018-08-30 21:22:38', 'nnnnnnnnnn@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'data-2018-08-301535664158.jpg'),
(11, 'bbbbbbbbbbbb', '2018-08-30 21:24:05', 'bbbbbbb@gmail.com', '6a4120be23c814f80233ecbb34e71adc', 'i', 'data-2018-08-301535664245.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`codcontato`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`codempresa`);

--
-- Indexes for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`codmensagem`),
  ADD KEY `codfuncionario` (`codfuncionario`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codpessoa`),
  ADD KEY `status` (`status`),
  ADD KEY `nome` (`nome`(5));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `codcontato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `codempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `codmensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
