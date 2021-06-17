

INSERT INTO `cu` (`id`, `name`) VALUES
(5, 'masters'),
(6, 'vertmax'),
(7, 'vertmax-master');

-- --------------------------------------------------------

INSERT INTO `provider` (`id`, `name`) VALUES
(5, 'DIAMUT'),
(6, 'ATG'),
(7, 'EC GLASS'),
(8, 'BOHLE');

-- --------------------------------------------------------

INSERT INTO `recti_machine` (`id`, `name`) VALUES
(3, 'bilaterales'),
(4, 'rock'),
(5, 'baudin');

-- --------------------------------------------------------
INSERT INTO `position` (`id`, `recti_machine_id`, `name`, `stock_mini`, `type`, `working`, `matters`, `stock_real`, `total_not_delivered`) VALUES
(1, 3, '1', 4, 'Boisseau', 'Talon', 'Diamanté', 6, NULL),
(2, 3, '2', 4, 'Boisseau', 'Talon', 'Diamanté', 7, NULL),
(3, 3, '3', 4, 'Boisseau', 'Talon', 'Résine', 7, NULL),
(4, 3, '4 et 12', 8, 'Boisseau', 'Arête', 'Diamanté/Résine', 15, NULL),
(5, 3, '5 et 13', 8, 'Boisseau', 'Arête', 'Polissante', 34, NULL),
(6, 3, '9', 10, 'Boisseau', 'Talon', 'Polissante', 23, NULL),
(7, 3, '10', 10, 'Boisseau', 'Talon', 'Polissante', 15, NULL),
(8, 3, '11', 8, 'Boisseau', 'Talon', 'Cérium', 13, NULL),
(9, 3, '6', 0, 'Périphérique', 'Joint complet', 'Diamanté', 0, NULL),
(10, 3, '7', 0, 'Périphérique', 'Joint complet', 'Diamanté', 0, NULL),
(11, 3, '8', 0, 'Périphérique', 'Joint complet', 'Polissante', 0, NULL),
(12, 4, '1', 2, 'Boisseau', 'Talon', 'Diamanté', 3, NULL),
(13, 4, '2', 1, 'Boisseau', 'Talon', 'Diamanté', 3, NULL),
(14, 4, '3', 1, 'Boisseau', 'Talon', 'Résine', 3, NULL),
(15, 4, '4', 3, 'Boisseau', 'Talon', 'Polissante', 23, NULL),
(16, 4, '5', 3, 'Boisseau', 'Talon', 'Polissante', 27, NULL),
(17, 4, '6', 1, 'Boisseau', 'Talon', 'Cérium', 3, NULL),
(18, 4, '7 et 9', 4, 'Boisseau', 'Arête', 'Diamanté/Résine', 6, NULL),
(19, 4, '8 et 10', 4, 'Boisseau', 'Arête', 'Polissante', 5, NULL),
(20, 5, '1', 4, 'Boisseau', 'Talon', 'Diamanté', 5, NULL),
(21, 5, '2', 3, 'Boisseau', 'Talon', 'Diamanté', 2, NULL),
(22, 5, '3', 4, 'Boisseau', 'Talon', 'Polissante', 10, NULL),
(23, 5, '4', 4, 'Boisseau', 'Talon', 'Polissante', 10, NULL),
(24, 5, '5', 1, 'Boisseau', 'Talon', 'Cérium', 3, NULL),
(25, 5, '6 et 7', 4, 'Boisseau', 'Arête', 'Diamanté', 4, NULL),
(26, 5, '7 et 9', 6, 'Boisseau', 'Arête', 'Polissante', 29, NULL);

