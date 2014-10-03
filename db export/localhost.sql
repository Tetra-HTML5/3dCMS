-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 03 okt 2014 om 06:25
-- Serverversie: 5.5.24-log
-- PHP-versie: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `3dcms`
--
CREATE DATABASE `3dcms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `3dcms`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `asset_material`
--

CREATE TABLE IF NOT EXISTS `asset_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `accessId` int(11) NOT NULL,
  `textureId` int(11) NOT NULL,
  `colorDiffuse_r` float NOT NULL DEFAULT '0',
  `colorDiffuse_g` float NOT NULL DEFAULT '0',
  `colorDiffuse_b` float NOT NULL DEFAULT '0',
  `colorSpecular_r` float NOT NULL DEFAULT '0',
  `colorSpecular_g` float NOT NULL DEFAULT '0',
  `colorSpecular_b` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `asset_material`
--

INSERT INTO `asset_material` (`id`, `name`, `accessId`, `textureId`, `colorDiffuse_r`, `colorDiffuse_g`, `colorDiffuse_b`, `colorSpecular_r`, `colorSpecular_g`, `colorSpecular_b`) VALUES
(1, 'material 1', 2, 9, 1, 0, 1, 0.8, 0.8, 1),
(2, 'material 2', 2, 1, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `asset_model3d`
--

CREATE TABLE IF NOT EXISTS `asset_model3d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `accessId` int(11) NOT NULL,
  `fileName` varchar(300) NOT NULL,
  `materialAssetId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `asset_model3d`
--

INSERT INTO `asset_model3d` (`id`, `name`, `accessId`, `fileName`, `materialAssetId`) VALUES
(1, 'kamer', 0, 'floor.obj', 2),
(2, 'rek', 3, 'rek.obj', 1),
(3, 'kassa', 3, 'kassa.obj', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `asset_texture`
--

CREATE TABLE IF NOT EXISTS `asset_texture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `accessId` int(11) NOT NULL,
  `fileName` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `asset_texture`
--

INSERT INTO `asset_texture` (`id`, `name`, `accessId`, `fileName`) VALUES
(1, 'bridgegroundstones', 4, 'bridgegroundstones.png'),
(2, 'marble floor', 1, 'marblefloor.jpg'),
(8, 'test', 1, 'Seamless_wall_white_paint_plaster_stucco_texture_02.jpg'),
(9, 'metal', 1, 'Seamless_metal_texture_smooth_by_hhh316.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `assetsaccess`
--

CREATE TABLE IF NOT EXISTS `assetsaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `assetType` enum('Model','Material','Texture','') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `model3d`
--

CREATE TABLE IF NOT EXISTS `model3d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceneObjectId` int(11) NOT NULL,
  `model3dAssetId` int(11) NOT NULL,
  `materialAssetId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `model3d`
--

INSERT INTO `model3d` (`id`, `sceneObjectId`, `model3dAssetId`, `materialAssetId`) VALUES
(12, 12, 2, 1),
(13, 13, 1, 2),
(14, 14, 2, 1),
(15, 15, 2, 1),
(16, 16, 2, 1),
(17, 17, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scene`
--

CREATE TABLE IF NOT EXISTS `scene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `adminUserId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `scene`
--

INSERT INTO `scene` (`id`, `name`, `adminUserId`) VALUES
(1, 'scene1', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sceneobject`
--

CREATE TABLE IF NOT EXISTS `sceneobject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sceneId` int(11) NOT NULL,
  `position_x` float NOT NULL,
  `position_y` float NOT NULL,
  `position_z` float NOT NULL,
  `rotation_x` float NOT NULL,
  `rotation_y` float NOT NULL,
  `rotation_z` float NOT NULL,
  `scale_x` float NOT NULL,
  `scale_y` float NOT NULL,
  `scale_z` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `sceneobject`
--

INSERT INTO `sceneobject` (`id`, `name`, `sceneId`, `position_x`, `position_y`, `position_z`, `rotation_x`, `rotation_y`, `rotation_z`, `scale_x`, `scale_y`, `scale_z`) VALUES
(12, 'nieuw', 1, -19.4727, 0, 10.993, 0, 1.57383, 0, 2.53562, 1, 1),
(13, 'nieuw', 1, 0, 0, 0, 0, 0, 0, 1, 1, 1),
(14, 'nieuw', 1, 1.80988, 0, 1.52737, 0, -0.992937, 0, 0.993908, 1, 1),
(15, 'nieuw', 1, 1.37922, 0, 13.2028, 0, 0, 0, 2, 1, 1),
(16, 'nieuw', 1, -11.2188, 0, -18.289, 0, 1.19894, 0, 1, 1, 1),
(17, 'nieuw', 1, 0, 0, -18.582, 0, 1.13038, 0, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
