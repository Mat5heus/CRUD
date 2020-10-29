-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: CRUD
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `CRUD`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `CRUD` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `CRUD`;

--
-- Table structure for table `carro`
--

DROP TABLE IF EXISTS `carro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(7) NOT NULL,
  `estacionado` enum('true','false') NOT NULL,
  `checkin` varchar(18) NOT NULL,
  `checkout` varchar(18) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `carro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carro`
--

LOCK TABLES `carro` WRITE;
/*!40000 ALTER TABLE `carro` DISABLE KEYS */;
INSERT INTO `carro` VALUES (1,'slfk342','true','14/07/2020 17:30','14/07/2020 15:25',1),(2,'hdk0394','false','','',2),(3,'lfj8493','true','14/07/2020 17:30','14/07/2020 15:25',4);
/*!40000 ALTER TABLE `carro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compania`
--

DROP TABLE IF EXISTS `compania`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compania` (
  `id_compania` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `nome_fantasia` varchar(30) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_compania`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compania`
--

LOCK TABLES `compania` WRITE;
/*!40000 ALTER TABLE `compania` DISABLE KEYS */;
INSERT INTO `compania` VALUES (1,'Joia Calcados','Joia confeccoes','04893000/4876',1),(2,'Panetone e Cia','Panetones Bauducco','04893000/4887',2),(3,'Livaria SA','Amazon','9739284/9348',4);
/*!40000 ALTER TABLE `compania` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(20) NOT NULL DEFAULT 'Brasil',
  `estado` varchar(3) NOT NULL DEFAULT 'SP',
  `cidade` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `pk_compania` int(11) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `pk_compania` (`pk_compania`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`pk_compania`) REFERENCES `compania` (`id_compania`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'Brasil','SP','Araras','Pq tiradentes','Pedras preciosas','234',1),(2,'Brasil','SP','São paulo','Vila mariano','Arnaldo quarto','7382',2),(3,'EUA','DC','Washington','Broklyn ','Avenue street, Portland street','7383',3);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `CPF` varchar(13) NOT NULL,
  `CNH` varchar(13) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `tipo_usuario` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'joao.zinho@gmail.com','$2y$12$h2Py554.frsck.r/QtHhh.3.WCxLYueO2.eXCGh8AGNt3X2QYPVHS','Tiago','793872384','53954890','7928374900','admin'),(2,'atendimento@bauducco.com','$2y$12$7672AiIiZJWV8FXGTn.VJeSdoPJqfZNatgUjQbtV0khLtxEfGfLtu','Caio','8372948734','93028409893','19973848798','user'),(4,'jeff.bezos@amazon.com','$2y$12$Da84C5UrMwizpCjDNqt1/uFf0yvPQo/2/GIJkQP.q.x2Lh6pmf4ea','Jeff bezos','7468379783','78457979845','19993487943','admin');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-29 19:57:23
