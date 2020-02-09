-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2020 a las 14:15:35
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pepsidb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `call_center_reports`
--

CREATE TABLE `call_center_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `call_assigned` int(11) NOT NULL,
  `call_managed` int(11) NOT NULL,
  `call_reject` int(11) NOT NULL,
  `call_unattended` int(11) NOT NULL,
  `call_average_response_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_outgoing` int(11) NOT NULL,
  `call_inquiry` int(11) NOT NULL,
  `email_assigned` int(11) NOT NULL,
  `email_managed` int(11) NOT NULL,
  `email_outgoing` int(11) NOT NULL,
  `email_average_response_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_assigned` int(11) NOT NULL,
  `chat_managed` int(11) NOT NULL,
  `chat_average_response_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `returned_call_assigned` int(11) NOT NULL,
  `returned_call_managed` int(11) NOT NULL,
  `returned_call_average_response_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'test', 'test2'),
(2, 'goal_calls', '600'),
(3, 'goal_orders', '300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imported` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documents`
--

INSERT INTO `documents` (`id`, `document_name`, `imported`, `created_at`, `updated_at`) VALUES
(1, 'name', 1, NULL, NULL),
(3, 'Reporte Alberto.xlsx', 16980, '2020-01-12 22:55:29', '2020-01-12 22:55:29'),
(7, 'REPORTE NOV DIC ENE.xlsx', 13794, '2020-01-18 00:59:19', '2020-01-18 00:59:19'),
(8, 'Copia de Agent - Contact Handling Volume 4 - Daily del 04 al 08.11 (alberto.xlsx', 35, '2020-01-27 01:18:57', '2020-01-27 01:18:57'),
(9, 'VCD-CYM-ADC PAIS  AL 12.09.2019.xlsx', 3150, '2020-02-02 03:02:37', '2020-02-02 03:02:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalation`
--

CREATE TABLE `instalation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_1p` int(11) DEFAULT NULL,
  `vc_2p` int(11) DEFAULT NULL,
  `enfriador_1t` int(11) DEFAULT NULL,
  `enfriador_2t` int(11) DEFAULT NULL,
  `enfriador_3t` int(11) DEFAULT NULL,
  `passthrough` int(11) DEFAULT NULL,
  `zone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `instalation`
--

INSERT INTO `instalation` (`id`, `vc_1p`, `vc_2p`, `enfriador_1t`, `enfriador_2t`, `enfriador_3t`, `passthrough`, `zone`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 1, 5, 3, 3, 'Centro', '2020-02-08 04:00:00', '2020-02-08 04:00:00'),
(2, 3, 2, 2, 4, 1, 2, 'Centro Occ', '2020-02-08 04:00:00', '2020-02-08 04:00:00'),
(3, 4, 2, 2, 7, 3, 2, 'Metropolitana', '2020-02-08 04:00:00', '2020-02-08 04:00:00'),
(4, 1, 1, 2, 1, 10, 60, 'Occidente', '2020-02-08 04:00:00', '2020-02-08 04:00:00'),
(5, 1, 1, 2, 1, 1, 1, 'Oriente', '2020-02-08 04:00:00', '2020-02-08 04:00:00'),
(8, 10, 21, 3, 4, 2, 4, 'Valencia', '2020-02-09 05:13:45', '2020-02-09 05:13:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kit_details_reports`
--

CREATE TABLE `kit_details_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_stock` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denomination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_asset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventary_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabrication_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_was_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cam_clasif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lock_date` date DEFAULT NULL,
  `status` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `missing_report_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kit_reports`
--

CREATE TABLE `kit_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pto_tbjo_resp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_type_id` int(10) UNSIGNED DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `kit_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_fix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denomination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planning_center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `init_date` date DEFAULT NULL,
  `modification_date` date DEFAULT NULL,
  `extreme_end_date` date DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `ctro_pto_trab` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_id` int(10) UNSIGNED DEFAULT NULL,
  `center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planning_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_generated` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_activity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_21_021021_alter_user_and_role_table', 1),
(4, '2019_11_24_141902_alltables', 1),
(5, '2019_12_05_030558_alter_user_table_add_identification_number', 1),
(6, '2019_12_05_044052_create_instalationstable', 1),
(7, '2019_12_09_021621_create_table_documents', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_type`
--

