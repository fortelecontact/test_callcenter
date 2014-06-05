<?php
require_once('enigne/init.php');
$query="SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `contactId` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `statusId` int(11) NOT NULL,
  `lockedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`contactId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `contacts`
-- ----------------------------
BEGIN;
INSERT INTO `contacts` VALUES ('1', '+375447409237', '4', null), ('2', '+375-29-6811134', '0', null), ('3', '+37544623134', '0', '2014-06-05 20:53:30'), ('4', '+375-29-6822324', '0', null), ('5', '+375-29-6811134', '2', null), ('6', '+375-29-2311134', '3', null), ('7', '+375-29-1111134', '5', null), ('8', '+375-29-2221134', '1', null), ('9', '+375-29-5011134', '4', null), ('10', '+375-29-3411134', '2', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;";
if($conn->pdo->exec($query) !== false){
	echo("Install complete");
}