
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
  PRIMARY KEY (`code`) USING BTREE,
  UNIQUE INDEX `uq_code`(`code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of artikal
-- ----------------------------
INSERT INTO `artikal` VALUES ('000000', 'adad', 1, 5);
INSERT INTO `artikal` VALUES ('000001', 'Brufen', 1, 4);
INSERT INTO `artikal` VALUES ('000002', 'ANALGIN', 0, 4);
INSERT INTO `artikal` VALUES ('000003', 'Mast', 0, NULL);
INSERT INTO `artikal` VALUES ('000004', 'Krema', 1, 2);
INSERT INTO `artikal` VALUES ('000005', 'sok', 1, 2);
INSERT INTO `artikal` VALUES ('000006', 'lek1', 1, 3);
INSERT INTO `artikal` VALUES ('000007', 'lek2', 1, 6);
INSERT INTO `artikal` VALUES ('000008', 'GE132', 1, 7);
INSERT INTO `artikal` VALUES ('012335', 'adad', 0, NULL);
INSERT INTO `artikal` VALUES ('adadad', 'ada', 0, NULL);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`message_id`) USING BTREE,
  INDEX `fk_message_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_message_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (1, 'cvetkovici888@gmail.com', 'Ivan', 'Cvetković', 'aaadadasdsdadasdaddas', 0);
INSERT INTO `message` VALUES (2, 'cvetkovici888@gmail.com', 'Ivan', 'Cvetković', 'wdqwerqwewqeqwwewqeeqw', 1);
INSERT INTO `message` VALUES (5, 'cvetkovici888@gmail.com', 'Ivan', 'Cvetković', 'bez login', 0);
INSERT INTO `message` VALUES (6, 'jvicic@mail.ru', 'Jovana', 'Vicic', 'Pozdrav', 2);
INSERT INTO `message` VALUES (7, 'fasdq@fsds.com', 'Admin', 'Test', 'Test Admintest', 0);

-- ----------------------------
-- Table structure for rok
-- ----------------------------
DROP TABLE IF EXISTS `rok`;
CREATE TABLE `rok`  (
  `rok_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesec_isteka` int(5) NOT NULL,
  `godina_isteka` int(5) NOT NULL,
  `kolicina` float(10, 2) UNSIGNED NOT NULL,
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rok_id`) USING BTREE,
  INDEX `fk_rok_code`(`code`) USING BTREE,
  INDEX `fk_rok_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_rok_code` FOREIGN KEY (`code`) REFERENCES `artikal` (`code`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_rok_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `rok` VALUES (19, 6, 2020, 2.00, '000001', 1, '2020-08-30 11:14:08');
INSERT INTO `rok` VALUES (20, 3, 2020, 1.00, '000001', 1, '2020-08-30 12:00:19');
INSERT INTO `rok` VALUES (21, 3, 2020, 5.00, '000002', 1, '2020-08-30 12:04:34');
INSERT INTO `rok` VALUES (22, 6, 2021, 2.00, '000001', 1, '2020-08-30 19:03:26');
INSERT INTO `rok` VALUES (23, 3, 2022, 5.00, '000001', 1, '2020-08-31 20:09:56');
INSERT INTO `rok` VALUES (24, 12, 2020, 2.00, '000004', 1, '2020-08-31 20:40:15');
INSERT INTO `rok` VALUES (27, 11, 2020, 2.00, '000005', 1, '2020-08-31 20:42:29');

-- ----------------------------
-- Table structure for sesija
-- ----------------------------
DROP TABLE IF EXISTS `sesija`;
CREATE TABLE `sesija`  (
  `sesija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
  `destroyed_at` timestamp(0) NULL DEFAULT NULL,
  `is_expired` tinyint(1) NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ukupnoMinuta` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`sesija_id`) USING BTREE,
  INDEX `fk_sesija_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_sesija_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sesija
-- ----------------------------
INSERT INTO `sesija` VALUES (1, '2020-08-31 16:19:34', '2020-08-31 16:38:02', 1, 1, 18);
INSERT INTO `sesija` VALUES (2, '2020-08-31 16:32:25', '2020-08-31 16:32:44', 1, 2, 0);
INSERT INTO `sesija` VALUES (3, '2020-08-31 16:33:07', '2020-08-31 16:37:19', 1, 1, 4);
INSERT INTO `sesija` VALUES (4, '2020-08-31 17:29:16', NULL, 0, 1, NULL);
INSERT INTO `sesija` VALUES (5, '2020-08-31 17:38:09', NULL, 0, 1, NULL);
INSERT INTO `sesija` VALUES (6, '2020-08-31 17:38:51', '2020-08-31 17:48:02', 1, 1, 9);
INSERT INTO `sesija` VALUES (7, '2020-08-31 19:36:07', '2020-08-31 20:07:10', 1, 1, 31);
INSERT INTO `sesija` VALUES (8, '2020-08-31 20:08:14', '2020-08-31 20:08:21', 1, 1, 0);
INSERT INTO `sesija` VALUES (9, '2020-08-31 20:09:40', '2020-08-31 20:22:57', 1, 1, 13);
INSERT INTO `sesija` VALUES (10, '2020-08-31 20:24:33', '2020-08-31 20:29:33', 1, 2, 5);
INSERT INTO `sesija` VALUES (11, '2020-08-31 20:30:09', '2020-08-31 20:30:36', 1, 3, 0);
INSERT INTO `sesija` VALUES (12, '2020-08-31 20:30:43', NULL, 0, 1, NULL);
INSERT INTO `sesija` VALUES (13, '2020-08-31 20:39:49', '2020-08-31 20:42:36', 1, 3, 2);
INSERT INTO `sesija` VALUES (14, '2020-08-31 20:42:42', NULL, 0, 3, NULL);
INSERT INTO `sesija` VALUES (15, '2020-09-01 14:44:28', '2020-09-01 17:49:23', 1, 2, 184);
INSERT INTO `sesija` VALUES (16, '2020-09-01 17:49:29', NULL, 0, 1, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime_prezime` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_radnik` tinyint(1) UNSIGNED NULL DEFAULT 0,
  `privilegije` int(5) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (0, 'NO_USER', 0, 0, NULL, NULL);
INSERT INTO `user` VALUES (1, 'Ivan', 1, 5, 'vani', '26d2ddbaa6f7190e56904b2308d48efd');
INSERT INTO `user` VALUES (2, 'Jovana Vicic', 0, 0, 'jvicic', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `user` VALUES (3, 'Admin Adminic', 0, 5, 'admin', '21232f297a57a5a743894a0e4a801fc3');

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

-- ----------------------------
-- Triggers structure for table sesija
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_sesija_bu`;
delimiter ;;
CREATE TRIGGER `trigger_sesija_bu` BEFORE UPDATE ON `sesija` FOR EACH ROW BEGIN
IF (NEW.is_expired = 1) THEN
    SET NEW.destroyed_at = CURRENT_TIMESTAMP;
END IF;
SET NEW.ukupnoMinuta = TIMESTAMPDIFF(MINUTE,NEW.created_at , NEW.destroyed_at);
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
