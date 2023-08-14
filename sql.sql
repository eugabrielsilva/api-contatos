-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela api-contatos.contatos
CREATE TABLE IF NOT EXISTS `contatos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoa` bigint(20) unsigned NOT NULL,
  `contato` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `CASCADE` (`id_pessoa`),
  CONSTRAINT `CASCADE` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela api-contatos.contatos: ~3 rows (aproximadamente)
INSERT IGNORE INTO `contatos` (`id`, `id_pessoa`, `contato`, `tipo`, `created_at`, `updated_at`) VALUES
	(1, 1, '(62) 99835-8851', 'WhatsApp', '2023-08-14 20:21:16', '2023-08-14 20:21:16'),
	(2, 1, 'gabriel.o.silva10@gmail.com', 'E-mail', '2023-08-14 20:21:16', '2023-08-14 20:21:16'),
	(3, 2, '(62) 3251-4878', 'Telefone', '2023-08-14 20:21:16', '2023-08-14 20:21:16');

-- Copiando estrutura para tabela api-contatos.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `name` varchar(255) NOT NULL,
  `applied_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela api-contatos.migrations: ~3 rows (aproximadamente)
INSERT IGNORE INTO `migrations` (`name`, `applied_at`) VALUES
	('m2023_08_13_223529_CreatePessoasTable', '2023-08-14 20:21:16'),
	('m2023_08_13_223740_CreateContatosTable', '2023-08-14 20:21:16'),
	('m2023_08_14_170450_PopulateDemoData', '2023-08-14 20:21:16');

-- Copiando estrutura para tabela api-contatos.pessoas
CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela api-contatos.pessoas: ~3 rows (aproximadamente)
INSERT IGNORE INTO `pessoas` (`id`, `nome`, `created_at`, `updated_at`) VALUES
	(1, 'Gabriel', '2023-08-14 20:21:16', '2023-08-14 20:21:16'),
	(2, 'Lucas', '2023-08-14 20:21:16', '2023-08-14 20:21:16'),
	(3, 'Adriano', '2023-08-14 20:21:16', '2023-08-14 20:21:16');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
