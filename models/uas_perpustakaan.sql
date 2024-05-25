/*
 Navicat Premium Data Transfer

 Source Server         : localhost - database
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : uas_perpustakaan

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 25/05/2024 07:24:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `penulis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (1, 'Harry Potter and the Philosopher Stone', 'J.K. Rowling', '1997-06-26', NULL, NULL, NULL);
INSERT INTO `buku` VALUES (2, 'The Midnight Librarys', 'Matt Haig', '2020-01-01', '2024-05-19 09:42:17', '2024-05-19 10:35:08', NULL);
INSERT INTO `buku` VALUES (3, 'A Game Of Throens', 'George R. R. Martin', '2024-08-09', '2024-05-25 06:18:40', '2024-05-25 06:18:40', NULL);

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_buku` int NULL DEFAULT NULL,
  `tanggal_pinjam` datetime(0) NOT NULL,
  `tanggal_kembali` datetime(0) NULL DEFAULT NULL,
  `deleted_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nim`(`nim`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, '22201278', 'Andika Dayu', '7E51EEA5FA101ED4DADE9AD3A7A072BB');
INSERT INTO `siswa` VALUES (2, '2201152', 'Wahyu Hendri', '32c9e71e866ecdbc93e497482aa6779f');

SET FOREIGN_KEY_CHECKS = 1;
