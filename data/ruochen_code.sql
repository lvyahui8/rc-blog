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
-- Table structure for table `code`
--

DROP TABLE IF EXISTS `code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL COMMENT '标题',
  `body` text NOT NULL COMMENT '代码内容',
  `lang` varchar(12) NOT NULL DEFAULT 'Java',
  `short` text NOT NULL COMMENT '说明',
  `view_ct` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `code`
--

LOCK TABLES `code` WRITE;
/*!40000 ALTER TABLE `code` DISABLE KEYS */;
INSERT INTO rc_code VALUES (1,'这是标题','class Tag extends BaseModel\r\n{\r\n    protected $table = \'tag\';\r\n    protected $timestamps = false;\r\n}','php','能不能保存呢',34,'2016-02-02 01:56:13','2016-04-08 03:50:39'),(2,'哈哈哈哈哈','.home{\r\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\r\n  background-size: cover ;\r\n}\r\n.page{\r\n  -webkit-background-size:cover;\r\n  background-size:cover;;\r\n}','css','LESS Demo',0,'2016-02-02 01:56:13','2016-02-25 05:12:41'),(3,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',20,'2016-02-19 04:48:16','2016-04-07 20:00:40'),(4,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',0,'2016-02-19 04:48:16','0000-00-00 00:00:00'),(5,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',34,'2016-02-19 04:48:21','2016-04-07 11:57:47'),(6,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',23,'2016-02-19 04:48:21','2016-04-06 06:34:53'),(7,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',18,'2016-02-19 04:48:23','2016-04-07 03:54:01'),(8,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',18,'2016-02-19 04:48:23','2016-04-03 23:59:11'),(9,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',20,'2016-02-19 04:48:24','2016-04-07 08:00:38'),(10,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',22,'2016-02-19 04:48:24','2016-05-15 10:12:21'),(11,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',21,'2016-02-19 04:48:25','2016-04-08 00:53:40'),(12,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',23,'2016-02-19 04:48:25','2016-04-10 09:59:45'),(13,'标题','class Tag extends BaseModel\n{\n    protected $table = \'tag\';\n    protected $timestamps = false;\n}','php','基类',20,'2016-02-19 04:48:27','2016-04-07 03:55:21'),(14,'标题','.home{\n  background: url(\"../images/top_bg.jpg\") no-repeat fixed;\n  background-size: cover ;\n}\n.page{\n  -webkit-background-size:cover;\n  background-size:cover;;\n}','css','LESS Demo',25,'2016-02-19 04:48:27','2016-04-07 03:54:11'),(15,'取配置项','$conf = include (\"zip_data.conf.php\");\r\n\r\nif(!defined(\'ZIP_DATA_CONF\')){\r\n    define(\'ZIP_DATA_CONF\',json_encode($conf));\r\n}\r\nfunction config($prop){\r\n    static $_conf = null;\r\n    if(!$_conf){\r\n        $_conf = json_decode(ZIP_DATA_CONF,true);\r\n    }\r\n    if(is_string($prop)){\r\n        if(!strpos($prop,\'.\')){\r\n            return $_conf[$prop];\r\n        }else{\r\n            $names = explode(\'.\',$prop);\r\n            $val = $_conf[$names[0]];\r\n            $num = count($names);\r\n            for($i = 1; $i < $num;$i ++){\r\n                $val = $val[$names[$i]];\r\n            }\r\n            return $val;\r\n        }\r\n    }else{\r\n        return null;\r\n    }\r\n}','php','多级取配置',18,'2016-03-16 10:55:15','2016-04-07 03:55:01'),(16,'CURL POST',' function getUrlContents($url, $param=null) {\r\n	//创建一个新的CURL资源\r\n	$ch = curl_init();\r\n	//设置将要请求的URL地址\r\n	curl_setopt($ch, CURLOPT_URL, $url);\r\n	//设置超时时间为5秒\r\n	curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);\r\n	//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出\r\n	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\r\n	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);\r\n	//执行这个CURL回话\r\n	$json = curl_exec($ch);\r\n	//关闭CURL资源，释放系统资源\r\n	curl_close($ch);\r\n	//返回文件流\r\n	return $json;\r\n}','php','curl post example',20,'2016-03-16 11:40:40','2016-04-13 15:38:10'),(17,'PHP按位遍历二进制文件','/**\r\n * Created by PhpStorm.\r\n * User: samlv\r\n * Date: 2016/3/30\r\n * Time: 20:44\r\n */\r\n$map = [];\r\n$file = __DIR__.\'/../report_file/nonSmallData\';\r\n$fp = fopen($file,\'r\');\r\nif($fp){\r\n    $bi = 12;\r\n    $bufSize = 1 << $bi;\r\n    for($n = 0;$bytes = fread($fp,$bufSize);$n++){\r\n        $length = strlen($bytes);\r\n        for($i = 0; $i < $length; $i++){\r\n            $byte = hexdec(bin2hex($bytes[$i]));\r\n            for($j = 0; $j < 8; $j++){\r\n                if($byte & (0x80 >> $j)){\r\n//                if($byte & (1 << $j)){    // 对每个字节反向读取\r\n                    $id = ($n << $bi) + ($i << 3) + $j;\r\n                    $map[$id] = isset($map[$id]) ? $map[$id] + 1 : 1;\r\n                }\r\n            }\r\n        }\r\n    }\r\n    fclose($fp);\r\n}\r\nprint_r($map);\r\necho \'count:\'.count($map).\"\\n\";','php','处理按位标识数据的二进制文件',19,'2016-03-31 03:00:00','2016-04-13 15:38:00');
/*!40000 ALTER TABLE `code` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-15 19:20:26
