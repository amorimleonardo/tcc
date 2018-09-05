-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para tcc
DROP DATABASE IF EXISTS `tcc`;
CREATE DATABASE IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tcc`;

-- Copiando estrutura para tabela tcc.agrup_usuario
DROP TABLE IF EXISTS `agrup_usuario`;
CREATE TABLE IF NOT EXISTS `agrup_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.agrup_usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `agrup_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `agrup_usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.balanca
DROP TABLE IF EXISTS `balanca`;
CREATE TABLE IF NOT EXISTS `balanca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peso_atual` decimal(4,2) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.balanca: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `balanca` DISABLE KEYS */;
/*!40000 ALTER TABLE `balanca` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `data_compra` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_compra_produto` (`id_produto`),
  CONSTRAINT `FK_compra_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.compra: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` (`id`, `id_user`, `id_produto`, `data_compra`) VALUES
	(8, 2, 13, '2018-09-05'),
	(9, 2, 14, '2018-09-05');
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.historico
DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_compra` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.historico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.mercado
DROP TABLE IF EXISTS `mercado`;
CREATE TABLE IF NOT EXISTS `mercado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.mercado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mercado` DISABLE KEYS */;
/*!40000 ALTER TABLE `mercado` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.produto
DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `qtd_min` float(4,2) DEFAULT NULL,
  `preco_custo` float(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.produto: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`id`, `nome`, `qtd_min`, `preco_custo`) VALUES
	(13, 'arroz', NULL, 5.30),
	(14, 'feijão', NULL, 10.60),
	(15, 'açucar', NULL, 7.30);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.prox_compra
DROP TABLE IF EXISTS `prox_compra`;
CREATE TABLE IF NOT EXISTS `prox_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  `data_prox` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.prox_compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `prox_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `prox_compra` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `dt_nasc` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela tcc.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `name`, `email`, `password`, `created`, `dt_nasc`) VALUES
	(2, 'leo', 'leo@teste.com', '123', NULL, '2014-11-30 00:00:00');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
