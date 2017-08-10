-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Ago-2017 às 02:30
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `abertura_classe`
--

CREATE TABLE IF NOT EXISTS `abertura_classe` (
  `id_abertura_classe` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `abertura_grupo`
--

CREATE TABLE IF NOT EXISTS `abertura_grupo` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL,
  `id_abertura_grupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `abertura_subclasse`
--

CREATE TABLE IF NOT EXISTS `abertura_subclasse` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL,
  `id_abertura_subclasse` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `abertura_subgrupo`
--

CREATE TABLE IF NOT EXISTS `abertura_subgrupo` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL,
  `id_abertura_subgrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `classe_codigo` varchar(9) NOT NULL,
  `classe_nome` varchar(255) NOT NULL,
  `classe_ativa` int(11) NOT NULL,
  `classe_subordinacao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desativacao_classe`
--

CREATE TABLE IF NOT EXISTS `desativacao_classe` (
  `id_desativacao_classe` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desativacao_grupo`
--

CREATE TABLE IF NOT EXISTS `desativacao_grupo` (
  `id_desativacao_grupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desativacao_subclasse`
--

CREATE TABLE IF NOT EXISTS `desativacao_subclasse` (
  `id_desativacao_subclasse` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desativacao_subgrupo`
--

CREATE TABLE IF NOT EXISTS `desativacao_subgrupo` (
  `id_desativacao_subgrupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deslocamento_classe`
--

CREATE TABLE IF NOT EXISTS `deslocamento_classe` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subordinacao_anterior` varchar(45) NOT NULL,
  `id_deslocamento_classe` int(11) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deslocamento_grupo`
--

CREATE TABLE IF NOT EXISTS `deslocamento_grupo` (
  `id_deslocamento_grupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subordinacao_anterior` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deslocamento_subclasse`
--

CREATE TABLE IF NOT EXISTS `deslocamento_subclasse` (
  `id_deslocamento_subclasse` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subordinacao_anterior` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deslocamento_subgrupo`
--

CREATE TABLE IF NOT EXISTS `deslocamento_subgrupo` (
  `id_deslocamento_subgrupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subordinacao_anterior` varchar(45) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `extincao_classe`
--

CREATE TABLE IF NOT EXISTS `extincao_classe` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL,
  `id_extincao_classe` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `extincao_grupo`
--

CREATE TABLE IF NOT EXISTS `extincao_grupo` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL,
  `id_extincao_grupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `extincao_subclasse`
--

CREATE TABLE IF NOT EXISTS `extincao_subclasse` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL,
  `id_extincao_subclasse` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `extincao_subgrupo`
--

CREATE TABLE IF NOT EXISTS `extincao_subgrupo` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL,
  `id_extincao_subgrupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_codigo` varchar(9) NOT NULL,
  `grupo_nome` varchar(255) NOT NULL,
  `grupo_ativo` int(11) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mudanca_nome_classe`
--

CREATE TABLE IF NOT EXISTS `mudanca_nome_classe` (
  `id_mudancao_nome_classe` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `nome_anterior` varchar(255) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mudanca_nome_grupo`
--

CREATE TABLE IF NOT EXISTS `mudanca_nome_grupo` (
  `id_mudanca_nome_grupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `nome_anterior` varchar(255) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mudanca_nome_subclasse`
--

CREATE TABLE IF NOT EXISTS `mudanca_nome_subclasse` (
  `id_mudanca_nome_subclasse` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `nome_anterior` varchar(255) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mudanca_nome_subgrupo`
--

CREATE TABLE IF NOT EXISTS `mudanca_nome_subgrupo` (
  `id_mudanca_nome_subgrupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `nome_anterior` varchar(255) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reativacao_classe`
--

CREATE TABLE IF NOT EXISTS `reativacao_classe` (
  `id_reativacao_classe` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reativacao_grupo`
--

CREATE TABLE IF NOT EXISTS `reativacao_grupo` (
  `id_reativacao_grupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reativacao_subclasse`
--

CREATE TABLE IF NOT EXISTS `reativacao_subclasse` (
  `id_reativacao_subclasse` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reativacao_subgrupo`
--

CREATE TABLE IF NOT EXISTS `reativacao_subgrupo` (
  `id_reativacao_subgrupo` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavel` varchar(45) NOT NULL,
  `subgrupo_subgrupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_alteracao_classe`
--

CREATE TABLE IF NOT EXISTS `registro_alteracao_classe` (
  `id_registro_alteracao_classe` int(11) NOT NULL,
  `descricao` varchar(955) NOT NULL,
  `prazo_anterior` date NOT NULL,
  `destinacao_anterior` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavek` varchar(45) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_alteracao_grupo`
--

CREATE TABLE IF NOT EXISTS `registro_alteracao_grupo` (
  `id_registro_alteracao_grupo` int(11) NOT NULL,
  `descricao` varchar(955) NOT NULL,
  `prazo_anterior` date NOT NULL,
  `destinacao_anterior` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavek` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_alteracao_subclasse`
--

CREATE TABLE IF NOT EXISTS `registro_alteracao_subclasse` (
  `id_registro_alteracao_classe` int(11) NOT NULL,
  `descricao` varchar(955) NOT NULL,
  `prazo_anterior` date NOT NULL,
  `destinacao_anterior` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavek` varchar(45) NOT NULL,
  `subclasse_subclasse_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_alteracao_subgrupo`
--

CREATE TABLE IF NOT EXISTS `registro_alteracao_subgrupo` (
  `id_registro_alteracao_subgrupo` int(11) NOT NULL,
  `descricao` varchar(955) NOT NULL,
  `prazo_anterior` date NOT NULL,
  `destinacao_anterior` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `responsavek` varchar(45) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subclasse`
--

CREATE TABLE IF NOT EXISTS `subclasse` (
  `subclasse_codigo` varchar(9) NOT NULL,
  `subclasse_nome` varchar(255) NOT NULL,
  `subclasse_ativa` int(11) NOT NULL,
  `classe_classe_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subgrupo`
--

CREATE TABLE IF NOT EXISTS `subgrupo` (
  `subgrupo_codigo` varchar(9) NOT NULL,
  `subgrupo_nome` varchar(255) NOT NULL,
  `subgrupo_ativo` int(11) NOT NULL,
  `grupo_grupo_codigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL,
  `userLogin` varchar(45) NOT NULL,
  `userPass` varchar(512) NOT NULL,
  `userType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abertura_classe`
--
ALTER TABLE `abertura_classe`
  ADD PRIMARY KEY (`id_abertura_classe`), ADD KEY `fk_abertura_classe_classe1` (`classe_classe_codigo`);

--
-- Indexes for table `abertura_grupo`
--
ALTER TABLE `abertura_grupo`
  ADD PRIMARY KEY (`id_abertura_grupo`), ADD KEY `fk_abertura_grupo_grupo1` (`grupo_grupo_codigo`);

--
-- Indexes for table `abertura_subclasse`
--
ALTER TABLE `abertura_subclasse`
  ADD PRIMARY KEY (`id_abertura_subclasse`), ADD KEY `fk_abertura_subclasse_subclasse1` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `abertura_subgrupo`
--
ALTER TABLE `abertura_subgrupo`
  ADD PRIMARY KEY (`id_abertura_subgrupo`), ADD KEY `fk_abertura_subgrupo_subgrupo1` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`classe_codigo`);

--
-- Indexes for table `desativacao_classe`
--
ALTER TABLE `desativacao_classe`
  ADD PRIMARY KEY (`id_desativacao_classe`), ADD KEY `fk_desativacao_classe_classe1_idx` (`classe_classe_codigo`);

--
-- Indexes for table `desativacao_grupo`
--
ALTER TABLE `desativacao_grupo`
  ADD PRIMARY KEY (`id_desativacao_grupo`), ADD KEY `fk_desativacao_grupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `desativacao_subclasse`
--
ALTER TABLE `desativacao_subclasse`
  ADD PRIMARY KEY (`id_desativacao_subclasse`), ADD KEY `fk_desativacao_subclasse_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `desativacao_subgrupo`
--
ALTER TABLE `desativacao_subgrupo`
  ADD PRIMARY KEY (`id_desativacao_subgrupo`), ADD KEY `fk_desativacao_subgrupo_subgrupo1_idx` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `deslocamento_classe`
--
ALTER TABLE `deslocamento_classe`
  ADD PRIMARY KEY (`id_deslocamento_classe`), ADD KEY `fk_deslocamento_classe_classe1_idx` (`classe_classe_codigo`);

--
-- Indexes for table `deslocamento_grupo`
--
ALTER TABLE `deslocamento_grupo`
  ADD PRIMARY KEY (`id_deslocamento_grupo`), ADD KEY `fk_deslocamento_grupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `deslocamento_subclasse`
--
ALTER TABLE `deslocamento_subclasse`
  ADD PRIMARY KEY (`id_deslocamento_subclasse`), ADD KEY `fk_deslocamento_subclasse_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `deslocamento_subgrupo`
--
ALTER TABLE `deslocamento_subgrupo`
  ADD PRIMARY KEY (`id_deslocamento_subgrupo`), ADD KEY `fk_deslocamento_subgrupo_subgrupo1_idx` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `extincao_classe`
--
ALTER TABLE `extincao_classe`
  ADD PRIMARY KEY (`id_extincao_classe`), ADD KEY `fk_extincao_classe_classe1` (`classe_classe_codigo`);

--
-- Indexes for table `extincao_grupo`
--
ALTER TABLE `extincao_grupo`
  ADD PRIMARY KEY (`id_extincao_grupo`), ADD KEY `fk_extincao_grupo_grupo1` (`grupo_grupo_codigo`);

--
-- Indexes for table `extincao_subclasse`
--
ALTER TABLE `extincao_subclasse`
  ADD PRIMARY KEY (`id_extincao_subclasse`), ADD KEY `fk_extincao_subclasse_subclasse1` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `extincao_subgrupo`
--
ALTER TABLE `extincao_subgrupo`
  ADD PRIMARY KEY (`id_extincao_subgrupo`), ADD KEY `fk_extincao_subgrupo_subgrupo1` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`grupo_codigo`), ADD KEY `fk_grupo_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `mudanca_nome_classe`
--
ALTER TABLE `mudanca_nome_classe`
  ADD PRIMARY KEY (`id_mudancao_nome_classe`), ADD KEY `fk_mudanca_nome_classe_classe1_idx` (`classe_classe_codigo`);

--
-- Indexes for table `mudanca_nome_grupo`
--
ALTER TABLE `mudanca_nome_grupo`
  ADD PRIMARY KEY (`id_mudanca_nome_grupo`), ADD KEY `fk_mudanca_nome_grupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `mudanca_nome_subclasse`
--
ALTER TABLE `mudanca_nome_subclasse`
  ADD PRIMARY KEY (`id_mudanca_nome_subclasse`), ADD KEY `fk_mudanca_nome_subclasse_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `mudanca_nome_subgrupo`
--
ALTER TABLE `mudanca_nome_subgrupo`
  ADD PRIMARY KEY (`id_mudanca_nome_subgrupo`), ADD KEY `fk_mudanca_nome_subgrupo_subgrupo1_idx` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `reativacao_classe`
--
ALTER TABLE `reativacao_classe`
  ADD PRIMARY KEY (`id_reativacao_classe`), ADD KEY `fk_reativacao_classe_classe1_idx` (`classe_classe_codigo`);

--
-- Indexes for table `reativacao_grupo`
--
ALTER TABLE `reativacao_grupo`
  ADD PRIMARY KEY (`id_reativacao_grupo`), ADD KEY `fk_reativacao_grupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `reativacao_subclasse`
--
ALTER TABLE `reativacao_subclasse`
  ADD PRIMARY KEY (`id_reativacao_subclasse`), ADD KEY `fk_reativacao_subclasse_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `reativacao_subgrupo`
--
ALTER TABLE `reativacao_subgrupo`
  ADD PRIMARY KEY (`id_reativacao_subgrupo`), ADD KEY `fk_reativacao_subgrupo_subgrupo1_idx` (`subgrupo_subgrupo_codigo`);

--
-- Indexes for table `registro_alteracao_classe`
--
ALTER TABLE `registro_alteracao_classe`
  ADD PRIMARY KEY (`id_registro_alteracao_classe`), ADD KEY `fk_registro_alteracao_classe_classe1_idx` (`classe_classe_codigo`);

--
-- Indexes for table `registro_alteracao_grupo`
--
ALTER TABLE `registro_alteracao_grupo`
  ADD PRIMARY KEY (`id_registro_alteracao_grupo`), ADD KEY `fk_registro_alteracao_grupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `registro_alteracao_subclasse`
--
ALTER TABLE `registro_alteracao_subclasse`
  ADD PRIMARY KEY (`id_registro_alteracao_classe`), ADD KEY `fk_registro_alteracao_subclasse_subclasse1_idx` (`subclasse_subclasse_codigo`);

--
-- Indexes for table `registro_alteracao_subgrupo`
--
ALTER TABLE `registro_alteracao_subgrupo`
  ADD PRIMARY KEY (`id_registro_alteracao_subgrupo`), ADD KEY `fk_registro_alteracao_subgrupo_subgrupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `subclasse`
--
ALTER TABLE `subclasse`
  ADD PRIMARY KEY (`subclasse_codigo`), ADD KEY `fk_subclasse_classe_idx` (`classe_classe_codigo`);

--
-- Indexes for table `subgrupo`
--
ALTER TABLE `subgrupo`
  ADD PRIMARY KEY (`subgrupo_codigo`), ADD KEY `fk_subgrupo_grupo1_idx` (`grupo_grupo_codigo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abertura_classe`
--
ALTER TABLE `abertura_classe`
  MODIFY `id_abertura_classe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `abertura_grupo`
--
ALTER TABLE `abertura_grupo`
  MODIFY `id_abertura_grupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `abertura_subclasse`
--
ALTER TABLE `abertura_subclasse`
  MODIFY `id_abertura_subclasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `abertura_subgrupo`
--
ALTER TABLE `abertura_subgrupo`
  MODIFY `id_abertura_subgrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `desativacao_classe`
--
ALTER TABLE `desativacao_classe`
  MODIFY `id_desativacao_classe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `desativacao_grupo`
--
ALTER TABLE `desativacao_grupo`
  MODIFY `id_desativacao_grupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `desativacao_subclasse`
--
ALTER TABLE `desativacao_subclasse`
  MODIFY `id_desativacao_subclasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `desativacao_subgrupo`
--
ALTER TABLE `desativacao_subgrupo`
  MODIFY `id_desativacao_subgrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `deslocamento_classe`
--
ALTER TABLE `deslocamento_classe`
  MODIFY `id_deslocamento_classe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deslocamento_grupo`
--
ALTER TABLE `deslocamento_grupo`
  MODIFY `id_deslocamento_grupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deslocamento_subclasse`
--
ALTER TABLE `deslocamento_subclasse`
  MODIFY `id_deslocamento_subclasse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deslocamento_subgrupo`
--
ALTER TABLE `deslocamento_subgrupo`
  MODIFY `id_deslocamento_subgrupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extincao_classe`
--
ALTER TABLE `extincao_classe`
  MODIFY `id_extincao_classe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `extincao_grupo`
--
ALTER TABLE `extincao_grupo`
  MODIFY `id_extincao_grupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `extincao_subclasse`
--
ALTER TABLE `extincao_subclasse`
  MODIFY `id_extincao_subclasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `extincao_subgrupo`
--
ALTER TABLE `extincao_subgrupo`
  MODIFY `id_extincao_subgrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mudanca_nome_classe`
--
ALTER TABLE `mudanca_nome_classe`
  MODIFY `id_mudancao_nome_classe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mudanca_nome_grupo`
--
ALTER TABLE `mudanca_nome_grupo`
  MODIFY `id_mudanca_nome_grupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mudanca_nome_subclasse`
--
ALTER TABLE `mudanca_nome_subclasse`
  MODIFY `id_mudanca_nome_subclasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mudanca_nome_subgrupo`
--
ALTER TABLE `mudanca_nome_subgrupo`
  MODIFY `id_mudanca_nome_subgrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reativacao_classe`
--
ALTER TABLE `reativacao_classe`
  MODIFY `id_reativacao_classe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reativacao_grupo`
--
ALTER TABLE `reativacao_grupo`
  MODIFY `id_reativacao_grupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reativacao_subclasse`
--
ALTER TABLE `reativacao_subclasse`
  MODIFY `id_reativacao_subclasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reativacao_subgrupo`
--
ALTER TABLE `reativacao_subgrupo`
  MODIFY `id_reativacao_subgrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `abertura_classe`
--
ALTER TABLE `abertura_classe`
ADD CONSTRAINT `fk_abertura_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `abertura_grupo`
--
ALTER TABLE `abertura_grupo`
ADD CONSTRAINT `fk_abertura_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `abertura_subclasse`
--
ALTER TABLE `abertura_subclasse`
ADD CONSTRAINT `fk_abertura_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `abertura_subgrupo`
--
ALTER TABLE `abertura_subgrupo`
ADD CONSTRAINT `fk_abertura_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `desativacao_classe`
--
ALTER TABLE `desativacao_classe`
ADD CONSTRAINT `fk_desativacao_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `desativacao_grupo`
--
ALTER TABLE `desativacao_grupo`
ADD CONSTRAINT `fk_desativacao_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `desativacao_subclasse`
--
ALTER TABLE `desativacao_subclasse`
ADD CONSTRAINT `fk_desativacao_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `desativacao_subgrupo`
--
ALTER TABLE `desativacao_subgrupo`
ADD CONSTRAINT `fk_desativacao_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deslocamento_classe`
--
ALTER TABLE `deslocamento_classe`
ADD CONSTRAINT `fk_deslocamento_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deslocamento_grupo`
--
ALTER TABLE `deslocamento_grupo`
ADD CONSTRAINT `fk_deslocamento_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deslocamento_subclasse`
--
ALTER TABLE `deslocamento_subclasse`
ADD CONSTRAINT `fk_deslocamento_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deslocamento_subgrupo`
--
ALTER TABLE `deslocamento_subgrupo`
ADD CONSTRAINT `fk_deslocamento_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `extincao_classe`
--
ALTER TABLE `extincao_classe`
ADD CONSTRAINT `fk_extincao_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `extincao_grupo`
--
ALTER TABLE `extincao_grupo`
ADD CONSTRAINT `fk_extincao_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `extincao_subclasse`
--
ALTER TABLE `extincao_subclasse`
ADD CONSTRAINT `fk_extincao_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `extincao_subgrupo`
--
ALTER TABLE `extincao_subgrupo`
ADD CONSTRAINT `fk_extincao_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `grupo`
--
ALTER TABLE `grupo`
ADD CONSTRAINT `fk_grupo_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mudanca_nome_classe`
--
ALTER TABLE `mudanca_nome_classe`
ADD CONSTRAINT `fk_mudanca_nome_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mudanca_nome_grupo`
--
ALTER TABLE `mudanca_nome_grupo`
ADD CONSTRAINT `fk_mudanca_nome_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mudanca_nome_subclasse`
--
ALTER TABLE `mudanca_nome_subclasse`
ADD CONSTRAINT `fk_mudanca_nome_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mudanca_nome_subgrupo`
--
ALTER TABLE `mudanca_nome_subgrupo`
ADD CONSTRAINT `fk_mudanca_nome_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reativacao_classe`
--
ALTER TABLE `reativacao_classe`
ADD CONSTRAINT `fk_reativacao_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reativacao_grupo`
--
ALTER TABLE `reativacao_grupo`
ADD CONSTRAINT `fk_reativacao_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reativacao_subclasse`
--
ALTER TABLE `reativacao_subclasse`
ADD CONSTRAINT `fk_reativacao_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reativacao_subgrupo`
--
ALTER TABLE `reativacao_subgrupo`
ADD CONSTRAINT `fk_reativacao_subgrupo_subgrupo1` FOREIGN KEY (`subgrupo_subgrupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `registro_alteracao_classe`
--
ALTER TABLE `registro_alteracao_classe`
ADD CONSTRAINT `fk_registro_alteracao_classe_classe1` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `registro_alteracao_grupo`
--
ALTER TABLE `registro_alteracao_grupo`
ADD CONSTRAINT `fk_registro_alteracao_grupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `registro_alteracao_subclasse`
--
ALTER TABLE `registro_alteracao_subclasse`
ADD CONSTRAINT `fk_registro_alteracao_subclasse_subclasse1` FOREIGN KEY (`subclasse_subclasse_codigo`) REFERENCES `subclasse` (`subclasse_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `registro_alteracao_subgrupo`
--
ALTER TABLE `registro_alteracao_subgrupo`
ADD CONSTRAINT `fk_registro_alteracao_subgrupo_subgrupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `subgrupo` (`subgrupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `subclasse`
--
ALTER TABLE `subclasse`
ADD CONSTRAINT `fk_subclasse_classe` FOREIGN KEY (`classe_classe_codigo`) REFERENCES `classe` (`classe_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `subgrupo`
--
ALTER TABLE `subgrupo`
ADD CONSTRAINT `fk_subgrupo_grupo1` FOREIGN KEY (`grupo_grupo_codigo`) REFERENCES `grupo` (`grupo_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
