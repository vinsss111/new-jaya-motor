/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;

DROP TABLE IF EXISTS `barang_keluar`;
CREATE TABLE `barang_keluar` (
  `id_log_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `id_sparepart` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `metode_pengambilan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_log_keluar`),
  KEY `fk_barang_keluar_sparepart` (`id_sparepart`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barang_keluar` VALUES (3,2,1,'2026-04-18 15:50:54',50000,'tggg','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (4,1,1,'2026-04-18 15:50:54',65000,'tggg','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (5,3,2,'2026-04-18 17:26:46',120000,'Ceo Aphen','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (6,2,1,'2026-04-18 17:26:46',50000,'Ceo Aphen','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (7,5,1,'2026-04-25 15:52:17',500000,'Kepin','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (8,4,1,'2026-04-25 15:52:17',75000,'Kepin','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (9,3,1,'2026-04-25 15:52:17',60000,'Kepin','Ambil di Toko');
INSERT INTO `barang_keluar` VALUES (10,2,1,'2026-04-25 15:52:17',50000,'Kepin','Ambil di Toko');
DROP TABLE IF EXISTS `barang_masuk`;
CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_sparepart` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_masuk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barang_masuk` VALUES (1,1,1,'2026-04-18 14:57:59','Update Stok Manual');
INSERT INTO `barang_masuk` VALUES (2,2,5,'2026-04-18 15:02:05','Tambah Barang Baru');
INSERT INTO `barang_masuk` VALUES (3,1,5,'2026-04-18 15:02:13','Update Stok Manual');
INSERT INTO `barang_masuk` VALUES (4,2,5,'2026-04-18 15:02:29','Update Stok Manual');
INSERT INTO `barang_masuk` VALUES (5,3,15,'2026-04-18 17:24:54','Tambah Barang Baru');
INSERT INTO `barang_masuk` VALUES (6,1,5,'2026-04-18 17:27:09','Update Stok Manual');
INSERT INTO `barang_masuk` VALUES (7,4,15,'2026-04-18 17:32:32','Tambah Barang Baru');
INSERT INTO `barang_masuk` VALUES (8,5,10,'2026-04-18 17:33:12','Tambah Barang Baru');
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(100) NOT NULL,
  `metode_pengambilan` varchar(100) NOT NULL,
  `item_barang` text NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_approve` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pesanan` VALUES (1,'APHEN RIMEX BENGKEL','Ambil di Toko','[{\"id\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":10},{\"id\":1,\"nama\":\"Oli \",\"harga\":65000,\"qty\":1,\"stok\":6}]',115000,'approved','2026-04-18 15:31:59','2026-04-18 15:36:10');
INSERT INTO `pesanan` VALUES (2,'Telor','Ambil di Toko','[{\"id\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":2,\"stok\":10},{\"id\":1,\"nama\":\"Oli \",\"harga\":65000,\"qty\":2,\"stok\":6}]',230000,'approved','2026-04-18 15:38:50','2026-04-18 15:42:03');
INSERT INTO `pesanan` VALUES (3,'tggg','Ambil di Toko','[{\"id_sparepart\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":10},{\"id_sparepart\":1,\"nama\":\"Oli \",\"harga\":65000,\"qty\":1,\"stok\":6}]',115000,'approved','2026-04-18 15:50:34','2026-04-18 15:50:54');
INSERT INTO `pesanan` VALUES (4,'ggggg','Ambil di Toko','[{\"id_sparepart\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":10},{\"id_sparepart\":1,\"nama\":\"Oli \",\"harga\":65000,\"qty\":1,\"stok\":5}]',115000,'','2026-04-18 15:52:20','2026-04-18 17:25:09');
INSERT INTO `pesanan` VALUES (5,'Kontol','Ambil di Toko','[{\"id_sparepart\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":9},{\"id_sparepart\":1,\"nama\":\"Oli \",\"harga\":65000,\"qty\":1,\"stok\":5}]',115000,'','2026-04-18 17:22:51','2026-04-18 17:25:07');
INSERT INTO `pesanan` VALUES (6,'Ceo Aphen','Ambil di Toko','[{\"id_sparepart\":3,\"nama\":\"Spion Carbon\",\"harga\":60000,\"qty\":2,\"stok\":15},{\"id_sparepart\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":9}]',170000,'approved','2026-04-18 17:26:04','2026-04-18 17:26:47');
INSERT INTO `pesanan` VALUES (7,'Kepin','Ambil di Toko','[{\"id_sparepart\":5,\"nama\":\"GIR BAJA\",\"harga\":500000,\"qty\":1,\"stok\":10},{\"id_sparepart\":4,\"nama\":\"PISTON\",\"harga\":75000,\"qty\":1,\"stok\":15},{\"id_sparepart\":3,\"nama\":\"Spion Carbon\",\"harga\":60000,\"qty\":1,\"stok\":13},{\"id_sparepart\":2,\"nama\":\"Busi motor\",\"harga\":50000,\"qty\":1,\"stok\":8}]',685000,'approved','2026-04-25 15:51:47','2026-04-25 15:52:17');
INSERT INTO `pesanan` VALUES (8,'Budi','Ambil di Toko','[{\"id_sparepart\":5,\"nama\":\"GIR BAJA\",\"harga\":500000,\"qty\":2,\"stok\":9},{\"id_sparepart\":4,\"nama\":\"PISTON\",\"harga\":75000,\"qty\":1,\"stok\":14},{\"id_sparepart\":3,\"nama\":\"Spion Carbon\",\"harga\":60000,\"qty\":1,\"stok\":12}]',1135000,'pending','2026-05-06 11:32:48',NULL);
DROP TABLE IF EXISTS `spareparts`;
CREATE TABLE `spareparts` (
  `id_sparepart` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sparepart`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `spareparts` VALUES (1,'OLI-01','Oli ','Oli Premium',65000,10,'4b00da1bf9871609f65230a22440f613.jpg');
INSERT INTO `spareparts` VALUES (2,'Busi-01','Busi motor','cvt',50000,7,'3ba1a5f396f7a7d968164ec06c14601d.jpg');
INSERT INTO `spareparts` VALUES (3,'SPION-01','Spion Carbon','Aksesoris',60000,12,'ed301f93f1345ac46cc2766aaf73a3b2.jpg');
INSERT INTO `spareparts` VALUES (4,'PISTON-01','PISTON','Elektonik',75000,14,'e10432113079427b3e0fe4a28d08aedd.jpg');
INSERT INTO `spareparts` VALUES (5,'GIR-01','GIR BAJA','Mesin',500000,9,'6fbafb017f525e7d1ecac55be5df57aa.jpg');
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES (1,'admin','$2y$10$ua6Ce5OyBTS2TYpWuGX1m.hRPvum/bN2Nd/9ePCdBFHy1RN9rB1qW','admin bengkel');

ALTER TABLE `barang_keluar`
ADD CONSTRAINT `fk_barang_keluar_sparepart` FOREIGN KEY (`id_sparepart`) REFERENCES `spareparts` (`id_sparepart`) ON DELETE SET NULL ON UPDATE CASCADE;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
