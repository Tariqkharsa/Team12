CREATE DATABASE  IF NOT EXISTS `FinalTeam12` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `FinalTeam12`;
-- MySQL dump 10.13  Distrib 8.0.28, for macos11 (x86_64)
--
-- Host: team12.copftkcel1k2.us-east-1.rds.amazonaws.com    Database: FinalTeam12
-- ------------------------------------------------------
-- Server version	8.0.27

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `ACCESS`
--

DROP TABLE IF EXISTS `ACCESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ACCESS` (
  `ACID` int NOT NULL,
  `ACEN` varchar(50) NOT NULL,
  KEY `ACID` (`ACID`),
  KEY `ACEN` (`ACEN`),
  CONSTRAINT `ACCESS_ibfk_1` FOREIGN KEY (`ACID`) REFERENCES `CUSTOMERS` (`CID`),
  CONSTRAINT `ACCESS_ibfk_2` FOREIGN KEY (`ACEN`) REFERENCES `Exhibition` (`exName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACCESS`
--

LOCK TABLES `ACCESS` WRITE;
/*!40000 ALTER TABLE `ACCESS` DISABLE KEYS */;
INSERT INTO `ACCESS` VALUES (1,'Summer Art Pieces');
/*!40000 ALTER TABLE `ACCESS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ARTPIECES`
--

DROP TABLE IF EXISTS `ARTPIECES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ARTPIECES` (
  `AID` char(6) NOT NULL,
  `ANAME` varchar(100) NOT NULL,
  `ARTIST` varchar(50) DEFAULT NULL,
  `DEPTNAME` enum('PAINTING','SCULPTURE','FILM','ARCHITECTURE') NOT NULL,
  `ARTINFO` varchar(1500) DEFAULT NULL,
  `INDATE` date NOT NULL,
  `OUTDATE` date DEFAULT NULL,
  `dID` int NOT NULL,
  PRIMARY KEY (`AID`),
  KEY `dID` (`dID`),
  CONSTRAINT `ARTPIECES_ibfk_1` FOREIGN KEY (`dID`) REFERENCES `Departments` (`Dep_Num`),
  CONSTRAINT `INVALD_INSTALL_DATE` CHECK (((`INDATE` > _utf8mb4'2001-01-01') and (`INDATE` <= sysdate()))),
  CONSTRAINT `INVALD_REMOVE_DATE` CHECK (((`OUTDATE` > _utf8mb4'2001-01-01') and (`OUTDATE` >= `INDATE`)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ARTPIECES`
--

LOCK TABLES `ARTPIECES` WRITE;
/*!40000 ALTER TABLE `ARTPIECES` DISABLE KEYS */;
INSERT INTO `ARTPIECES` VALUES ('198762','DAVID','MICHEANGELO','SCULPTURE','a','2022-01-08','2022-01-08',1);
/*!40000 ALTER TABLE `ARTPIECES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CUSTOMERS`
--

DROP TABLE IF EXISTS `CUSTOMERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUSTOMERS` (
  `FirstName` char(50) DEFAULT NULL,
  `LastName` char(50) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `PhoneNumber` bigint DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `CID` int NOT NULL,
  `SpecialStatus` enum('CollegeStudent','Veteran','Senior','Child','None') NOT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMERS`
--

LOCK TABLES `CUSTOMERS` WRITE;
/*!40000 ALTER TABLE `CUSTOMERS` DISABLE KEYS */;
INSERT INTO `CUSTOMERS` VALUES ('Dorian','Nozales',23,8325671234,'myemail@yahoo.com',1,'CollegeStudent'),('Erika','Ubuya',5,NULL,NULL,2,'Child'),('Elijah','Tottenham',69,6347895003,NULL,3,'Senior'),('Zachary','Sams',36,3484700098,NULL,4,'None');
/*!40000 ALTER TABLE `CUSTOMERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Departments`
--

DROP TABLE IF EXISTS `Departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Departments` (
  `Dep_Num` int NOT NULL,
  `Dep_Name` varchar(30) NOT NULL,
  `Dep_Mus` varchar(65) NOT NULL,
  PRIMARY KEY (`Dep_Num`),
  KEY `Dep_Mus` (`Dep_Mus`),
  CONSTRAINT `Departments_ibfk_1` FOREIGN KEY (`Dep_Mus`) REFERENCES `Museum` (`mName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Departments`
--

LOCK TABLES `Departments` WRITE;
/*!40000 ALTER TABLE `Departments` DISABLE KEYS */;
INSERT INTO `Departments` VALUES (1,'S','Houston Museum of Fine Arts');
/*!40000 ALTER TABLE `Departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EMPLOYEES`
--

DROP TABLE IF EXISTS `EMPLOYEES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EMPLOYEES` (
  `EMPLOYEE_ID` int NOT NULL,
  `JOBTITLE` varchar(100) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `AGE` varchar(3) NOT NULL,
  `SEX` enum('M','F','Other') DEFAULT NULL,
  `PHONE_NUMBER` char(10) NOT NULL,
  `EMPLOYEE_ADDRESS` varchar(200) NOT NULL,
  `SALARY` decimal(9,2) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `dNUM` int NOT NULL,
  PRIMARY KEY (`EMPLOYEE_ID`),
  KEY `dNUM` (`dNUM`),
  CONSTRAINT `EMPLOYEES_ibfk_1` FOREIGN KEY (`dNUM`) REFERENCES `Departments` (`Dep_Num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EMPLOYEES`
--

LOCK TABLES `EMPLOYEES` WRITE;
/*!40000 ALTER TABLE `EMPLOYEES` DISABLE KEYS */;
INSERT INTO `EMPLOYEES` VALUES (1,'Janitor','Harold','Hart','21','M','8328459284','440 North St Houston, TX',40000.00,'2000-08-12',1),(2,'Tour Guide','Arnold','Mart','22','M','2817463838','100 Stone Blvd Bellaire, TX',60000.00,'2000-08-13',1);
/*!40000 ALTER TABLE `EMPLOYEES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Exhibition`
--

DROP TABLE IF EXISTS `Exhibition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Exhibition` (
  `EXID` int NOT NULL,
  `exName` varchar(50) NOT NULL,
  `COST` double(4,2) NOT NULL,
  `sDate` date NOT NULL,
  `eDate` date NOT NULL,
  PRIMARY KEY (`exName`),
  CONSTRAINT `INVALID_INSTALL_DATE` CHECK (((`sDate` > _utf8mb4'2001-01-01') and (`sDate` <= sysdate()))),
  CONSTRAINT `INVALID_REMOVE_DATE` CHECK (((`eDate` > _utf8mb4'2001-01-01') and (`eDate` >= `sDate`)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

alter table Exhibition 

drop column EXID,
add column cover_url varchar(200) not null;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Exhibition`
--

LOCK TABLES `Exhibition` WRITE;
/*!40000 ALTER TABLE `Exhibition` DISABLE KEYS */;
INSERT INTO `Exhibition` VALUES (1,'Summer Art Pieces',10.50,'2021-06-09','2022-07-09');
/*!40000 ALTER TABLE `Exhibition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GiftShop`
--

DROP TABLE IF EXISTS `GiftShop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `GiftShop` (
    'GiftID'		INT(10) NOT NULL AUTO_INCREMENT,
    'quantity'    INT(10) NOT NULL,
    'GiftName'	VARCHAR(30) NOT NULL,
    'Price'		DOUBLE(16,2) NOT NULL,
    'SpecialStatus'	ENUM('Sold', 'In Stock'),
    Primary Key (GiftID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GiftShop`
--

LOCK TABLES `GiftShop` WRITE;
/*!40000 ALTER TABLE `GiftShop` DISABLE KEYS */;
INSERT INTO `GiftShop` VALUES (1,'a',10.25,'Sold'),(2,'b',1.99,'In Stock'),(3,'c',8.99,'Sold'),(4,'d',4.00,'Sold');
/*!40000 ALTER TABLE `GiftShop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Museum`
--

DROP TABLE IF EXISTS `Museum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Museum` (
  `mName` varchar(65) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Province` varchar(20) NOT NULL,
  `ZipCode` varchar(5) NOT NULL,
  `sTime` time NOT NULL,
  `eTime` time NOT NULL,
  `Ratings` decimal(2,1) DEFAULT NULL,
  PRIMARY KEY (`mName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Museum`
--

LOCK TABLES `Museum` WRITE;
/*!40000 ALTER TABLE `Museum` DISABLE KEYS */;
INSERT INTO `Museum` VALUES ('Houston Museum of Fine Arts','1001 Bissonnet St','Houston','TX','77005','09:00:00','18:00:00',4.9);
/*!40000 ALTER TABLE `Museum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TICKET`
--

DROP TABLE IF EXISTS `TICKET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TICKET` (
  `TID` char(10) NOT NULL,
  `TTYPES` enum('CHILD','SENIOR','REGULAR','VETERAN','STUDENT') NOT NULL,
  `PRICE` decimal(8,2) NOT NULL,
  `SOLDDATE` date DEFAULT NULL,
  `CUSID` int NOT NULL,
  PRIMARY KEY (`TID`),
  KEY `CUSID` (`CUSID`),
  CONSTRAINT `TICKET_ibfk_1` FOREIGN KEY (`CUSID`) REFERENCES `CUSTOMERS` (`CID`),
  CONSTRAINT `INVALID_SOLDDATE` CHECK (((`SOLDDATE` >= _utf8mb4'2001-01-01') and (`SOLDDATE` <= sysdate())))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TICKET`
--

LOCK TABLES `TICKET` WRITE;
/*!40000 ALTER TABLE `TICKET` DISABLE KEYS */;
INSERT INTO `TICKET` VALUES ('123456780','CHILD',12.99,'2020-09-09',1);
/*!40000 ALTER TABLE `TICKET` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-11 20:47:51
