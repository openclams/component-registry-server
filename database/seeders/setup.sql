-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 02:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(22, 5, 'id', 'text', 'Attributes', 1, 0, 1, 1, 0, 0, '{\"view\":\"attributes.formfields\"}', 1),
(23, 5, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(24, 5, 'img', 'media_picker', 'Image', 0, 1, 1, 1, 1, 1, '{\"max\":1,\"min\":0,\"expanded\":true,\"show_folders\":true,\"allow_upload\":true,\"allow_move\":true,\"allow_delete\":true,\"allow_rename\":true,\"allowed\":[],\"hide_thumbnails\":false,\"show_as_images\":true}', 3),
(25, 5, 'provider_id', 'text', 'Provider Id', 1, 0, 0, 0, 0, 0, '{}', 2),
(26, 5, 'component_belongsto_provider_relationship', 'relationship', 'Providers', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Provider\",\"table\":\"providers\",\"type\":\"belongsTo\",\"column\":\"provider_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"attributes\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(27, 6, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(28, 6, 'target', 'text', 'Target', 1, 0, 0, 1, 1, 0, '{}', 5),
(29, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
(30, 6, 'company', 'text', 'Company', 1, 1, 1, 1, 1, 1, '{}', 4),
(31, 6, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 2),
(32, 5, 'isTemplate', 'checkbox', 'Type', 1, 1, 1, 1, 1, 1, '{\"on\":\"Is Template\",\"off\":\"Is Component\",\"checked\":false}', 5),
(33, 7, 'id_name', 'text', 'Id Name', 1, 1, 1, 1, 1, 1, '{}', 1),
(34, 7, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(35, 7, 'img', 'media_picker', 'Img', 0, 1, 1, 1, 1, 1, '{}', 5),
(36, 7, 'type', 'text', 'Type', 1, 1, 1, 1, 1, 1, '{}', 6),
(37, 7, 'description', 'text', 'Description', 0, 0, 1, 1, 1, 1, '{}', 7),
(38, 7, 'value', 'text', 'Value', 1, 1, 1, 1, 1, 1, '{}', 8),
(39, 7, 'readable', 'text', 'Readable', 0, 1, 1, 1, 1, 1, '{}', 9),
(40, 7, 'attributable_id', 'text', 'Entity ID', 1, 1, 1, 1, 1, 1, '{}', 2),
(41, 7, 'attributable_type', 'text', 'Entity Type', 1, 1, 1, 1, 1, 1, '{\"default\":\"App\\\\Models\\\\Component\",\"options\":{\"App\\\\Models\\\\Component\":\"Component Attribute\",\"App\\\\Models\\\\Edge\":\"Edge Attribute\"}}', 3),
(42, 5, 'component_belongsto_component_relationship', 'relationship', 'Parent', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"parent_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attributes\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(43, 5, 'order', 'text', 'Order', 1, 0, 0, 0, 0, 0, '{}', 6),
(44, 5, 'parent_id', 'text', 'Parent Id', 0, 0, 0, 0, 0, 0, '{}', 7),
(45, 5, 'component_belongstomany_component_relationship', 'relationship', 'components', 0, 1, 1, 1, 1, 1, '{\"foreign_pivot_key\":\"template_id\",\"related_pivot_key\":\"component_id\",\"parent_key\":\"id\",\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"component_template\",\"pivot\":\"1\",\"taggable\":\"0\"}', 8),
(46, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(47, 9, 'type', 'text', 'Type', 1, 1, 1, 1, 1, 1, '{\"default\":\"Allow\",\"options\":{\"Allow\":\"Allow\",\"Exclude\":\"Exclude\"}}', 5),
(48, 9, 'edge_id', 'text', 'Edge Id', 1, 0, 0, 0, 0, 0, '{}', 2),
(49, 9, 'from_component_id', 'text', 'From Component Id', 1, 0, 0, 0, 0, 0, '{}', 3),
(50, 9, 'to_component_id', 'text', 'To Component Id', 1, 0, 0, 0, 0, 0, '{}', 4),
(51, 9, 'edge_constraint_belongsto_edge_relationship', 'relationship', 'Edge', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Edge\",\"table\":\"edges\",\"type\":\"belongsTo\",\"column\":\"edge_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(52, 9, 'edge_constraint_belongsto_component_relationship', 'relationship', 'From', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"from_component_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(53, 9, 'edge_constraint_belongsto_component_relationship_1', 'relationship', 'components', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"to_component_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(54, 11, 'id', 'text', 'Attributes', 1, 0, 0, 1, 1, 0, '{\"view\":\"edges.formfields\"}', 2),
(55, 11, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 1),
(56, 11, 'provider_id', 'text', 'Provider Id', 1, 0, 0, 1, 1, 0, '{}', 4),
(57, 11, 'edge_belongsto_provider_relationship', 'relationship', 'Provider', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Provider\",\"table\":\"providers\",\"type\":\"belongsTo\",\"column\":\"provider_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(58, 5, 'component_belongstomany_category_relationship', 'relationship', 'categories', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"category_component\",\"pivot\":\"1\",\"taggable\":\"on\"}', 9),
(59, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(60, 13, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 3),
(61, 13, 'provider_id', 'text', 'Provider Id', 1, 1, 1, 1, 1, 1, '{}', 2);
COMMIT;
-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--
-- Dumping data for table `data_rows`
--
START TRANSACTION;
SET time_zone = "+00:00";
INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2021-01-18 07:39:07', '2021-01-18 07:39:07'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2021-01-18 07:39:07', '2021-01-18 07:39:07'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2021-01-18 07:39:07', '2021-01-18 07:39:07'),
(5, 'components', 'components', 'Component', 'Components', NULL, 'App\\Models\\Component', NULL, '\\App\\Http\\Controllers\\Voyager\\ComponentController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-01-18 07:51:00', '2021-04-07 07:54:51'),
(6, 'providers', 'providers', 'Provider', 'Providers', NULL, 'App\\Models\\Provider', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2021-01-18 09:37:08', '2021-01-18 09:37:08'),
(7, 'attributes', 'attributes', 'Attribute', 'Attributes', NULL, 'App\\Models\\Attribute', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"id_name\",\"scope\":null}', '2021-01-19 12:58:27', '2021-01-31 16:09:41'),
(9, 'edge_constraints', 'edge-constraints', 'Edge Constraint', 'Edge Constraints', NULL, 'App\\Models\\EdgeConstraint', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-02-01 10:26:36', '2021-02-01 10:33:01'),
(11, 'edges', 'edges', 'Edge', 'Edges', NULL, 'App\\Models\\Edge', NULL, '\\App\\Http\\Controllers\\Voyager\\EdgeController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-02-01 10:47:02', '2021-02-02 12:36:03'),
(13, 'categories', 'categories', 'Category', 'Categories', NULL, 'App\\Models\\Category', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2021-02-03 07:22:08', '2021-02-03 07:22:08');
COMMIT;
-- --------------------------------------------------------


START TRANSACTION;
SET time_zone = "+00:00";
INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(12, 1, 'Components', '', '_self', NULL, NULL, NULL, 7, '2021-01-18 07:51:00', '2021-01-18 07:56:18', 'voyager.components.index', NULL),
(13, 1, 'Providers', '', '_self', NULL, NULL, NULL, 8, '2021-01-18 09:37:08', '2021-01-18 09:37:08', 'voyager.providers.index', NULL),
(14, 1, 'Attributes', '', '_self', NULL, NULL, NULL, 9, '2021-01-19 12:58:27', '2021-01-19 12:58:27', 'voyager.attributes.index', NULL),
(15, 1, 'Edge Constraints', '', '_self', NULL, NULL, NULL, 10, '2021-02-01 10:26:36', '2021-02-01 10:26:36', 'voyager.edge-constraints.index', NULL),
(16, 1, 'Edges', '', '_self', NULL, NULL, NULL, 11, '2021-02-01 10:47:02', '2021-02-01 10:47:02', 'voyager.edges.index', NULL),
(17, 1, 'Categories', '', '_self', NULL, NULL, NULL, 12, '2021-02-03 07:22:08', '2021-02-03 07:22:08', 'voyager.categories.index', NULL);
COMMIT;
--
-- Indexes for dumped tables
--
