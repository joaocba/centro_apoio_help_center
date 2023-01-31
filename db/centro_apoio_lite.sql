-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 31-Jan-2023 às 00:44
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `centro_apoio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `kb_artigos`
--

CREATE TABLE `kb_artigos` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `assunto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `kb_artigos`
--

INSERT INTO `kb_artigos` (`id`, `cat_id`, `assunto`, `descricao`, `keywords`) VALUES
(1, 2, 'Password expirada', '<p>Se a sua password de acesso aos computadores expirou deve abrir um ticket e <strong>indicar o seu código de verificação</strong> de colaborador.</p>\r\n<p>Iremos gerar uma nova password de acesso.</p>', 'password, login, expirada, conta, recuperar'),
(2, 3, 'Equipamento danificado', 'Caso algum equipamento seja danificado durante a utilização deve entrar em contacto com o departamento de TI para a troca do mesmo.', 'equipamento, hardware, danificado'),
(5, 2, 'Conta bloqueada', 'Caso a sua conta cliente apresente mensagem de bloqueada deve criar um ticket e indique a mensagem de erro apresentada', 'conta, bloqueada, falha, entrar'),
(8, 9, 'Como verificar os tickets abertos', '<p>Para verificar os tickets abertos deve aceder ao menu lateral</p>\r\n<img src=\"https://www.linkpicture.com/q/kb-app1.jpg\">\r\n<p>Clique em Ticket Abertos</p>\r\n<img src=\"https://www.linkpicture.com/q/kb-app2.jpg\">\r\n<p>Aqui pode verificar quais são os tickets que estão em resolução</p>', 'ticket, tickets, painel, app');

-- --------------------------------------------------------

--
-- Estrutura da tabela `kb_categorias`
--

