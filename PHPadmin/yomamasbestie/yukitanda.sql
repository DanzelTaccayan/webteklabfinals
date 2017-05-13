-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: webtekfinals
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `sender` int(11) NOT NULL,
  `recepient` int(11) NOT NULL,
  `content` text NOT NULL,
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`feedback_id`),
  KEY `sender_idx` (`sender`),
  KEY `recipient_idx` (`recepient`),
  CONSTRAINT `recipient` FOREIGN KEY (`recepient`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (6,8,'ULUL',3),(6,4,'PANGET WALANG KWENTA',4),(6,9,'MAITITM KA',5),(6,7,'ANO TO?',6),(8,9,'BASURA',7),(4,4,'VERY VERy BAAAAD',8);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver` int(11) NOT NULL COMMENT 'receiver ng notif',
  `data` varchar(255) NOT NULL COMMENT 'laman ng notif',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`),
  CONSTRAINT `receiver.fk` FOREIGN KEY (`receiver`) REFERENCES `user_details` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (3,5,'Username 123  has registered a new account with a user type of  SP','2017-05-12 19:01:19','2017-05-12 16:35:33','2017-05-12 16:35:33'),(4,5,'Username miguel  has registered a new account with a user type of  SP','2017-05-12 19:05:33','2017-05-12 19:05:15','2017-05-12 19:05:15'),(5,5,'Username eyot  has registered a new account with a user type of  customer','2017-05-13 11:50:44','2017-05-13 11:43:48','2017-05-13 11:43:48');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluator` int(11) NOT NULL,
  `evaluatee` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `evaluator _idx` (`evaluator`),
  KEY `evaluatee_idx` (`evaluatee`),
  CONSTRAINT `evaluatee` FOREIGN KEY (`evaluatee`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  CONSTRAINT `evaluator ` FOREIGN KEY (`evaluator`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (1,4,5,4),(2,6,5,5),(3,7,5,3),(4,5,6,4),(5,4,6,2),(6,4,7,5),(7,5,7,2),(8,4,8,5),(9,5,8,4),(10,4,9,5),(11,5,9,4),(12,6,9,1);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `recipient`
--

DROP TABLE IF EXISTS `recipient`;
/*!50001 DROP VIEW IF EXISTS `recipient`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `recipient` AS SELECT 
 1 AS `recepient`,
 1 AS `recName`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `idrequest` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('approve','reject','pending') NOT NULL DEFAULT 'pending',
  `requested_by` int(11) NOT NULL,
  `requested_to` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_needed` varchar(7) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`idrequest`),
  UNIQUE KEY `idrequest_UNIQUE` (`idrequest`),
  KEY `requested_by_idx` (`requested_by`),
  KEY `requested_to_idx` (`requested_to`),
  KEY `service_id_idx` (`service_id`),
  CONSTRAINT `requested_by` FOREIGN KEY (`requested_by`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  CONSTRAINT `requested_to` FOREIGN KEY (`requested_to`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (1,'pending',6,7,1,'2017-05-10 15:12:13','2017-05-10 15:12:13','12:13',NULL);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `sender`
--

DROP TABLE IF EXISTS `sender`;
/*!50001 DROP VIEW IF EXISTS `sender`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `sender` AS SELECT 
 1 AS `sender`,
 1 AS `senderName`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service_description` text,
  `sp_id` int(11) NOT NULL,
  PRIMARY KEY (`service_id`),
  UNIQUE KEY `service_id_UNIQUE` (`service_id`),
  UNIQUE KEY `service_name_UNIQUE` (`service_name`),
  KEY `fk_sp_idx` (`sp_id`),
  CONSTRAINT `ff_sp` FOREIGN KEY (`sp_id`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Haircut','2017-05-10 15:12:13','2017-05-10 23:12:13',6),(2,'Jakol','2017-05-10 15:12:13','2017-05-10 23:12:13',6);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `transaction_status` enum('ongoing','done') DEFAULT 'ongoing',
  `sp_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`transaction_id`),
  KEY `sp_id_idx` (`sp_id`),
  KEY `cust_id_idx` (`cust_id`),
  KEY `service_id_idx` (`service_id`),
  CONSTRAINT `cust_fk` FOREIGN KEY (`cust_id`) REFERENCES `user_details` (`idUser`),
  CONSTRAINT `service_fk` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE,
  CONSTRAINT `sp_fk` FOREIGN KEY (`sp_id`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UserType` enum('SP','customer','admin','guest') DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUser_UNIQUE` (`idUser`),
  CONSTRAINT `fk_reqid_reqslip` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (4,'Galo Berlyn','Dullas','Garlejo','123 bonifaceio','test@yahoo.com',123456789,'IBM','2017-05-10 15:12:13','2017-04-28 12:13:38','SP'),(5,'asdas','asdasdas','asdasda','aaa','asdasdas@asdasda.com',222,'aaa','2017-05-10 15:12:40','2017-04-28 12:15:55','admin'),(6,'Ethel Dawn','Tufay','Mejala','Camp Dangwa, La Trinidad, Benguet','mademoiselle@gmail.com',222,'d','2017-05-10 15:12:47','2017-04-28 12:36:17','customer'),(7,'sadas','sadas','sdas','sadas','asdasdas@asdasda.com',22,'','2017-05-10 15:12:24','2017-04-28 12:36:40','SP'),(8,'Kobe','wv','Miguel','qwf','2153820@slu.edu.ph',32131,'BOTAS','2017-05-04 03:49:20','2017-05-04 03:49:20','SP'),(9,'Yuki','Pogi','Marfil','jan sa gilid','yukipogi@gmail.com',98457847,'Apple','2017-05-08 03:49:20','2017-05-08 04:49:20','SP'),(10,'test','test','test','dg','tset@ff.com',3414,'fswq','2017-05-12 03:14:58','2017-05-12 03:14:58','SP'),(11,'test','trst ','wow ','mecv','faloW@dms',448484,'646cdwcw','2017-05-12 19:05:14','2017-05-12 19:05:14','SP'),(12,'c','dv','dq','dwv','dvw@ef',23321,'dwv','2017-05-13 11:43:48','2017-05-13 11:43:48','customer');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` enum('Active','Disabled','pending') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`idUsers`),
  UNIQUE KEY `idUsers_UNIQUE` (`idUsers`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'galo','$2y$10$.VnMQXvYbrEQyM3dyRUC3.YnydaDhAO295Ki68y/XbqjoWkExYGYm','Active'),(5,'galo123','$2y$10$kSvMVPukBXrwowUItl.Ne.m11pMK9R/6JFdCYJ4uM9.aKizk1vEt.','Active'),(6,'etheldawn','wooden','Active'),(7,'dasdas','$2y$10$jACl6i2Dxmtiw.NaJPxs.OOdgzY77LUmwuwa8ZRYL9FZ7WGqHlrFy','Active'),(8,'burat','$2y$10$Rj1fSB88l.ZCXDRkak2nkucU9P6CU4v34DbAbypb/mzbfTrM.fObq','Active'),(9,'yuki','$2y$10$gx/AZWXciIUVd/rnxtBQLevlHPrWEHUyaPl3cMcrHuqoFumud1z1u','pending'),(10,'test','$2y$10$Y6I.Y0NnQKDdUBDu7EnpTulI5GvwNhx/8aftolpmZl390umiLCzW2','pending'),(11,'miguel','$2y$10$csoRcvrgNpNuZRbRDaj0juoBIDTTzRxrf2I7B0Hx.LCG9/DCiCYZ2','pending'),(12,'eyot','$2y$10$hBW7T4fcFLYZ6z.RrNM7UOEYIBuo3ZPxYc5s1BROBLfo5hF5mdO92','pending');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `recipient`
--

/*!50001 DROP VIEW IF EXISTS `recipient`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `recipient` AS select `feedback`.`recepient` AS `recepient`,concat(`user_details`.`firstName`,`user_details`.`middleName`,`user_details`.`lastName`) AS `recName` from (`feedback` join `user_details`) where (`user_details`.`idUser` = `feedback`.`recepient`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `sender`
--

/*!50001 DROP VIEW IF EXISTS `sender`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `sender` AS select `feedback`.`sender` AS `sender`,concat(`user_details`.`firstName`,`user_details`.`middleName`,`user_details`.`lastName`) AS `senderName` from (`feedback` join `user_details`) where (`user_details`.`idUser` = `feedback`.`sender`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-13 21:08:28
