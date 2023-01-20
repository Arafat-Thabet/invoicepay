/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 1,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `options`, `type`, `order`, `group`) VALUES
(2, 'site_name', 'Site name', 'Invoice Payment', NULL, 'text', 0, 'Site setings');
INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `options`, `type`, `order`, `group`) VALUES
(3, 'logo', 'Logo', 'uploads/settings/VLkT6Z6MDMvVFQMsGeu5P5Q86qUwOvfUE1R3Ktuj.png', NULL, 'image', 1, 'Site setings');
INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `options`, `type`, `order`, `group`) VALUES
(4, 'sms_username', 'User name', NULL, NULL, 'text', 1, 'SMS');
INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `options`, `type`, `order`, `group`) VALUES
(5, 'sms_password', 'Password', NULL, NULL, 'text', 1, 'SMS'),
(6, 'sms_sendername', 'Sender name', NULL, NULL, 'text', 1, 'SMS'),
(7, 'token', 'Token', NULL, NULL, 'text_area', 1, 'Moyasar'),
(8, 'currency', 'Currency', 'SAR', NULL, 'text', 2, 'Site setings');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;