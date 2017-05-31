-- MySQL dump 10.16  Distrib 10.1.9-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: ruochen
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB

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
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=495 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO rc_tag VALUES (402,'dedecms'),(403,'html'),(404,'css'),(405,'javascript'),(406,'jquery'),(407,'html5'),(408,'css3'),(409,'prompt'),(410,'chms'),(411,'前端'),(412,'git'),(413,'github'),(414,'开源项目'),(415,'Genymotion'),(416,'android'),(417,'安卓'),(418,'VBox'),(419,'思维导图'),(420,'Xmind'),(421,'impress'),(422,'prezi'),(423,'skitter'),(424,'slider'),(425,'jqueryzoom'),(426,'放大镜'),(427,'绝对定位'),(428,'折叠菜单'),(429,'多彩Tag'),(430,'AngularJS'),(431,'javascript面向对象'),(432,'文法'),(433,'算法'),(434,'左递归'),(435,'C语言'),(436,'FIRSTVT集'),(437,'python'),(438,'java'),(439,'规范族集'),(440,'ACTION表'),(441,'GOTO表'),(442,'rpm'),(443,'gcc'),(444,'fedora'),(445,'linux'),(446,'yii'),(447,'php'),(448,'ajax分页'),(449,'yii多条件多表查询'),(450,'accessRules'),(451,'校验'),(452,'validate'),(453,'progress'),(454,'ajax'),(455,'进度条'),(456,'xhr2'),(457,'ssh'),(458,'文件上传'),(459,'异步上传'),(460,'1505'),(461,'acm'),(462,'c'),(463,'c++'),(464,'数据结构'),(465,'文件推送'),(466,'sftp'),(467,'laravel'),(468,'word生成'),(469,'zip打包'),(470,'javase'),(471,'javaio'),(472,'队列'),(473,'耗时任务'),(474,'守护进程'),(475,'rpc'),(476,'静态库'),(477,'动态库'),(478,'makefile'),(479,'unix'),(480,'gdb'),(481,'linuxc'),(482,'调试'),(483,'Thrift'),(484,'远程调用'),(485,'表格内联编辑'),(486,'RMI'),(487,'分布式'),(488,'ActiveMQ'),(489,'消息中间件'),(490,'消息引擎'),(491,'phantomjs'),(492,'highchart'),(493,'CRUD'),(494,'SximoBuilder');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-31 22:05:09
