-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: rest_laravel
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `m_product`
--

DROP TABLE IF EXISTS `m_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `brand` varchar(50) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_product`
--

LOCK TABLES `m_product` WRITE;
/*!40000 ALTER TABLE `m_product` DISABLE KEYS */;
INSERT INTO `m_product` VALUES (1,'MSI Modern 14','1000001.22','MSI','MSI Modern 14 cocok untuk anak muda pembisnis bahkan mahasiswa',1,'2022-08-10 08:09:18',NULL,NULL);
/*!40000 ALTER TABLE `m_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_product_variasi`
--

DROP TABLE IF EXISTS `m_product_variasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_product_variasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_product_variasi_FK` (`product_id`),
  CONSTRAINT `m_product_variasi_FK` FOREIGN KEY (`product_id`) REFERENCES `m_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_product_variasi`
--

LOCK TABLES `m_product_variasi` WRITE;
/*!40000 ALTER TABLE `m_product_variasi` DISABLE KEYS */;
INSERT INTO `m_product_variasi` VALUES (1,1,'MSI Modern 14 i7','1000001.22.1660118958.0',12000000.00,1,'2022-08-10 08:09:18',NULL,NULL),(2,1,'MSI Modern 14 i5','1000001.22.1660118958.1',10000000.00,1,'2022-08-10 08:09:18',NULL,NULL),(3,1,'MSI Modern Ryzen 7 Touchscreen','1000001.22.1660118958.2',15000000.00,1,'2022-08-10 08:09:18',NULL,NULL),(4,1,'MSI Modern Ryzen 7','1000001.22.1660118958.3',11000000.00,1,'2022-08-10 08:09:18',NULL,NULL),(5,1,'MSI Modern Ryzen 5','1000001.22.1660118958.4',9000000.00,1,'2022-08-10 08:09:18',NULL,NULL),(6,1,'MSI Modern 14 i3','1000001.22.1660118964.0',7000000.00,1,'2022-08-10 08:09:24',NULL,NULL),(7,1,'MSI Modern 14 i3 Touchscreen','1000001.22.1660118964.1',8000000.00,1,'2022-08-10 08:09:24',NULL,NULL);
/*!40000 ALTER TABLE `m_product_variasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag_active` tinyint(1) NOT NULL,
  `expired_at` datetime NOT NULL,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'eyJpdiI6IlBpMUU0QlpvU1gwbko4bm1BNDZqc0E9PSIsInZhbHVlIjoiNW94ZWszSFAvZ2MyWjhSTVpOZ1BnRG54TW45aG9aTDhNckFQdmhWMTB6QkN1RFgzZmZwRUE0UUdJNUFGUGtHVzRQM1lMQkRrbFA5RzFVNWJnVkpuUVhzMWVhRldRcWRJeklMRjZ0MVdtbjhXMG9wZmh2RkEvcERpQmEwWjB4NDZGK1RuVWdnallwcWJ0RXdhRlVrQ2Z3STFSTUZMT3hMZzNNaGZLV0xBdk5BUEtKQUtyV0ZXbTBHTFUyL29iM1F3IiwibWFjIjoiODQxNmI4YjNkMTlmYzdkNWVmNjg5OTkyNmNhMWU2NDM5Mjc5ODM2MjQ0NmFiZWVmYmNiNWY3MTM1OTExNzNmYiIsInRhZyI6IiJ9',0,'2022-08-11 04:11:13',NULL,'2022-08-10 04:03:49','2022-08-10 04:11:27'),(2,'eyJpdiI6IkFWSlhZQ0puNmVrdkJRSFFPT0lnUVE9PSIsInZhbHVlIjoiaTExYVJocjJQLzQzRng5MFpmc1c2RHlXNWFDYVBZZkpjVGgrMVYxelpPdFhManJoUUpYcmdmVThqcXlLeURBd01hdnVWa2VHNGtCcDN6b0NVcTRuWGR1VEhQSjJKbWJBeGRjNFI4dmhvcDdHNUYxTksrOGN1NzIzemFQTVhENVlHMHRZd0xMbFNzdGtrUTE5bFlVNG5JVDRka3A0enFBd2plaWk2NFVvNnJuOWJPTGJiVzZaZHR5L0NhWTdCWStVIiwibWFjIjoiZWRiYTViMzJjMThiMGQ5YTA2YzI2ZDM3MGVlZDgyMWFjNTk5NTQ3Zjk0ZmJlOWMwYzI4NDM3OGE1OTFlYjRiOCIsInRhZyI6IiJ9',1,'2022-08-11 04:11:30',NULL,'2022-08-10 04:11:30',NULL),(3,'eyJpdiI6IitzWDZFaXNLZUpMZzNZY1M3b1VRdlE9PSIsInZhbHVlIjoiVG1ob2FGb1lGQlZKWDZJU0VPSzQrUndXMmdqVUgrNFJNSFZUR0k4MitWb2F3bzk5Y1NVWjdhU2ZGeFpmd3h3blZLUDhpQ2tiQ3pHbE52QW1mK0JIcW0rYzhCVHNBdXBKNzFzQ3pVQ2VNVUcrV1c2QTlhTWFHdGZmTGNPSGcxKzcrK0JwanJSdXV1dTJzQjlTQ1ZwVHMxWGltR0R1dGk2aHhDSTBpbk8zNjFiOHFCVHkzZ2JlU1RBbjg0M1cxMkp4IiwibWFjIjoiZTc0YTUzYWIyZGZkNTc5MjI3OWU1OTA4ZjQ2MjI2NzczZTRhOGJjNGMzNjBiMGUzMmE4OWUyMGY4MmM3NWVjNSIsInRhZyI6IiJ9',0,'2022-08-11 08:12:33',NULL,'2022-08-10 08:10:25','2022-08-10 08:13:01'),(4,'eyJpdiI6IktKSHpxMkNyL3VZYkh3N2ZvS09peUE9PSIsInZhbHVlIjoiTXcvSUV0SUZ3S2FSWmdRMVVsQThSS1JLWEZDTVBDa2oyWTFGMlZXQWR1MURqWk5hRTc4dU5FSm5YTHVMYkZLdUQxQ0lEbWxJVjErNHBKV0tZeG5TVW9nQXZzaWIxNmZUSEtHRXJETDhGQzZCY2Y3K3BEUkMrWjZWRnRsUjhqKzlZUWtCT1IyTjF0dmlJbFZZZXhQdVltcm1PYjlMSmtCVUJiNjN0SENObnNJbmtzVzdNaER5UEl6c2JOUWdScVRLIiwibWFjIjoiMTY4MTAxZDc5ZWU1MzBkZGQyNTMyNGM0MjA3ZTZhYTBhYmJmN2M2OGQxY2M0MTQ4ZDRjY2U1OGYyM2EzN2EyYyIsInRhZyI6IiJ9',1,'2022-08-11 08:13:10',NULL,'2022-08-10 08:13:10',NULL);
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Agus Suandi','agus.suandi','agussuandi48@gmail.com',NULL,'$2y$10$2rNDXCHv6SCx2AQ1B69fSO9Hjrbcpeao.KUAiHnzh0Q/LB6sqalMe',NULL,'2022-08-09 20:49:58','2022-08-09 20:49:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rest_laravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-10 15:39:19
