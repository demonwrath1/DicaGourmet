-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para dicagourmet
CREATE DATABASE IF NOT EXISTS `dicagourmet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dicagourmet`;

-- Copiando estrutura para tabela dicagourmet.avaliacao
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_aval_comida` int(11) NOT NULL,
  `id_aval_serv` int(11) NOT NULL,
  `id_aval_ambiente` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  `dt_aval` date NOT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `id_aval_comida` (`id_aval_comida`),
  KEY `id_aval_serv` (`id_aval_serv`),
  KEY `id_aval_ambiente` (`id_aval_ambiente`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_aval_comida`) REFERENCES `aval_comida` (`id_aval_comida`),
  CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_aval_serv`) REFERENCES `aval_servico` (`id_aval_serv`),
  CONSTRAINT `avaliacao_ibfk_3` FOREIGN KEY (`id_aval_ambiente`) REFERENCES `aval_ambiente` (`id_aval_ambiente`),
  CONSTRAINT `avaliacao_ibfk_4` FOREIGN KEY (`id_cliente`) REFERENCES `usu_cliente` (`id_cliente`),
  CONSTRAINT `avaliacao_ibfk_5` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.avaliacao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.aval_ambiente
CREATE TABLE IF NOT EXISTS `aval_ambiente` (
  `id_aval_ambiente` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_estrela_ambiente` int(11) NOT NULL,
  `aval_descri_ambiente` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_aval_ambiente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.aval_ambiente: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.aval_comida
