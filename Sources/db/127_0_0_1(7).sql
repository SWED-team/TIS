-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 26.Jan 2016, 14:34
-- Verzia serveru: 10.0.17-MariaDB
-- Verzia PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `tis`
--
CREATE DATABASE IF NOT EXISTS `tis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tis`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `edit_rights`
--

CREATE TABLE `edit_rights` (
  `page_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL COMMENT 'ak je file priradeny stranke tak obsahje id stranky',
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'nazov suboru',
  `description` text COLLATE utf8_slovak_ci NOT NULL,
  `path` text COLLATE utf8_slovak_ci COMMENT 'relativna cesta k suboru',
  `thumb` text COLLATE utf8_slovak_ci NOT NULL,
  `thumb-medium` text COLLATE utf8_slovak_ci COMMENT 'relativna cesta k strednemu nahladu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `file`
--

INSERT INTO `file` (`id`, `module_id`, `page_id`, `title`, `description`, `path`, `thumb`, `thumb-medium`) VALUES
(20, NULL, 3, '', '', 'files/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb_medium/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg'),
(22, 14, NULL, '', '', 'files/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb_medium/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg'),
(25, NULL, 5, '', '', 'files/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg', 'filesthumb_medium/full-hd-nature-wallpapers-1080p-wallpaper-full-hd-nature-wallpapers.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL COMMENT 'id modulu',
  `page_id` int(11) DEFAULT NULL COMMENT 'id stranky na ktorej je modul umiestneny',
  `type` varchar(20) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'typ modulu',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'datum vytvorenia',
  `edited` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'datum editovania',
  `created_by` int(11) DEFAULT NULL COMMENT 'id pouzivatela ktory vytvoril stranku',
  `edited_by` int(11) DEFAULT NULL COMMENT 'id pouzivatela ktory posledny editoval stranku',
  `rows` int(11) DEFAULT '1' COMMENT 'pocet riadkov modulu na stranke',
  `cols` int(11) DEFAULT '1' COMMENT 'pocet stlpcov na stranke',
  `order` double DEFAULT NULL COMMENT 'poradie modulu na stranke',
  `status` int(11) DEFAULT NULL COMMENT 'status daneho modulu - schvaleny/neschvaleny'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka obsahujuca zakladne vlastnosti kazdeho modulu';

--
-- Sťahujem dáta pre tabuľku `module`
--

INSERT INTO `module` (`id`, `page_id`, `type`, `created`, `edited`, `created_by`, `edited_by`, `rows`, `cols`, `order`, `status`) VALUES
(14, 3, 'module_link', '2016-01-25 21:39:33', '2016-01-26 12:43:34', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_attachements`
--

CREATE TABLE `module_attachements` (
  `id` int(11) NOT NULL COMMENT 'id modulu',
  `module_id` int(11) NOT NULL,
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'titulka pre prilohove subory',
  `description` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'popis prilohovych suborov'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka modulu prilohovych suborov';

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_embeded`
--

CREATE TABLE `module_embeded` (
  `id` int(11) NOT NULL COMMENT 'id embedovaneho videa',
  `module_id` int(11) DEFAULT NULL COMMENT 'modul pre embedovane video',
  `link` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'odkaz pre embedovane video',
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'nazov embedovaneho videa',
  `description` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'popis embedovaneho videa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka pre modul embeded video';

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_formated`
--

CREATE TABLE `module_formated` (
  `id` int(11) NOT NULL COMMENT 'id modulu',
  `module_id` int(11) NOT NULL COMMENT 'id modulu pre formatovany text ',
  `content` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'formatovany text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='modul formatovaneho textu';

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_gallery`
--

CREATE TABLE `module_gallery` (
  `id` int(11) NOT NULL COMMENT 'id galerie',
  `module_id` int(11) DEFAULT NULL COMMENT 'id modulu pre galeriu',
  `title` text COLLATE utf8_slovak_ci COMMENT 'nazov galerie',
  `description` text COLLATE utf8_slovak_ci COMMENT 'popis galerie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka galerii obrazkov';

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_image`
--

CREATE TABLE `module_image` (
  `id` int(11) NOT NULL COMMENT 'id obrazka',
  `module_id` int(11) DEFAULT NULL COMMENT 'id modulu pre obrazok',
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'nazov obrazka',
  `description` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'popis obrazka'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka modulov obrazkov';

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_link`
--

CREATE TABLE `module_link` (
  `id` int(11) NOT NULL COMMENT 'link id',
  `module_id` int(11) NOT NULL COMMENT 'modul pre link',
  `page_id` int(11) DEFAULT NULL COMMENT 'id internej stranky na ktoru ukazuje',
  `link` text COLLATE utf8_slovak_ci COMMENT 'odkaz',
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'titulka odkazu',
  `description` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'popis odkazu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='modul linku';

--
-- Sťahujem dáta pre tabuľku `module_link`
--

INSERT INTO `module_link` (`id`, `module_id`, `page_id`, `link`, `title`, `description`) VALUES
(7, 14, 3, '', 'link to home', 'asdf asdas d asd ');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_video`
--

CREATE TABLE `module_video` (
  `id` int(11) NOT NULL COMMENT 'id videa',
  `module_id` int(11) DEFAULT NULL COMMENT 'id modulu pre video',
  `title` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'nazov videa',
  `description` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'popis videa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL COMMENT 'id stranky',
  `status` int(11) DEFAULT NULL COMMENT 'ak je stranka viditelna status je 1 inak je nula',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'datum vytvorenia stranky',
  `edited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'datum editacie stranky',
  `created_by` int(11) DEFAULT NULL COMMENT 'id pouzivatela ktory vytvoril stranku ',
  `edited_by` int(11) DEFAULT NULL COMMENT 'id pouzivatela ktory naposledy editoval stranku',
  `title` text COLLATE utf8_slovak_ci NOT NULL,
  `description` text COLLATE utf8_slovak_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_home` tinyint(1) DEFAULT NULL COMMENT 'ak je stranka nastavena ako home',
  `in_navbar` tinyint(1) DEFAULT NULL COMMENT 'ak ma byt stranka zobrazena v navigacii'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `page`
--

INSERT INTO `page` (`id`, `status`, `created`, `edited`, `created_by`, `edited_by`, `title`, `description`, `category_id`, `is_home`, `in_navbar`) VALUES
(3, NULL, '2016-01-24 16:43:01', '2016-01-26 12:30:06', 1, 1, 'home', 'popis stranky na viacej riadkov kludne moze byt to uz ako clovek chce tak si zada rekuuuuu', 1, 1, 0),
(5, NULL, '2016-01-26 12:41:17', '2016-01-26 12:41:17', 1, 1, 'page 1', 'popis k page 1', 1, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `page_category`
--

CREATE TABLE `page_category` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `page_category`
--

INSERT INTO `page_category` (`id`, `title`, `description`) VALUES
(1, 'Kategoria 1', 'popis kategorie'),
(2, 'kategoria 2', 'popis 2');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_slovak_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='pomocna tabulka na skusanie dopytov';

--
-- Sťahujem dáta pre tabuľku `test`
--

INSERT INTO `test` (`id`, `text`, `date`) VALUES
(1, '', '2015-12-15 23:10:37');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'id pouzivatela',
  `email` varchar(255) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'email pouzivatela',
  `first_name` varchar(255) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'first_name' COMMENT 'meno pouzivatela',
  `last_name` varchar(255) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'last_name' COMMENT 'priezvisko pouzivatela',
  `admin` int(11) DEFAULT NULL COMMENT 'ak je pouzivatel administrator, hodnota musi byt 1',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'datum registracie pouzivatela',
  `bio` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'dodatocne informacie o pouzivatelovi',
  `password` varchar(80) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'prihlasovacie heslo pouzivatela',
  `deactivated` tinyint(1) DEFAULT '0' COMMENT 'ak je true tak je pouzivatel deaktivovany'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `admin`, `reg_date`, `bio`, `password`, `deactivated`) VALUES
(1, 'admin', 'Administrator', 'Administratorovic', 1, '2015-12-15 22:08:11', 'ja som taky velky admin muhahe', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `edit_rights`
--
ALTER TABLE `edit_rights`
  ADD KEY `page_id` (`page_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pre tabuľku `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexy pre tabuľku `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `edited_by` (`edited_by`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexy pre tabuľku `module_attachements`
--
ALTER TABLE `module_attachements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `module_embeded`
--
ALTER TABLE `module_embeded`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `module_formated`
--
ALTER TABLE `module_formated`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `module_gallery`
--
ALTER TABLE `module_gallery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `module_image`
--
ALTER TABLE `module_image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `module_link`
--
ALTER TABLE `module_link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexy pre tabuľku `module_video`
--
ALTER TABLE `module_video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexy pre tabuľku `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `edited_by` (`edited_by`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexy pre tabuľku `page_category`
--
ALTER TABLE `page_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pre tabuľku `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pre tabuľku `module_attachements`
--
ALTER TABLE `module_attachements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu';
--
-- AUTO_INCREMENT pre tabuľku `module_embeded`
--
ALTER TABLE `module_embeded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id embedovaneho videa';
--
-- AUTO_INCREMENT pre tabuľku `module_formated`
--
ALTER TABLE `module_formated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `module_gallery`
--
ALTER TABLE `module_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id galerie', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `module_image`
--
ALTER TABLE `module_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id obrazka', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pre tabuľku `module_link`
--
ALTER TABLE `module_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'link id', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pre tabuľku `module_video`
--
ALTER TABLE `module_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id videa';
--
-- AUTO_INCREMENT pre tabuľku `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id stranky', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pre tabuľku `page_category`
--
ALTER TABLE `page_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pouzivatela', AUTO_INCREMENT=2;
--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `edit_rights`
--
ALTER TABLE `edit_rights`
  ADD CONSTRAINT `edit_rights_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `edit_rights_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`edited_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `module_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_attachements`
--
ALTER TABLE `module_attachements`
  ADD CONSTRAINT `module_attachements_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_embeded`
--
ALTER TABLE `module_embeded`
  ADD CONSTRAINT `module_embeded_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_formated`
--
ALTER TABLE `module_formated`
  ADD CONSTRAINT `module_formated_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_gallery`
--
ALTER TABLE `module_gallery`
  ADD CONSTRAINT `module_gallery_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_image`
--
ALTER TABLE `module_image`
  ADD CONSTRAINT `module_image_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_link`
--
ALTER TABLE `module_link`
  ADD CONSTRAINT `module_link_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_link_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `module_video`
--
ALTER TABLE `module_video`
  ADD CONSTRAINT `module_video_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`edited_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `page_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `page_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
