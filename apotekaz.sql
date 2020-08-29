/*
 Navicat Premium Data Transfer

 Source Server         : xampp
 Source Server Type    : MariaDB
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : apotekaz

 Target Server Type    : MariaDB
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 30/08/2020 00:40:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for artikal
-- ----------------------------
DROP TABLE IF EXISTS `artikal`;
CREATE TABLE `artikal`  (
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_povrat` tinyint(1) NOT NULL,
  `meseci_pre_isteka` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of artikal
-- ----------------------------
INSERT INTO `artikal` VALUES ('000000', 'adad', 1, NULL);
INSERT INTO `artikal` VALUES ('000001', 'Brufen', 1, NULL);
INSERT INTO `artikal` VALUES ('012335', 'adad', 0, NULL);
INSERT INTO `artikal` VALUES ('adadad', 'ada', 0, NULL);

-- ----------------------------
-- Table structure for rok
-- ----------------------------
DROP TABLE IF EXISTS `rok`;
CREATE TABLE `rok`  (
  `rok_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesec_isteka` int(5) UNSIGNED NOT NULL,
  `godina_isteka` int(5) UNSIGNED NOT NULL,
  `kolicina` float(10, 2) UNSIGNED NOT NULL,
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rok_id`) USING BTREE,
  INDEX `fk_rok_code`(`code`) USING BTREE,
  INDEX `fk_rok_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_rok_code` FOREIGN KEY (`code`) REFERENCES `artikal` (`code`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_rok_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rok
-- ----------------------------
INSERT INTO `rok` VALUES (1, 5, 2021, 2.00, '000001', 1, '2020-08-29 21:37:05');
INSERT INTO `rok` VALUES (12, 3, 2022, 1.00, '000001', 1, '2020-08-30 00:09:21');
INSERT INTO `rok` VALUES (13, 9, 2023, 5.00, '000001', 1, '2020-08-30 00:10:41');
INSERT INTO `rok` VALUES (14, 9, 2023, 5.00, '000001', 1, '2020-08-30 00:11:25');
INSERT INTO `rok` VALUES (15, 2, 2020, 1.00, '000001', 1, '2020-08-30 00:17:10');
INSERT INTO `rok` VALUES (16, 3, 2025, 5.00, '000001', 1, '2020-08-30 00:17:47');
INSERT INTO `rok` VALUES (17, 2, 2021, 5.00, '000001', 1, '2020-08-30 00:26:42');
INSERT INTO `rok` VALUES (18, 2, 2030, 2.00, '000001', 1, '2020-08-30 00:40:14');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime_prezime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_radnik` tinyint(1) NULL DEFAULT NULL,
  `privilegije` int(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Ivan', 1, 5);

-- ----------------------------
-- Triggers structure for table artikal
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_artikal_bi`;
delimiter ;;
CREATE TRIGGER `trigger_artikal_bi` BEFORE INSERT ON `artikal` FOR EACH ROW BEGIN
  IF CHAR_LENGTH(NEW.`code`) != 6 THEN 
	  SIGNAL SQLSTATE '50002' SET MESSAGE_TEXT = 'Kod mora biti duzine 6 karaktera.';
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table artikal
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_artikal_bu`;
delimiter ;;
CREATE TRIGGER `trigger_artikal_bu` BEFORE UPDATE ON `artikal` FOR EACH ROW BEGIN
  IF CHAR_LENGTH(NEW.`code`) != 6 THEN 
	  SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Kod mora biti       duzine   6 karaktera.';
	END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