CREATE TABLE `report_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `help` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `report_type`
--

INSERT INTO `report_type` (`id`, `value`, `name`, `help`, `created_at`, `updated_at`) VALUES
(1, 'ZPMI', 'ZPMI', 'help', NULL, NULL),
(3, 'ZPMR', 'ZPMR', 'help', NULL, NULL),
(4, 'ZPMC', 'ZPMC', 'help', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'AD', '2020-01-05 22:25:38', '2020-01-05 22:25:38'),
(2, 'Operador', 'OP', '2020-01-05 22:25:39', '2020-01-05 22:25:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identification_document` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `identification_document`, `name`, `lastname`, `username`, `email`, `email_verified_at`, `password`, `phone_number`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 27381899, 'Administrator', 'Administrador', 'admin', 'admin@admin.com', NULL, '$2y$10$5nooX5ExfIHg3flW5PF7Tu4kNRuy7DI63.Y.VNqysAIV2LryAswcW', '1234', NULL, '2020-01-05 22:25:38', '2020-01-05 22:25:38', 1),
(2, 123456, 'BETANCOURT HIDALGO', 'ALBERTO JOSE', 'R25ABETANCOU', 'alberto.betancourt@empresas-polar.com', NULL, '$2y$10$r78wIuamSKC.xlufxQV56u7HYzMetEAjBueRG2ih2mJ4hCyHwDQ5q', '123442', 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(3, 27381899, 'ZARAHI FABIOLA', 'ASCANIO LUGO', 'R25ZASCANIO', 'zarahi.azcanio@empresas-polar.com', NULL, '$2y$10$I90vewsSMuGrohVWMPKJ3.FF8TxG4MnJd7WMzRdyF1mtPqeJgrrSa', NULL, 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(4, 273818933, 'NUBIA CAROLINA', 'ARAUJO GONZALEZ', 'R25NARAUJOO', 'nubia.araujo@empresas-polar.com', NULL, '$2y$10$yBUXixEEHpHgFSv6ylBuhucZF2Cx6wVWDjLKjEbkpNHNBAudXWwJC', '12344', 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(5, 27381899, 'MARY JOSBEL', 'COLMENARES CARRERO', 'R25MCOLMENAR', 'mary.colmenares@empresas-polar.com ', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'N', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(6, 27381899, 'NATHALY JHOANA', 'LIENDO TORO', 'R25NARAUJO', 'nathaly.liendo@empresas-polar.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'N', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(8, 27381899, 'Lizzet', 'Lopez', 'R25NARAUJO', 'llopez@user.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'N', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(9, 27381899, 'RAMON ANTONIO', 'RIOS MONTESINOS', 'R25RRIOS', 'ramon.rios@empresas-polar.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(10, 27381899, 'Jesus', 'Solorzano', 'R2JSOLORZANO', 'jesus.solorzano@empresas-polar.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(11, 27381899, 'MARLYN DANIELA', 'VALERO ROSENDO', 'R25MVALERO', 'marlyn.valero@empresas-polar.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(12, 27381899, 'RAYZA ALEJANDRA', 'VILLEGAS PADILLA ', 'R25RVILLEGAS', 'rayza.villegas@empresas-polar.com', NULL, '$2y$10$nXmwifSq1gkdJ5gjRFJgS.549pRhgB8offL1w7q6m6PNflhNTng6C', NULL, 'Y', '2020-01-05 22:25:38', '2020-01-05 22:25:38', 2),
(16, 1234567, 'pruesb', 'S', 'sb@mail.com', 'sd@mail', NULL, '$2y$10$mnp9FmJQprJjTV5D7DO77eM2FWTKQNixhxJNrgba9z52Niln.uCc6', '2334', 'N', '2020-02-01 03:01:08', '2020-02-01 03:01:08', 2),
(17, 2738827, 'JS', 'MS', 'js@mail.com', 'js@mail.com', NULL, '$2y$10$uV3TTew0Fz6zLs1GOtGMd.yk/T8muUES2VopKUycN8e3O5VXrWIU6', '12345', 'N', '2020-02-01 03:02:27', '2020-02-01 03:02:27', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zone`
--

CREATE TABLE `zone` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `call_center_reports`
--
ALTER TABLE `call_center_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_code_unique` (`code`),
  ADD UNIQUE KEY `clients_rif_unique` (`rif`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_un` (`name`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instalation`
--
ALTER TABLE `instalation`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kit_details_reports`
--
ALTER TABLE `kit_details_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kit_reports`
--
ALTER TABLE `kit_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `report_type`
--
ALTER TABLE `report_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `report_type_value_unique` (`value`),
  ADD UNIQUE KEY `report_type_name_unique` (`name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_value_unique` (`value`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `call_center_reports`
--
ALTER TABLE `call_center_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=772;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `instalation`
--
ALTER TABLE `instalation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `kit_details_reports`
--
ALTER TABLE `kit_details_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3151;

--
-- AUTO_INCREMENT de la tabla `kit_reports`
--
ALTER TABLE `kit_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30783;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `report_type`
--
ALTER TABLE `report_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `zone`
--
ALTER TABLE `zone`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
