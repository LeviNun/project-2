-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<<< Updated upstream:sistemaacademico (6).sql
-- Tempo de geração: 31/01/2024 às 13:43
========
-- Tempo de geração: 29/01/2024 às 12:38
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaacademico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `remetente` varchar(255) NOT NULL,
  `destinatario` varchar(255) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `col_projeto`
--

CREATE TABLE `col_projeto` (
  `id` int(11) NOT NULL,
  `login_colaborador` varchar(255) NOT NULL,
  `id_projeto` int(255) NOT NULL,
  `id_setor` int(255) NOT NULL,
  `dt_entrada` datetime NOT NULL,
  `viw` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<<< Updated upstream:sistemaacademico (6).sql
--
-- Despejando dados para a tabela `col_projeto`
--

INSERT INTO `col_projeto` (`id`, `login_colaborador`, `id_projeto`, `id_setor`, `dt_entrada`, `viw`) VALUES
(28, '44', 50, 12, '2024-01-31 11:30:17', 1),
(29, '123', 50, 12, '2024-01-31 11:31:06', 1),
(30, '44', 52, 14, '2024-01-31 13:12:53', 1),
(31, '23', 52, 14, '2024-01-31 13:13:18', 1),
(32, '43', 52, 15, '2024-01-31 13:23:21', 1),
(33, '54', 52, 15, '2024-01-31 13:23:25', 1),
(34, '43', 52, 16, '2024-01-31 13:27:49', 1),
(35, '43', 52, 17, '2024-01-31 13:31:07', 1),
(36, '43', 52, 18, '2024-01-31 13:37:12', 1),
(37, '123', 53, 19, '2024-01-31 13:39:03', 1);

========
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `cpf` varchar(255) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `login` varchar(255) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` text NOT NULL DEFAULT 'ativo',
  `perfil` text NOT NULL DEFAULT 'funcionario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`cpf`, `nome`, `login`, `setor`, `senha`, `status`, `perfil`) VALUES
('0000', 'rafael donga', '000', 'cvt', '000', 'ativo', 'funcionario'),
('0002', 'rafael donga', '0002', 'cvt', '0002', 'ativo', 'funcionario'),
('003', 'SENHOR MELB LAU', '003', 'inovação', '003', 'ativo', 'gestor'),
('004', 'juninhopvp', '004', 'cvt', '004', 'ativo', 'funcionario'),
('02165498987945', 'Carla beatriz ', '43', 'cvt', '43', 'ativo', 'funcionario'),
('111', 'bils', '111', 'cvt', '111', 'ativo', 'funcionario'),
('1234', 'zibora', '123', 'cvt', '123', 'ativo', 'funcionario'),
('222', 'levi', '23', 'ti', '23', 'ativo', 'gestor'),
('231.212.212-21', 'Lukinha muia perfi', '33', 'banese', '33', 'ativo', 'funcionario'),
('235333535', 'Melb lau', '55', 'bio fabrica', '55', 'ativo', 'funcionario'),
('32444242', 'vitor hugor ', '45', 'cvt', '45', 'ativo', 'funcionario'),
('4444', 'rafae', '44', 'cvt', '44', 'ativo', 'gestor'),
('85544548678587', 'carol santos bispo', '54', 'cvt', '54', 'ativo', 'funcionario');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notatividades`
--

CREATE TABLE `notatividades` (
  `id` int(11) NOT NULL,
  `de` varchar(255) NOT NULL,
  `para` varchar(255) NOT NULL,
  `projeto` varchar(255) NOT NULL,
  `datanot` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notatividades`
--

INSERT INTO `notatividades` (`id`, `de`, `para`, `projeto`, `datanot`) VALUES
(14, '222', '1234', 'iaa ,uleka', '0000-00-00'),
(15, 'zibora', 'zibora', 'iaa ,uleka', '0000-00-00'),
(16, 'SENHOR MELB LAU', 'zibora', 'rtreter', '0000-00-00'),
(17, 'SENHOR MELB LAU', 'zibora', 'rtreter', '0000-00-00'),
(18, '003', '1234', 'rtreter', '0000-00-00'),
(19, '003', '1234', 'terewtewbty 4ry', '0000-00-00'),
(20, 'SENHOR MELB LAU', 'zibora', 'terewtewbty 4ry', '0000-00-00'),
(21, 'SENHOR MELB LAU', 'zibora', '547475475767575', '0000-00-00'),
(22, 'SENHOR MELB LAU', 'zibora', 'kççok', '0000-00-00'),
(23, '003', '1234', 'rtreter', '0000-00-00'),
(24, '222', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(25, '1234', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(26, '222', '1234', '', '0000-00-00'),
(27, '222', '1234', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(28, 'zibora', 'zibora', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(29, 'levi', 'zibora', '', '0000-00-00'),
(30, 'levi', 'zibora', 'Gosto de piza', '0000-00-00'),
(31, 'levi', 'zibora', 'Tomar no cu', '0000-00-00'),
(32, '222', '222', 'va tomar no cukkkkkkkkkk', '0000-00-00'),
(33, '', '1234', 'w11ww', '0000-00-00'),
(34, '003', '1234', '3fre', '0000-00-00'),
(35, '003', '1234', 'y56y6u', '0000-00-00'),
(36, '', '1234', 'wefwf', '0000-00-00'),
(37, '', '1234', '4444', '0000-00-00'),
(38, '', '1234', '4444', '0000-00-00'),
(39, '', '1234', '09-=80u0olk', '0000-00-00'),
(40, '4444', '1234', '4444', '0000-00-00'),
(41, '4444', '1234', 'htrhhe', '0000-00-00'),
(42, '4444', '1234', 'htrhhe', '0000-00-00'),
(43, '4444', '1234', 'htrhhe', '0000-00-00'),
(44, '4444', '1234', 'htrhhe', '0000-00-00'),
(45, '003', '0000', 'iae meh paecrf', '2024-01-18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL,
  `nome_projeto` varchar(255) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
  `caminho_projeto` varchar(255) NOT NULL,
  `objetivo` varchar(400) NOT NULL,
  `dt_criada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `nome_projeto`, `login_criador`, `caminho_projeto`, `objetivo`, `dt_criada`) VALUES
(48, 'corre5353', '003', '..projetos/projetos/', '553', '2024-01-26 18:33:15'),
(49, '34534', '003', '..projetos/projetos/', '535', '2024-01-26 18:33:42'),
<<<<<<<< Updated upstream:sistemaacademico (6).sql
(50, 'gismao', '003', '..projetos/projetos/', 'ruler', '2024-01-29 14:22:42'),
(51, 'Bolhaço ', '003', '..projetos/projetos/', 'é criar um palahaço catolico que gosta de fazer as pessoas felizes e evangelizando por ai a fim de levar almas para o céu:', '2024-01-31 14:32:58'),
(52, 'projeto de muie', '003', '..projetos/projetos/', 'o objetivo do projeto é tranformar varias mulheres em programadoras de sucesso ', '2024-01-31 16:09:56'),
(53, 'jeca', '003', '..projetos/projetos/', 'mato', '2024-01-31 16:38:10');
========
(50, 'gismao', '003', '..projetos/projetos/', 'ruler', '2024-01-29 14:22:42');
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id_relatorio` int(11) NOT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `id_setor` int(255) NOT NULL,
  `login_remetente` varchar(255) NOT NULL,
  `nome_relatorio` varchar(255) NOT NULL,
  `caminho_pdf` varchar(255) NOT NULL,
  `data_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  `id_setor` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
  `objetivo_setor` varchar(400) NOT NULL,
========
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `login_criador` varchar(255) NOT NULL,
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
  `dt_criado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `setor`
--

<<<<<<<< Updated upstream:sistemaacademico (6).sql
INSERT INTO `setor` (`id_setor`, `nome`, `id_projeto`, `login_criador`, `objetivo_setor`, `dt_criado`) VALUES
(8, '535345', 48, '003', '', '2024-01-26 15:33:17'),
(9, '345', 48, '003', '', '2024-01-26 15:33:26'),
(10, '534534', 49, '003', '', '2024-01-26 15:33:45'),
(11, 'cvt', 50, '003', '', '2024-01-29 11:22:53'),
(12, 'bola de  fogo', 50, '003', '', '2024-01-29 11:51:23'),
(13, 'cvt', 51, '003', '', '2024-01-31 13:08:32'),
(14, 'Gestores', 52, '003', '', '2024-01-31 13:10:50'),
(15, 'Professores', 52, '003', '', '2024-01-31 13:23:06'),
(16, 'Cordenadores gerais', 52, '003', '', '2024-01-31 13:27:37'),
(17, 'cvt', 52, '003', 'criar tu r34', '2024-01-31 13:30:51'),
(18, 'gu', 52, '003', 'Cria um app lonix, para manutenção de pisinas ', '2024-01-31 13:37:03'),
(19, 'vuter', 53, '003', 'Cria um app lonix, para manutenção de pisinas ', '2024-01-31 13:38:45');
========
INSERT INTO `setor` (`id`, `nome`, `id_projeto`, `login_criador`, `dt_criado`) VALUES
(8, '535345', 48, '003', '2024-01-26 15:33:17'),
(9, '345', 48, '003', '2024-01-26 15:33:26'),
(10, '534534', 49, '003', '2024-01-26 15:33:45'),
(11, 'cvt', 50, '003', '2024-01-29 11:22:53'),
(12, 'bola de  fogo', 50, '003', '2024-01-29 11:51:23');
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `col_projeto`
--
ALTER TABLE `col_projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projeto_col` (`id_projeto`),
  ADD KEY `col_setor` (`id_setor`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `notatividades`
--
ALTER TABLE `notatividades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`);

--
-- Índices de tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id_relatorio`),
  ADD KEY `id_projeto` (`id_projeto`),
  ADD KEY `relatorio_setor` (`id_setor`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  ADD PRIMARY KEY (`id_setor`),
========
  ADD PRIMARY KEY (`id`),
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
  ADD KEY `setor_projetos` (`id_projeto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `col_projeto`
--
ALTER TABLE `col_projeto`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
========
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

--
-- AUTO_INCREMENT de tabela `notatividades`
--
ALTER TABLE `notatividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
========
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
========
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
========
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `col_projeto`
--
ALTER TABLE `col_projeto`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  ADD CONSTRAINT `col_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
========
  ADD CONSTRAINT `col_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`),
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
  ADD CONSTRAINT `projeto_col` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `relatorios`
--
ALTER TABLE `relatorios`
<<<<<<<< Updated upstream:sistemaacademico (6).sql
  ADD CONSTRAINT `relatorio_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
========
  ADD CONSTRAINT `relatorio_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`),
>>>>>>>> Stashed changes:projetos/53/sistemaacademico (5).sql
  ADD CONSTRAINT `relatorios_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `setor_projetos` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