CREATE TABLE IF NOT EXISTS `aval_comida` (
  `id_aval_comida` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_estrela_comida` int(11) NOT NULL,
  `aval_descri_comida` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_aval_comida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.aval_comida: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.aval_servico
CREATE TABLE IF NOT EXISTS `aval_servico` (
  `id_aval_serv` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_estrela_serv` int(11) NOT NULL,
  `aval_descri_serv` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_aval_serv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.aval_servico: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.cardapio
CREATE TABLE IF NOT EXISTS `cardapio` (
  `id_cardapio` int(11) NOT NULL AUTO_INCREMENT,
  `id_estabelecimento` int(11) NOT NULL,
  `nome_prato` varchar(100) NOT NULL,
  `valor_prato` varchar(10) NOT NULL DEFAULT '',
  `descricao_prato` varchar(250) NOT NULL,
  `foto_prato` text DEFAULT NULL,
  PRIMARY KEY (`id_cardapio`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `cardapio_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.cardapio: ~4 rows (aproximadamente)
INSERT INTO `cardapio` (`id_cardapio`, `id_estabelecimento`, `nome_prato`, `valor_prato`, `descricao_prato`, `foto_prato`) VALUES
	(39, 38, 'Travessa de costela', '45', 'Deliciosa travessa com costela e acompanhamentos', 'fotos_pratos/674b29e4f3fc5.jpg'),
	(40, 38, 'Prato da casa', '35.99', 'Uma iguaria italiana que se torna uma experiência.', 'fotos_pratos/674b2a3d4df94.jpg'),
	(41, 39, 'Bife tradicional', '55', 'Para você que curte uma comida mais abrasileirada, nosso restaurante também te acolhe.', 'fotos_pratos/674b323b1aa24.jpg'),
	(43, 41, 'Hamburguer default', '30', 'Hambúrguer padrão com nosso cheddar especial', 'fotos_pratos/674b5ecd2bcc2.jpg');

-- Copiando estrutura para tabela dicagourmet.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `id_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `id_estabelecimento` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `dt_contrato` datetime NOT NULL,
  `dt_pag` datetime NOT NULL,
  PRIMARY KEY (`id_contrato`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  KEY `id_plano` (`id_plano`),
  CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`id_plano`) REFERENCES `plano` (`id_plano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.contrato: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.favoritos
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favoritos` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  `dt_favorito` date NOT NULL,
  PRIMARY KEY (`id_favoritos`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usu_cliente` (`id_cliente`),
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.favoritos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.foto_ambiente_estab
CREATE TABLE IF NOT EXISTS `foto_ambiente_estab` (
  `id_foto_estab` int(11) NOT NULL AUTO_INCREMENT,
  `id_estabelecimento` int(11) NOT NULL,
  `imgs_ambiente` text NOT NULL,
  `img_perf` text NOT NULL,
  PRIMARY KEY (`id_foto_estab`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `foto_ambiente_estab_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.foto_ambiente_estab: ~3 rows (aproximadamente)
INSERT INTO `foto_ambiente_estab` (`id_foto_estab`, `id_estabelecimento`, `imgs_ambiente`, `img_perf`) VALUES
	(38, 38, 'fotos_ambiente/674b2992ba494.jpg;fotos_ambiente/674b2992ba816.jpg;fotos_ambiente/674b2992bab0f.jpg;fotos_ambiente/674b2992baf77.jpg', 'fotos_perfil/674b2992b2fe0.jpg'),
	(39, 39, 'fotos_ambiente/674b3140bec6b.jpg;fotos_ambiente/674b3140bf02b.jpg;fotos_ambiente/674b3140bf315.jpg;fotos_ambiente/674b3140bf56d.jpg', 'fotos_perfil/674b3140bd57d.jpg'),
	(41, 41, 'fotos_ambiente/674b5e78ec4c8.jpg;fotos_ambiente/674b5e78ec8a8.jpg;fotos_ambiente/674b5e78ecc6b.jpg;fotos_ambiente/674b5e78ed04a.jpg', 'fotos_perfil/674b5e78eae0a.jpg');

-- Copiando estrutura para tabela dicagourmet.horario_func
CREATE TABLE IF NOT EXISTS `horario_func` (
  `id_horario_func` int(11) NOT NULL AUTO_INCREMENT,
  `dia_func` varchar(500) NOT NULL,
  `hora_abertura` time NOT NULL,
  `hora_fechamento` time NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  `tempo_max_atraso` varchar(20) NOT NULL,
  `tempo_max_estadia` varchar(20) NOT NULL,
  PRIMARY KEY (`id_horario_func`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `horario_func_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.horario_func: ~3 rows (aproximadamente)
INSERT INTO `horario_func` (`id_horario_func`, `dia_func`, `hora_abertura`, `hora_fechamento`, `id_estabelecimento`, `tempo_max_atraso`, `tempo_max_estadia`) VALUES
	(40, '', '09:00:00', '17:00:00', 38, '01:30', ''),
	(41, '', '14:00:00', '22:00:00', 39, '00:20', ''),
	(43, '', '09:00:00', '22:00:00', 41, '01:00', '');

-- Copiando estrutura para tabela dicagourmet.localidade
CREATE TABLE IF NOT EXISTS `localidade` (
  `id_localidade` int(11) NOT NULL AUTO_INCREMENT,
  `cep` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `complemento` varchar(150) DEFAULT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  PRIMARY KEY (`id_localidade`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.localidade: ~7 rows (aproximadamente)
INSERT INTO `localidade` (`id_localidade`, `cep`, `logradouro`, `cidade`, `bairro`, `uf`, `complemento`, `latitude`, `longitude`) VALUES
	(97, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', '', 'Perto da praça São Jorge', '-22.8808571', '-43.4130032'),
	(98, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', 'RJ', NULL, '-22.8808571', '-43.4130032'),
	(99, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', '', 'Próximo ao Parque Central, ao lado da Loja Green Life', '-22.8808571', '-43.4130032'),
	(101, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', '', ' Rua dos Anos 50, 200, ao lado do Cinema Retrô', '-22.8808571', '-43.4130032'),
	(102, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', 'RJ', NULL, '', ''),
	(103, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', 'RJ', NULL, '', ''),
	(104, 21740001, 'Avenida Marechal Fontenelle', 'Rio de Janeiro', 'Campo dos Afonsos', 'RJ', NULL, '-22.8808571', '-43.4130032');

-- Copiando estrutura para tabela dicagourmet.mesa
CREATE TABLE IF NOT EXISTS `mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `id_estabelecimento` int(11) NOT NULL,
  `nome_mesa` varchar(30) NOT NULL DEFAULT '',
  `npessoas` int(10) NOT NULL DEFAULT 0,
  `descmesa` varchar(50) DEFAULT '',
  `status` varchar(20) DEFAULT NULL,
  `mesa_s` text DEFAULT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `mesa_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.mesa: ~4 rows (aproximadamente)
INSERT INTO `mesa` (`id_mesa`, `id_estabelecimento`, `nome_mesa`, `npessoas`, `descmesa`, `status`, `mesa_s`) VALUES
	(16, 38, 'Mesa um', 5, 'Mesa pequena família', NULL, NULL),
	(17, 38, 'Mesa dois', 2, 'Para casais românticos.', NULL, NULL),
	(18, 39, 'Mesa Prime', 10, 'Para reuniões importantes', NULL, NULL),
	(20, 41, 'Mesa Retrô', 5, 'Para os que querem voltar no tempo', NULL, NULL);

-- Copiando estrutura para tabela dicagourmet.plano
CREATE TABLE IF NOT EXISTS `plano` (
  `id_plano` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `valor` varchar(10) NOT NULL DEFAULT '',
  `pago` varchar(15) DEFAULT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  PRIMARY KEY (`id_plano`),
  KEY `fk_id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `fk_id_estabelecimento` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.plano: ~3 rows (aproximadamente)
INSERT INTO `plano` (`id_plano`, `nome`, `descricao`, `valor`, `pago`, `id_estabelecimento`) VALUES
	(44, 'Deluxe', '', 'R$34,99', NULL, 38),
	(45, 'Elegance', '', 'R$ 49,99', NULL, 39),
	(47, 'Deluxe', '', 'R$34,99', NULL, 41);

-- Copiando estrutura para tabela dicagourmet.promocao
CREATE TABLE IF NOT EXISTS `promocao` (
  `id_promocao` int(11) NOT NULL AUTO_INCREMENT,
  `id_cardapio` int(11) NOT NULL,
  `val_promo` decimal(2,1) NOT NULL,
  PRIMARY KEY (`id_promocao`),
  KEY `id_cardapio` (`id_cardapio`),
  CONSTRAINT `promocao_ibfk_1` FOREIGN KEY (`id_cardapio`) REFERENCES `cardapio` (`id_cardapio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.promocao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.proprietario
CREATE TABLE IF NOT EXISTS `proprietario` (
  `id_proprietario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_proprietario` varchar(100) NOT NULL,
  `email_proprietario` varchar(150) NOT NULL,
  `telefone_proprietario` int(11) NOT NULL,
  `cpf_proprietario` int(11) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  PRIMARY KEY (`id_proprietario`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `proprietario_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.proprietario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.rede_social_estab
CREATE TABLE IF NOT EXISTS `rede_social_estab` (
  `id_rede_social` int(11) NOT NULL AUTO_INCREMENT,
  `nome_rede` varchar(500) DEFAULT NULL,
  `link_rede` varchar(500) DEFAULT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  PRIMARY KEY (`id_rede_social`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `rede_social_estab_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.rede_social_estab: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.reserva
CREATE TABLE IF NOT EXISTS `reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_mesa` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  `horario_reserva` time NOT NULL,
  `data_reserva` varchar(20) NOT NULL DEFAULT '',
  `qnt_pessoas` int(11) NOT NULL,
  `mesa_s` text DEFAULT NULL,
  `nome_completo` varchar(110) NOT NULL,
  `data_reserva_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_mesa` (`id_mesa`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usu_cliente` (`id_cliente`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.reserva: ~3 rows (aproximadamente)
INSERT INTO `reserva` (`id_reserva`, `id_mesa`, `id_cliente`, `id_estabelecimento`, `horario_reserva`, `data_reserva`, `qnt_pessoas`, `mesa_s`, `nome_completo`, `data_reserva_criacao`) VALUES
	(9, 16, 28, 38, '12:00:00', '30/nov', 4, '16', 'Maria Eduarda Freitas', '2024-11-30 12:27:38'),
	(10, 17, 28, 38, '20:00:00', '3/dez', 2, '17', 'Vivi Luiza', '2024-11-30 12:31:38'),
	(11, 18, 28, 39, '16:00:00', '4/dez', 10, '18', 'Maria Eduarda Freitas', '2024-11-30 15:34:32'),
	(12, 20, 29, 41, '16:00:00', '8/dez', 2, '20', 'Monique Oliveira', '2024-11-30 16:26:25');

-- Copiando estrutura para tabela dicagourmet.serv_oferecido
CREATE TABLE IF NOT EXISTS `serv_oferecido` (
  `id_serv_oferecido` int(11) NOT NULL AUTO_INCREMENT,
  `nome_serv_oferecido` varchar(100) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  `tipo_comidas` text NOT NULL,
  PRIMARY KEY (`id_serv_oferecido`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `serv_oferecido_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.serv_oferecido: ~3 rows (aproximadamente)
INSERT INTO `serv_oferecido` (`id_serv_oferecido`, `nome_serv_oferecido`, `id_estabelecimento`, `tipo_comidas`) VALUES
	(38, 'pets, wifi, buffet', 38, 'massa, espanhola, italiana'),
	(39, 'buffet, musica, acessibilidade', 39, 'massa, italiana, infantil, sobremesa'),
	(41, 'ar_condicionado, buffet, tv_telao ', 41, 'massa, carne, bar, fastfood');

-- Copiando estrutura para tabela dicagourmet.telefone_estab
CREATE TABLE IF NOT EXISTS `telefone_estab` (
  `id_telefone_estab` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_telefone` varchar(100) NOT NULL,
  `num_telefone_estab` varchar(150) NOT NULL,
  `id_estabelecimento` int(11) NOT NULL,
  PRIMARY KEY (`id_telefone_estab`),
  KEY `id_estabelecimento` (`id_estabelecimento`),
  CONSTRAINT `telefone_estab_ibfk_1` FOREIGN KEY (`id_estabelecimento`) REFERENCES `usu_estabelecimento` (`id_estabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.telefone_estab: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela dicagourmet.usu_cliente
CREATE TABLE IF NOT EXISTS `usu_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone_cliente` varchar(13) NOT NULL,
  `nome_usu` varchar(100) NOT NULL,
  `foto_perfil` text DEFAULT NULL,
  `senha` varchar(64) NOT NULL,
  `id_localidade` int(11) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT '',
  PRIMARY KEY (`id_cliente`),
  KEY `id_localidade` (`id_localidade`),
  CONSTRAINT `usu_cliente_ibfk_1` FOREIGN KEY (`id_localidade`) REFERENCES `localidade` (`id_localidade`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.usu_cliente: ~2 rows (aproximadamente)
INSERT INTO `usu_cliente` (`id_cliente`, `nome_cliente`, `email`, `telefone_cliente`, `nome_usu`, `foto_perfil`, `senha`, `id_localidade`, `complemento`, `cpf`) VALUES
	(28, 'Maria Eduarda', 'cliente@gmail.com', '', 'Madu', '../Estabelecimento/fotos_perfil/674b588946d5e.jpg', '$2y$10$S0Mit1aDhVxdM5vBAOMtWuGDehRfs3JzEOsTYrMXJHcByQVUleQEu', 98, NULL, '123'),
	(29, 'Monique Oliveira', 'monique@gmail.com', '', 'Nyque', '../Estabelecimento/fotos_perfil/674b664ee8da5.jpg', '$2y$10$9.qXhZT0/zXpuEe4CepiPeNRdlHtAlGdrV.Tf4j3f30mKHIpcY1Se', 104, NULL, '3545463643');

-- Copiando estrutura para tabela dicagourmet.usu_estabelecimento
CREATE TABLE IF NOT EXISTS `usu_estabelecimento` (
  `id_estabelecimento` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estabelecimento` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_localidade` int(11) NOT NULL,
  `cnpj` varchar(24) NOT NULL,
  `nome_prop` varchar(150) NOT NULL,
  `senha` text NOT NULL,
  `qtd_max_pesreserva` int(11) NOT NULL,
  `temp_max_atraso` time DEFAULT NULL,
  `temp_max_estadia` time DEFAULT NULL,
  `sobre_estab` varchar(500) NOT NULL,
  `regras_jurisdicoes` varchar(500) DEFAULT NULL,
  `telefone_estab` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estabelecimento`),
  KEY `id_localidade` (`id_localidade`),
  CONSTRAINT `usu_estabelecimento_ibfk_1` FOREIGN KEY (`id_localidade`) REFERENCES `localidade` (`id_localidade`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dicagourmet.usu_estabelecimento: ~3 rows (aproximadamente)
INSERT INTO `usu_estabelecimento` (`id_estabelecimento`, `nome_estabelecimento`, `email`, `id_localidade`, `cnpj`, `nome_prop`, `senha`, `qtd_max_pesreserva`, `temp_max_atraso`, `temp_max_estadia`, `sobre_estab`, `regras_jurisdicoes`, `telefone_estab`) VALUES
	(38, 'Capo Capo', 'viviluiza0107@gmail.com', 97, '12.435.456/5342-33', 'Vivi', '$2y$10$nZwI/yHBEF6/H7Ft9Vo/heLjeMh3CuwgfJIl0Lv0YMyXMbhYCNeDW', 15, NULL, NULL, 'Espaço aconchegante especializado em massas e comida italiana.', 'Proibido fumar dentro do estabelecimento. Pertences perdidos não estão sobre nossa responsabilidade.', '(21)98552-5165'),
	(39, 'Bella Vista', 'nmariaeduarda196@gmail.com', 99, '12.435.456/5342-33', 'Maria Eduarda', '$2y$10$iwt6Jqy8BYAFDoljR9yGLueEO7AfpxMId5er62FqU5sQ.LqY20I6G', 30, NULL, NULL, 'Conhecido pela fusão de sabores tradicionais italianos e técnicas modernas, com destaque para seus risotos exclusivos e uma carta de vinhos selecionada.', 'É proibido fumar no local. É necessário fazer reservas para grupos acima de 10 pessoas. Não são permitidos animais de estimação.', '(21)99664-3224'),
	(41, 'Holy Burguer', 'willian.gaberel2@gmail.com', 101, '21.433.546/5567-65', 'Willian', '$2y$10$P1sxTUIXbtR6Do7w2IFAEuo56dAq7UN33rrG9r2LqAlaU1K2XCf8q', 20, NULL, NULL, 'Ambientada no charme dos anos 50, a Vintage Burger oferece hambúrgueres artesanais com um toque nostálgico, preparados com ingredientes frescos e acompanhados de milkshakes cremosos. O cardápio traz opções clássicas, como o Cheeseburger, além de combinações exclusivas e deliciosas com sabores que remetem à década de ouro do rock \\\'n roll.', 'Não é permitido o uso de bonés ou chapéus no salão. Para garantir a autenticidade da experiência, o uso de celulares deve ser restrito à área externa. Não aceitamos pagamentos com cheque ou criptomoedas.', '(21)98449-2910');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
