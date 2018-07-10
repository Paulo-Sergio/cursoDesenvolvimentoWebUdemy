-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: twitter_clone_udemy
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweet` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `data_inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweet`
--

LOCK TABLES `tweet` WRITE;
/*!40000 ALTER TABLE `tweet` DISABLE KEYS */;
INSERT INTO `tweet` VALUES (1,2,'meu primeiro tweet','2018-07-08 14:14:46'),(2,2,'outro teste','2018-07-08 14:20:40'),(3,3,'Brasil perdeu pra bélgica... =/','2018-07-08 14:30:46'),(4,2,'copa do mundo 2018','2018-07-08 14:50:05'),(5,1,'tweet falando sobre iza','2018-07-10 18:28:47'),(6,1,'novo tweet para teste','2018-07-10 18:47:40'),(7,1,'teste de tweet','2018-07-10 18:48:11'),(8,1,'mais um teste','2018-07-10 18:48:17'),(9,1,'\"twitando\" bastante','2018-07-10 18:48:34'),(10,3,'Paulo de Tweet Novo','2018-07-10 18:48:59'),(11,3,'mais uuuummm','2018-07-10 18:49:05'),(12,2,'Novo tweet do usuário TESTE','2018-07-10 18:49:47'),(13,2,'muit interessante','2018-07-10 18:50:01');
/*!40000 ALTER TABLE `tweet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'iza','bellynha_18@hotmail.com','e10adc3949ba59abbe56e057f20f883e'),(2,'teste','teste@teste.com','e10adc3949ba59abbe56e057f20f883e'),(3,'paulo','paulo@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(4,'jorge','jorge.teste@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(5,'mateus','mateus@hotmail.com','e10adc3949ba59abbe56e057f20f883e'),(6,'bruno','bruno.sobrenome@oul.com.br','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_seguidores`
--

DROP TABLE IF EXISTS `usuarios_seguidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_seguidores` (
  `id_usuario_seguidor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `seguindo_id_usuario` int(11) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario_seguidor`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_seguidores`
--

LOCK TABLES `usuarios_seguidores` WRITE;
/*!40000 ALTER TABLE `usuarios_seguidores` DISABLE KEYS */;
INSERT INTO `usuarios_seguidores` VALUES (8,2,1,'2018-07-08 21:42:43'),(12,3,2,'2018-07-10 18:29:25'),(11,3,1,'2018-07-10 18:29:05'),(13,2,3,'2018-07-10 18:49:25');
/*!40000 ALTER TABLE `usuarios_seguidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'twitter_clone_udemy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-10 18:55:20
