/*
 Navicat Premium Data Transfer

 Source Server         : Localhost Saya
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : up_skaneda

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 06/10/2023 12:48:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinsi
-- ----------------------------
DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE `provinsi`  (
  `id_provinsi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 95 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of provinsi
-- ----------------------------
INSERT INTO `provinsi` VALUES (11, 'ACEH', NULL, NULL);
INSERT INTO `provinsi` VALUES (12, 'SUMATERA UTARA', NULL, NULL);
INSERT INTO `provinsi` VALUES (13, 'SUMATERA BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (14, 'RIAU', NULL, NULL);
INSERT INTO `provinsi` VALUES (15, 'JAMBI', NULL, NULL);
INSERT INTO `provinsi` VALUES (16, 'SUMATERA SELATAN', NULL, NULL);
INSERT INTO `provinsi` VALUES (17, 'BENGKULU', NULL, NULL);
INSERT INTO `provinsi` VALUES (18, 'LAMPUNG', NULL, NULL);
INSERT INTO `provinsi` VALUES (19, 'KEPULAUAN BANGKA BELITUNG', NULL, NULL);
INSERT INTO `provinsi` VALUES (21, 'KEPULAUAN RIAU', NULL, NULL);
INSERT INTO `provinsi` VALUES (31, 'DKI JAKARTA', NULL, NULL);
INSERT INTO `provinsi` VALUES (32, 'JAWA BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (33, 'JAWA TENGAH', NULL, NULL);
INSERT INTO `provinsi` VALUES (34, 'DI YOGYAKARTA', NULL, NULL);
INSERT INTO `provinsi` VALUES (35, 'JAWA TIMUR', NULL, NULL);
INSERT INTO `provinsi` VALUES (36, 'BANTEN', NULL, NULL);
INSERT INTO `provinsi` VALUES (51, 'BALI', NULL, NULL);
INSERT INTO `provinsi` VALUES (52, 'NUSA TENGGARA BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (53, 'NUSA TENGGARA TIMUR', NULL, NULL);
INSERT INTO `provinsi` VALUES (61, 'KALIMANTAN BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (62, 'KALIMANTAN TENGAH', NULL, NULL);
INSERT INTO `provinsi` VALUES (63, 'KALIMANTAN SELATAN', NULL, NULL);
INSERT INTO `provinsi` VALUES (64, 'KALIMANTAN TIMUR', NULL, NULL);
INSERT INTO `provinsi` VALUES (65, 'KALIMANTAN UTARA', NULL, NULL);
INSERT INTO `provinsi` VALUES (71, 'SULAWESI UTARA', NULL, NULL);
INSERT INTO `provinsi` VALUES (72, 'SULAWESI TENGAH', NULL, NULL);
INSERT INTO `provinsi` VALUES (73, 'SULAWESI SELATAN', NULL, NULL);
INSERT INTO `provinsi` VALUES (74, 'SULAWESI TENGGARA', NULL, NULL);
INSERT INTO `provinsi` VALUES (75, 'GORONTALO', NULL, NULL);
INSERT INTO `provinsi` VALUES (76, 'SULAWESI BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (81, 'MALUKU', NULL, NULL);
INSERT INTO `provinsi` VALUES (82, 'MALUKU UTARA', NULL, NULL);
INSERT INTO `provinsi` VALUES (91, 'PAPUA BARAT', NULL, NULL);
INSERT INTO `provinsi` VALUES (94, 'PAPUA', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
