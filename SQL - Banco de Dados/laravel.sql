-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Dez-2023 às 20:21
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `laravel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------



--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('contato@contato.com', 'teste', '2023-06-24 22:21:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Estrutura da tabela `tcc_elicitacao`
--

CREATE TABLE `tcc_elicitacao` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `setor_envolvido` varchar(255) NOT NULL,
  `data_reuniao` date DEFAULT NULL,
  `conteudo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `imagem` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tcc_elicitacao`
--

INSERT INTO `tcc_elicitacao` (`id`, `titulo`, `tipo`, `setor_envolvido`, `data_reuniao`, `conteudo`, `created_at`, `updated_at`, `id_user`, `imagem`) VALUES
(5, 'Entrevista Suprimentos', 'Entrevista', 'Suprimentos', '2023-09-17', 'teste novo 1', '2023-09-17 20:29:30', '2023-11-10 01:31:05', 1, NULL),
(6, 'Questionário Contabilidade', 'Questionário', 'Contabilidade', '2023-09-17', 'Conforme alinhamento, haverá teste', '2023-09-17 20:53:58', '2023-11-10 01:53:03', 1, NULL),
(7, 'Observação PCP', 'Observação', 'PCP', '2023-09-17', 'Observação ao setor de PCP...', '2023-09-17 21:28:12', '2023-09-17 21:28:12', 2, NULL),
(9, 'Entrevista com Compras', 'Entrevista', 'Suprimentos', '2023-09-23', 'Entrevista no dia X', '2023-09-23 15:41:09', '2023-09-23 15:41:09', 2, NULL),
(14, 'Auditoria 7S', 'Questionario', 'Compras', '2023-10-21', 'Teste', '2023-10-21 21:00:06', '2023-11-10 01:32:00', 1, NULL),
(18, 'Elicitação para Gestão Escolar', 'Questionário', 'Suprimentos', '2023-11-14', 'teste', '2023-11-15 01:20:54', '2023-11-15 01:38:18', 1, NULL),
(19, 'Entrevista com Leandro', 'Entrevista', 'Docencia', '2023-11-24', 'Teste', '2023-11-25 01:47:25', '2023-11-25 01:47:25', 1, NULL),
(20, 'Entrevista com João', 'Entrevista', 'Contabilidade', '2023-12-02', 'Teste\r\nnovo', '2023-12-03 02:38:16', '2023-12-03 02:52:39', 1, NULL),
(27, 'Teste 2', 'Entrevista', 'Contabilidade', '2023-12-03', 'teste', '2023-12-04 01:39:21', '2023-12-04 01:40:20', 1, 0x433a5c78616d70705c746d705c706870434141462e746d70);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tcc_historia`
--