INSERT INTO `wheels_recti_machine` (`id`, `ref`, `tavname`, `grain`, `diameter`, `height`, `stock`, `provider_id`, `not_delivered`, `position_id`) VALUES
(40, 'DT01139', 'Meule Diamanté Bilatérale Position 1', 'D151', 175, 35, 4, 5, NULL, 1),
(41, 'DT01109', 'Meule Diamanté Bilatérale Position 2', 'D91', 175, 35, 5, 5, NULL, 2),
(42, 'DR01140', 'Meule Résine Bilatérale Position 3', 'D76', 175, 35, 3, 5, NULL, 3),
(43, '0B010200175-43', 'Meule Diamanté Bilatérale Position 1', '100', 175, 35, 2, 6, NULL, 1),
(44, '0B010200117-43', 'Meule Diamanté Bilatérale Position 2', '170', 175, 35, 2, 6, NULL, 2),
(45, '0B010200518-43', 'Meule Résine Bilatérale Position 3', '200', 175, 35, 4, 6, NULL, 3),
(46, 'DR20147', 'Meule d\'arête Résine Bilatérale', 'D54', 150, 35, 5, 5, NULL, 4),
(47, '0D010100816-43', 'Meule d\'arête Résine Bilatérale', '270', 150, 35, 3, 6, NULL, 4),
(48, 'OB010100366-43', 'Meule d\'arête Diamanté Bilatérale', '270', 150, 35, 7, 6, NULL, 4),
(49, 'DL15949', 'Meule d\'arête Polissante Bilatérale', 'Green Arris', 150, 60, 22, 5, NULL, 5),
(50, '0F010100046-414', 'Meule d\'arête Polissante Bilatérale', 'AB400', 150, 60, 4, 6, NULL, 5),
(51, '0F010100188-204', 'Meule d\'arête Polissante Bilatérale', '600 Green', 150, 40, 4, 6, NULL, 5),
(52, 'DL16850', 'Meule Polissante Bilatérale Position 9', 'A040BQ5', 150, 40, 15, 5, NULL, 6),
(53, '0H010100019-204', 'Meule Polissante Bilatérale Position 9', '10S40', 150, 40, 4, 6, NULL, 6),
(54, '0H010200011-469', 'Meule Polissante Bilatérale Position 9', '9RS40', 150, 40, 4, 6, NULL, 6),
(55, 'DL16851', 'Meule Polissante Bilatérale Position 10', 'A060BQ5', 150, 40, 7, 5, NULL, 7),
(56, '0H010100016-204', 'Meule Polissante Bilatérale Position 10', '9R80', 150, 40, 4, 6, NULL, 7),
(57, '0H010200010-469', 'Meule Polissante Bilatérale Position 10', '9RS60', 150, 40, 4, 6, NULL, 7),
(58, 'DL15785', 'Meule d\'arête Cérium Bilatérale', 'X09', 150, 47, 9, 5, NULL, 8),
(59, '0H010200015-469', 'Meule Polissante Bilatérale Position 11', '9RS80', 150, 30, 4, 6, NULL, 8),
(60, 'DT10014', 'Meule Diamanté Rock Position 1', 'D151', 150, 38, 2, 5, NULL, 12),
(61, 'OB050200154-208', 'Meule Diamanté Rock Position 1', '100', 150, 38, 1, 6, NULL, 12),
(62, 'DT10006', 'Meule Diamanté Rock Position 2', 'D107', 150, 39, 2, 5, NULL, 13),
(63, '0B010500019-208', 'Meule Diamanté Rock Position 2', '200', 150, 36, 1, 6, NULL, 13),
(64, 'DR20001', 'Meule Résine Rock Position 3', 'D64', 150, 46, 2, 5, NULL, 14),
(65, '0D010100816-208', 'Meule Résine Rock Position 3', '270', 150, 37, 1, 6, NULL, 14),
(66, 'DL12945', 'Meule Polissante Rock Position 4', '10S40', 150, 30, 5, 5, NULL, 15),
(67, '0H010100019-204', 'Meule Polissante Rock Position 4', '10S40', 150, 40, 13, 6, NULL, 15),
(68, '0H010100006-200', 'Meule Polissante Rock Position 4', '10S40', 150, 30, 5, 6, NULL, 15),
(69, 'DL10190', 'Meule Polissante Rock Position 5', '9R80', 150, 30, 8, 5, NULL, 16),
(70, '0H010100016-204', 'Meule Polissante Rock Position 5', '9R80', 150, 40, 14, 6, NULL, 16),
(71, '0H010100003-200', 'Meule Polissante Rock Position 5', '9R80', 150, 30, 5, 6, NULL, 16),
(72, 'DL11394', 'Meule Cérium Rock Position 6', 'Feutre', 150, 40, 2, 5, NULL, 17),
(73, '0H010100178-200', 'Meule Cérium Rock Position 6', 'X5000', 150, 30, 1, 6, NULL, 17),
(74, 'DR20036', 'Meule d\'arête Résine Rock', 'D64', 100, 24, 4, 5, NULL, 18),
(75, '0B010100275-2', 'Meule d\'arête Diamanté Rock', '230', 100, 41, 2, 6, NULL, 18),
(76, 'DL11607', 'Meule d\'arête Polissante Rock', 'GREY', 100, 45, 3, 5, NULL, 19),
(77, '0F010100190-89', 'Meule d\'arête Polissante Rock', '600 Green', 100, 38, 2, 6, NULL, 19),
(78, '0B050200159-173', 'Meule Diamanté Baudin Position 1', '120', 150, 35, 4, 6, NULL, 20),
(79, 'KT0766', 'Meule Diamanté Baudin Position 1', 'D151', 150, 40, 1, 7, NULL, 20),
(80, '0B010500073-173', 'Meule Diamanté Baudin Position 2', '200', 150, 35, 1, 6, NULL, 21),
(81, 'KT0238', 'Meule Diamanté Baudin Position 2', 'D91', 150, 40, 1, 7, NULL, 21),
(82, '0H010100019-204', 'Meule Polissante Baudin Position 3', '10S40', 150, 40, 10, 6, NULL, 22),
(83, '0H010100016-204', 'Meule Polissante Baudin Position 4', '9R80', 150, 40, 10, 6, NULL, 23),
(84, '0H010100379-469', 'Meule Cérium Baudin Position 5', 'X09', 150, 40, 3, 6, NULL, 24),
(85, '0B010100421-173', 'Meule d\'arête Diamanté Baudin', '200', 150, 35, 4, 6, NULL, 25),
(86, '0F010100092-204', 'Meule d\'arête Polissante Baudin', 'BLACK', 150, 40, 6, 6, NULL, 26),
(87, 'NULL', 'Meule d\'arête Polissante Baudin', 'RR80.G4', 150, 40, 23, 7, NULL, 26);