CREATE TABLE `kb_categorias` (
  `id` int(11) NOT NULL,
  `nome_categoria` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_categoria` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `kb_categorias`
--

INSERT INTO `kb_categorias` (`id`, `nome_categoria`, `descricao_categoria`) VALUES
(1, 'Geral', 'Artigos relacionados com problemas gerais'),
(2, 'Contas', 'Artigos relacionados com gestão de contas e sessões'),
(3, 'Equipamento', 'Artigos relacionados com equipamento e hardware'),
(6, 'Testes', 'Categoria de testes'),
(7, 'Formulários', 'Artigos relacionados com formularios'),
(9, 'App Centro de Apoio', 'Artigos relacionados com a utilização da Web App Centro de Apoio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `phone_list`
--

CREATE TABLE `phone_list` (
  `id` int(11) NOT NULL,
  `colaborador` varchar(250) NOT NULL,
  `departamento` varchar(250) NOT NULL,
  `num_directo` varchar(250) NOT NULL,
  `curto_fixo` varchar(250) NOT NULL,
  `telemovel` varchar(250) NOT NULL,
  `curto_movel` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `phone_list`
--

INSERT INTO `phone_list` (`id`, `colaborador`, `departamento`, `num_directo`, `curto_fixo`, `telemovel`, `curto_movel`, `email`) VALUES
(207, 'Daniel Pereira', 'Informática', '', '', '91 117 66 65', '9327', 'daniel.pereira@oneshop.pt'),
(230, '24 Horas ', 'Oficina', '', '', '93 733 30 09', '', ''),
(231, 'Portaria', 'Portaria', '21 957 93 29', '329', '', '', ''),
(232, 'Elevador', 'Elevador', '21 958 98 58', '228', '', '', ''),
(233, 'Geral', 'Geral Alverca', '21 957 93 10', '310', '', '', 'geral@hydraplan.com'),
(234, 'Assistência 24h Portugal', '', '0034 91 382 6829', '', '', '', ''),
(235, 'Assistência 24h Europa', '', '0080 06 624 5324', '', '', '', ''),
(256, 'Geral', 'Geral', '34 924 035 092', '', '', '', 'info@hydraplan.com'),
(257, 'Comercial', '', '34 672 285 868', '', '', '', ''),
(258, '24h Taller', '', '34 672 285 909', '', '', '', ''),
(259, '24h Recambios', '', '34 672 285 899', '', '', '', ''),
(286, 'Oficina 24H FordTrucks', 'Oficina 24H FordTrucks', '', '', '91 070 96 53', '2424', ''),
(304, 'Teste', 'Dep Teste', '123 456 789', '123', '987 654 321', '321', 'teste_contacto@teste.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `prioridade` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` int(255) NOT NULL,
  `assunto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_reply` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_id`, `user_id`, `status`, `prioridade`, `nome`, `telefone`, `email`, `nome_empresa`, `dep_empresa`, `categoria`, `assunto`, `message`, `date`, `date_reply`) VALUES
(61, '0720f3bcca', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'Password expirou, como posso recuperar?', '2022-12-19 23:02:49', '2023-01-20 22:44:18'),
(62, 'd7690b8910', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 3, 'Equipamento danificado', 'asdasd', '2022-12-19 23:27:31', '0000-00-00 00:00:00'),
(63, '0586b8046b', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'asdasdsad', '2022-12-21 15:15:09', '2023-01-25 20:13:53'),
(64, 'd5f20a1ee3', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 7, 'Formulario problem login', 'asdasd', '2022-12-21 15:41:16', '0000-00-00 00:00:00'),
(65, '02d27cff95', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 1, 'Equipamento danificado', 'sdfsdf', '2022-12-22 22:20:43', '2022-12-22 22:37:17'),
(66, '29333d0aa3', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'preciso de nova password', '2023-01-20 22:45:02', '0000-00-00 00:00:00'),
(67, '710d768c62', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Equipamento danificado', 'asdasdasd', '2023-01-21 02:27:01', '0000-00-00 00:00:00'),
(68, 'c504e983d6', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 1, 'Password expirada', 'Aasas', '2023-01-23 17:55:43', '0000-00-00 00:00:00'),
(69, '5af58b2bf3', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'asdasd', '2023-01-23 17:56:48', '0000-00-00 00:00:00'),
(70, '125c4067be', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'asdasd', '2023-01-23 17:58:13', '0000-00-00 00:00:00'),
(71, '481c9d122b', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'asdasdasd', '2023-01-23 17:59:10', '0000-00-00 00:00:00'),
(72, '0670299ed4', 1, 2, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 2, 'Password expirada', 'asdasd', '2023-01-23 18:01:14', '0000-00-00 00:00:00'),
(73, '3131159d2a', 1, 0, 0, 'Paulo Santos', '912555121', 'user@user.com', 'OneShop SA', 'Contabilidade', 3, 'Falha no switch', 'jhkgkjjghl', '2023-01-26 03:42:29', '0000-00-00 00:00:00'),
(74, '5bcfe42807', 9, 1, 0, 'Ana Sofia', '938392193', 'anasofia@mail.com', 'Hydraplan SA', 'Contabilidade', 2, 'Erro ao fazer login no Windows', 'Boa tarde, não estou a conseguir entrar na conta do computador. Como posso resolver?', '2023-01-30 23:34:21', '2023-01-31 00:13:52'),
(75, 'e773146b14', 9, 1, 1, 'Ana Sofia', '938392193', 'anasofia@mail.com', 'Hydraplan SA', 'Contabilidade', 3, 'Teclado com mau funcionamento', 'Boa tarde, algumas das teclas do teclado não inserem as letras, preciso que seja substituido o mais breve possivel', '2023-01-30 23:42:14', '2023-01-31 00:03:25'),
(76, '3b03d20c45', 10, 1, 0, 'Marco Agostinho', '920131099', 'marcoagostinho@mail.com', 'OneShop SA', 'Oficina', 7, 'Folha de obra', 'Preciso de atualização nos campos de folha de obra, é necessário inserir as os preços unitários de peças', '2023-01-30 23:55:14', '2023-01-30 23:57:09'),
(77, '5ba931c8af', 11, 0, 0, 'Carina Marlene', '961011833', 'carinamarlene@mail.com', 'Hydraplan SA', 'Contabilidade', 1, 'Atualização Programa', 'Olá, o programa de contabilidade está a pedir que faça uma atualização. Como devo proceder?', '2023-01-30 23:58:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_reply`
--

CREATE TABLE `ticket_reply` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `send_by` int(11) NOT NULL DEFAULT 0,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ticket_reply`
--

INSERT INTO `ticket_reply` (`id`, `ticket_id`, `send_by`, `message`, `date`) VALUES
(19, 20, 0, 'Uso Windows 10', '2022-12-06 04:37:39'),
(20, 20, 0, 'Teste mensagem', '2022-12-06 18:58:25'),
(21, 20, 0, 'teste 2', '2022-12-06 19:06:49'),
(22, 20, 0, 'teste3', '2022-12-06 19:07:57'),
(23, 20, 0, 'test5', '2022-12-06 19:09:00'),
(24, 20, 0, 'teste6', '2022-12-06 19:10:23'),
(25, 20, 0, 'blasdalsdas', '2022-12-06 19:11:19'),
(26, 19, 0, 'test', '2022-12-06 19:19:33'),
(27, 20, 0, 'laksdalksdasdasd', '2022-12-06 19:20:47'),
(28, 17, 0, 'teste mensagem', '2022-12-06 19:28:20'),
(29, 17, 1, 'teste mensagem agente', '2022-12-09 05:27:52'),
(30, 19, 1, 'Test resposta agente', '2022-12-09 05:35:38'),
(31, 19, 1, 'Resposta de agente outra vez', '2022-12-09 05:37:55'),
(32, 19, 0, 'resposta user', '2022-12-09 14:12:47'),
(33, 19, 0, 'ola', '2022-12-09 21:49:50'),
(34, 21, 0, 'Problema ao ligar', '2022-12-10 13:52:02'),
(35, 47, 0, 'asdasd', '2022-12-12 18:56:29'),
(36, 19, 0, 'fdsdfsd', '2022-12-12 19:06:04'),
(37, 58, 0, 'khkl.', '2022-12-16 19:46:53'),
(38, 59, 1, 'Teste', '2022-12-19 02:40:29'),
(39, 51, 1, 'teste', '2022-12-19 03:20:36'),
(40, 61, 0, 'teste', '2022-12-19 23:17:15'),
(41, 61, 0, 'teste data', '2022-12-20 00:44:01'),
(42, 61, 1, 'Teste resposta ag', '2022-12-20 01:23:43'),
(43, 63, 1, 'dasdasd', '2022-12-21 15:17:17'),
(44, 65, 1, 'asdasd', '2022-12-22 22:37:17'),
(45, 61, 0, 'kjkikj', '2023-01-20 22:44:18'),
(46, 63, 0, 'Teste', '2023-01-25 20:13:53'),
(47, 76, 0, 'É para o sistema de tablets', '2023-01-30 23:56:51'),
(48, 76, 0, 'Da oficina 3', '2023-01-30 23:57:09'),
(49, 75, 1, 'Boa tarde, iremos de imediato realizar a troca do equipamento', '2023-01-31 00:03:25'),
(50, 74, 1, 'Boa tarde, indique-nos o seu codigo de identificação de colaborador por favor', '2023-01-31 00:05:29'),
(51, 74, 0, 'É \"AS9904\"', '2023-01-31 00:09:01'),
(52, 74, 1, 'A sua conta foi reposta e a nova password é <strong>Anasofia1</strong>\r\n\r\nCaso o problema persista diga', '2023-01-31 00:13:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(11) NOT NULL DEFAULT 0,
  `last_login` date NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` int(11) NOT NULL,
  `morada` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cod_postal` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_empresa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_empresa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_empresa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `last_login`, `nome`, `apelido`, `data_nascimento`, `telefone`, `morada`, `cod_postal`, `cidade`, `nome_empresa`, `local_empresa`, `dep_empresa`) VALUES
(1, 'user@user.com', '9200554923a0dce21e9b89651a3a94aa3b9a2dcb', 0, '2023-01-31', 'Paulo', 'Santos', '2022-12-21', 912555121, 'Rua do Jambira N777', '2500-124', 'Lisboa', 'OneShop SA', 'Viseu', 'Contabilidade'),
(2, 'agent@agent.com', '0608c4054662dd902e1314f7e450e3eaa81c1143', 1, '2023-01-31', 'Agente', 'Teste', '1980-12-20', 913311883, 'Rua do Mocambo N89', '6700-331', 'Aveiro', 'OneShop SA', 'Alverca', 'Técnico'),
(3, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, '2023-01-31', 'Administrador', 'Teste', '1993-12-10', 914001351, 'Rua do Paço N77', '5600-541', 'Guimarães', 'OneShop SA', 'Alverca', 'Técnico'),
(9, 'anasofia@mail.com', '570bfb48d80777859f5e9d83fdf505fe6cd8a236', 0, '2023-01-31', 'Ana', 'Sofia', '1997-05-22', 938392193, 'Estrada de Santa Luzia', '3600-616', 'Viseu', 'Hydraplan SA', 'Viseu', 'Contabilidade'),
(10, 'marcoagostinho@mail.com', '05136b1cd96b001955fd457ddce04d8e30fd8316', 0, '2023-01-30', 'Marco', 'Agostinho', '1987-12-15', 920131099, 'Avenida Dr Augusto', '9800-515', 'Castelo Branco', 'OneShop SA', 'Porto', 'Oficina'),
(11, 'carinamarlene@mail.com', 'b1b11b31fd9c9b91de505dbca34f657ab142098c', 0, '2023-01-30', 'Carina', 'Marlene', '1995-06-18', 961011833, 'Estrada Nacional 3', '1530-776', 'Beja', 'Hydraplan SA', 'Lisboa', 'Contabilidade');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `kb_artigos`
--
ALTER TABLE `kb_artigos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Índices para tabela `kb_categorias`
--
ALTER TABLE `kb_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `phone_list`
--
ALTER TABLE `phone_list`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_ibfk_2` (`user_id`),
  ADD KEY `categoria` (`categoria`);

--
-- Índices para tabela `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `kb_artigos`
--
ALTER TABLE `kb_artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `kb_categorias`
--
ALTER TABLE `kb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `phone_list`
--
ALTER TABLE `phone_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `kb_artigos`
--
ALTER TABLE `kb_artigos`
  ADD CONSTRAINT `kb_artigos_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `kb_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`categoria`) REFERENCES `kb_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
