CREATE TABLE `servicelogreplacement` (
  `id` int(11) UNSIGNED NOT NULL,
  `old_id` int(11) UNSIGNED DEFAULT NULL,
  `new_id` int(11) UNSIGNED DEFAULT NULL,
  `entered_by` int(11) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;