-- --------------------------------------------------------

INSERT INTO `wheels_cu_type` (`id`, `tavname`, `working`, `matters`, `type`, `stock_mini`, `stock_real`, `cu_id`, `total_not_delivered`) VALUES
(1, 'désignation', 'Diabolo', 'Diamanté', 'Tout', 2, NULL, 7, NULL),
(3, 'désignation2', 'Fraise', 'Diamantée', '8mm', 5, NULL, 7, NULL),
(4, 'désignation3', 'Diabolo', 'Diamanté', '4mm', 6, NULL, 7, NULL),
(5, 'désignation4', 'Diabolo', 'Diamanté', '5mm', 7, NULL, 7, NULL),
(6, 'désignation0', 'Foret', 'Diamanté', '8mm', 9, 11, 7, NULL),
(7, 'désignation1', 'Diabolo', 'Diamantée', '4mm', 9, NULL, 7, NULL),
(8, 'Meule Trapézoidale Grain Fin Diamètre 100', 'Trapèze Fine D100', 'Diamanté', '5mm', 1, NULL, 5, NULL),
(9, 'désignation3', 'Trapèze D100', 'Polissante', '6mm', 5, NULL, 5, NULL),
(10, 'désignation4', 'Foret', 'Diamantée', '4mm', 8, NULL, 7, NULL),
(11, 'désignation5', 'Fraise', 'Diamantée', '6mm', 10, NULL, 7, NULL),
(12, 'désignation6', 'Ebauche', 'Polissante', '8mm', 2, NULL, 6, NULL),
(17, 'désignation0', 'Trapèzoidale', 'Polissante', '6mm', 4, NULL, 5, NULL),
(21, 'désignation4', 'Trapèzoidale', 'Polissante', '4mm', 2, NULL, 6, NULL),
(22, 'désignation5', 'Ebauche', 'Polissante', '6mm', 3, NULL, 7, NULL),
(24, 'désignation1', 'Trapèzoidale', 'Résine', '8mm', 9, NULL, 6, NULL),
(25, 'désignation2', 'Ebauche', 'Diamanté', '8mm', 10, NULL, 7, NULL),
(28, 'désignation0', 'Trapèzoidale', 'Résine', '6mm', 9, NULL, 7, NULL),
(29, 'désignation1', 'Diabolo', 'Résine', '5mm', 3, NULL, 5, NULL),
(31, 'désignation3', 'Diabolo', 'Polissante', '4mm', 3, NULL, 7, NULL),
(32, 'désignation4', 'Diabolo', 'Résine', '8mm', 9, NULL, 6, NULL),
(33, 'désignation5', 'Fraise', 'Diamanté', '8mm', 6, NULL, 5, NULL);


