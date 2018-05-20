-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: Jobster
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `Application`
--

DROP TABLE IF EXISTS `Application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Application` (
  `sid` int(11) NOT NULL,
  `jid` int(11) NOT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 - unreviewed\n1 - accept\n2 - reject\n3 - unreplied',
  `appTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sid`,`jid`),
  KEY `application_jid_idx` (`jid`),
  CONSTRAINT `application_jid` FOREIGN KEY (`jid`) REFERENCES `Job` (`jid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `application_sid` FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Application`
--

LOCK TABLES `Application` WRITE;
/*!40000 ALTER TABLE `Application` DISABLE KEYS */;
INSERT INTO `Application` VALUES (1,1,0,'2018-05-06 13:37:47'),(1,2,0,'2018-05-06 12:19:02'),(1,3,2,'2018-05-05 23:29:11'),(1,4,3,'2018-05-05 23:43:06'),(1,5,1,'2018-05-05 23:29:11'),(1,6,3,'2018-05-06 16:14:42'),(1,7,3,'2018-05-05 23:42:36'),(1,8,2,'2018-05-05 23:29:11'),(1,9,3,'2018-05-05 23:29:11'),(1,10,3,'2018-05-05 23:32:43'),(1,11,1,'2018-05-05 23:29:11'),(1,12,0,'2018-05-06 16:14:52'),(1,13,0,'2018-05-07 00:31:51'),(1,14,0,'2018-05-06 19:11:53'),(1,16,0,'2018-05-06 14:04:27'),(2,4,0,'2018-05-06 19:14:34'),(3,4,3,'2018-05-06 19:14:34'),(4,6,3,'2018-05-06 19:15:32'),(5,4,0,'2018-05-07 11:46:12'),(5,7,3,'2018-05-06 19:15:32'),(6,8,0,'2018-05-06 19:15:32'),(14,9,0,'2018-05-06 19:15:32'),(17,5,2,'2018-05-06 16:15:23');
/*!40000 ALTER TABLE `Application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Company`
--

DROP TABLE IF EXISTS `Company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Company` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(45) DEFAULT NULL,
  `pswd` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `magnitude` varchar(20) DEFAULT NULL,
  `cdesc` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Company`
--

LOCK TABLES `Company` WRITE;
/*!40000 ALTER TABLE `Company` DISABLE KEYS */;
INSERT INTO `Company` VALUES (1,'Google','Google','googlehr@google.com','3473307987','New York','Internet','8000','Since our founding in 1998, Google has grown by leaps and bounds. From offering search in a single language we now offer dozens of products and services'),(2,'Amazon','Amazon','amazonhr@amazon.com','3242787976','Seattle','Internet','9000','Amazon is guided by four principles: customer obsession rather than competitor focus, passion for invention, commitment to operational excellence, and long-term thinking. '),(3,'Facebook','Facebook','facebookhr@facebook.com','2897688976','Mello Park, CA','Internet','13000','Founded in 2004, Facebook’s mission is to give people the power to build community and bring the world closer together. People use Facebook to stay connected with friends and family, to discover what’s going on in the world, and to share and express what matters to them'),(4,'Walmart','Walmart','walmarthr@walmart.com','3478978867','San Bruno, California','Retail','3000','At Walmart, we help people save money so they can live better. This mission serves as the foundation for every decision we make, from responsible sourcing to sustainability'),(5,'Microsoft','Microsoft','microsofthr@microsoft.com','2787637787','Redmond, WA','Computer Software','15000','At Microsoft, our mission is to empower every person and every organization on the planet to achieve more. Our mission is grounded in both the world in which we live and the future we strive to create.'),(6,'Huawei','Huawei','huaweihr@huawei.com','15800712401','343 gold street','mobile','10000','At Huawei, we define human progress by innovations that enrich humanity. We do not view connectivity as a privilege, but a necessity. We believe that the impact of information and communications technology should be measured by how many people can benefit from it'),(7,'Didi','Didi','didihr@didi.com','2333332234','Haidian,Beijing','Internet','43680','Didi Chuxing is the world’s leading mobile transportation platform. The company offers a full range of mobile tech-based mobility options for over 450 million users, including Taxi, Express, Premier, Luxe, Hitch, Bus, Minibus, Designated Driving, Car Rental, Enterprise Solutions and Bike-Sharing'),(8,'test','test','testc@nyu.edu','','','','',NULL);
/*!40000 ALTER TABLE `Company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CompanyPost`
--

DROP TABLE IF EXISTS `CompanyPost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CompanyPost` (
  `cid` int(11) NOT NULL,
  `postTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`,`postTime`),
  CONSTRAINT `cpost_cid` FOREIGN KEY (`cid`) REFERENCES `Company` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CompanyPost`
--

LOCK TABLES `CompanyPost` WRITE;
/*!40000 ALTER TABLE `CompanyPost` DISABLE KEYS */;
INSERT INTO `CompanyPost` VALUES (1,'2018-05-07 01:56:48','I\'m Google'),(2,'2018-05-07 01:57:45','I\'m Amazon'),(3,'2018-05-07 01:57:45','I\'m Facebook'),(4,'2018-05-07 01:57:45','I\'m Walmart'),(5,'2018-05-07 01:57:45','I\'m Microsoft'),(6,'2018-05-07 00:15:18','huawei'),(6,'2018-05-07 00:16:55','My company is so good!'),(6,'2018-05-07 00:17:26','project finished hahahahahahah'),(6,'2018-05-07 00:36:08','hi'),(6,'2018-05-07 13:54:51','I\'m a good company~~'),(7,'2018-05-07 01:58:07','I\'m Didi');
/*!40000 ALTER TABLE `CompanyPost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Follow`
--

DROP TABLE IF EXISTS `Follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Follow` (
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `followTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sid`,`cid`),
  KEY `follow_cid_idx` (`cid`),
  CONSTRAINT `follow_cid` FOREIGN KEY (`cid`) REFERENCES `Company` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `follow_sid` FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Follow`
--

LOCK TABLES `Follow` WRITE;
/*!40000 ALTER TABLE `Follow` DISABLE KEYS */;
INSERT INTO `Follow` VALUES (1,1,'2018-05-06 13:02:45'),(1,2,'2018-05-06 13:03:29'),(1,3,'2018-05-06 13:20:26'),(1,4,'2018-05-07 00:33:18'),(6,5,'2017-04-15 00:00:00');
/*!40000 ALTER TABLE `Follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Job`
--

DROP TABLE IF EXISTS `Job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Job` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `salary` varchar(20) DEFAULT NULL,
  `requirement` varchar(1000) DEFAULT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `postTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`jid`),
  KEY `job_cid_idx` (`cid`),
  CONSTRAINT `job_cid` FOREIGN KEY (`cid`) REFERENCES `Company` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Job`
--

LOCK TABLES `Job` WRITE;
/*!40000 ALTER TABLE `Job` DISABLE KEYS */;
INSERT INTO `Job` VALUES (1,5,'New York City, NY, US','Data & Applied Scientist','11','MS in CS','Assisting in statistical debugging, core algorithm implementation and automated offline experimentation.\nData wrangling and framing aspects of new applications of the decision service.\nDrive end-to-end projects by utilizing, applying and analyzing data associated business problems.','2018-04-14 00:00:00','2018-02-14 00:00:00'),(2,2,'Cambridge, MA, US','Software Developer','15','MS in CS','Participate in the development and maintenance of key Machine Learning systems and infrastructure for NLU in Alexa; deliver high quality software against aggressive schedules\nActively participate in defining strategy, roadmaps and architecture for the team’s products\nWork with other team members to investigate best design approaches, prototype new technology and evaluate technical feasibility\nMentor and help develop junior engineers, and demonstrate best development practices','2018-05-19 00:00:00','2018-04-14 00:00:00'),(3,5,'New York City, NY, US','Post Doc Researcher','7','MS in CS','The postdoctoral researcher will define and lead research directions. S/he will contribute to the machine learning research community by publishing papers, securing patents, collaborating with leading academic institutions, and speaking and participating at international conferences.','2018-05-19 00:00:00','2018-05-19 00:00:00'),(4,6,'Greater New York City Area','Staff Engineer - Machine Learning','6','PhD in CS,EE,Stat','Identify key opportunities to apply modern machine learning in Huawei business such as mobile network planning and optimization; initiate new high-impact projects','2018-10-19 00:00:00','2018-05-19 00:00:00'),(5,6,'Istanbul, Turkey','New Graduate Software Engineer','5','MS in CS','Carry out research and development projects, including key solution and algorithm design and verification','2018-09-01 00:00:00','2018-07-29 00:00:00'),(6,6,'Newark, New Jersey','PV Solar Inverter Sales Executive','10','MS in CS','Candidates will take role in one of the various Software Development Projects in Telecommunication sector.','2018-05-19 00:00:00','2018-06-19 00:00:00'),(7,6,'Bonn, North Rhine-Westphalia, Germany','Cloud Solution Architect','13','MS in CS','Carry out research and development projects, including key solution and algorithm design and verification','2018-07-19 00:00:00','2018-05-19 00:00:00'),(8,6,'Dubai, United Arab Emirates','Senior UI Developer','11','MS in CS','System installation: Participate projects in the video and media domain, including the requirement analysis, network design, system installation, technical document and other documents;','2018-05-29 00:00:00','2018-06-19 00:00:00'),(9,6,'Paris Area, France','Senior HRBP Huawei France R&D Center','11','MS in CS','Partner with Hiring Managers to support the hiring demand of the organization as well as with HQ (China) regarding staffing activities','2019-05-19 00:00:00','2018-05-19 00:00:00'),(10,6,'Greater Seattle Area','Chief Data scientist for R&D','9','MS in EE','Monitor technology and industrial trends; propose technology strategy and roadmap to support the decision making of executives','2018-05-19 00:00:00','2018-05-19 00:00:00'),(11,6,'Markham, Ontario, Canada','Software Engineer ','7','MS in CS','Carry out research and development projects, including key solution and algorithm design and verification','2019-01-19 00:00:00','2018-05-19 00:00:00'),(12,3,'New York City, NY, US','PhD Recruiting, Intern Recruite','11','PhD in Recruiting ','The ideal candidate will have technical recruiting experience with PhD students in a high-volume environment. We\'re looking for a patient, communicative, team player that is detail-oriented and has outstanding interpersonal skills.','2019-01-19 00:00:00','2018-05-06 13:57:50'),(13,3,'New York City, NY, US','Marketing Science Research','15','PhD in Stats','Apply your expertise in quantitative analysis, data mining, and the presentation of data to measure and communicate the effectiveness of online advertising','2019-01-19 00:00:00','2018-05-06 13:59:00'),(14,1,'New York City, NY, US','Front End Software Engineer','11','BS in CS','Experience with one or more general purpose programming languages including but not limited to: Java, C/C++, C#, Objective C, Python, JavaScript, or Go','2019-01-19 00:00:00','2018-05-06 14:00:32'),(15,4,'Bentonville, AR, US','Programmer Analyst','11','CS in IT','Designing, developing, testing, and implementing robust technology solutions using ABAP, configuring SAP FICO application at scale for Walmart’s financial systems','2019-01-19 00:00:00','2018-05-06 14:02:11'),(16,7,'Mountain View, California, US','Senior Software Engineer','8','BS in CS','Collaborate with HQ to deliver systems and products that improve the experience of DiDi’s global customer base','2019-05-19 00:00:00','2018-05-06 14:04:10'),(27,6,'test alert of huawei','test alert of huawei','1','test alert of huawei','test alert of huawei','2018-05-03 00:00:00','2018-05-07 01:54:29'),(29,1,'Mountain View, CA, US','Kernel/OS Software Engineer','12','MS in CE','Experience writing code targeting bare metal or for a Real-Time Operating System (RTOS)','2018-05-31 00:00:00','2018-05-07 12:29:11');
/*!40000 ALTER TABLE `Job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(16) DEFAULT NULL,
  `pswd` varchar(32) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `interest` varchar(100) DEFAULT NULL,
  `resumeFile` blob,
  `resumeText` varchar(5000) DEFAULT NULL,
  `university` varchar(45) DEFAULT NULL,
  `qualification` varchar(20) DEFAULT NULL COMMENT 'MS, BS, etc',
  `major` varchar(50) DEFAULT NULL,
  `gpa` varchar(10) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `seenbyall` int(10) DEFAULT '1' COMMENT '1 all can see; 0 only friends and applied companies',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES (1,'Shangwen Yan','sy2160','sy2160@nyu.edu','3473207075',NULL,NULL,'Machine Learning Related Labs (Python3, JupyterNotebook, Tensorflow, Keras, PyTorch) 09/2017-Present','New York University','MS','CE','3.8','2017-09-01','2019-05-01',0),(2,'Ruochen Fang','ruochen','ruochen@gmail.com','3252399898',NULL,NULL,'ACADEMIC PROJECTS\nSpotify Music Streaming Website with PHP 11/2017-12/2017\n\n  Constructed a personal music library database systems and utilized Spotify API to access data\n\nfrom its web service for music streaming and information about music.\n\n  Established a music website, realizing original functions like searching music, liking\n\nsingers and following users, creating playlists, and rating music by my origin code.\nRoad Fuel Consumption Visualization System with PHP 01/2016-11/2016','Carnegie Mellon University','MS','SE','3.51','2018-01-01','2019-05-01',1),(3,'Xinyu Ma','xm546','xm546@nyu.edu','3253773345',NULL,NULL,'Online Cooperative Teaching System with Java 07/2016\n - Applied Agile and Lean mixed method to implement an online cooperative teaching system, with functions including resources uploading/downloading, discussion, etc.\n - Acted as scrum master in charge of user case analysis, team coordination, scrum conduction and developer building frame and database, testing product,database systems etc.','New York University','MS','CE','3.7','2017-09-01','2019-05-01',1),(4,'Linya Gong','lg2740','lg2740@nyu.edu','3209847899',NULL,NULL,'E-Commerce Platform “JingTao” (Java, JavaScript, HTML, MySQL, Redis)                          01/2017-03/2017 •	Developed backend logic with SSM framework(Spring, SpringMVC, MyBatis) in JAVA to access database and return processed data to the front page •	Deployed wars on Linux, implemented load balance and high availability through Nginx in roll polling •	Implemented cross-domain access through HttpClient and JSONP •	Improved SSO(Single Sign On) function with user’s ticked stored on Redis •	Self-learnt jQuery, zTree, AJAX, EasyUI skills to better fit the data format in frontend','Nankai University','BS','EE','3.1','2016-09-01','2018-05-01',0),(5,'Runqi Du','rd233','rd233@nyu.edu','2372342390',NULL,NULL,'Impact Investment Index Business Analysis 02/2017\n• Defined the function and variables, used datasets from 50 different companies as data source.\n• Created a scoring method to evaluate Impact Investments and companies in terms of the variables.\n• Used central tendency method to assign the weight of variables.\n• Data visualization and analysis, applied index into business uses.\n\n','Tianjing University','BS','MOT','2.9','2016-09-01','2018-05-01',0),(6,'Yan Li','yl4752','yl4752@nyu.edu','3283783378',NULL,NULL,'Collection & Analysis of Web Traffic Data (Hadoop, Flume, Kafka, Hive, MySQL，database systems)                         04/2017-05/2017\n•	Used JavaScript to make a request to log server after gathering website’s traffic data, such as pv, uv, vv, br\n•	Log4jAppender function in log server transmitted the data to Flume  cluster (in avro form)\n•	Off-line data were saved in HDFS, processed in MR, Hive and stored in MySQL through Sqoop\n•	Real-time data was transmitted to Kafka and calculated in Storm to realize monitor and alert function','New York University','MS','CE','4','2017-09-01','2019-05-01',1),(14,'Xidan Xu','xx777','xx777@nyu.edu','2333332234','Computer Science Realated','','Impact Investment Index Business Analysis 02/2017 • Defined the function and variables, used datasets from 50 different companies as data source. • Created a scoring method to evaluate Impact Investments and companies in terms of the variables. • Used central tendency method to assign the weight of variables. • Data visualization and analysis, applied index into business uses.  ','New York University','PHD','CS','4','2017-09-01','2019-05-01',0),(16,'Shu Zhong','sz777','sz777@nyu.edu','1237867876',NULL,NULL,'E-Commerce Platform “JingTao” (Java, JavaScript, CSS, HTML, MySQL, Redis)                          01/2017-03/2017 •	Developed backend logic with SSM framework(Spring, SpringMVC, MyBatis) in JAVA to access database and return processed data to the front page •	Deployed wars on Linux, implemented load balance and high availability through Nginx in roll polling •	Implemented cross-domain access through HttpClient and JSONP •	Improved SSO(Single Sign On) function with user’s ticked stored on Redis •	Self-learnt jQuery, zTree, AJAX, EasyUI skills to better fit the data format in frontend','New York University','MS','CS','3.2','2017-09-01','2019-05-01',1),(17,'Yunfei Teng','yt777','yt777@nyu.edu','3463278976',NULL,NULL,'Machine Learning Related Labs (Python3, JupyterNotebook, Tensorflow, Keras, PyTorch) 09/2017-Present • LabsincludingbutnotlimitedtoK-Means,GD,CNN,SVMs,LASSO,PCA,Back-Propagation,etc • Packagesinvolved:sklearn,torch,pandas,scipy,numpy,matplotlib,etc • Projectwillbekeptupdatingonhttps://github.com/Yunfei-Teng/Machine-Learning Analysis of Browsing Data from Telecom Users (NIO, ZooKeeper, Hadoop, Spark, ECharts) 06/2017 • Processeddatatoanalyzeuser’sfavorateapp,website,timeonlineandplacesthatsurfmostfrequently • Distributed design: one jobtracker converted data into object and distribute file split to next stage, two first- stage engines calculated data, one second stage engine merged and stored data to MySQL database • VisualizeddatatoformconciseandelegentstatisticalgraphwithECharts • AlsohaveastandaloneversionusingSparkRDDtoimplementthesamefunction','Tongji University','PHD','EE','4','2016-09-01','2018-05-01',0);
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StudentPost`
--

DROP TABLE IF EXISTS `StudentPost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StudentPost` (
  `sid` int(11) NOT NULL,
  `postTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`sid`,`postTime`),
  CONSTRAINT `spost_sid` FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentPost`
--

LOCK TABLES `StudentPost` WRITE;
/*!40000 ALTER TABLE `StudentPost` DISABLE KEYS */;
INSERT INTO `StudentPost` VALUES (1,'2017-12-12 00:00:00','heiheihei'),(1,'2018-05-06 14:48:47','today is so cold!'),(1,'2018-05-06 14:49:03','I hate final =-='),(1,'2018-05-06 14:49:25','I\'m frozen :)'),(1,'2018-05-06 14:49:47','I wanna wear dress.....T T'),(1,'2018-05-06 14:50:26','Come back home soon!!Yeah~~'),(1,'2018-05-06 16:05:39','project half done ^_^'),(1,'2018-05-07 13:52:01','demo presentation tomorrow ^_^'),(2,'2018-05-07 11:37:45','Hi, I\'m ruochen'),(3,'2018-05-07 11:38:12','I\'m xinyu, nice to meet u.'),(4,'2018-05-07 11:42:58','Hard to find a job T T...'),(5,'2018-05-07 11:42:58','I have got a good job from jobster ^.^'),(14,'2018-05-06 16:15:51','I\'m xidan, pls call me dandan.');
/*!40000 ALTER TABLE `StudentPost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobalert`
--

DROP TABLE IF EXISTS `jobalert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobalert` (
  `sid` int(11) NOT NULL,
  `jid` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0 - follow \n1 -friend forward \n2 -company notification',
  `addTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender` varchar(45) DEFAULT NULL,
  `sendid` int(11) NOT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 unread 1 read',
  PRIMARY KEY (`sid`,`jid`,`addTime`,`sendid`),
  KEY `jobalert_jid_idx` (`jid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobalert`
--

LOCK TABLES `jobalert` WRITE;
/*!40000 ALTER TABLE `jobalert` DISABLE KEYS */;
INSERT INTO `jobalert` VALUES (1,1,0,'2018-04-25 20:01:00','Microsoft',5,0),(1,2,1,'2018-04-26 02:17:37','Xinyu Ma',3,0),(1,4,2,'2018-04-26 01:58:05','Huawei',6,1),(1,4,2,'2018-05-06 19:55:31','Huawei',6,1),(1,6,1,'2018-05-05 19:22:55','Ruochen Fang',2,1),(1,6,2,'2018-05-06 20:35:56','',6,1),(1,7,1,'2018-05-05 19:22:55','Ruochen Fang',2,0),(1,7,2,'2018-05-07 03:16:21','',6,1),(1,10,2,'2018-05-07 03:27:09','Huawei',6,1),(1,15,1,'2018-05-07 03:13:26','Xidan Xu',14,0),(1,27,0,'2018-05-07 01:54:29','Huawei',6,0),(1,29,0,'2018-05-07 12:29:11','Google',1,0),(2,1,0,'2018-04-25 20:01:00','1',5,0),(2,1,0,'2018-04-25 20:02:11','1',5,0),(2,2,1,'2018-04-26 02:17:36','1',13,0),(2,2,1,'2018-05-07 03:11:07','Shangwen Yan',1,0),(3,4,2,'2018-04-26 01:58:05','huawei',6,0),(3,4,2,'2018-04-26 02:13:32','huawei',6,0),(4,14,1,'2018-05-07 13:47:46','Shangwen Yan',1,1),(5,2,1,'2018-04-26 02:17:35','1',13,0),(5,4,1,'2018-05-07 11:45:34','Shangwen Yan',1,1),(6,1,0,'2018-04-25 20:01:00','1',5,0),(6,1,0,'2018-04-25 20:02:11','1',5,0);
/*!40000 ALTER TABLE `jobalert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `sid1` int(11) NOT NULL,
  `sid2` int(11) NOT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `msgTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '0 unread 1 read',
  PRIMARY KEY (`sid1`,`sid2`,`msgTime`),
  KEY `message_sid2_idx` (`sid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,2,'hahaha','2018-04-04 00:00:00',1),(1,2,'i love u','2018-05-05 17:33:48',0),(1,2,'hi','2018-05-06 02:00:37',0),(1,2,'how are you today?','2018-05-06 11:46:08',0),(1,2,'hi','2018-05-06 13:51:09',0),(1,2,'miao?','2018-05-06 13:51:19',0),(1,3,'not yet','2018-05-05 17:55:04',0),(1,3,'ok','2018-05-07 00:32:19',0),(1,4,'Do you know Linong Chen?','2018-05-06 12:02:20',1),(1,4,'are you here?','2018-05-06 15:58:14',1),(1,4,'How are u today?','2018-05-07 13:47:11',1),(1,5,'Have you paid the rent?','2018-05-06 12:15:24',0),(1,5,'maybe you should do it now','2018-05-06 12:36:23',0),(1,6,'not good =-=','2018-05-05 18:45:50',0),(1,6,'Let me die ...','2018-05-06 02:01:38',0),(1,6,'how are u today?','2018-05-06 11:48:09',0),(1,16,'send  me your code?','2018-05-05 17:55:57',0),(1,16,'sure','2018-05-05 22:21:54',0),(1,17,'of course not','2018-05-05 16:52:28',0),(1,17,'yes!!','2018-05-05 17:44:50',0),(1,17,'hi','2018-05-07 02:00:54',0),(2,1,'hi xzz','2018-04-05 00:00:01',1),(2,1,'loveuu','2018-05-05 14:36:14',1),(3,1,'have lunch together?','2018-05-05 12:29:47',1),(3,1,'paid the rent?','2018-05-05 14:36:14',1),(3,1,'ASAP','2018-05-05 22:21:05',1),(4,1,'Thanks for your forwarding','2018-05-07 13:49:04',1),(5,1,'not yet','2018-05-06 12:35:20',0),(6,1,'how is project?','2018-05-05 12:29:07',0),(16,1,'my scala doesn\'t compile','2018-05-05 12:29:47',0),(16,1,'wait a moment','2018-05-05 22:20:37',0),(17,1,'finish ml hw4?','2018-05-05 14:36:14',0),(17,1,'need help?','2018-05-05 16:52:45',0);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationrequest`
--

DROP TABLE IF EXISTS `relationrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationrequest` (
  `sid1` int(11) NOT NULL,
  `sid2` int(11) NOT NULL,
  `requestTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '0 unread 1 read',
  `msg` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sid1`,`sid2`,`requestTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationrequest`
--

LOCK TABLES `relationrequest` WRITE;
/*!40000 ALTER TABLE `relationrequest` DISABLE KEYS */;
INSERT INTO `relationrequest` VALUES (1,2,'2018-05-07 04:16:15',0,'ff'),(1,5,'2018-05-07 11:43:48',1,'hi runqi, may be be friends?'),(1,14,'2018-05-07 04:04:05',1,'xxx'),(1,14,'2018-05-07 04:19:21',1,'may we be friends,xx?'),(1,16,'2018-05-07 13:50:37',0,'may we be friends?'),(3,1,'2018-04-25 02:52:28',1,'your roomate'),(4,1,'2018-05-06 12:00:05',1,'I\'m handsome'),(5,13,'2018-03-12 00:00:00',1,NULL),(14,1,'2018-05-06 12:00:05',0,'HELP ME!!'),(16,1,'2018-04-25 02:02:58',0,'take big data together'),(17,1,'2018-04-25 02:02:00',0,'hhhh');
/*!40000 ALTER TABLE `relationrequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationship`
--

DROP TABLE IF EXISTS `relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationship` (
  `sid1` int(11) NOT NULL COMMENT 'from',
  `sid2` int(11) NOT NULL COMMENT 'to',
  `hide` int(10) unsigned DEFAULT '0' COMMENT '0 not hide; 1 hide',
  PRIMARY KEY (`sid1`,`sid2`),
  KEY `relation_sid2_idx` (`sid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationship`
--

LOCK TABLES `relationship` WRITE;
/*!40000 ALTER TABLE `relationship` DISABLE KEYS */;
INSERT INTO `relationship` VALUES (1,4,0),(1,5,0),(4,1,0),(5,1,1);
/*!40000 ALTER TABLE `relationship` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-07 21:57:39
