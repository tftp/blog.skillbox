-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `notes_id` int(11) NOT NULL,
  `trust` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`users_id`,`notes_id`),
  KEY `fk_comments_users_idx` (`users_id`),
  KEY `fk_comments_notes1_idx` (`notes_id`),
  KEY `comments_create_time` (`create_time`),
  CONSTRAINT `fk_comments_notes1` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (71,'afgrgg','2021-03-16 16:01:57',17,58,-1),(72,'agaergaerg','2021-03-16 16:02:00',17,58,0),(73,'gargra','2021-03-16 16:02:03',17,58,-1),(74,'dhnhns','2021-03-16 16:02:20',18,58,0),(75,'snfns','2021-03-16 16:02:23',18,58,0),(76,'snfns','2021-03-16 16:02:25',18,58,1),(77,'xgngbsfgbsb','2021-03-16 16:02:42',16,58,1),(78,'sdfbdfbb','2021-03-16 16:02:51',16,58,1),(79,'sbgbsgbsgfb','2021-03-16 16:02:54',16,58,-1),(80,'яапяп','2021-03-16 17:04:44',16,49,1),(81,'япапвп','2021-03-16 17:04:47',16,49,1),(82,'яппквп','2021-03-16 17:04:49',16,49,1),(83,'якпквкпп','2021-03-16 17:04:51',16,49,1),(84,'якпфкпвк','2021-03-16 17:04:54',16,49,1),(85,'jh;lkh; ;kh;lh;h;h;jhk ;j;oiu\'io\'j\'jk\'ljk\'j\'j\'   \'j\'kljjjjjjjjjjj\'oi\';j\'lj\'lj ;h;kjh;kjhjljhlj \'j\'kj\'kjkh;kjhjhjkhjhghjuui itdfgdfgdfgxasefasfa afafafafafasdf adfafadfafdafaf adfadfadfadfafa adfadfafadfa adfadfadfadfadfafd adfadfadfasdfasdf adfadfafafadf','2021-03-16 17:29:57',17,49,0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (49,'1614350810.jpg','Путин обсудил с канцлером Австрии возможные поставки «Спутника V»','«Подробно обсуждены вопросы противодействия распространению коронавирусной инфекции, включая возможности поставок в Австрию российской вакцины “Спутник V”, а также налаживания ее совместного производства», — говорится в сообщении.\r\n\r\nСтороны договорились о поддержании плотных контактов по данному вопросу по линии профильных ведомств, пишет «Газета.ру».\r\n\r\nРанее в феврале профессор, ведущий инфекционист Медицинского университета Вены и председатель Австрийского общества инфекционных заболеваний и тропической медицины Флориан Тальхаммер назвал российскую вакцину «Спутник V» эффективной и надежной, как автомат Калашникова.','2021-02-26 14:46:50'),(58,'1615827796.jpg','Италия и Франция вслед за ФРГ приостановили использование вакцины AstraZeneca','«По рекомендации министра здравоохранения было принято решение в качестве меры предосторожности приостановить использование вакцины AstraZeneca в надежде его быстро возобновить, если это позволит мнение ЕМА», — сказал Макрон на совместной пресс-конференции с премьером-министром Испании Педро Санчесом.\r\n\r\nРешение об остановке вакцинации указанным препаратом приняли и в Италии.\r\n\r\nМинздрав страны объяснил это мерами предосторожности «в соответствии с аналогичными решениями других европейских стран», дополняет ТАСС.\r\nТакже 15 марта власти Германии приняли решение о приостановке применения вакцины от коронавируса компании AstraZeneca в качестве мер предосторожности. Уточняется, что это решение было принято на фоне сообщений о развитии тромбоэмболии у ранее привитых пациентов.','2021-03-15 17:03:16');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes_has_subscribers`
--

DROP TABLE IF EXISTS `notes_has_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes_has_subscribers` (
  `notes_id` int(11) NOT NULL,
  `subscribers_email` varchar(100) NOT NULL,
  PRIMARY KEY (`notes_id`,`subscribers_email`),
  KEY `fk_notes_has_subscribers_subscribers1_idx` (`subscribers_email`),
  KEY `fk_notes_has_subscribers_notes1_idx` (`notes_id`),
  CONSTRAINT `fk_notes_has_subscribers_notes1` FOREIGN KEY (`notes_id`) REFERENCES `notes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notes_has_subscribers_subscribers1` FOREIGN KEY (`subscribers_email`) REFERENCES `subscribers` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes_has_subscribers`
--

LOCK TABLES `notes_has_subscribers` WRITE;
/*!40000 ALTER TABLE `notes_has_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes_has_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (65,'Контакты для связи с автором','Чтобы связаться с автором пишите письма на admin@localhost\r\nС уважением, автор!','Контакты','2021-03-20 08:36:20');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `email` varchar(100) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `secret` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES ('kara@localhost.ru','2021-03-17 17:12:38','3b92f9fa09d9e9639dd5bce8b8838406'),('may@localhost.ru','2021-03-17 17:12:42','aced60e51d0f36687046995fa736e118'),('wi-fi@list.ru','2021-03-17 17:13:08','07896c396dd8147bd1b9a6de14a869fd'),('www@local.ru','2021-03-17 17:26:38','3fc0cf4ca97bf95a6ebd0c1e4be27dc4');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `annotation` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@localhost','Вероятнее всего, что я администратор :)','1614177120.png',1,'2021-02-11 12:15:52','$2y$10$5Af7.hNo/C4EYVmdg6JjleJ70Zh3v0UMt4KTNN0.fVNPEO9p1wKC6'),(16,'Наталья','guest@localhost.ru',NULL,'noname-avatar.png',2,'2021-02-26 18:32:05','$2y$10$ijF7IK98wfuPWlRuO4eUt.ggZoOFe25RCgP1.FT0n0VUbMw2lh5V2'),(17,'КараМурза','kara@localhost.ru',NULL,'noname-avatar.png',0,'2021-02-27 15:26:30','$2y$10$hDQK/1GJTZlJbSLolUGvreiIYkazV9ypqJRGed1YBe7uv5ZiiYz.q'),(18,'МэйАлекс','may@localhost.ru',NULL,'noname-avatar.png',0,'2021-03-02 17:10:09','$2y$10$NBGDC9sI8bqczlNxi/zKI.QJo7Z2E41AxwfzkZCRhOxsMYdFHCvfC'),(19,'Rozovaja Buka','buka@localhost.ru',NULL,'noname-avatar.png',0,'2021-03-08 18:36:36','$2y$10$VfKtyOdLFbzEHsEVxusj8e10MRKJFCrf0TOFACPr32fVLurP.0vXq');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-20 11:59:49
