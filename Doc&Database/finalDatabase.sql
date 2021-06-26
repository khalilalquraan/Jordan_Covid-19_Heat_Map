-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: GP
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `approves`
--

DROP TABLE IF EXISTS `approves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `national_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approves`
--

LOCK TABLES `approves` WRITE;
/*!40000 ALTER TABLE `approves` DISABLE KEYS */;
INSERT INTO `approves` VALUES (26,'1234567890'),(29,'1234567891'),(30,'9851054965'),(32,'1234567893');
/*!40000 ALTER TABLE `approves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hospitals` (
  `hospital_id` int NOT NULL AUTO_INCREMENT,
  `hospital_name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `isolation_beds` int NOT NULL,
  `icu_beds` int NOT NULL,
  `ventilators` int NOT NULL,
  PRIMARY KEY (`hospital_id`),
  UNIQUE KEY `hospital_id_UNIQUE` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitals`
--

LOCK TABLES `hospitals` WRITE;
/*!40000 ALTER TABLE `hospitals` DISABLE KEYS */;
INSERT INTO `hospitals` VALUES (3,'Al amer hamza','amman',20,30,5);
/*!40000 ALTER TABLE `hospitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `create` date NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `hospital_id` int DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `test_date` date NOT NULL,
  `chronic_diease` varchar(45) DEFAULT NULL,
  `test_result` varchar(45) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `death_date` date DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (321,1604,3,NULL,'2021-06-12','soso','-1',NULL,NULL,'Good'),(322,1604,3,NULL,'2021-06-17','soso','1',NULL,NULL,'Medium');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'user'),(2,'admin'),(3,'healthcare manager');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'good','green','319518'),(2,'medium','orange','16226048'),(3,'Bad','red','10950168');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usernotifications`
--

DROP TABLE IF EXISTS `usernotifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usernotifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notification_id` int NOT NULL,
  `user_id` int NOT NULL,
  `open` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usernotifications`
--