CREATE TABLE `tcc_historia` (
  `id` int(11) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_requisito` int(11) NOT NULL,
  `id_elicitacao` int(11) NOT NULL,
  `necessidade` varchar(255) NOT NULL,
  `solucao` varchar(255) NOT NULL,
  `cenario_teste` varchar(255) NOT NULL,
  `especificacao` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `data_homologacao` datetime DEFAULT NULL,
  `data_cancelamento` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tcc_historia`
--

INSERT INTO `tcc_historia` (`id`, `id_user`, `id_requisito`, `id_elicitacao`, `necessidade`, `solucao`, `cenario_teste`, `especificacao`, `status`, `data_homologacao`, `data_cancelamento`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 7, 'Impedimento', 'Ajustar', 'Testar', 'Implementar', 'Concluida', '2023-10-13 11:23:34', NULL, '2023-09-20 16:18:06', '2023-09-30 21:23:34'),
(2, 1, 5, 6, 'Impedimento', 'Ajustar', 'Testar', 'Implementar nova validação', 'Concluida', '2023-10-08 17:13:38', NULL, '2023-09-23 02:21:35', '2023-10-08 20:13:38'),
(3, 1, 2, 5, 'Impedimento', 'Melhorar', 'Testar', 'Especificar', 'Concluida', '2023-09-30 18:24:06', NULL, '2023-09-23 15:37:40', '2023-09-30 21:24:06'),
(4, 2, 2, 9, 'Melhoria Suprimentos', 'Melhorar', 'Testar Melhoria', 'Especificar', 'Cancelada', '2023-10-03 22:08:51', NULL, '2023-09-23 15:41:49', '2023-10-04 01:08:51'),
(6, 1, 8, 5, 'Cadastro de nova resolução', 'Implementar novo recurso', 'Validar as informações', 'Cadastro de novo campo XPTO', 'Concluida', '2023-10-05 22:28:40', NULL, '2023-10-06 01:27:34', '2023-10-06 01:28:40'),
(7, 1, 1, 6, 'Melhoria Suprimentos Novo', 'Melhorar', 'Testar Melhoria', 'Cadastro de novo campo', 'Concluida', '2023-10-08 23:21:49', NULL, '2023-10-09 02:21:28', '2023-10-09 02:21:49'),
(8, 1, 1, 5, 'Ajustar a liberação REINF', 'Com base no exposto e tal, averiguou coisarada\r\ndnadionoind', 'nodinaoidn\r\n\r\nTestar conforme tal.\r\n\r\n1. Teste\r\n\r\n2. Teste', 'odnoandNo contreedaiaoijdijadojadji\r\n\r\n- dauhdiaudhad\r\n-siuajsiuhaid', 'Concluida', '2023-10-12 19:53:17', NULL, '2023-10-12 22:43:43', '2023-10-12 22:53:17'),
(9, 1, 1, 5, 'Teste de usabilidade', 'Teste', 'Teste', 'teste novo', 'Cancelada', '2023-10-14 16:52:24', NULL, '2023-10-14 19:51:42', '2023-10-14 19:52:24'),
(10, 1, 1, 5, 'Ajustar liberação de campo XPTO', 'Criar nova forma de atribuir valor ao corpo', 'Inserir valor ao campo', 'Ajustar  na tabela xpto.Campo', 'Concluida', '2023-10-15 18:54:03', NULL, '2023-10-15 21:52:16', '2023-10-15 21:54:03'),
(11, 1, 1, 5, 'Teste', 'Teste Imp', 'Testeno', 'Teste', 'Cancelada', NULL, '2023-10-19 23:23:49', '2023-10-20 02:16:22', '2023-10-20 02:23:49'),
(12, 10, 1, 5, 'Implementar campo XPTO', 'Criar na tabela x o valor y', 'Testar cadastro CRUD novamente', 'Detalhar que será realizado', 'Concluida', '2023-10-20 23:53:55', NULL, '2023-10-21 02:53:15', '2023-10-21 02:53:55'),
(13, 1, 1, 14, 'Auditoria 7S - Validação', 'Implementar novidade', 'Testar novidade', 'Especificar novidade', 'Concluida', '2023-11-09 22:49:23', NULL, '2023-11-10 01:49:13', '2023-11-10 01:49:23'),
(14, 1, 15, 5, 'Alteração de matricula', 'Alterar campo', 'Testar campo', 'Especificar o campo', 'Concluida', '2023-11-10 23:42:32', NULL, '2023-11-11 02:41:00', '2023-11-11 02:42:32'),
(15, 1, 16, 5, 'Alteração do programa de avaliação', 'Implementar campo XPTO na tabela Y.', 'Testar a usabilidade padrão da aplicação', 'Desenvolver com xpto.\r\nTeste', 'Concluida', '2023-11-24 22:51:07', NULL, '2023-11-25 01:49:11', '2023-11-25 01:51:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tcc_requisito`
--

CREATE TABLE `tcc_requisito` (
  `id` int(11) NOT NULL,
  `programa` varchar(255) NOT NULL,
  `ativo` varchar(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tcc_requisito`
--

INSERT INTO `tcc_requisito` (`id`, `programa`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'Nota Fiscal', 'S', '2023-09-07 15:25:59', '2023-11-10 01:27:46'),
(2, 'Cotação de Compra', 'N', '2023-09-07 15:44:24', '2023-11-15 01:36:39'),
(5, 'Cotação de Venda', 'N', '2023-09-23 02:20:37', '2023-10-21 20:18:02'),
(8, 'Cadastro Positivo', 'N', '2023-10-06 01:24:47', '2023-10-15 20:35:12'),
(15, 'Gestão Escolar', 'S', '2023-11-11 02:20:11', '2023-11-11 02:20:11'),
(16, 'Programa FTEC', 'S', '2023-11-25 01:44:57', '2023-11-25 01:46:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `autorizado` varchar(1) DEFAULT NULL,
  `senha` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `tipo`, `autorizado`, `senha`) VALUES
(1, 'Bryan Oliveira', 'contato@contato.com', '2023-06-17 12:40:17', 'teste', 'G2JrqZ4Vu33NteAkd8cbcun88J1tC7zoLQBO45MQB5cD8U6kmA06wibjpalw', '2023-06-17 12:40:17', '2023-11-10 01:27:55', '1', 'S', 'teste'),
(2, 'João Suporte', 'joao@contato.com', '2023-07-03 22:25:08', 'teste', 'BOW4I0rp1HCXJo98qg4vWiG7ScOceQ9g6f1HvnJ9AME3NQz7CCQZIywgru7M', '2023-07-03 22:25:08', '2023-11-15 01:34:02', '2', 'S', NULL),
(6, 'Andressa Santos', 'andressa@contato.com', NULL, NULL, NULL, '2023-10-13 21:11:02', '2023-11-11 02:17:29', '2', 'N', 'teste1'),
(10, 'Carlos Tadeu', 'carlos@contato.com', NULL, NULL, NULL, '2023-10-21 02:50:58', '2023-11-15 01:29:48', '1', 'S', '12345'),
(14, 'Teste', 'teste@contato.com', NULL, NULL, NULL, '2023-11-15 02:08:22', '2023-11-15 02:08:22', '2', 'N', 'tes@2023'),
(15, 'Leandro Machado', 'leandro@ftec.com', NULL, NULL, NULL, '2023-11-25 01:44:01', '2023-11-25 01:46:03', '1', 'S', 'Teste@23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `tcc_elicitacao`
--
ALTER TABLE `tcc_elicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `tcc_historia`
--
ALTER TABLE `tcc_historia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_requisito` (`id_requisito`),
  ADD KEY `id_elicitacao` (`id_elicitacao`);

--
-- Índices para tabela `tcc_requisito`
--
ALTER TABLE `tcc_requisito`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tcc_elicitacao`
--
ALTER TABLE `tcc_elicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tcc_historia`
--
ALTER TABLE `tcc_historia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tcc_requisito`
--
ALTER TABLE `tcc_requisito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tcc_elicitacao`
--
ALTER TABLE `tcc_elicitacao`
  ADD CONSTRAINT `fk_user_elicitacao` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `tcc_historia`
--
ALTER TABLE `tcc_historia`
  ADD CONSTRAINT `fk_elicitacao` FOREIGN KEY (`id_elicitacao`) REFERENCES `tcc_elicitacao` (`id`),
  ADD CONSTRAINT `fk_requisito` FOREIGN KEY (`id_requisito`) REFERENCES `tcc_requisito` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
