-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Nov-2017 às 18:41
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `controlvendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `address_number` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `address_neighb` varchar(50) DEFAULT NULL,
  `address_city` varchar(50) DEFAULT NULL,
  `address_state` varchar(50) DEFAULT NULL,
  `address_country` varchar(50) DEFAULT NULL,
  `address_zipcode` varchar(50) DEFAULT NULL,
  `stars` int(11) NOT NULL DEFAULT '3',
  `internal_obs` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'Feliciano i9');

-- --------------------------------------------------------

--
-- Estrutura da tabela `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_purchase` int(11) DEFAULT NULL,
  `name_desc` varchar(100) NOT NULL,
  `date_expense` datetime NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `purchase_price` float DEFAULT NULL,
  `quant` int(11) NOT NULL,
  `min_quant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory_history`
--

CREATE TABLE IF NOT EXISTS `inventory_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action` varchar(3) NOT NULL,
  `date_action` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE IF NOT EXISTS `permission_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name_group` varchar(50) NOT NULL DEFAULT '',
  `params` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `id_company`, `name_group`, `params`) VALUES
(1, 1, 'Desenvolvedores', '1,2,6,7,8,9,11,12,13,14,15,17,18,19,21,22,23,24,25,26,27'),
(2, 1, 'Testadores 45', '1'),
(3, 1, 'Visitante', '1'),
(4, 1, 'Visualizador', '1,7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_params`
--

CREATE TABLE IF NOT EXISTS `permission_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `permission_params`
--

INSERT INTO `permission_params` (`id`, `id_company`, `name`, `name2`) VALUES
(1, 1, 'logout', NULL),
(2, 1, 'permissions_view', NULL),
(6, 1, 'users_view', NULL),
(7, 1, 'clients_view', NULL),
(8, 1, 'clients_edit', NULL),
(9, 1, 'inventory_view', NULL),
(10, 1, 'inventory_add', NULL),
(11, 1, 'inventory_edit', NULL),
(12, 1, 'inventory_del', NULL),
(13, 1, 'sales_view', NULL),
(14, 1, 'sales_edit', NULL),
(15, 1, 'purchases_view', NULL),
(17, 1, 'providers_view', NULL),
(18, 1, 'providers_edit', NULL),
(19, 1, 'purchases_edit', 'Editar Compra'),
(21, 1, 'reports_view', 'Visualizar RelatÃ³rios'),
(22, 1, 'financial_view', 'Visualizar Financeiro'),
(23, 1, 'expenses_edit', 'Editar Despesas'),
(24, 1, 'expenses_view', 'Ver Despesas'),
(25, 1, 'revenue_view', 'Visualizar Receita'),
(26, 1, 'revenue_add', 'Adicionar Receita'),
(27, 1, 'revenue_edit', 'visualizar EdiÃ§Ã£o e detalhes da receita');

-- --------------------------------------------------------

--
-- Estrutura da tabela `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_neighb` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_zipcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `internal_obs` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `date_purchase` datetime NOT NULL,
  `total_price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases_products`
--

CREATE TABLE IF NOT EXISTS `purchases_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quant` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `revenue`
--

CREATE TABLE IF NOT EXISTS `revenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sale` int(11) DEFAULT NULL,
  `name_desc` varchar(100) NOT NULL,
  `date_revenue` datetime NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_sale` datetime NOT NULL,
  `total_price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales_products`
--

CREATE TABLE IF NOT EXISTS `sales_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  `sale_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `id_company`, `name`, `email`, `password`, `id_group`) VALUES
(1, 1, 'Rogério Feliciano dos Santos', 'admin@felicianoi9.com', 'f6fdb2f9e59fe2121c136ef65c47f287', 1),
(4, 1, 'Visitante', 'visitante@ensinafacil.com.br', 'e10adc3949ba59abbe56e057f20f883e', 3),
(5, 1, 'Visualizador', 'vejo@vejo.com', '202cb962ac59075b964b07152d234b70', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