LOCK TABLES `usernotifications` WRITE;
/*!40000 ALTER TABLE `usernotifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `usernotifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `zone_id` int DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `family_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `phone` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `approve` int DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `city` varchar(255) NOT NULL,
  `neighbourhood` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `national` varchar(255) NOT NULL,
  `safe_question` int NOT NULL,
  `answer_safe_question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `national_UNIQUE` (`national`)
) ENGINE=InnoDB AUTO_INCREMENT=1608 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,2,NULL,'khalil','alquraan','kalquraan','$2a$10$eDSXDRMx5oTMdUPqpAQGzu1pL5CDGBbYfiOTxjD3zdM0ooZObvJaO','khalilalquraan@gmail.com',21,NULL,NULL,NULL,32.070118,36.092363399999996,'Zarqa','حي النصر','13111','Hay Al-Nozha','1234567890',0,''),(1600,1,NULL,'khalil','alquraan','newHcare','$2a$10$zZd.I5pj2RpGpzT.e6E3C.8pMamfDgdARxwlpE0TCSt0w17j3f6TG','khalilalquraan1@gmail.com',22,NULL,NULL,NULL,32.0626663,36.0799233,'Zarqa','الحديقة','13111','Hay Al-Nozha','1234567891',3,'ali'),(1601,2,NULL,'admin','alquraan','admin','$2a$10$eDSXDRMx5oTMdUPqpAQGzu1pL5CDGBbYfiOTxjD3zdM0ooZObvJaO','khalilalquraan2@gmail.com',22,NULL,NULL,NULL,32.0626663,36.0799233,'Zarqa','الحديقة','13111','Hay Al-Nozha','1234567892',0,''),(1602,3,NULL,'healthcare','alquraan','hcare','$2a$10$.bbS5MnbRIRQwurjbXf9f.Om2tykWTm9YkL7cFAIP5EpHk9OgonCG','khalilalquraan3@gmail.com',33,NULL,NULL,NULL,32.0701523,36.092371299999996,'Zarqa','حي النصر','13111','Hay Al-Nozha','1234567893',3,'ali'),(1604,1,NULL,'khalil','alquraan','user1','$2a$10$McD0YzUxUQgJBEZbfcvhv.KIdd2u9KL7WawHqA42P2MZgPDyE/xWK','khalilalquraan001@gmail.com',22,NULL,NULL,NULL,32.0752725,36.1002004,'Zarqa','الغويرية','1324','Hay Al-Nozha','1000000001',0,'none'),(1605,3,NULL,'ahmad','alzoubi','a.alzoubi','$2a$10$oorZOh/TXy7gOv2CeVVUo.LIoSCBVZG/TQqCixSbsGB8Iy3a2ElzK','ahmadAlzoubi@gmail.com',36,NULL,NULL,NULL,32.0752725,36.1002004,'Zarqa','الغويرية','1324','Hay Al-Nozha','9851054965',0,'data Structure and Algorithm'),(1606,1,NULL,'tt','tt','test1','$2a$10$ZRY5GWpJksMsv4qR6CY3S.bFhCNUnWSWJTziuW6VHx8Zo8ZR6Ix1O','khalilalquraan99@gmail.com',16,NULL,NULL,NULL,32.0752725,36.1002004,'Zarqa','الغويرية','1324','Hay Al-Nozha','1234567899',0,'none'),(1607,3,NULL,'hcare','familyHcare','healthcare1','$2a$10$4gGMxGSG1nfLhmCoswbv..k0op653WVPElr6LrHfAvquB.G965Lu2','hcare22@gmail.com',23,NULL,NULL,NULL,32.0752725,36.1002004,'Zarqa','الغويرية','1324','Hay Al-Nozha','1234567888',0,'none');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zones` (
  `zone_id` int NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(45) NOT NULL,
  `area` int NOT NULL,
  `populatoin` int NOT NULL,
  `city` varchar(45) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`zone_id`),
  UNIQUE KEY `zone_id_UNIQUE` (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (1,'liwa\' Qasabatan Maean',2356,45030,'Ma\'an','5526355'),(2,'liwa\' Alruwyshd',21630,7490,'Mafraq','3882817'),(3,'liwa\' Aljiza',2621,104165,'Amman','5394768'),(4,'qada\' Al\'azraq',3948,57490,'Zarqa','4014657'),(5,'liwa\' Alqawayra',1606,22778,'Aqaba','6052699'),(6,'Wadi Araba',2322,9504,'Aqaba','6052693'),(7,'liwa\' Alqasr & liwa\'Alqitarana',1229,32443,'Karak','5527123'),(8,'liwa\' Qasbat Aleaqaba',20222,149514,'Aqaba','6052701'),(9,'liwa\' Alhusaynia & liwa\' Alshuwbik',911,39580,'Karak','6051925'),(10,'liwa\' Qasbat Altafila',1031,65595,'Tafila','6051411'),(11,'liwa\' Fuque & Qada\' Ghur Almazraea & Sirfa',10,34045,'Karak','5395280'),(12,'lwa\' Albtra\'',240,36740,'Ma\'an','6052696'),(13,'liwa\' Qasbatan Madibanaan',413,164970,'Madaba','5197392'),(14,'Sabha',10,9338,'Mafraq','4013889'),(15,'liwa\' Almazar Aljanubii & Qasbat Alkrk & Ei',1235,190009,'Karak','5723731'),(16,'liwa\' Alhasa',952,11135,'Tafila','5920339'),(17,'liwa\' Sahab',483,169434,'Amman','5066320'),(18,'liwa\' Qasbat Almafraq',10,196196,'Mafraq','4014660'),(19,'liwa\' Qasbat Alzirqa\'',259,717390,'Zarqa','4869198'),(20,'liwa\' Dayr Ealaan & liwa\' Alshuwnat Aljanubia',538,126191,'Balqa','4868427'),(21,'liwa\' Qasbat \'Iirbad',987,1023940,'Irbid','4409158'),(22,'liwa\' Qasbat Eamman & Naeur & Wadi Alsayr',277,1302317,'Amman','5066318'),(23,'baleama',10,35599,'Mafraq','4540233'),(24,'liwa\' Almuaqar',609,47753,'Amman','5198160'),(25,'liwa\' Qasbat Alsult&Eayan Albasha&Mahis',319,319283,'Balqa','4869195'),(26,'liwa\' Altibiya',63,56940,'Irbid','4408390'),(27,'liwa\' Qasbat Jarash',268,207997,'Jerash','4737355'),(28,'liwa\' Alramtha',275,263680,'Irbid','4211780'),(29,'liwa\' Dhiban',544,39330,'Madaba','5526352'),(30,'liwa\' Qasbat Eajlun',359,89800,'Ajloun','4736841'),(31,'liwa\' Basirana',227,27270,'Tafila','6051923'),(32,'samma alsarhan',10,7018,'Mafraq','4211268'),(33,'liwa\' Al\'aghwar Alshamalia',246,135240,'Irbid','4409161'),(34,'Birin',10,2928,'Zarqa','5065806');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-17  1:34:09
