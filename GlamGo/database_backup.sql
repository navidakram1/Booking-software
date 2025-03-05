-- GlamGo Database Backup Script
-- Generated on: 2024-03-04

-- Disable foreign key checks during restore
SET FOREIGN_KEY_CHECKS=0;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `customers`;
DROP TABLE IF EXISTS `customer_preferences`;
DROP TABLE IF EXISTS `loyalty_points`;
DROP TABLE IF EXISTS `staff`;
DROP TABLE IF EXISTS `team_members`;
DROP TABLE IF EXISTS `service_packages`;
DROP TABLE IF EXISTS `service_addons`;
DROP TABLE IF EXISTS `pricing_rules`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `testimonials`;
DROP TABLE IF EXISTS `galleries`;
DROP TABLE IF EXISTS `landing_pages`;

-- Create Users table
CREATE TABLE `users` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `role` enum('admin', 'staff', 'customer') NOT NULL DEFAULT 'customer',
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `remember_token` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Categories table
CREATE TABLE `categories` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL UNIQUE,
    `description` text DEFAULT NULL,
    `icon` varchar(255) DEFAULT NULL,
    `sort_order` int NOT NULL DEFAULT 0,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Services table
CREATE TABLE `services` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` bigint(20) UNSIGNED NOT NULL,
    `name` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL UNIQUE,
    `description` text DEFAULT NULL,
    `duration` int NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `image` varchar(255) DEFAULT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Bookings table
CREATE TABLE `bookings` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `service_id` bigint(20) UNSIGNED NOT NULL,
    `staff_id` bigint(20) UNSIGNED NOT NULL,
    `start_time` datetime NOT NULL,
    `end_time` datetime NOT NULL,
    `status` enum('pending', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    `notes` text DEFAULT NULL,
    `rating` decimal(3,1) DEFAULT NULL,
    `rating_comment` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
    FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Staff table
CREATE TABLE `staff` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `bio` text DEFAULT NULL,
    `specialization` varchar(255) DEFAULT NULL,
    `experience_years` int DEFAULT NULL,
    `image` varchar(255) DEFAULT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Service Addons table
CREATE TABLE `service_addons` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `service_id` bigint(20) UNSIGNED NOT NULL,
    `name` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `price` decimal(10,2) NOT NULL,
    `duration` int NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Reviews table
CREATE TABLE `reviews` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `booking_id` bigint(20) UNSIGNED NOT NULL,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `service_id` bigint(20) UNSIGNED NOT NULL,
    `rating` decimal(3,1) NOT NULL,
    `comment` text DEFAULT NULL,
    `is_published` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Gallery table
CREATE TABLE `galleries` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `image` varchar(255) NOT NULL,
    `type` enum('service', 'staff', 'general') NOT NULL DEFAULT 'general',
    `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Staff Schedule table
CREATE TABLE `staff_schedules` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `staff_id` bigint(20) UNSIGNED NOT NULL,
    `day_of_week` tinyint NOT NULL,
    `start_time` time NOT NULL,
    `end_time` time NOT NULL,
    `is_day_off` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Service Packages table
CREATE TABLE `service_packages` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `price` decimal(10,2) NOT NULL,
    `discount_percentage` decimal(5,2) DEFAULT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Package Services table (junction table)
CREATE TABLE `package_services` (
    `package_id` bigint(20) UNSIGNED NOT NULL,
    `service_id` bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`package_id`, `service_id`),
    FOREIGN KEY (`package_id`) REFERENCES `service_packages` (`id`),
    FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS=1;

-- Insert default admin user
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@glamgo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW());

-- Insert sample categories
INSERT INTO `categories` (`name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
('Hair Care', 'hair-care', 'Professional hair care services', 1, 1, NOW(), NOW()),
('Nail Care', 'nail-care', 'Professional nail care services', 2, 1, NOW(), NOW()),
('Skin Care', 'skin-care', 'Professional skin care services', 3, 1, NOW(), NOW()),
('Massage', 'massage', 'Professional massage services', 4, 1, NOW(), NOW());

-- Insert sample services
INSERT INTO `services` (`category_id`, `name`, `slug`, `description`, `duration`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Haircut & Styling', 'haircut-styling', 'Professional haircut and styling service', 60, 50.00, 1, NOW(), NOW()),
(1, 'Hair Coloring', 'hair-coloring', 'Professional hair coloring service', 120, 100.00, 1, NOW(), NOW()),
(2, 'Manicure', 'manicure', 'Professional manicure service', 45, 35.00, 1, NOW(), NOW()),
(2, 'Pedicure', 'pedicure', 'Professional pedicure service', 60, 45.00, 1, NOW(), NOW()),
(3, 'Facial', 'facial', 'Professional facial treatment', 60, 75.00, 1, NOW(), NOW()),
(4, 'Swedish Massage', 'swedish-massage', 'Relaxing Swedish massage', 60, 80.00, 1, NOW(), NOW());

-- Insert sample staff member
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Jane Smith', 'jane@glamgo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'staff', NOW(), NOW());

INSERT INTO `staff` (`user_id`, `bio`, `specialization`, `experience_years`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Professional hairstylist with over 5 years of experience', 'Hair Styling', 5, 1, NOW(), NOW());

-- Insert sample service addons
INSERT INTO `service_addons` (`service_id`, `name`, `description`, `price`, `duration`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Deep Conditioning', 'Deep conditioning treatment for healthy hair', 25.00, 30, 1, NOW(), NOW()),
(2, 'Hair Treatment', 'Intensive hair treatment for colored hair', 35.00, 30, 1, NOW(), NOW());

-- Insert sample service package
INSERT INTO `service_packages` (`name`, `description`, `price`, `discount_percentage`, `is_active`, `created_at`, `updated_at`) VALUES
('Beauty Package', 'Complete beauty package including hair and nail services', 120.00, 15.00, 1, NOW(), NOW());

INSERT INTO `package_services` (`package_id`, `service_id`) VALUES
(1, 1),
(1, 3); 