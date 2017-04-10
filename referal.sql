-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 10 2017 г., 18:23
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `referal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `aboutus`
--

INSERT INTO `aboutus` (`id`, `title`, `short_description`, `description`) VALUES
(1, 'Lorem Ispum222', '<p>fsadfdfsdfasdfasdfasdfasdf aasadfsdfasdfasdfasdfasdfsa asdfsafasdfsadf sadfadfsdfas sadfsdfsdfasd asdfsadfasdf &nbsp;fsadfdfsdfasdfasdfasdfasdf aasadfsdfasdfasdfasdfasdfsa asdfsafasdfsadf sadfadfsdfas sadfsdfsdfasd asdfsadfasdf&nbsp;</p>\r\n', '<p>Lorem IspumLorem IspumLorem Ispum&nbsp;Lorem IspumLorem IspumLorem IspumLorem IspumLorem Ispum</p>\r\n\r\n<p>Lorem IspumLorem IspumLorem IspumLorem Ispum&nbsp;Lorem IspumLorem IspumLorem IspumLorem Ispum</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `blog_category_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `coordinate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contactus`
--

INSERT INTO `contactus` (`id`, `phone`, `mobile_phone`, `fax`, `email`, `coordinate`) VALUES
(1, '12-31-3213-1313', '+33 1 23 13 13 13', 'xzcvxzcv', 'xzcvxzcvxc', '500');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `top` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `path`, `category`, `category_id`, `mime`, `created_at`, `updated_at`, `top`) VALUES
(1, '149139873458e4f04ec28cb9.86656492_0.jpg', 'blog', 7, '', '2017-04-05 13:25:35', '0000-00-00 00:00:00', 1),
(2, '149139873558e4f04f33bca6.36168378_1.jpg', 'blog', 7, '', '2017-04-05 13:25:35', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `short_code` varchar(250) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `is_default` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `name`, `short_code`, `ordering`, `is_default`) VALUES
(1, 'Rus', 'ru', 1, 1),
(2, 'Eng', 'en', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(2, 'ru', 'xcvbcvbcv'),
(3, 'am', 'Մեր մասին'),
(3, 'en', 'ABOUT US'),
(3, 'ru', 'О Нас'),
(4, 'am', 'Միջոցառում'),
(4, 'en', 'EVENTS'),
(4, 'ru', 'Мероприятия');

-- --------------------------------------------------------

--
-- Структура таблицы `message_system`
--

CREATE TABLE `message_system` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL COMMENT 'User who sent message',
  `recipient_user_id` int(11) NOT NULL COMMENT 'User who get message',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL COMMENT 'Is message read',
  `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `status` int(1) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `type` int(2) DEFAULT NULL,
  `short_description` varchar(255) NOT NULL,
  `route_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `status`, `parent_id`, `ordering`, `created_date`, `updated_date`, `type`, `short_description`, `route_name`) VALUES
(1, 'cxvz zxcv', 'xcbxcvb', 1, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'vbxcb', 'cxvz-zxcv');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE `slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `source_message`
--

CREATE TABLE `source_message` (
  `id` int(11) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'app',
  `message` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(3, 'app', 'ABOUT US'),
(4, 'app', 'EVENTS');

-- --------------------------------------------------------

--
-- Структура таблицы `tr_blog`
--

CREATE TABLE `tr_blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tr_blog_categories`
--

CREATE TABLE `tr_blog_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `blog_categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tr_news`
--

CREATE TABLE `tr_news` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tr_pages`
--

CREATE TABLE `tr_pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pages_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `short_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tr_pages`
--

INSERT INTO `tr_pages` (`id`, `title`, `content`, `pages_id`, `language_id`, `short_description`) VALUES
(1, 'cxvz zxcv', 'xcbxcvb', 1, 1, 'vbxcb');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bio` text,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `password_token` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `social_type` varchar(255) DEFAULT NULL,
  `social_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `remember_token`, `created`, `updated`, `deleted_at`, `bio`, `gender`, `dob`, `pic`, `country`, `state`, `city`, `address`, `postal`, `auth_key`, `role`, `password_token`, `api_key`, `social_type`, `social_id`) VALUES
(1, 'admin123', 'info@termoros.am', '$2y$13$/LJHW5TgflHq.P62ek8/lObb2E4ui0V0FCKeM8JdysaA5w0bWu/n2', NULL, '0000-00-00 00:00:00', '2017-03-04 15:25:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zJIqL7C9wyCHbcwbugyZr-jT9zEYdcQ1', 0, '', NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `blog_category_id` (`blog_category_id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Индексы таблицы `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`language`),
  ADD KEY `idx_message_language` (`language`);

--
-- Индексы таблицы `message_system`
--
ALTER TABLE `message_system`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `source_message`
--
ALTER TABLE `source_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tr_blog`
--
ALTER TABLE `tr_blog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tr_blog_categories`
--
ALTER TABLE `tr_blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `blog_categories_id` (`blog_categories_id`);

--
-- Индексы таблицы `tr_news`
--
ALTER TABLE `tr_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tr_pages`
--
ALTER TABLE `tr_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_page_pages_id` (`pages_id`),
  ADD KEY `fk_page_language_id` (`language_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `message_system`
--
ALTER TABLE `message_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `source_message`
--
ALTER TABLE `source_message`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `tr_blog`
--
ALTER TABLE `tr_blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tr_blog_categories`
--
ALTER TABLE `tr_blog_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tr_news`
--
ALTER TABLE `tr_news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tr_pages`
--
ALTER TABLE `tr_pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
