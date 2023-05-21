-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for porto
CREATE DATABASE IF NOT EXISTS `porto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `porto`;

-- Dumping structure for table porto.skills
CREATE TABLE IF NOT EXISTS `skills` (
  `skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `skill_name` varchar(50) NOT NULL DEFAULT '0',
  `skill_desc` varchar(500) NOT NULL DEFAULT '0',
  `skill_year` year(4) NOT NULL DEFAULT 0000,
  `skill_photo` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`skill_id`),
  KEY `FK__users` (`user_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CC1` CHECK (year(`skill_year`))
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table porto.skills: ~6 rows (approximately)
INSERT INTO `skills` (`skill_id`, `user_id`, `skill_name`, `skill_desc`, `skill_year`, `skill_photo`) VALUES
	(1, 1, 'Java Programming', 'Creating and developing Car Rental Desktop Models', '2022', 'java.png'),
	(2, 1, 'php Programming', 'Creating and developing Car Rental Website Models', '2023', 'php.png'),
	(3, 1, 'Figma Prototyping', 'Building an Applications prototype with Figma', '2022', 'figma.png'),
	(4, 1, 'English Speaker', 'Participating in National English Debating Competitions', '2023', 'debate.jpg'),
	(5, 1, 'Valorant Duelist Main', 'Good at every duelist Agent in Valorant Except Jett, Raze, and Neon', '2023', 'valo.jpeg'),
	(6, 1, 'Song Creator', 'Writing and Making Song lyrics with also Proggression Chord', '2020', 'fl-studio.png');

-- Dumping structure for table porto.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL DEFAULT '0',
  `user_password` varchar(50) NOT NULL DEFAULT '0',
  `user_name` varchar(50) NOT NULL,
  `user_age` int(11) NOT NULL DEFAULT 0,
  `user_desc` varchar(505) NOT NULL,
  `user_photo` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table porto.users: ~0 rows (approximately)
INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_age`, `user_desc`, `user_photo`) VALUES
	(1, 'ben@gmail.com', 'ben123', 'Bennart Dem Gunawan', 20, 'Ungraduation System Information Student of ITENAS Bandung', 'ben.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
