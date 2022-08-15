CREATE USER 'shareFiles'@'localhost' IDENTIFIED BY 't8AgECsq1Esqg98Fs3E/5qsdFb45dsv8B3c4CCp@';
GRANT USAGE ON *.* TO 'shareFiles'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `shareFiles`;
GRANT ALL PRIVILEGES ON `shareFiles`.* TO 'shareFiles'@'localhost';
REVOKE ALL PRIVILEGES ON `shareFiles`.* FROM 'shareFiles'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `shareFiles`.* TO 'shareFiles'@'localhost';
USE shareFiles;

CREATE TABLE `contacts` (
                            `id` int(11) NOT NULL,
                            `mat_user1` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `mat_user2` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
                               `id` int(11) NOT NULL,
                               `mat_sender` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `mat_recipient` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
                              `id` int(10) UNSIGNED NOT NULL,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
                         `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `matricule` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `last_action` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- D�chargement des donn�es de la table `users`
--

INSERT INTO `users` (`id`, `name`, `matricule`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_action`) VALUES
('28f0918a-a1b8-4f0e-a73a-b390c1a75d2d', 'Bryan Grégoire', '53735', '53735@etu.he2b.be', NULL, '$argon2id$v=19$m=1024,t=2,p=2$NERQZDZBS25BQzNSWEVycw$Dpk+H1VhH747DDC2rjk9oXeTg1v1d2A3sBplCv7Q8u2XtUJwSaxTs0hIdmx+1kHVe4F6K0UhlHdUg+D3r3lK6ylL7zDqB/q3KZjQbyF0Rk3KehfpM0bLGLg7/NeO0w8N', '4IKj95oSlD0PnCDPzzYOyflKAat23CwbD7N8TjHUPfGfJl0rAkD9fZ1uKife', '2022-08-26 12:23:47', '2022-08-26 12:23:47', '2022-08-26 15:23:47'),
('98638172-a1b8-4f0e-a73a-73N29187NJEA', 'Billal Zidi', '54637', '54637@etu.he2b.be', NULL, '$argon2id$v=19$m=1024,t=2,p=2$SmNQMjRyclQ3d1Zmb3hZeg$xrZdrh2gAygJhNNg4OgcMVFBHNhpK3eG8WHfIRYEH2G18yOObuD/biUe5HuXhkiA/RNqA/al68WXFho2I5HwTq1bodJZPDzuUcy8EwP3PGG3o23sv3A5+QznTZYkSY2E', '4IKj95oSlD0PnCDPzzYOyflKAat23CwbD7N8TjHUPfGfJl0rAkD9fZ1uKife', '2022-08-26 12:23:47', '2022-08-26 12:23:47', '2022-08-26 15:23:47'),
('bb113a75-df52-4a7d-8db0-8eb35441bf4a', 'Pierre Hauweele', 'pha', 'phauweele@he2b.be', NULL, '$argon2id$v=19$m=1024,t=2,p=2$MGd3a0RTSG1wRmJ6TWNqNg$CvWFkhK5nctsvaYe/iGaq8lIuB/w80/p/4b4S0O1o/axGib+bkSNj4kzeyits+j6KkbjdaUeWzK9fvHKgeVljATs6s8+wPSTmSCeRBaHT02bM8ScmZ/2JvRUsYrBDiWy', 'DgAYU8qUz6YQOZSlPoMvcIE2VkYc5khWpmXPUojZzR3IW8CoLu7n0mDiHUJ0', '2022-08-26 12:23:47', '2022-08-26 12:23:47', '2022-08-26 15:23:47');

--
-- Index pour les tables d�charg�es
--

CREATE TABLE `files` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `mat_sender` varchar(255) NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `name_file` varchar(255) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mat_user1` (`mat_user1`),
  ADD KEY `fk_mat_user2` (`mat_user2`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mat_recipient3` (`mat_recipient`),
  ADD KEY `fk_mat_sender3` (`mat_sender`);

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
-- Index pour la table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `matricule` (`matricule`);

--
-- AUTO_INCREMENT pour les tables d�charg�es
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables d�charg�es
--

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
    ADD CONSTRAINT `fk_mat_user1` FOREIGN KEY (`mat_user1`) REFERENCES `users` (`matricule`),
  ADD CONSTRAINT `fk_mat_user2` FOREIGN KEY (`mat_user2`) REFERENCES `users` (`matricule`);

--
-- Contraintes pour la table `invitations`
--
ALTER TABLE `invitations`
    ADD CONSTRAINT `fk_mat_recipient3` FOREIGN KEY (`mat_recipient`) REFERENCES `users` (`matricule`),
  ADD CONSTRAINT `fk_mat_sender3` FOREIGN KEY (`mat_sender`) REFERENCES `users` (`matricule`);
