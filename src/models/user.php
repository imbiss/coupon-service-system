<?php
/**
* 一个简单的Auth表
* Created by PhpStorm.
* User: hongyi
* Date: 14-4-16
* Time: 上午12:05
 *
-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 23. Sep 2014 um 23:14
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `coupon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
`uuid` binary(16) NOT NULL,
`email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
`emailhash` binary(16) NOT NULL,
`passwordhash` binary(16) NOT NULL,
`active` tinyint(1) NOT NULL,
`firma_uuid` binary(16) DEFAULT NULL,
`created` datetime NOT NULL,
`lastmodify` datetime NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `uuid` (`uuid`),
UNIQUE KEY `emailhash` (`emailhash`),
KEY `username` (`email`(255)),
KEY `IDX_Firma_Uuid` (`firma_uuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Trigger `partner`
--
DROP TRIGGER IF EXISTS `partner-created`;
DELIMITER //
CREATE TRIGGER `partner-created` BEFORE INSERT ON `partner`
FOR EACH ROW BEGIN
IF (@DISABLE_TRIGGERS IS NULL) then
SET NEW.created = NOW();
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `partner-lastmofiy`;
DELIMITER //
CREATE TRIGGER `partner-lastmofiy` BEFORE UPDATE ON `partner`
FOR EACH ROW BEGIN
IF (@DISABLE_TRIGGERS IS NULL) then
SET NEW.lastmodify = NOW();
END IF;
END
//
DELIMITER ;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `partner`
--
ALTER TABLE `partner`
ADD CONSTRAINT `FK_Partner_Firma_Uuid-Firma_Uuid` FOREIGN KEY (`firma_uuid`) REFERENCES `firma` (`uuid`) ON DELETE SET NULL ON UPDATE CASCADE;


*/
class user extends AppModel
{
    public $useTable = 'user';
    public $useIndex = "uuid";

    protected $_colums = array(
        'uuid',             // bin16
        'email',            // varchar(255),
        'emailhash',            // bin16, hash from email address in low case
        'passwordhash',     // bin16,
        'active',           // is active,
        'partnerUuid',    // bin16 FK
        'api_key',      // unique string 8 alpha + num
        'api_secret_key', // string md5 char(32)
        'created',
        'lastmodify'
    );


    /**
     * 返回所有Partner并且附带shop统计数
     *
     * @return mixed
     */
    public function findAllWithShopCount()
    {
        $sql = sprintf("SELECT *
                FROM %s AS P
                GROUP BY P.id;",
            $this->getTbName()
        );
        return $this->query($sql);
    }
}
/* EOF */