INSERT INTO `wheels_cu` (`id`, `provider_id`, `ref`, `diameter`, `height`, `grain`, `wheels_cu_type_id`, `stock`) VALUES
(1, 8, 'Reference-n0_0', 114, 36, 'grain0_0', 17, 2),
(2, 5, 'Reference-n0_1', 146, 12, 'grain0_1', 29, 3),
(3, 8, 'Reference-n1_0', 131, 77, 'grain1_0', 6, 3),
(4, 5, 'Reference-n1_1', 120, 63, 'grain1_1', 24, 6),
(5, 5, 'Reference-n2_0', 127, 85, 'grain2_0', 24, 2),
(6, 5, 'Reference-n2_1', 55, 36, 'grain2_1', 6, 8),
(7, NULL, 'Reference-n2_2', 91, 92, 'grain2_2', NULL, NULL),
(8, NULL, 'Reference-n3_0', 144, 84, 'grain3_0', NULL, NULL),
(9, NULL, 'Reference-n3_1', 89, 48, 'grain3_1', NULL, NULL),
(10, NULL, 'Reference-n3_2', 103, 83, 'grain3_2', NULL, NULL),
(11, NULL, 'Reference-n4_0', 70, 26, 'grain4_0', NULL, NULL),
(12, NULL, 'Reference-n4_1', 133, 39, 'grain4_1', NULL, NULL),
(13, NULL, 'Reference-n4_2', 41, 36, 'grain4_2', NULL, NULL),
(14, NULL, 'Reference-n0_0', 21, 29, 'grain0_0', NULL, NULL),
(15, NULL, 'Reference-n0_1', 129, 11, 'grain0_1', NULL, NULL),
(16, NULL, 'Reference-n1_0', 96, 31, 'grain1_0', NULL, NULL),
(17, NULL, 'Reference-n1_1', 148, 100, 'grain1_1', NULL, NULL),
(18, NULL, 'Reference-n1_2', 50, 55, 'grain1_2', NULL, NULL),
(19, NULL, 'Reference-n2_0', 39, 94, 'grain2_0', NULL, NULL),
(20, NULL, 'Reference-n3_0', 73, 54, 'grain3_0', NULL, NULL),
(21, NULL, 'Reference-n3_1', 109, 57, 'grain3_1', NULL, NULL),
(22, NULL, 'Reference-n3_2', 14, 22, 'grain3_2', NULL, NULL),
(23, NULL, 'Reference-n4_0', 33, 18, 'grain4_0', NULL, NULL),
(24, NULL, 'Reference-n4_1', 38, 78, 'grain4_1', NULL, NULL),
(25, NULL, 'Reference-n4_2', 16, 80, 'grain4_2', NULL, NULL),
(26, NULL, 'Reference-n5_0', 148, 62, 'grain5_0', NULL, NULL),
(27, NULL, 'Reference-n5_1', 55, 40, 'grain5_1', NULL, NULL),
(28, NULL, 'Reference-n5_2', 13, 33, 'grain5_2', NULL, NULL),
(29, NULL, 'Reference-n5_3', 134, 50, 'grain5_3', NULL, NULL),
(30, NULL, 'Reference-n6_0', 150, 71, 'grain6_0', NULL, NULL),
(31, NULL, 'Reference-n6_1', 125, 72, 'grain6_1', NULL, NULL),
(32, NULL, 'Reference-n0_0', 68, 75, 'grain0_0', NULL, NULL),
(33, NULL, 'Reference-n0_1', 53, 65, 'grain0_1', NULL, NULL),
(34, NULL, 'Reference-n1_0', 75, 97, 'grain1_0', NULL, NULL),
(35, NULL, 'Reference-n1_1', 146, 89, 'grain1_1', NULL, NULL),
(36, NULL, 'Reference-n1_2', 109, 76, 'grain1_2', NULL, NULL),
(37, NULL, 'Reference-n2_0', 102, 45, 'grain2_0', NULL, NULL),
(38, NULL, 'Reference-n2_1', 85, 80, 'grain2_1', NULL, NULL),
(39, NULL, 'Reference-n2_2', 91, 88, 'grain2_2', NULL, NULL),
(40, NULL, 'Reference-n3_0', 38, 73, 'grain3_0', NULL, NULL),
(41, NULL, 'Reference-n0_0', 131, 41, 'grain0_0', NULL, NULL),
(42, NULL, 'Reference-n0_1', 14, 26, 'grain0_1', NULL, NULL),
(43, NULL, 'Reference-n1_0', 26, 57, 'grain1_0', NULL, NULL),
(44, NULL, 'Reference-n1_1', 148, 70, 'grain1_1', NULL, NULL),
(45, NULL, 'Reference-n2_0', 33, 49, 'grain2_0', NULL, NULL),
(46, NULL, 'Reference-n2_1', 64, 41, 'grain2_1', NULL, NULL),
(47, NULL, 'Reference-n3_0', 82, 70, 'grain3_0', NULL, NULL),
(48, NULL, 'Reference-n3_1', 94, 90, 'grain3_1', NULL, NULL),
(49, NULL, 'Reference-n3_2', 64, 30, 'grain3_2', NULL, NULL),
(50, NULL, 'Reference-n3_3', 137, 17, 'grain3_3', NULL, NULL),
(51, NULL, 'Reference-n4_0', 23, 20, 'grain4_0', NULL, NULL),
(52, NULL, 'Reference-n4_1', 99, 15, 'grain4_1', NULL, NULL),
(53, NULL, 'Reference-n5_0', 88, 93, 'grain5_0', NULL, NULL),
(54, NULL, 'Reference-n0_0', 68, 18, 'grain0_0', NULL, NULL),
(55, NULL, 'Reference-n1_0', 117, 23, 'grain1_0', NULL, NULL),
(56, NULL, 'Reference-n1_1', 132, 81, 'grain1_1', NULL, NULL),
(57, NULL, 'Reference-n2_0', 30, 60, 'grain2_0', NULL, NULL),
(58, NULL, 'Reference-n2_1', 70, 85, 'grain2_1', NULL, NULL),
(59, NULL, 'Reference-n2_2', 67, 89, 'grain2_2', NULL, NULL),
(60, NULL, 'Reference-n3_0', 89, 65, 'grain3_0', NULL, NULL),
(61, NULL, 'Reference-n3_1', 22, 59, 'grain3_1', NULL, NULL),
(62, NULL, 'Reference-n3_2', 98, 91, 'grain3_2', NULL, NULL),
(63, NULL, 'Reference-n4_0', 127, 79, 'grain4_0', NULL, NULL),
(64, NULL, 'Reference-n0_0', 46, 78, 'grain0_0', NULL, NULL),
(65, NULL, 'Reference-n0_1', 63, 57, 'grain0_1', NULL, NULL),
(66, NULL, 'Reference-n1_0', 88, 25, 'grain1_0', NULL, NULL),
(67, NULL, 'Reference-n1_1', 12, 43, 'grain1_1', NULL, NULL),
(68, NULL, 'Reference-n1_2', 66, 32, 'grain1_2', NULL, NULL),
(69, NULL, 'Reference-n2_0', 61, 11, 'grain2_0', NULL, NULL),
(70, NULL, 'Reference-n2_1', 28, 47, 'grain2_1', NULL, NULL),
(71, NULL, 'Reference-n3_0', 75, 92, 'grain3_0', NULL, NULL),
(72, NULL, 'Reference-n3_1', 123, 99, 'grain3_1', NULL, NULL),
(73, NULL, 'Reference-n4_0', 11, 24, 'grain4_0', NULL, NULL),
(74, NULL, 'Reference-n4_1', 45, 60, 'grain4_1', NULL, NULL),
(75, NULL, 'Reference-n5_0', 15, 80, 'grain5_0', NULL, NULL),
(76, NULL, 'Reference-n5_1', 144, 44, 'grain5_1', NULL, NULL),
(77, NULL, 'Reference-n5_2', 102, 23, 'grain5_2', NULL, NULL);

-- --------------------------------------------------------



-- --------------------------------------------------------


