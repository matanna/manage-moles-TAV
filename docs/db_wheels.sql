-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 juil. 2021 à 14:00
-- Version du serveur : 8.0.25
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_wheels`
--

-- --------------------------------------------------------

--
-- Structure de la table `cu`
--

CREATE TABLE `cu` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cu`
--

INSERT INTO `cu` (`id`, `name`) VALUES
(5, 'masters'),
(6, 'vertmax'),
(7, 'vertmax-master');

-- --------------------------------------------------------

--
-- Structure de la table `cu_categories`
--

CREATE TABLE `cu_categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cu_categories`
--

INSERT INTO `cu_categories` (`id`, `name`) VALUES
(1, 'Diabolo'),
(2, 'Fraise'),
(3, 'Fine'),
(4, 'Ebauche'),
(6, 'Polissante'),
(8, 'Foret'),
(22, 'Filet_de_Versaille'),
(25, 'Biseau');

-- --------------------------------------------------------

--
-- Structure de la table `cu_consumption`
--

CREATE TABLE `cu_consumption` (
  `id` int NOT NULL,
  `provider_id` int DEFAULT NULL,
  `wheels_cu_type_id` int DEFAULT NULL,
  `linear_meters` int DEFAULT NULL,
  `date` date NOT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cu_consumption`
--

INSERT INTO `cu_consumption` (`id`, `provider_id`, `wheels_cu_type_id`, `linear_meters`, `date`, `ref`) VALUES
(3, 5, 68, NULL, '2021-07-13', 'DOFF000010KCXL69');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210419133028', '2021-06-14 13:32:32', 822),
('DoctrineMigrations\\Version20210420093327', '2021-06-14 13:32:33', 197),
('DoctrineMigrations\\Version20210420094830', '2021-06-14 13:32:33', 152),
('DoctrineMigrations\\Version20210420115001', '2021-06-14 13:32:33', 35),
('DoctrineMigrations\\Version20210420120415', '2021-06-14 13:32:33', 112),
('DoctrineMigrations\\Version20210420120730', '2021-06-14 13:32:33', 132),
('DoctrineMigrations\\Version20210420203252', '2021-06-14 13:32:34', 137),
('DoctrineMigrations\\Version20210420204811', '2021-06-14 13:32:34', 288),
('DoctrineMigrations\\Version20210420205155', '2021-06-14 13:32:34', 215),
('DoctrineMigrations\\Version20210420210907', '2021-06-14 13:32:34', 224),
('DoctrineMigrations\\Version20210422183406', '2021-06-14 13:32:34', 52),
('DoctrineMigrations\\Version20210422190840', '2021-06-14 13:32:35', 37),
('DoctrineMigrations\\Version20210422213636', '2021-06-14 13:32:35', 36),
('DoctrineMigrations\\Version20210423163822', '2021-06-14 13:32:35', 46),
('DoctrineMigrations\\Version20210426214922', '2021-06-14 13:32:35', 182),
('DoctrineMigrations\\Version20210428095959', '2021-06-14 13:32:35', 93),
('DoctrineMigrations\\Version20210503101759', '2021-06-14 13:32:35', 343),
('DoctrineMigrations\\Version20210503185725', '2021-06-14 13:32:35', 379),
('DoctrineMigrations\\Version20210505055447', '2021-06-14 13:32:36', 144),
('DoctrineMigrations\\Version20210505055853', '2021-06-14 13:32:36', 209),
('DoctrineMigrations\\Version20210517163921', '2021-06-14 13:32:36', 475),
('DoctrineMigrations\\Version20210517164708', '2021-06-14 13:32:37', 168),
('DoctrineMigrations\\Version20210517184545', '2021-06-14 13:32:37', 20),
('DoctrineMigrations\\Version20210518183400', '2021-06-14 13:32:37', 155),
('DoctrineMigrations\\Version20210520192607', '2021-06-14 13:32:37', 34),
('DoctrineMigrations\\Version20210601070739', '2021-06-14 13:32:37', 30),
('DoctrineMigrations\\Version20210601080038', '2021-06-14 13:32:37', 33),
('DoctrineMigrations\\Version20210617065309', '2021-06-17 06:57:07', 178),
('DoctrineMigrations\\Version20210617072855', '2021-06-17 07:29:01', 417),
('DoctrineMigrations\\Version20210629085318', '2021-06-29 08:53:32', 424),
('DoctrineMigrations\\Version20210629140756', '2021-06-29 14:08:21', 150),
('DoctrineMigrations\\Version20210706125639', '2021-07-06 12:56:53', 939),
('DoctrineMigrations\\Version20210706131535', '2021-07-06 13:15:40', 471),
('DoctrineMigrations\\Version20210707101207', '2021-07-07 10:12:20', 799);

-- --------------------------------------------------------

--
-- Structure de la table `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_mini` int DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recti_machine_id` int DEFAULT NULL,
  `working` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matters` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_real` int DEFAULT NULL,
  `total_not_delivered` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `position`
--

INSERT INTO `position` (`id`, `name`, `stock_mini`, `type`, `recti_machine_id`, `working`, `matters`, `stock_real`, `total_not_delivered`) VALUES
(1, '1', 4, 'Boisseau', 3, 'Talon', 'Diamanté', 6, NULL),
(2, '2', 4, 'Boisseau', 3, 'Talon', 'Diamanté', 7, NULL),
(3, '3', 4, 'Boisseau', 3, 'Talon', 'Résine', 7, NULL),
(4, '4 et 12', 8, 'Boisseau', 3, 'Arête', 'Diamanté/Résine', 10, NULL),
(5, '5 et 13', 8, 'Boisseau', 3, 'Arête', 'Polissante', 34, NULL),
(6, '9', 10, 'Boisseau', 3, 'Talon', 'Polissante', 23, NULL),
(7, '10', 10, 'Boisseau', 3, 'Talon', 'Polissante', 15, NULL),
(8, '11', 8, 'Boisseau', 3, 'Talon', 'Cérium', 13, NULL),
(9, '6', 0, 'Périphérique', 3, 'Joint complet', 'Diamanté', 0, NULL),
(10, '7', 0, 'Périphérique', 3, 'Joint complet', 'Diamanté', 0, NULL),
(11, '8', 0, 'Périphérique', 3, 'Joint complet', 'Polissante', 0, NULL),
(12, '1', 2, 'Boisseau', 4, 'Talon', 'Diamanté', 3, NULL),
(13, '2', 1, 'Boisseau', 4, 'Talon', 'Diamanté', 3, NULL),
(14, '3', 1, 'Boisseau', 4, 'Talon', 'Résine', 2, NULL),
(15, '4', 3, 'Boisseau', 4, 'Talon', 'Polissante', 23, NULL),
(16, '5', 3, 'Boisseau', 4, 'Talon', 'Polissante', 27, NULL),
(17, '6', 1, 'Boisseau', 4, 'Talon', 'Cérium', 3, NULL),
(18, '7 et 9', 4, 'Boisseau', 4, 'Arête', 'Diamanté/Résine', 6, NULL),
(19, '8 et 10', 4, 'Boisseau', 4, 'Arête', 'Polissante', 5, NULL),
(20, '1', 4, 'Boisseau', 5, 'Talon', 'Diamanté', 5, NULL),
(21, '2', 3, 'Boisseau', 5, 'Talon', 'Diamanté', 2, NULL),
(22, '3', 4, 'Boisseau', 5, 'Talon', 'Polissante', 10, NULL),
(23, '4', 4, 'Boisseau', 5, 'Talon', 'Polissante', 10, NULL),
(24, '5', 1, 'Boisseau', 5, 'Talon', 'Cérium', 3, NULL),
(25, '6 et 7', 4, 'Boisseau', 5, 'Arête', 'Diamanté', 4, NULL),
(26, '7 et 9', 6, 'Boisseau', 5, 'Arête', 'Polissante', 29, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `provider`
--

CREATE TABLE `provider` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `provider`
--

INSERT INTO `provider` (`id`, `name`) VALUES
(5, 'DIAMUT / BIESSE'),
(6, 'ATG / MORESCHI'),
(7, 'EC GLASS'),
(8, 'BOHLE');

-- --------------------------------------------------------

--
-- Structure de la table `recti_machine`
--

CREATE TABLE `recti_machine` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recti_machine`
--

INSERT INTO `recti_machine` (`id`, `name`) VALUES
(5, 'baudin'),
(3, 'bilaterales'),
(4, 'rock');

-- --------------------------------------------------------

--
-- Structure de la table `recti_machine_consumption`
--

CREATE TABLE `recti_machine_consumption` (
  `id` int NOT NULL,
  `provider_id` int DEFAULT NULL,
  `position_id` int DEFAULT NULL,
  `machine_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `machine_side` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linear_meters` int DEFAULT NULL,
  `date` date NOT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recti_machine_consumption`
--

INSERT INTO `recti_machine_consumption` (`id`, `provider_id`, `position_id`, `machine_number`, `machine_side`, `linear_meters`, `date`, `ref`) VALUES
(1, 6, 4, 'F10', 'mobil', NULL, '2021-05-20', '0D010100816-43'),
(2, 6, 4, 'F10', 'fixe', NULL, '2021-05-17', '0D010100816-43'),
(3, 6, 4, 'F10', 'mobil', NULL, '2021-05-20', 'OB010100366-43'),
(4, 6, 14, 'Rock', NULL, NULL, '2021-07-07', '0D010100816-208'),
(5, 6, 4, 'F10', 'mobil', NULL, '2021-07-08', 'OB010100366-43');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(12, 'user', '[]', '$2y$13$8JPG0dL5nCzmU7R2WO245Oy5STIPzR9vslMSJwmpN72vb6tueCakC'),
(16, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$Y80q8GWJ4BenH8aBPSawWuHou7gT9.jQcKMJY84E47jGfcCTTXfk6'),
(19, 'super_user', '[\"ROLE_SUPER_USER\"]', '$2y$13$rETB1OU88NtTJjS03/wCvuSf/h.rcY.BuMjGUHhkGJzntFMfCqj96'),
(20, 'testdemotdepassefort', '[\"ROLE_ADMIN\"]', '$2y$13$R7uULDWUbWWVkncsXdqTiOY9gLGMGcgXRGwgwDVfiPKI25G836kka'),
(21, 'master35', '[\"ROLE_USER\"]', '$2y$13$l/9F4DUscW.smZY2mYsUm.EqT46cbWMFQGXm5UIYKzhW1Ig3EoFoe'),
(22, 'master33', '[\"ROLE_USER\"]', '$2y$13$/NC5KkEiswYR.n0t8s.vYeaQo1FvlHaCqWLYNBGUra0QGTwZiDCW2');

-- --------------------------------------------------------

--
-- Structure de la table `wheels_cu`
--

CREATE TABLE `wheels_cu` (
  `id` int NOT NULL,
  `provider_id` int DEFAULT NULL,
  `wheels_cu_type_id` int DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diameter` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `grain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `tav_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `not_delivered` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wheels_cu`
--

INSERT INTO `wheels_cu` (`id`, `provider_id`, `wheels_cu_type_id`, `ref`, `diameter`, `height`, `grain`, `stock`, `tav_name`, `not_delivered`) VALUES
(84, 6, 41, '0M030100222-816', 6, 55, '100', 5, 'Foret 6mm H55 1/2G', NULL),
(85, 5, 41, 'DOFF000006KCXL69', 6, 69, 'D181', 9, 'Foret 6mm H69 1/2G', NULL),
(86, 6, 67, '0M030100224-816', 8, 55, '100', 7, 'Foret 8mm H55 1/2G', NULL),
(87, 5, 67, 'DOFF000008KCXL69', 8, 69, 'D181', 10, 'Foret 8mm H69 1/2G', NULL),
(88, 6, 68, 'OM030100226-816', 10, 55, '100', 5, 'Foret 10mm H55 1/2G', NULL),
(89, 5, 68, 'DOFF000010KCXL69', 10, 69, 'D181', 20, 'Foret 10mm H69 1/2G', NULL),
(90, 6, 69, '0M030100227-816', 11, 55, '100', 6, 'Foret 11mm H55 1/2G', NULL),
(91, 5, 69, 'DOFF000011KCXL69', 11, 69, 'D181', 7, 'Foret 11mm H69 1/2G', NULL),
(92, 6, 70, '0M030100228-816', 12, 55, '100', 6, 'Foret 12mm H55 1/2G', NULL),
(93, 6, 72, '0M030100230-816', 14, 55, '100', 2, 'Foret 14mm H55 1/2G', NULL),
(94, 5, 72, 'DOFF000014KCXL69', 14, 69, 'D181', 13, 'Foret 14mm H69 1/2G', NULL),
(95, 6, 74, '0M030100232-816', 16, 55, '100', 3, 'Foret 16mm H55 1/2G', NULL),
(96, 6, 76, '0M030100234-816', 18, 55, '100', 4, 'Foret 18mm H55 1/2G', NULL),
(97, 5, 79, 'DOFF000020KCXL69', 20, 69, 'D181', 6, 'Foret 20mm H69 1/2G', NULL),
(98, 6, 80, '0M030100238-816', 22, 53, '100', 1, 'Foret 22mm H53 1/2G', NULL),
(99, 5, 80, 'DOFF000022KCXL69', 22, 69, 'D181', 7, 'Foret 22mm H69 1/2G', NULL),
(100, 5, 81, 'DOFF000024KCXL69', 24, 69, 'D181', 6, 'Foret 24mm H69 1/2G', NULL),
(101, 6, 82, '0M030100242-816', 26, 55, '100', 1, 'Foret 26mm H55 1/2G', NULL),
(102, 5, 147, 'DOFF000027KCXL69', 27, 69, 'D181', 5, 'Foret 27mm H69 1/2G', NULL),
(103, 5, 83, 'DOFF000028KCXL69', 28, 69, 'D181', 5, 'Foret 28mm H69 1/2G', NULL),
(104, 6, 66, '0M030100221-816', 5, 55, '100', 2, 'Foret 5mm H55 1/2G', NULL),
(105, 6, 78, '0M030100223-816', 7, 55, '100', 1, 'Foret 7mm H55 1/2G', NULL),
(106, 5, 77, 'DOFF000009KCXL69', 9, 69, 'D181', 4, 'Foret 9mm H69 1/2G', NULL),
(107, 5, 70, 'DOFF000012KCXL69', 12, 69, 'D181', 2, 'Foret 12mm H69 1/2G', NULL),
(108, 5, 71, 'DOFF000013KCXL69', 13, 69, 'D181', 4, 'Foret 13mm H69 1/2G', NULL),
(109, 5, 73, 'DOFF000015KCXL69', 15, 69, 'D181', 4, 'Foret 15mm H69 1/2G', NULL),
(110, 5, 74, 'DOFF000016KCXL69', 16, 69, 'D181', 5, 'Foret 16mm H69 1/2G', NULL),
(111, 5, 76, 'DOFF000018KCXL69', 18, 69, 'D181', 3, 'Foret 18mm H69 1/2G', NULL),
(112, 6, 79, '0M030100236-816', 20, 55, '100', 4, 'Foret 20mm H55 1/2G', NULL),
(113, 5, 148, 'DOFF000025KCXL69', 25, 69, 'D181', 4, 'Foret 25mm H69 1/2G', NULL),
(114, 5, 82, 'DOFF000026KCXL69', 26, 69, 'D181', 4, 'Foret 26mm H69 1/2G', NULL),
(115, 5, 84, 'DOFF000030KCXL69', 30, 69, 'D181', 2, 'Foret 30mm H69 1/2G', NULL),
(116, 5, 85, 'DOFF000032KCXL69', 32, 69, 'D181', 4, 'Foret 32mm H69 1/2G', NULL),
(117, 5, 86, 'DOFF000034KCXL69', 34, 69, 'D181', 2, 'Foret 34mm H69 1/2G', NULL),
(118, 5, 87, 'DOFF000036KCXL69', 36, 69, 'D181', 4, 'Foret 36mm H69 1/2G', NULL),
(119, 5, 88, 'DOFF000038KCXL69', 38, 69, 'D181', 2, 'Foret 38mm H69 1/2G', NULL),
(120, 6, 64, '0K010200216-76', 10, 27, '50', 7, 'Fraise D10 H75 F27 3s', NULL),
(121, 6, 3, '0K010200217-76', 20, 40, '50', 3, 'Fraise D20 H100 F40 4s', NULL),
(122, 6, 159, '0A060100077-242', 20, 12, '170', 2, 'Diabolo 6mm D20 Alésage 12mm', NULL),
(123, 6, 160, '0A060100080-242', 20, 14, '170', 3, 'Diabolo 8mm D20 Alésage 12mm', NULL),
(124, 6, 161, '0A060100084-242', 20, 16, '170', 4, 'Diabolo 10mm D20 Alésage 12mm', NULL),
(125, 5, 4, 'DFR01525', 10, 72, 'D126', 3, 'Diabolo 4mm D10 1/2G', NULL),
(126, 6, 4, '0A060100023-76', 10, 75, '200', 2, 'Diabolo 4mm D10 1/2G', NULL),
(127, 5, 42, 'DFR01277', 10, 72, 'D126', 1, 'Diabolo 6mm D10 1/2G', NULL),
(128, 6, 42, '0A060100026-76', 10, 75, '200', 2, 'Diabolo 6mm D10 1/2G', NULL),
(129, 5, 150, 'DFR01495', 6, 72, 'D126', 3, 'Diabolo 5mm D6 1/2G', NULL),
(130, 5, 42, 'DFR01965', 10, 72, 'D107', 2, 'Diabolo 6mm D10 1/2G', NULL),
(131, 5, 151, 'DFR01509', 6, 72, 'D126', 6, 'Diabolo 6mm D6 1/2G', NULL),
(132, 6, 44, '0A060100032-76', 10, 75, '200', 1, 'Diabolo 10mm D10 1/2G', NULL),
(133, 5, 47, 'DFR01406', 10, 79, 'D107', 1, 'Diabolo 19mm D10 1/2G', NULL),
(134, 5, 152, 'DFR01510', 6, 72, 'D126', 3, 'Diabolo 8mm D6 1/2G', NULL),
(135, 5, 153, 'DFR01511', 6, 72, 'D126', 3, 'Diabolo 10mm D6 1/2G', NULL),
(136, 5, 154, 'DFR01743', 6, 72, 'D126', 2, 'Diabolo 12mm D6 1/2G', NULL),
(137, 5, 161, 'DFR04994', 16, 72, 'D126', 1, 'Diabolo 10mm D16 1/2G', NULL),
(138, 6, 45, '0A060100035-76', 10, 75, '200', 1, 'Diabolo 12mm D10 1/2G', NULL),
(139, 5, 164, 'DFR01319', 16, 79, 'D107', 1, 'Diabolo 19mm D16 1/2G', NULL),
(140, 5, 90, 'DL15509PW', 25, 25, 'TOP 1', 43, 'Diabolo Polissante D25 H25 Alésage 12', NULL),
(141, 6, 89, 'ABTT251512', 25, 15, 'TOP 1', 23, 'Diabolo Polissante D25 H15 Alésage 12', NULL),
(142, 6, 118, '0A060600198-319', 150, 12, '230', 1, 'Fine Trapèzoidale 6mm D150', NULL),
(143, 6, 119, '0A060600200-319', 150, 14, '230', 3, 'Fine Trapèzoidale 8mm D150', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wheels_cu_type`
--

CREATE TABLE `wheels_cu_type` (
  `id` int NOT NULL,
  `cu_id` int DEFAULT NULL,
  `matters` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_mini` int DEFAULT NULL,
  `stock_real` int DEFAULT NULL,
  `total_not_delivered` int DEFAULT NULL,
  `working` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cu_category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wheels_cu_type`
--

INSERT INTO `wheels_cu_type` (`id`, `cu_id`, `matters`, `stock_mini`, `stock_real`, `total_not_delivered`, `working`, `type`, `cu_category_id`) VALUES
(1, 7, 'Diamanté', 2, 0, NULL, 'Joint encoche', 'Diabolo 5mm D10', 1),
(3, 7, 'Diamanté', 5, 3, NULL, 'Découpe', 'Fraise D20', 2),
(4, 7, 'Diamant', 2, 5, NULL, 'Joint Encoche', 'Diabolo 4mm D10', 1),
(8, 5, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 5mm D100', 3),
(12, 6, 'Diamant', 4, 0, NULL, 'Joint', 'Segmentée 4/5/6mm D150', 4),
(21, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 4mm D150', 3),
(41, 7, 'Diamant', 4, 14, NULL, 'Perçage', 'Foret 6mm', 8),
(42, 7, 'Diamant', 4, 5, NULL, 'Joint Encoche', 'Diabolo 6mm D10', 1),
(43, 7, 'Diamant', 4, 0, NULL, 'Joint Encoche', 'Diabolo 8mm D10', 1),
(44, 7, 'Diamant', 3, 1, NULL, 'Joint Encoche', 'Diabolo 10mm D10', 1),
(45, 7, 'Diamant', 2, 1, NULL, 'Joint Encoche', 'Diabolo 12mm D10', 1),
(46, 7, 'Diamant', 1, 0, NULL, 'Joint Encoche', 'Diabolo 15mm D10', 1),
(47, 7, 'Diamant', 1, 1, NULL, 'Joint Encoche', 'Diabolo 19mm D10', 1),
(64, 7, 'Diamant', 5, 7, NULL, 'Découpe', 'Fraise D10', 2),
(65, 7, 'Diamant', 0, 0, NULL, 'Perçage', 'Foret 4mm', 8),
(66, 7, 'Diamant', 2, 2, NULL, 'Perçage', 'Foret 5mm', 8),
(67, 7, 'Diamant', 4, 17, NULL, 'Perçage', 'Foret 8mm', 8),
(68, 7, 'Diamant', 4, 25, NULL, 'Perçage', 'Foret 10mm', 8),
(69, 7, 'Diamant', 2, 13, NULL, 'Perçage', 'Foret 11mm', 8),
(70, 7, 'Diamant', 4, 8, NULL, 'Perçage', 'Foret 12mm', 8),
(71, 7, 'Diamant', 3, 4, NULL, 'Perçage', 'Foret 13mm', 8),
(72, 7, 'Diamant', 4, 15, NULL, 'Perçage', 'Foret 14mm', 8),
(73, 7, 'Diamant', 3, 4, NULL, 'Perçage', 'Foret 15mm', 8),
(74, 7, 'Diamant', 4, 8, NULL, 'Perçage', 'Foret 16mm', 8),
(75, 7, 'Diamant', 1, 0, NULL, 'Perçage', 'Foret 17mm', 8),
(76, 7, 'Diamant', 3, 7, NULL, 'Perçage', 'Foret 18mm', 8),
(77, 7, 'Diamant', 2, 4, NULL, 'Perçage', 'Foret 9mm', 8),
(78, 7, 'Diamant', 2, 1, NULL, 'Perçage', 'Foret 7mm', 8),
(79, 7, 'Diamant', 2, 10, NULL, 'Perçage', 'Foret 20mm', 8),
(80, 7, 'Diamant', 2, 8, NULL, 'Perçage', 'Foret 22mm', 8),
(81, 7, 'Diamant', 2, 6, NULL, 'Perçage', 'Foret 24mm', 8),
(82, 7, 'Diamant', 2, 5, NULL, 'Perçage', 'Foret 26mm', 8),
(83, 7, 'Diamant', 2, 5, NULL, 'Perçage', 'Foret 28mm', 8),
(84, 7, 'Diamant', 1, 2, NULL, 'Perçage', 'Foret 30mm', 8),
(85, 7, 'Diamant', 1, 4, NULL, 'Perçage', 'Foret 32mm', 8),
(86, 7, 'Diamant', 1, 2, NULL, 'Perçage', 'Foret 34mm', 8),
(87, 7, 'Diamant', 1, 4, NULL, 'Perçage', 'Foret 36mm', 8),
(88, 7, 'Diamant', 1, 2, NULL, 'Perçage', 'Foret 38mm', 8),
(89, 7, 'Polissante', 15, 23, NULL, 'Joint Encoche', 'Diabolo Petite Poli H15', 1),
(90, 7, 'Polissante', 15, 43, NULL, 'Joint Encoche', 'Diabolo Petite Poli H25', 1),
(91, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 4mm D100', 3),
(92, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 6mm D100', 3),
(93, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 8mm D100', 3),
(94, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 10mm D100', 3),
(95, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 12mm D100', 3),
(96, 5, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 15mm D100', 3),
(97, 5, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 19mm D100', 3),
(98, 5, 'Diamant', 3, 0, NULL, 'Joint', 'Segmentée 4/5/6mm D100', 4),
(99, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 8mm D100', 4),
(100, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 10mm D100', 4),
(101, 5, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 12mm D100', 4),
(102, 5, 'Diamant', 1, 0, NULL, 'Joint', 'Segmentée 15/19mm D100', 4),
(103, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H10 D100', 6),
(104, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H10 D100', 6),
(105, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H15 D100', 6),
(106, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H15 D100', 6),
(107, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H20 D100', 6),
(108, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H20 D100', 6),
(109, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H25 D100', 6),
(110, 5, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H25 D100', 6),
(111, 5, 'Diamant', 2, 0, NULL, 'Gravure', 'Filet de Versailles Diamantée 6mm', 22),
(112, 5, 'Polissante', 10, 0, NULL, 'Gravure', 'Filet de Versailles Polissante 6mm', 22),
(113, 5, 'Diamant', 2, 0, NULL, 'Gravure', 'Filet de Versailles Diamantée 8mm', 22),
(114, 5, 'Polissante', 10, 0, NULL, 'Gravure', 'Filet de Versailles Polissante 8mm', 22),
(115, 5, 'Diamant', 1, 0, NULL, 'Gravure', 'Filet de Versailles Diamantée 10mm', 22),
(116, 5, 'Polissante', 5, 0, NULL, 'Gravure', 'Filet de Versailles Polissante 10mm', 22),
(117, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 5mm D150', 3),
(118, 6, 'Diamant', 2, 1, NULL, 'Joint', 'Fine Trapèzoidale 6mm D150', 3),
(119, 6, 'Diamant', 2, 3, NULL, 'Joint', 'Fine Trapèzoidale 8mm D150', 3),
(120, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 10mm D150', 3),
(121, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 12mm D150', 3),
(122, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 15mm D150', 3),
(123, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 19mm D150', 3),
(124, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 33.2 D150', 3),
(125, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 44.2 D150', 3),
(126, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 55.2 D150', 3),
(127, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Fine Trapèzoidale 66.2 D150', 3),
(128, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Fine Trapèzoidale 88.2 D150', 3),
(129, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 8mm D150', 4),
(130, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 10mm D150', 4),
(131, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Segmentée 12mm D150', 4),
(132, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Segmentée 15mm D150', 4),
(133, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Segmentée 19mm D150', 4),
(134, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 33.2 D150', 4),
(135, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 44.2 D150', 4),
(136, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 55.2 D150', 4),
(137, 6, 'Diamant', 2, 0, NULL, 'Joint', 'Segmentée 66.2 D150', 4),
(138, 6, 'Diamant', 1, 0, NULL, 'Joint', 'Segmentée 88.2 D150', 4),
(139, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H10 D150', 6),
(140, 6, 'Diamant', 10, 0, NULL, 'Joint', 'Polissante Top G H10 D150', 6),
(141, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H15 D150', 6),
(142, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H15 D150', 6),
(143, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H20 D150', 6),
(144, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H20 D150', 6),
(145, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top 1 H25 D150', 6),
(146, 6, 'Polissante', 10, 0, NULL, 'Joint', 'Polissante Top G H25 D150', 6),
(147, 7, 'Diamant', 1, 5, NULL, 'Perçage', 'Foret 27mm', 8),
(148, 7, 'Diamant', 2, 4, NULL, 'Perçage', 'Foret 25mm', 8),
(149, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 4mm D6', 1),
(150, 7, 'Diamant', 0, 3, NULL, 'Joint Encoche', 'Diabolo 5mm D6', 1),
(151, 7, 'Diamant', 0, 6, NULL, 'Joint Encoche', 'Diabolo 6mm D6', 1),
(152, 7, 'Diamant', 0, 3, NULL, 'Joint Encoche', 'Diabolo 8mm D6', 1),
(153, 7, 'Diamant', 0, 3, NULL, 'Joint Encoche', 'Diabolo 10mm D6', 1),
(154, 7, 'Diamant', 0, 2, NULL, 'Joint Encoche', 'Diabolo 12mm D6', 1),
(155, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 15mm D6', 1),
(156, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 19mm D6', 1),
(157, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 4mm D20', 1),
(158, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 5mm D25', 1),
(159, 7, 'Diamant', 0, 2, NULL, 'Joint Encoche', 'Diabolo 6mm D20', 1),
(160, 7, 'Diamant', 1, 3, NULL, 'Joint Encoche', 'Diabolo 8mm D20', 1),
(161, 7, 'Diamant', 1, 5, NULL, 'Joint Encoche', 'Diabolo 10mm D20', 1),
(162, 7, 'Diamant', 1, 0, NULL, 'Joint Encoche', 'Diabolo 12mm D20', 1),
(163, 7, 'Diamant', 0, 0, NULL, 'Joint Encoche', 'Diabolo 15mm D20', 1),
(164, 7, 'Diamant', 0, 1, NULL, 'Joint Encoche', 'Diabolo 19mm D20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `wheels_recti_machine`
--

CREATE TABLE `wheels_recti_machine` (
  `id` int NOT NULL,
  `provider_id` int DEFAULT NULL,
  `position_id` int DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tavname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diameter` int NOT NULL,
  `height` int DEFAULT NULL,
  `stock` int NOT NULL,
  `not_delivered` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wheels_recti_machine`
--

INSERT INTO `wheels_recti_machine` (`id`, `provider_id`, `position_id`, `ref`, `tavname`, `grain`, `diameter`, `height`, `stock`, `not_delivered`) VALUES
(40, 5, 1, 'DT01139', 'Meule Diamanté Bilatérale Position 1', 'D151', 175, 35, 4, NULL),
(41, 5, 2, 'DT01109', 'Meule Diamanté Bilatérale Position 2', 'D91', 175, 35, 5, NULL),
(42, 5, 3, 'DR01140', 'Meule Résine Bilatérale Position 3', 'D76', 175, 35, 3, NULL),
(43, 6, 1, '0B010200175-43', 'Meule Diamanté Bilatérale Position 1', '100', 175, 35, 2, NULL),
(44, 6, 2, '0B010200117-43', 'Meule Diamanté Bilatérale Position 2', '170', 175, 35, 2, NULL),
(45, 6, 3, '0B010200518-43', 'Meule Résine Bilatérale Position 3', '200', 175, 35, 4, NULL),
(46, 5, 4, 'DR20147', 'Meule d\'arête Résine Bilatérale', 'D54', 150, 35, 4, NULL),
(47, 6, 4, '0D010100816-43', 'Meule d\'arête Résine Bilatérale', '270', 150, 35, 1, NULL),
(48, 6, 4, 'OB010100366-43', 'Meule d\'arête Diamanté Bilatérale', '270', 150, 35, 5, NULL),
(49, 5, 5, 'DL15949', 'Meule d\'arête Polissante Bilatérale', 'Green Arris', 150, 60, 22, NULL),
(50, 6, 5, '0F010100046-414', 'Meule d\'arête Polissante Bilatérale', 'AB400', 150, 60, 4, NULL),
(51, 6, 5, '0F010100188-204', 'Meule d\'arête Polissante Bilatérale', '600 Green', 150, 40, 4, NULL),
(52, 5, 6, 'DL16850', 'Meule Polissante Bilatérale Position 9', 'A040BQ5', 150, 40, 15, NULL),
(53, 6, 6, '0H010100019-204', 'Meule Polissante Bilatérale Position 9', '10S40', 150, 40, 4, NULL),
(54, 6, 6, '0H010200011-469', 'Meule Polissante Bilatérale Position 9', '9RS40', 150, 40, 4, NULL),
(55, 5, 7, 'DL16851', 'Meule Polissante Bilatérale Position 10', 'A060BQ5', 150, 40, 7, NULL),
(56, 6, 7, '0H010100016-204', 'Meule Polissante Bilatérale Position 10', '9R80', 150, 40, 4, NULL),
(57, 6, 7, '0H010200010-469', 'Meule Polissante Bilatérale Position 10', '9RS60', 150, 40, 4, NULL),
(58, 5, 8, 'DL15785', 'Meule d\'arête Cérium Bilatérale', 'X09', 150, 47, 9, NULL),
(59, 6, 8, '0H010200015-469', 'Meule Polissante Bilatérale Position 11', '9RS80', 150, 30, 4, NULL),
(60, 5, 12, 'DT10014', 'Meule Diamanté Rock Position 1', 'D151', 150, 38, 2, NULL),
(61, 6, 12, 'OB050200154-208', 'Meule Diamanté Rock Position 1', '100', 150, 38, 1, NULL),
(62, 5, 13, 'DT10006', 'Meule Diamanté Rock Position 2', 'D107', 150, 39, 2, NULL),
(63, 6, 13, '0B010500019-208', 'Meule Diamanté Rock Position 2', '200', 150, 36, 1, NULL),
(64, 5, 14, 'DR20001', 'Meule Résine Rock Position 3', 'D64', 150, 46, 2, NULL),
(65, 6, 14, '0D010100816-208', 'Meule Résine Rock Position 3', '270', 150, 37, 0, NULL),
(66, 5, 15, 'DL12945', 'Meule Polissante Rock Position 4', '10S40', 150, 30, 5, NULL),
(67, 6, 15, '0H010100019-204', 'Meule Polissante Rock Position 4', '10S40', 150, 40, 13, NULL),
(68, 6, 15, '0H010100006-200', 'Meule Polissante Rock Position 4', '10S40', 150, 30, 5, NULL),
(69, 5, 16, 'DL10190', 'Meule Polissante Rock Position 5', '9R80', 150, 30, 8, NULL),
(70, 6, 16, '0H010100016-204', 'Meule Polissante Rock Position 5', '9R80', 150, 40, 14, NULL),
(71, 6, 16, '0H010100003-200', 'Meule Polissante Rock Position 5', '9R80', 150, 30, 5, NULL),
(72, 5, 17, 'DL11394', 'Meule Cérium Rock Position 6', 'Feutre', 150, 40, 2, NULL),
(73, 6, 17, '0H010100178-200', 'Meule Cérium Rock Position 6', 'X5000', 150, 30, 1, NULL),
(74, 5, 18, 'DR20036', 'Meule d\'arête Résine Rock', 'D64', 100, 24, 4, NULL),
(75, 6, 18, '0B010100275-2', 'Meule d\'arête Diamanté Rock', '230', 100, 41, 2, NULL),
(76, 5, 19, 'DL11607', 'Meule d\'arête Polissante Rock', 'GREY', 100, 45, 3, NULL),
(77, 6, 19, '0F010100190-89', 'Meule d\'arête Polissante Rock', '600 Green', 100, 38, 2, NULL),
(78, 6, 20, '0B050200159-173', 'Meule Diamanté Baudin Position 1', '120', 150, 35, 4, NULL),
(79, 7, 20, 'KT0766', 'Meule Diamanté Baudin Position 1', 'D151', 150, 40, 1, NULL),
(80, 6, 21, '0B010500073-173', 'Meule Diamanté Baudin Position 2', '200', 150, 35, 1, NULL),
(81, 7, 21, 'KT0238', 'Meule Diamanté Baudin Position 2', 'D91', 150, 40, 1, NULL),
(82, 6, 22, '0H010100019-204', 'Meule Polissante Baudin Position 3', '10S40', 150, 40, 10, NULL),
(83, 6, 23, '0H010100016-204', 'Meule Polissante Baudin Position 4', '9R80', 150, 40, 10, NULL),
(84, 6, 24, '0H010100379-469', 'Meule Cérium Baudin Position 5', 'X09', 150, 40, 3, NULL),
(85, 6, 25, '0B010100421-173', 'Meule d\'arête Diamanté Baudin', '200', 150, 35, 4, NULL),
(86, 6, 26, '0F010100092-204', 'Meule d\'arête Polissante Baudin', 'BLACK', 150, 40, 6, NULL),
(87, 7, 26, 'NULL', 'Meule d\'arête Polissante Baudin', 'RR80.G4', 150, 40, 23, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cu`
--
ALTER TABLE `cu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cu_categories`
--
ALTER TABLE `cu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cu_consumption`
--
ALTER TABLE `cu_consumption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F4B45CAA53A8AA` (`provider_id`),
  ADD KEY `IDX_8F4B45CAC645D94C` (`wheels_cu_type_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_462CE4F54B5D68C` (`recti_machine_id`);

--
-- Index pour la table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recti_machine`
--
ALTER TABLE `recti_machine`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A71697E15E237E06` (`name`);

--
-- Index pour la table `recti_machine_consumption`
--
ALTER TABLE `recti_machine_consumption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FB2B2ADDA53A8AA` (`provider_id`),
  ADD KEY `IDX_FB2B2ADDDD842E46` (`position_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Index pour la table `wheels_cu`
--
ALTER TABLE `wheels_cu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DC65BD73A53A8AA` (`provider_id`),
  ADD KEY `IDX_DC65BD73C645D94C` (`wheels_cu_type_id`);

--
-- Index pour la table `wheels_cu_type`
--
ALTER TABLE `wheels_cu_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E300A8B2DD51B60C` (`cu_id`),
  ADD KEY `IDX_E300A8B2B1F2F5D1` (`cu_category_id`);

--
-- Index pour la table `wheels_recti_machine`
--
ALTER TABLE `wheels_recti_machine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97BBB338A53A8AA` (`provider_id`),
  ADD KEY `IDX_97BBB338DD842E46` (`position_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cu`
--
ALTER TABLE `cu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `cu_categories`
--
ALTER TABLE `cu_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `cu_consumption`
--
ALTER TABLE `cu_consumption`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `recti_machine`
--
ALTER TABLE `recti_machine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `recti_machine_consumption`
--
ALTER TABLE `recti_machine_consumption`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `wheels_cu`
--
ALTER TABLE `wheels_cu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT pour la table `wheels_cu_type`
--
ALTER TABLE `wheels_cu_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT pour la table `wheels_recti_machine`
--
ALTER TABLE `wheels_recti_machine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cu_consumption`
--
ALTER TABLE `cu_consumption`
  ADD CONSTRAINT `FK_8F4B45CAA53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`),
  ADD CONSTRAINT `FK_8F4B45CAC645D94C` FOREIGN KEY (`wheels_cu_type_id`) REFERENCES `wheels_cu_type` (`id`);

--
-- Contraintes pour la table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `FK_462CE4F54B5D68C` FOREIGN KEY (`recti_machine_id`) REFERENCES `recti_machine` (`id`);

--
-- Contraintes pour la table `recti_machine_consumption`
--
ALTER TABLE `recti_machine_consumption`
  ADD CONSTRAINT `FK_FB2B2ADDA53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`),
  ADD CONSTRAINT `FK_FB2B2ADDDD842E46` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Contraintes pour la table `wheels_cu`
--
ALTER TABLE `wheels_cu`
  ADD CONSTRAINT `FK_DC65BD73A53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`),
  ADD CONSTRAINT `FK_DC65BD73C645D94C` FOREIGN KEY (`wheels_cu_type_id`) REFERENCES `wheels_cu_type` (`id`);

--
-- Contraintes pour la table `wheels_cu_type`
--
ALTER TABLE `wheels_cu_type`
  ADD CONSTRAINT `FK_E300A8B2B1F2F5D1` FOREIGN KEY (`cu_category_id`) REFERENCES `cu_categories` (`id`),
  ADD CONSTRAINT `FK_E300A8B2DD51B60C` FOREIGN KEY (`cu_id`) REFERENCES `cu` (`id`);

--
-- Contraintes pour la table `wheels_recti_machine`
--
ALTER TABLE `wheels_recti_machine`
  ADD CONSTRAINT `FK_97BBB338A53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`),
  ADD CONSTRAINT `FK_97BBB338DD842E46` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
