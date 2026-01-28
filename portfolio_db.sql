-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 03:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDashboardStats` ()   BEGIN
    -- Total messages
    SELECT COUNT(*) as total_messages FROM messages;
    
    -- Unread messages
    SELECT COUNT(*) as unread_messages FROM messages WHERE status = 'unread';
    
    -- Total projects
    SELECT COUNT(*) as total_projects FROM projects;
    
    -- Total chatbot conversations
    SELECT COUNT(*) as total_conversations FROM chatbot_conversations;
    
    -- Recent messages (last 7 days)
    SELECT COUNT(*) as recent_messages 
    FROM messages 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `full_name`, `email`, `created_at`, `last_login`, `status`) VALUES
(1, 'fanny', '??@͑+z||?^?=\'?', 'Fanuel Masuka', 'admin@fanuelmasuka.com', '2025-12-25 00:36:25', NULL, 'active'),
(2, 'fanuelmasuka2.projects@gmail.com', '$2y$10$LYzlwUmLJtUAFedoNNRS0erYebhMy7cFeI0X4il6XMcoPYg7c5Y.C', 'Fanuel Masuka', 'fanuelmasuka2.projects@gmail.com', '2026-01-11 17:50:00', '2026-01-15 08:03:22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_conversations`
--

CREATE TABLE `chatbot_conversations` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `user_message` text NOT NULL,
  `bot_response` text NOT NULL,
  `message_type` enum('question','greeting','feedback','other') DEFAULT 'question',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_feedback`
--

CREATE TABLE `chatbot_feedback` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `helpful` tinyint(1) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `status` enum('unread','read','replied','archived') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `messages`
--
DELIMITER $$
CREATE TRIGGER `update_message_status` BEFORE UPDATE ON `messages` FOR EACH ROW BEGIN
    IF NEW.status != OLD.status THEN
        SET NEW.updated_at = NOW();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `category` enum('software','data','education','other') DEFAULT 'software',
  `tags` text DEFAULT NULL,
  `github_url` varchar(500) DEFAULT NULL,
  `live_url` varchar(500) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image_url`, `category`, `tags`, `github_url`, `live_url`, `featured`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'E-Learning Platform', 'A comprehensive online learning platform with course management, video lectures, quizzes, and progress tracking.', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'software', 'PHP,MySQL,JavaScript,Laravel', 'https://github.com/fanuel/e-learning', 'https://elearning.demo.com', 1, 1, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(2, 'Sales Data Analytics Dashboard', 'Interactive dashboard for visualizing sales performance, customer demographics, and revenue trends.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'data', 'Python,Tableau,SQL,Data Visualization', 'https://github.com/fanuel/analytics-dashboard', 'https://analytics.demo.com', 1, 2, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(3, 'IT Training Curriculum', 'Developed a comprehensive 12-week curriculum for beginner to intermediate software development training.', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=871&q=80', 'education', 'Curriculum Design,E-Learning,Instructional Design', 'https://github.com/fanuel/it-curriculum', 'https://curriculum.demo.com', 0, 3, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(4, 'Inventory Management System', 'Web-based system for tracking inventory, orders, and suppliers with automated reporting features.', 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'software', 'PHP,MySQL,JavaScript,Bootstrap', 'https://github.com/fanuel/inventory-system', 'https://inventory.demo.com', 0, 4, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(5, 'Customer Churn Prediction Model', 'Machine learning model to predict customer churn with 87% accuracy for a telecom company.', 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'data', 'Python,Machine Learning,Pandas,Scikit-learn', 'https://github.com/fanuel/churn-prediction', 'https://churn.demo.com', 1, 5, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(6, 'Coding Bootcamp Platform', 'Platform for delivering coding bootcamps with interactive coding exercises and mentor support.', 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'education', 'React,Node.js,MongoDB,Education', 'https://github.com/fanuel/bootcamp-platform', 'https://bootcamp.demo.com', 0, 6, '2025-12-25 00:36:25', '2025-12-25 00:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `site_analytics`
--

CREATE TABLE `site_analytics` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `page_url` varchar(500) DEFAULT NULL,
  `referrer` varchar(500) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `visit_duration` int(11) DEFAULT 0 COMMENT 'In seconds',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` enum('software','data','education','other') DEFAULT 'software',
  `proficiency` int(11) DEFAULT 50 COMMENT 'Percentage from 0-100',
  `display_order` int(11) DEFAULT 0,
  `icon_class` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `category`, `proficiency`, `display_order`, `icon_class`, `created_at`) VALUES
(1, 'PHP & Laravel', 'software', 90, 1, 'fab fa-php', '2025-12-25 00:36:26'),
(2, 'JavaScript & React', 'software', 85, 2, 'fab fa-js-square', '2025-12-25 00:36:26'),
(3, 'Python & Django', 'software', 80, 3, 'fab fa-python', '2025-12-25 00:36:26'),
(4, 'Java & Spring Boot', 'software', 70, 4, 'fab fa-java', '2025-12-25 00:36:26'),
(5, 'Database Design (MySQL, MongoDB)', 'software', 90, 5, 'fas fa-database', '2025-12-25 00:36:26'),
(6, 'RESTful APIs', 'software', 85, 6, 'fas fa-code', '2025-12-25 00:36:26'),
(7, 'Python (Pandas, NumPy)', 'data', 85, 1, 'fab fa-python', '2025-12-25 00:36:26'),
(8, 'R Programming', 'data', 70, 2, 'fas fa-chart-line', '2025-12-25 00:36:26'),
(9, 'SQL for Data Analysis', 'data', 90, 3, 'fas fa-database', '2025-12-25 00:36:26'),
(10, 'Data Visualization (Tableau, Power BI)', 'data', 85, 4, 'fas fa-chart-bar', '2025-12-25 00:36:26'),
(11, 'Statistical Analysis', 'data', 80, 5, 'fas fa-chart-area', '2025-12-25 00:36:26'),
(12, 'Machine Learning Basics', 'data', 75, 6, 'fas fa-brain', '2025-12-25 00:36:26'),
(13, 'Curriculum Development', 'education', 85, 1, 'fas fa-book', '2025-12-25 00:36:26'),
(14, 'Technical Training & Workshops', 'education', 90, 2, 'fas fa-chalkboard-teacher', '2025-12-25 00:36:26'),
(15, 'E-Learning Platforms', 'education', 75, 3, 'fas fa-laptop-code', '2025-12-25 00:36:26'),
(16, 'Mentorship Programs', 'education', 85, 4, 'fas fa-user-graduate', '2025-12-25 00:36:26'),
(17, 'Instructional Design', 'education', 70, 5, 'fas fa-tasks', '2025-12-25 00:36:26'),
(18, 'Learning Management Systems', 'education', 80, 6, 'fas fa-graduation-cap', '2025-12-25 00:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subscribed` tinyint(1) DEFAULT 1,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_chatbot_stats`
-- (See below for the actual view)
--
CREATE TABLE `view_chatbot_stats` (
`date` date
,`total_conversations` bigint(21)
,`unique_sessions` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_message_stats`
-- (See below for the actual view)
--
CREATE TABLE `view_message_stats` (
`date` date
,`total_messages` bigint(21)
,`unread_messages` decimal(22,0)
,`replied_messages` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Structure for view `view_chatbot_stats`
--
DROP TABLE IF EXISTS `view_chatbot_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_chatbot_stats`  AS SELECT cast(`chatbot_conversations`.`created_at` as date) AS `date`, count(0) AS `total_conversations`, count(distinct `chatbot_conversations`.`session_id`) AS `unique_sessions` FROM `chatbot_conversations` GROUP BY cast(`chatbot_conversations`.`created_at` as date) ;

-- --------------------------------------------------------

--
-- Structure for view `view_message_stats`
--
DROP TABLE IF EXISTS `view_message_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_message_stats`  AS SELECT cast(`messages`.`created_at` as date) AS `date`, count(0) AS `total_messages`, sum(case when `messages`.`status` = 'unread' then 1 else 0 end) AS `unread_messages`, sum(case when `messages`.`status` = 'replied' then 1 else 0 end) AS `replied_messages` FROM `messages` GROUP BY cast(`messages`.`created_at` as date) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `chatbot_conversations`
--
ALTER TABLE `chatbot_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `idx_chatbot_created` (`created_at`);

--
-- Indexes for table `chatbot_feedback`
--
ALTER TABLE `chatbot_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_messages_status` (`status`),
  ADD KEY `idx_messages_created` (`created_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_projects_category` (`category`),
  ADD KEY `idx_projects_featured` (`featured`);

--
-- Indexes for table `site_analytics`
--
ALTER TABLE `site_analytics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_skills_category` (`category`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chatbot_conversations`
--
ALTER TABLE `chatbot_conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatbot_feedback`
--
ALTER TABLE `chatbot_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_analytics`
--
ALTER TABLE `site_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatbot_feedback`
--
ALTER TABLE `chatbot_feedback`
  ADD CONSTRAINT `chatbot_feedback_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `chatbot_conversations` (`id`) ON DELETE SET NULL;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `clean_old_chatbot_sessions` ON SCHEDULE EVERY 1 DAY STARTS '2025-12-25 02:36:26' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Delete chatbot conversations older than 30 days
    DELETE FROM chatbot_conversations 
    WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY);
    
    -- Delete corresponding feedback
    DELETE FROM chatbot_feedback 
    WHERE conversation_id NOT IN (SELECT id FROM chatbot_conversations);
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
