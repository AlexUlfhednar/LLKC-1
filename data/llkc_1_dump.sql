-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: llkc-1
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `additional`
--

DROP TABLE IF EXISTS `additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `additional` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `basic_id` int NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postal` varchar(10) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional`
--

LOCK TABLES `additional` WRITE;
/*!40000 ALTER TABLE `additional` DISABLE KEYS */;
INSERT INTO `additional` VALUES (32,186,'aaa','aaa','Latvia','1111','111111111','111111111'),(33,187,'bbb','bbbb','Latvia','2222','222222222','222222222'),(34,188,'ccccccc','ccccccc','Latvia','3333','333333333','333333333'),(36,190,'ddd','ddddd','Latvia','4444','444444111','444444111'),(45,199,'eee','eeeeeeee','Argentina','5555','555555555','555555555'),(60,214,'fff-12','fff','Australia','7654','567432123','567432123'),(64,218,'ggg-3','ggg75','Bahrain','7890','777777777','777777777'),(70,224,'kkkkkkk','kkkkkkkk','Bahrain','3456','765876987','kkkkkkkkkkk'),(73,227,'ggg','gghsjsht','Argentina','9999','999999999','999999999');
/*!40000 ALTER TABLE `additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basic`
--

DROP TABLE IF EXISTS `basic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basic` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basic`
--

LOCK TABLES `basic` WRITE;
/*!40000 ALTER TABLE `basic` DISABLE KEYS */;
INSERT INTO `basic` VALUES (186,'Aaaa','aaa','aaa@aaa.com','111'),(187,'Bbb','bbb','bbb@bbb.com','222'),(188,'Ccc','ccc','ccc@ccc.com','333'),(190,'Dddd','ddd','ddd@ddd.com','444'),(199,'Eee','eee','eee@eee.com','555'),(214,'Fff','fff','fff@fff.com','111'),(218,'GggGant1','ggg1','ggg@ggg.ggg','456'),(224,'Kkk','kkk','kkk@kkk.kkk','123'),(227,'Gandalf','ggg','gand@dalf.com','999');
/*!40000 ALTER TABLE `basic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special`
--

DROP TABLE IF EXISTS `special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dateFrom` varchar(12) DEFAULT NULL,
  `dateTo` varchar(12) DEFAULT NULL,
  `radio` varchar(5) DEFAULT NULL,
  `cycling` int DEFAULT NULL,
  `swimming` int DEFAULT NULL,
  `rowing` int DEFAULT NULL,
  `basketball` int DEFAULT NULL,
  `football` int DEFAULT NULL,
  `add_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special`
--

LOCK TABLES `special` WRITE;
/*!40000 ALTER TABLE `special` DISABLE KEYS */;
INSERT INTO `special` VALUES (19,'07/01/2023','07/02/2023','yes',0,1,1,0,0,186),(20,'07/02/2023','07/03/2023','yes',0,1,0,0,0,187),(21,'07/03/2023','07/04/2023','yes',1,1,0,0,0,188),(23,'07/05/2023','07/09/2023','no',1,0,0,0,0,190),(32,'07/05/2023','07/07/2023','no',1,0,1,0,0,199),(47,'07/10/2023','07/19/2023','yes',0,1,1,0,0,214),(51,'07/09/2023','07/09/2023','yes',0,1,1,0,0,218),(57,'07/07/2023','07/09/2023','yes',1,0,1,0,0,224),(60,'07/12/2023','07/17/2023','no',0,0,1,0,0,227);
/*!40000 ALTER TABLE `special` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-10 13:23:13
