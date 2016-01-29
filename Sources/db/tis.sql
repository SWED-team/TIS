-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Pi 29.Jan 2016, 19:20
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

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `edit_rights`
--

CREATE TABLE `edit_rights` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `edit_rights`
--

INSERT INTO `edit_rights` (`id`, `page_id`, `user_id`) VALUES
(54, 38, 15),
(55, 39, 15);

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
(59, NULL, 37, '', '', 'files/images/wallpapers/Anonymous-mask-Wallpaper-HD.jpg', 'filesthumb/images/wallpapers/Anonymous-mask-Wallpaper-HD.jpg', 'filesthumb_medium/images/wallpapers/Anonymous-mask-Wallpaper-HD.jpg'),
(60, NULL, 38, '', '', 'files/images/wallpapers/268678.jpg', 'filesthumb/images/wallpapers/268678.jpg', 'filesthumb_medium/images/wallpapers/268678.jpg'),
(61, 38, NULL, '', '', 'files/images/wallpapers/268678.jpg', 'filesthumb/images/wallpapers/268678.jpg', 'filesthumb_medium/images/wallpapers/268678.jpg'),
(63, 40, NULL, 'FarCry1.jpg', 'FarCry description obrazku 1', 'files/images/farcry/17909.jpg', 'filesthumb/images/farcry/17909.jpg', 'filesthumb_medium/images/farcry/17909.jpg'),
(64, 40, NULL, 'FarCry2.jpg', 'FarCry description obrazku 2', 'files/images/farcry/17910.jpg', 'filesthumb/images/farcry/17910.jpg', 'filesthumb_medium/images/farcry/17910.jpg'),
(65, 40, NULL, 'FarCry3.jpg', 'FarCry description obrazku 3', 'files/images/farcry/17912.jpg', 'filesthumb/images/farcry/17912.jpg', 'filesthumb_medium/images/farcry/17912.jpg'),
(66, 40, NULL, 'FarCry4.jpg', 'FarCry description obrazku 4', 'files/images/farcry/17913.jpg', 'filesthumb/images/farcry/17913.jpg', 'filesthumb_medium/images/farcry/17913.jpg'),
(69, 41, NULL, 'Specifikacia.pdf', 'Specifikacia robota', 'files/funkcionalne1.pdf', 'img/ico/pdf.jpg', 'img/ico/pdf.jpg'),
(70, 41, NULL, 'zdrojak.zip', 'zdrojove kody k robotovi', 'files/stiahnuta_jedna_stranka.zip', 'img/ico/zip.jpg', 'img/ico/zip.jpg'),
(71, NULL, 39, '', '', 'files/images/wallpapers/blue-sunset-wallpaper.jpg', 'filesthumb/images/wallpapers/blue-sunset-wallpaper.jpg', 'filesthumb_medium/images/wallpapers/blue-sunset-wallpaper.jpg'),
(72, 42, NULL, '', '', 'files/images/wallpapers/camera-wallpaper.jpg', 'filesthumb/images/wallpapers/camera-wallpaper.jpg', 'filesthumb_medium/images/wallpapers/camera-wallpaper.jpg'),
(73, 43, NULL, '', '', 'files/images/wallpapers/NIGHT_BOAT_HD-wallpaper-10377122.jpg', 'filesthumb/images/wallpapers/NIGHT_BOAT_HD-wallpaper-10377122.jpg', 'filesthumb_medium/images/wallpapers/NIGHT_BOAT_HD-wallpaper-10377122.jpg'),
(74, 44, NULL, '', '', 'files/images/wallpapers/115708.jpg', 'filesthumb/images/wallpapers/115708.jpg', 'filesthumb_medium/images/wallpapers/115708.jpg'),
(75, 45, NULL, '', '', 'files/images/wallpapers/2011-eleanor.jpg', 'filesthumb/images/wallpapers/2011-eleanor.jpg', 'filesthumb_medium/images/wallpapers/2011-eleanor.jpg'),
(76, 46, NULL, '', '', 'files/images/wallpapers/10.jpg', 'filesthumb/images/wallpapers/10.jpg', 'filesthumb_medium/images/wallpapers/10.jpg'),
(77, 47, NULL, '', '', 'files/images/wallpapers/1f9340acdcb0a8f56641e93dee73bb36.jpg', 'filesthumb/images/wallpapers/1f9340acdcb0a8f56641e93dee73bb36.jpg', 'filesthumb_medium/images/wallpapers/1f9340acdcb0a8f56641e93dee73bb36.jpg'),
(78, 48, NULL, '', '', 'files/images/github-logo.jpg', 'filesthumb/images/github-logo.jpg', 'filesthumb_medium/images/github-logo.jpg'),
(79, 50, NULL, '', '', 'files/videos/Snoop-Dogg--Wiz-Khalifa---Young-Wild-and-Free-ft.-Bruno-Mars.mp4', 'img/ico/mp4.jpg', 'img/ico/mp4.jpg'),
(96, 53, NULL, '', '', 'files/images/wallpapers/6cafebe05984a9817c2ddb440ac883be_large.jpeg', 'filesthumb/images/wallpapers/6cafebe05984a9817c2ddb440ac883be_large.jpeg', 'filesthumb_medium/images/wallpapers/6cafebe05984a9817c2ddb440ac883be_large.jpeg'),
(97, 54, NULL, '', '', 'files/images/farcry/17909.jpg', 'filesthumb/images/farcry/17909.jpg', 'filesthumb_medium/images/farcry/17909.jpg'),
(103, 51, NULL, 'Excel.xlsx', 'Excel dok', 'files/prilohy/Excel.xlsx', 'img/ico/xlsx.jpg', 'img/ico/xlsx.jpg'),
(104, 51, NULL, 'Dokument.docx', 'Word document ', 'files/prilohy/Dokument.docx', 'img/ico/docx.jpg', 'img/ico/docx.jpg'),
(105, 51, NULL, 'specification-en.pdf', 'PDF document ', 'files/prilohy/specification-en.pdf', 'img/ico/pdf.jpg', 'img/ico/pdf.jpg'),
(106, 51, NULL, 'PowerPoint.pptx', 'PowerPoint dokument', 'files/prilohy/PowerPoint.pptx', 'img/ico/pptx.jpg', 'img/ico/pptx.jpg'),
(107, 51, NULL, 'dokumentacia.zip', 'Dokumentacia k tomuto projektu', 'files/dokumentacia/dokumentacia.zip', 'img/ico/zip.jpg', 'img/ico/zip.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL COMMENT 'id modulu',
  `page_id` int(11) DEFAULT NULL COMMENT 'id stranky na ktorej je modul umiestneny',
  `type` varchar(20) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'typ modulu',
  `created` datetime DEFAULT NULL COMMENT 'datum vytvorenia',
  `edited` datetime DEFAULT NULL COMMENT 'datum editovania',
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
(37, 38, 'module_embeded', '2016-01-29 18:14:03', '2016-01-29 18:14:03', 1, 1, 2, 2, 1, 1),
(38, 38, 'module_image', '2016-01-29 18:15:20', '2016-01-29 18:22:32', 1, 1, 2, 2, 2, 1),
(40, 38, 'module_gallery', '2016-01-29 18:17:48', '2016-01-29 18:17:48', 1, 1, 2, 4, 3, 1),
(41, 38, 'module_attachements', '2016-01-29 18:21:23', '2016-01-29 18:21:33', 1, 1, 1, 1, 4, 1),
(42, 39, 'module_image', '2016-01-29 18:24:55', '2016-01-29 18:28:40', 1, 1, 2, 2, 1, 1),
(43, 39, 'module_image', '2016-01-29 18:25:02', '2016-01-29 18:25:21', 1, 1, 1, 1, 2, 1),
(44, 39, 'module_image', '2016-01-29 18:25:51', '2016-01-29 18:25:51', 1, 1, 1, 1, 3, 1),
(45, 39, 'module_image', '2016-01-29 18:26:35', '2016-01-29 18:26:35', 1, 1, 1, 1, 4, 1),
(46, 39, 'module_image', '2016-01-29 18:27:05', '2016-01-29 18:27:05', 1, 1, 1, 1, 5, 1),
(47, 39, 'module_image', '2016-01-29 18:27:50', '2016-01-29 18:28:03', 1, 1, 4, 4, 6, 1),
(48, 37, 'module_link', '2016-01-29 18:32:16', '2016-01-29 18:59:49', 1, 1, 2, 1, 1, 1),
(49, 37, 'module_formated', '2016-01-29 18:36:47', '2016-01-29 18:37:09', 1, 1, 2, 2, 2, 1),
(50, 37, 'module_video', '2016-01-29 18:52:26', '2016-01-29 19:13:46', 1, 1, 2, 4, 3.5, 1),
(51, 37, 'module_attachements', '2016-01-29 19:05:02', '2016-01-29 19:19:09', 1, 1, 2, 1, 2.75, 1),
(53, 37, 'module_link', '2016-01-29 19:15:58', '2016-01-29 19:18:38', 1, 1, 1, 2, 4.5, 1),
(54, 37, 'module_link', '2016-01-29 19:16:37', '2016-01-29 19:17:24', 1, 1, 1, 2, 5.5, 1);

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

--
-- Sťahujem dáta pre tabuľku `module_attachements`
--

INSERT INTO `module_attachements` (`id`, `module_id`, `title`, `description`) VALUES
(1, 41, 'Prílohy', 'Dokumentacie k robotovi\r\n'),
(2, 51, 'Prilohy', 'Prilohove subory');

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

--
-- Sťahujem dáta pre tabuľku `module_embeded`
--

INSERT INTO `module_embeded` (`id`, `module_id`, `link`, `title`, `description`) VALUES
(1, 37, '<iframe width="560" height="315" src="https://www.youtube.com/embed/8hYlB38asDY?showinfo=0" frameborder="0" allowfullscreen></iframe>', 'Iron Man Trailer', '');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `module_formated`
--

CREATE TABLE `module_formated` (
  `id` int(11) NOT NULL COMMENT 'id modulu',
  `module_id` int(11) NOT NULL COMMENT 'id modulu pre formatovany text ',
  `content` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'formatovany text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='modul formatovaneho textu';

--
-- Sťahujem dáta pre tabuľku `module_formated`
--

INSERT INTO `module_formated` (`id`, `module_id`, `content`) VALUES
(14, 49, '<h2 style="font-style:italic"><strong>Toto je ukazka formated textu</strong></h2>\r\n\r\n<p><strong>Zoznam:</strong></p>\r\n\r\n<ul>\r\n	<li>prvy prvok</li>\r\n	<li>druhy</li>\r\n	<li>treti</li>\r\n</ul>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" style="width:200px">\r\n	<caption>Tabulka</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td>Okno</td>\r\n			<td>zahrada</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dvere</td>\r\n			<td>dvor</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Zahrada</td>\r\n			<td>chodba</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n');

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

--
-- Sťahujem dáta pre tabuľku `module_gallery`
--

INSERT INTO `module_gallery` (`id`, `module_id`, `title`, `description`) VALUES
(1, 40, 'FarCry Gallery', 'FarCry Gallerka ktora osahuje zopar wallpaperov');

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

--
-- Sťahujem dáta pre tabuľku `module_image`
--

INSERT INTO `module_image` (`id`, `module_id`, `title`, `description`) VALUES
(2, 38, 'Robot', 'Ultronova žena'),
(4, 42, 'Obrazok1', 'Fotoaparat'),
(5, 43, 'Obrazok1', 'Fotoaparat'),
(6, 44, 'Obrazok 2', 'lyziar'),
(7, 45, 'Mustang', 'Mustang'),
(8, 46, 'Abstract', 'Abstract Wallpaper'),
(9, 47, 'Bike', 'Bike description');

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
(1, 48, NULL, 'https://github.com/SWED-team/TIS', 'GitHUB', 'Linka na repozitar na githube'),
(2, 53, 39, NULL, 'Odkaz na stránku s obrázkami', 'popis linku na túto stránku nieje definovaný loremom ipsum tak je tu len nejaký nezmyselný text :)'),
(3, 54, 38, NULL, 'Stránka v kategórií robot - Ultron', '');

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

--
-- Sťahujem dáta pre tabuľku `module_video`
--

INSERT INTO `module_video` (`id`, `module_id`, `title`, `description`) VALUES
(1, 50, 'Snoop Dogg', 'Pesnicka');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL COMMENT 'id stranky',
  `status` int(11) DEFAULT NULL COMMENT 'ak je stranka viditelna status je 1 inak je nula',
  `created` datetime DEFAULT NULL COMMENT 'datum vytvorenia stranky',
  `edited` datetime DEFAULT NULL COMMENT 'datum editacie stranky',
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
(37, 1, '2016-01-29 18:05:51', '2016-01-29 18:05:51', 1, 1, 'Home', 'HomePage description', 9, 1, NULL),
(38, 1, '2016-01-29 18:08:43', '2016-01-29 18:09:29', 1, 1, 'Ultron', 'Stránka sa zaobera robotom Ultron ktorý vznikol chybou ktrorú urobil Tony Stark', 4, NULL, NULL),
(39, 1, '2016-01-29 18:24:05', '2016-01-29 18:24:05', 1, 1, 'Obrázky Robotov', 'Tato stárnka obsahuje iba moduly image', 4, NULL, NULL);

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
(4, 'Robots', ''),
(5, 'Contests', ''),
(6, 'Research', ''),
(7, 'Teaching', ''),
(8, 'Student theses and projects', ''),
(9, 'Other', '');

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
  `reg_date` datetime NOT NULL COMMENT 'datum registracie pouzivatela',
  `bio` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'dodatocne informacie o pouzivatelovi',
  `password` varchar(80) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'prihlasovacie heslo pouzivatela',
  `deactivated` tinyint(1) DEFAULT '0' COMMENT 'ak je true tak je pouzivatel deaktivovany'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `admin`, `reg_date`, `bio`, `password`, `deactivated`) VALUES
(1, 'admin', 'Administrator', 'Administrator', 1, '2015-12-15 22:08:11', 'Tento pouzivatel je administrator', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0),
(15, 'martin.krasnan@gmail.com', 'Martin', 'Krasňan', 0, '2016-01-29 17:48:48', '', '5605370fe15f2eacd7b07fbf0a4717293052192f22066a81c6ad64a29627962e', 0);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `edit_rights`
--
ALTER TABLE `edit_rights`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT pre tabuľku `edit_rights`
--
ALTER TABLE `edit_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pre tabuľku `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT pre tabuľku `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu', AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pre tabuľku `module_attachements`
--
ALTER TABLE `module_attachements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `module_embeded`
--
ALTER TABLE `module_embeded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id embedovaneho videa', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `module_formated`
--
ALTER TABLE `module_formated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id modulu', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pre tabuľku `module_gallery`
--
ALTER TABLE `module_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id galerie', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `module_image`
--
ALTER TABLE `module_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id obrazka', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `module_link`
--
ALTER TABLE `module_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'link id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `module_video`
--
ALTER TABLE `module_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id videa', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id stranky', AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pre tabuľku `page_category`
--
ALTER TABLE `page_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pouzivatela', AUTO_INCREMENT=16;
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
