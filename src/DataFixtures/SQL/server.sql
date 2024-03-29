INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220821193837', '2022-08-21 21:38:37', 361);

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `avatar`) VALUES
(1, 'asishere44@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$jnOgSVLU/VXvWlZ3rMF2iulr2g5xLcQK9pVUUGx/tAtZaONbGjjOm', 'Admin', 'https://media-exp1.licdn.com/dms/image/C4E03AQF7jT87BmmN9w/profile-displayphoto-shrink_800_800/0/1658432730841?e=1665014400&v=beta&t=NI1XECgt6enZbAfSjHfZ7E_ZfOcHD_bBfYCF-zfM_ik'),
(2, 'jeanne.orhon@yahoo.fr', '[\"ROLE_USER\"]', '$2y$13$7tVp2p2rh6.3Ipt1IPiRHu1mrCGVnpDkaFd21OXZWsp9bWvzij5e6', 'Jeanne', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSBGjSeYimOBFkTRv3VK3T8aZZ8a1GWsSFzA&usqp=CAU');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `nom`, `couleur`, `icone`) VALUES
(1, 'Courses', '#F5846C', 'shopping-cart'),
(2, 'Administratif', '#B7DC88', 'edit'),
(3, 'Santé', '#63B4F4', 'ambulance'),
(4, 'Ecole', '#CA87E7', 'graduation-cap'),
(5, 'Bricolage', '#FE82A6', 'wrench'),
(6, 'Animaux', '#FFDC59', 'paw');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `rayon`
--

INSERT INTO `rayon` (`id`, `nom`) VALUES
(1, 'hygiène'),
(2, 'Boulangerie'),
(3, 'Boucherie'),
(4, 'Fruits et légumes'),
(5, 'Poissonnerie'),
(6, 'Boissons');--

-- --------------------------------------------------------

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `user_id`, `category_id`, `title`, `content`, `type`) VALUES
(1, 1, 1, 'Première note contenu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2),
(2, 2, 2, 'Deuxième note contenu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2),
(3, 1, 3, 'Troisième note contenu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2),
(4, 1, 4, 'Première note elements', NULL, 1),
(5, 1, 5, 'Deuxième note elements', NULL, 1),
(6, 1, 6, 'Troisième note elements', NULL, 1);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `element`
--

INSERT INTO `element` (`id`, `note_id`, `rayon_id`, `nom`, `photo`, `barre`) VALUES
(1, 4, 5, 'Element : 1', NULL, 0),
(2, 4, 3, 'Element : 2', NULL, 0),
(3, 4, 2, 'Element : 3', NULL, 0),
(4, 4, 1, 'Element : 4', NULL, 0),
(5, 4, 4, 'Element : 5', NULL, 0),
(6, 4, 2, 'Element : 6', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(7, 4, 1, 'Element : 7', NULL, 0),
(8, 4, 1, 'Element : 8', NULL, 0),
(9, 4, 1, 'Element : 9', NULL, 0),
(10, 4, 3, 'Element : 10', NULL, 0),
(11, 4, 3, 'Element : 11', NULL, 0),
(12, 4, 1, 'Element : 12', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(13, 4, 4, 'Element : 13', NULL, 0),
(14, 4, 2, 'Element : 14', NULL, 0),
(15, 4, 3, 'Element : 15', NULL, 0),
(16, 4, 6, 'Element : 16', NULL, 0),
(17, 4, 3, 'Element : 17', NULL, 0),
(18, 4, 1, 'Element : 18', NULL, 0),
(19, 4, 4, 'Element : 19', NULL, 0),
(20, 4, 1, 'Element : 20', NULL, 0),
(21, 4, 4, 'Element : 21', NULL, 0),
(22, 4, 2, 'Element : 22', NULL, 0),
(23, 4, 5, 'Element : 23', NULL, 0),
(24, 4, 1, 'Element : 24', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(25, 4, 2, 'Element : 25', NULL, 0),
(26, 4, 3, 'Element : 26', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(27, 4, 1, 'Element : 27', NULL, 0),
(28, 4, 5, 'Element : 28', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(29, 4, 5, 'Element : 29', NULL, 0),
(30, 4, 1, 'Element : 30', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(31, 4, 1, 'Element : 31', NULL, 0),
(32, 4, 3, 'Element : 32', NULL, 0),
(33, 4, 5, 'Element : 33', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(34, 4, 5, 'Element : 34', NULL, 0),
(35, 4, 1, 'Element : 35', NULL, 0),
(36, 4, 3, 'Element : 36', NULL, 0),
(37, 4, 4, 'Element : 37', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(38, 4, 6, 'Element : 38', NULL, 0),
(39, 4, 1, 'Element : 39', NULL, 0),
(40, 4, 1, 'Element : 40', NULL, 0),
(41, 4, 4, 'Element : 41', NULL, 0),
(42, 4, 4, 'Element : 42', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(43, 4, 1, 'Element : 43', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(44, 4, 3, 'Element : 44', NULL, 0),
(45, 4, 6, 'Element : 45', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(46, 4, 6, 'Element : 46', NULL, 0),
(47, 4, 3, 'Element : 47', NULL, 0),
(48, 4, 6, 'Element : 48', NULL, 0),
(49, 4, 6, 'Element : 49', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(50, 4, 6, 'Element : 50', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(51, 5, 1, 'Element : 1', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(52, 5, 5, 'Element : 2', NULL, 0),
(53, 5, 5, 'Element : 3', NULL, 0),
(54, 5, 5, 'Element : 4', NULL, 0),
(55, 5, 5, 'Element : 5', NULL, 0),
(56, 5, 4, 'Element : 6', NULL, 0),
(57, 5, 6, 'Element : 7', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(58, 5, 3, 'Element : 8', NULL, 0),
(59, 5, 2, 'Element : 9', NULL, 0),
(60, 5, 2, 'Element : 10', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(61, 5, 6, 'Element : 11', NULL, 0),
(62, 5, 2, 'Element : 12', NULL, 0),
(63, 5, 1, 'Element : 13', NULL, 0),
(64, 5, 1, 'Element : 14', NULL, 0),
(65, 5, 6, 'Element : 15', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(66, 5, 1, 'Element : 16', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(67, 5, 1, 'Element : 17', NULL, 0),
(68, 5, 6, 'Element : 18', NULL, 0),
(69, 5, 6, 'Element : 19', NULL, 0),
(70, 5, 1, 'Element : 20', NULL, 0),
(71, 5, 2, 'Element : 21', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(72, 5, 6, 'Element : 22', NULL, 0),
(73, 5, 1, 'Element : 23', NULL, 0),
(74, 5, 6, 'Element : 24', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(75, 5, 6, 'Element : 25', NULL, 0),
(76, 5, 6, 'Element : 26', NULL, 0),
(77, 5, 4, 'Element : 27', NULL, 0),
(78, 5, 2, 'Element : 28', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(79, 5, 5, 'Element : 29', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(80, 5, 3, 'Element : 30', NULL, 0),
(81, 5, 5, 'Element : 31', NULL, 0),
(82, 5, 2, 'Element : 32', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(83, 5, 6, 'Element : 33', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(84, 5, 6, 'Element : 34', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(85, 5, 4, 'Element : 35', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(86, 5, 6, 'Element : 36', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(87, 5, 1, 'Element : 37', NULL, 0),
(88, 5, 3, 'Element : 38', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(89, 5, 3, 'Element : 39', NULL, 0),
(90, 5, 5, 'Element : 40', NULL, 0),
(91, 5, 2, 'Element : 41', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(92, 5, 3, 'Element : 42', NULL, 0),
(93, 5, 6, 'Element : 43', NULL, 0),
(94, 5, 1, 'Element : 44', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(95, 5, 2, 'Element : 45', NULL, 0),
(96, 5, 2, 'Element : 46', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(97, 5, 3, 'Element : 47', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(98, 5, 4, 'Element : 48', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(99, 5, 6, 'Element : 49', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(100, 5, 5, 'Element : 50', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(101, 6, 1, 'Element : 1', NULL, 0),
(102, 6, 1, 'Element : 2', NULL, 0),
(103, 6, 3, 'Element : 3', NULL, 0),
(104, 6, 5, 'Element : 4', NULL, 0),
(105, 6, 1, 'Element : 5', NULL, 0),
(106, 6, 5, 'Element : 6', NULL, 0),
(107, 6, 1, 'Element : 7', NULL, 0),
(108, 6, 3, 'Element : 8', NULL, 0),
(109, 6, 6, 'Element : 9', NULL, 0),
(110, 6, 4, 'Element : 10', NULL, 0),
(111, 6, 4, 'Element : 11', NULL, 0),
(112, 6, 4, 'Element : 12', NULL, 0),
(113, 6, 1, 'Element : 13', NULL, 0),
(114, 6, 1, 'Element : 14', NULL, 0),
(115, 6, 2, 'Element : 15', NULL, 0),
(116, 6, 1, 'Element : 16', NULL, 0),
(117, 6, 5, 'Element : 17', NULL, 0),
(118, 6, 3, 'Element : 18', NULL, 0),
(119, 6, 4, 'Element : 19', NULL, 0),
(120, 6, 3, 'Element : 20', NULL, 0),
(121, 6, 4, 'Element : 21', NULL, 0),
(122, 6, 2, 'Element : 22', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(123, 6, 4, 'Element : 23', NULL, 0),
(124, 6, 2, 'Element : 24', NULL, 0),
(125, 6, 6, 'Element : 25', NULL, 0),
(126, 6, 5, 'Element : 26', NULL, 0),
(127, 6, 1, 'Element : 27', NULL, 0),
(128, 6, 2, 'Element : 28', NULL, 0),
(129, 6, 6, 'Element : 29', NULL, 0),
(130, 6, 3, 'Element : 30', NULL, 0),
(131, 6, 3, 'Element : 31', NULL, 0),
(132, 6, 3, 'Element : 32', NULL, 0),
(133, 6, 5, 'Element : 33', NULL, 0),
(134, 6, 3, 'Element : 34', NULL, 0),
(135, 6, 2, 'Element : 35', NULL, 0),
(136, 6, 4, 'Element : 36', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(137, 6, 6, 'Element : 37', NULL, 0),
(138, 6, 4, 'Element : 38', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(139, 6, 3, 'Element : 39', NULL, 0),
(140, 6, 2, 'Element : 40', NULL, 0),
(141, 6, 6, 'Element : 41', NULL, 0),
(142, 6, 2, 'Element : 42', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(143, 6, 1, 'Element : 43', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(144, 6, 5, 'Element : 44', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(145, 6, 6, 'Element : 45', NULL, 0),
(146, 6, 1, 'Element : 46', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(147, 6, 5, 'Element : 47', 'https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg', 0),
(148, 6, 6, 'Element : 48', NULL, 0),
(149, 6, 4, 'Element : 49', NULL, 0),
(150, 6, 4, 'Element : 50', NULL, 0);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `share`
--

INSERT INTO `share` (`id`, `user_1_id`, `user_2_id`, `note_id`, `updated_by_id`, `updated_at`, `seen`) VALUES
(1, 1, 2, 1, 2, '2022-10-23 21:15:45', 0),
(2, 1, 2, 2, 1, '2022-10-23 21:15:45', 0),
(3, 1, 2, 3, 2, '2022-10-23 21:15:45', 0),
(4, 1, 2, 4, 1, '2022-10-23 21:15:45', 0);