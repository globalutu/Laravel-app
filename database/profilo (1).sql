-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 14 oct. 2024 à 16:18
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `profilo`
--

-- --------------------------------------------------------

--
-- Structure de la table `accord_menus`
--

CREATE TABLE `accord_menus` (
  `id` int(11) NOT NULL,
  `Iduse` int(11) NOT NULL,
  `Idmen` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `accord_menus`
--

INSERT INTO `accord_menus` (`id`, `Iduse`, `Idmen`, `created_at`, `updated_at`) VALUES
(7, 3, 5, '2024-10-06 19:35:30', '2024-10-06 19:35:30'),
(8, 3, 8, '2024-10-07 06:53:40', '2024-10-07 06:53:40'),
(10, 2, 8, '2024-10-07 14:25:19', '2024-10-07 14:25:19'),
(13, 3, 26, '2024-10-10 05:21:13', '2024-10-10 05:21:13'),
(14, 3, 27, '2024-10-10 08:29:12', '2024-10-10 08:29:12'),
(16, 3, 4, '2024-10-10 09:50:08', '2024-10-10 09:50:08'),
(17, 11, 4, '2024-10-10 11:54:56', '2024-10-10 11:54:56'),
(18, 11, 27, '2024-10-10 11:55:02', '2024-10-10 11:55:02'),
(19, 10, 4, '2024-10-10 11:56:42', '2024-10-10 11:56:42'),
(20, 10, 27, '2024-10-10 11:56:59', '2024-10-10 11:56:59'),
(21, 10, 5, '2024-10-10 11:57:14', '2024-10-10 11:57:14');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idport` int(11) NOT NULL,
  `nom` varchar(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idport`, `nom`, `prenom`, `mdp`, `email`) VALUES
(1, 'hilaire', 'hilaire', '$2y$10$Tq4oLejN9ZcvOf3MHwWK6.VP954Hfj.mvvNpAy9BAe4tOUvsJLWH2', 'hilaire@gmail.com'),
(2, 'de', 'de', '$2y$10$XstfonEzotfRwfkoixdnPe.WpoFC8/8DGeGSt79F7Bl5BTN5Qj7PW', 'de@gmail.com'),
(3, 'hil', 'hil', '$2y$10$JFHh95RC1PfK2yPv6hm9FOAdC1sgCcjTKxRIAuMs4zbcFMUXxr0J2', 'kanths@gmail.com'),
(4, 'C', 'HILAIRZE', '$2y$10$JEkhS4PvFvT2uT6XREGO9.XpC9YPKkfPlsjKdiUbtgQel8xDrxjHu', 'kanths4@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `Idmen` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `route` varchar(12) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`Idmen`, `libelle`, `route`, `icon`, `created_at`, `updated_at`) VALUES
(4, 'Liste des Utilisateurs', 'liste.user', 'bi bi-collection', '2024-10-02 17:07:16', '2024-10-02 17:07:16'),
(5, 'Ajout d\'Utilisateur', 'useradd', 'bi bi-cloud-sun-fill', '2024-10-02 17:09:40', '2024-10-02 17:09:40'),
(8, 'Ajout de Rôle', 'role.get', 'bi bi-collection-fill', '2024-10-02 17:19:35', '2024-10-02 17:19:35'),
(26, 'Ajout de Menu', 'menu.get', 'f', '2024-10-09 17:33:19', '2024-10-09 17:33:19'),
(27, 'Liste des Menu', 'liste.menus', 'c', '2024-10-09 17:54:18', '2024-10-09 17:54:18');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hilairesevn7@gmail.com', '$2y$10$zfAaN4/ruCLVS8.yqafsC.pivvhoSjDKKV4R.31TQeIncj1Vg9je.', '2024-10-11 15:48:35');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `Idrol` int(11) NOT NULL,
  `libelrol` varchar(20) NOT NULL,
  `codrol` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`Idrol`, `libelrol`, `codrol`, `created_at`, `updated_at`) VALUES
(1, 'Gerant', 'GR', '2024-10-02 11:25:47', '2024-10-02 11:25:47'),
(2, 'Admin', 'AD', '2024-10-02 11:28:24', '2024-10-02 11:28:24'),
(3, 'Utilisateur', 'UT', '2024-10-02 11:28:42', '2024-10-02 11:28:42'),
(4, 'Super_Admin', 'SA', '2024-10-09 17:00:23', '2024-10-09 17:00:23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Iduse` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `prenoms` varchar(25) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(8) NOT NULL,
  `mtp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Iduse`, `nom`, `prenoms`, `email`, `role`, `mtp`, `created_at`, `updated_at`) VALUES
(2, 'Hilaire', 'Sevn', 'kanths41@gmail.com', '3', '$2y$10$jvdsinPGFg3P7HUhzfejb.3Ih681mVKl7AjXtwRLQd9tYzSxld/vO', '2024-10-02 16:16:53', '2024-10-10 07:22:45'),
(3, 'Hilaire', 'Sevn', 'hilairesevn7@gmail.com', '4', '$2y$10$qA8/LKGpPlhuFsCjIedgS.Vx2Ec0AyQlttl5QOuse2ZzLIpTFQRzq', '2024-10-02 17:03:14', '2024-10-11 17:19:19'),
(9, 'Fiacre', 'Derold', 'hilaire4@gmail.com', '3', '$2y$10$DKS9aVVFV.EgwhumotSI1OXsQ3EQKIOhmm9XxZVjJZr3PqdzwvnY.', NULL, NULL),
(10, 'Boukari', 'mouath', 'Mouath@gmail.com', '2', '$2y$10$AcU7xnxl6zAZ3COjhkDHheFeGHRhJZ0o3UtzpJHmoLtEYR6CzsxS6', '2024-10-10 13:53:07', '2024-10-10 13:54:21'),
(11, 'Victor', 'Warren', 'warren@gmail.com', '1', '$2y$10$5So0wXsppOuwUglWDW.UB.vOEngHt3vzkhUNaqvyG8a7QPyL39ePC', '2024-10-10 13:53:57', '2024-10-10 13:53:57'),
(12, '-', 't', 'hilairesevn@gmail.com', '3', '$2y$10$jJGzcoOutRwAwYYTnRFKLusLYBOXbIqjkM2vNy6ANdtg3tHz9KAvO', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accord_menus`
--
ALTER TABLE `accord_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Iduse` (`Iduse`),
  ADD KEY `Idmen` (`Idmen`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idport`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`Idmen`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Idrol`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`Iduse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accord_menus`
--
ALTER TABLE `accord_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `Idmen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `Idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Iduse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accord_menus`
--
ALTER TABLE `accord_menus`
  ADD CONSTRAINT `accord_menus_ibfk_1` FOREIGN KEY (`Iduse`) REFERENCES `utilisateurs` (`Iduse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accord_menus_ibfk_2` FOREIGN KEY (`Idmen`) REFERENCES `menus` (`Idmen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
