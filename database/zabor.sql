-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2016 at 03:24 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.6.17-3+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zabor`
--

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_admin`
--

CREATE TABLE IF NOT EXISTS `zabor_t_admin` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_name` varchar(100) NOT NULL,
  `s_username` varchar(40) NOT NULL,
  `s_password` char(60) NOT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_secret` varchar(40) DEFAULT NULL,
  `b_moderator` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_i_id`),
  UNIQUE KEY `s_username` (`s_username`),
  UNIQUE KEY `s_email` (`s_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_alerts`
--

CREATE TABLE IF NOT EXISTS `zabor_t_alerts` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_email` varchar(100) DEFAULT NULL,
  `fk_i_user_id` int(10) unsigned DEFAULT NULL,
  `s_search` longtext,
  `s_secret` varchar(40) DEFAULT NULL,
  `b_active` tinyint(1) NOT NULL DEFAULT '0',
  `e_type` enum('INSTANT','HOURLY','DAILY','WEEKLY','CUSTOM') NOT NULL,
  `dt_date` datetime DEFAULT NULL,
  `dt_unsub_date` datetime DEFAULT NULL,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_alerts_sent`
--

CREATE TABLE IF NOT EXISTS `zabor_t_alerts_sent` (
  `d_date` date NOT NULL,
  `i_num_alerts_sent` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`d_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_banners`
--

CREATE TABLE IF NOT EXISTS `zabor_t_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(4000) NOT NULL,
  `image_url` varchar(4000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_ban_rule`
--

CREATE TABLE IF NOT EXISTS `zabor_t_ban_rule` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_name` varchar(250) NOT NULL DEFAULT '',
  `s_ip` varchar(50) NOT NULL DEFAULT '',
  `s_email` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_category`
--

CREATE TABLE IF NOT EXISTS `zabor_t_category` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_parent_id` int(10) unsigned DEFAULT NULL,
  `i_expiration_days` int(3) unsigned NOT NULL DEFAULT '0',
  `i_position` int(2) unsigned NOT NULL DEFAULT '0',
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `b_price_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `s_icon` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_parent_id` (`fk_i_parent_id`),
  KEY `i_position` (`i_position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=262 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_category_description`
--

CREATE TABLE IF NOT EXISTS `zabor_t_category_description` (
  `fk_i_category_id` int(10) unsigned NOT NULL,
  `fk_c_locale_code` char(5) NOT NULL,
  `s_name` varchar(100) DEFAULT NULL,
  `s_description` text,
  `s_slug` varchar(100) NOT NULL,
  PRIMARY KEY (`fk_i_category_id`,`fk_c_locale_code`),
  KEY `idx_s_slug` (`s_slug`),
  KEY `fk_c_locale_code` (`fk_c_locale_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_category_stats`
--

CREATE TABLE IF NOT EXISTS `zabor_t_category_stats` (
  `fk_i_category_id` int(10) unsigned NOT NULL,
  `i_num_items` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fk_i_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_city`
--

CREATE TABLE IF NOT EXISTS `zabor_t_city` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_region_id` int(10) unsigned NOT NULL,
  `s_name` varchar(60) NOT NULL,
  `s_slug` varchar(60) NOT NULL DEFAULT '',
  `fk_c_country_code` char(2) DEFAULT NULL,
  `b_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_region_id` (`fk_i_region_id`),
  KEY `idx_s_name` (`s_name`),
  KEY `idx_s_slug` (`s_slug`),
  KEY `fk_c_country_code` (`fk_c_country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_city_area`
--

CREATE TABLE IF NOT EXISTS `zabor_t_city_area` (
  `pk_i_id` int(10) unsigned NOT NULL,
  `fk_i_city_id` int(10) unsigned NOT NULL,
  `s_name` varchar(255) NOT NULL,
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_city_id` (`fk_i_city_id`),
  KEY `idx_s_name` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_city_stats`
--

CREATE TABLE IF NOT EXISTS `zabor_t_city_stats` (
  `fk_i_city_id` int(10) unsigned NOT NULL,
  `i_num_items` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fk_i_city_id`),
  KEY `idx_num_items` (`i_num_items`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_country`
--

CREATE TABLE IF NOT EXISTS `zabor_t_country` (
  `pk_c_code` char(2) NOT NULL,
  `s_name` varchar(80) NOT NULL,
  `s_slug` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_c_code`),
  KEY `idx_s_slug` (`s_slug`),
  KEY `idx_s_name` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_country_stats`
--

CREATE TABLE IF NOT EXISTS `zabor_t_country_stats` (
  `fk_c_country_code` char(2) NOT NULL,
  `i_num_items` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fk_c_country_code`),
  KEY `idx_num_items` (`i_num_items`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_cron`
--

CREATE TABLE IF NOT EXISTS `zabor_t_cron` (
  `e_type` enum('INSTANT','HOURLY','DAILY','WEEKLY','CUSTOM') NOT NULL,
  `d_last_exec` datetime NOT NULL,
  `d_next_exec` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_currency`
--

CREATE TABLE IF NOT EXISTS `zabor_t_currency` (
  `pk_c_code` char(3) NOT NULL,
  `s_name` varchar(40) NOT NULL,
  `s_description` varchar(80) DEFAULT NULL,
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_c_code`),
  UNIQUE KEY `s_name` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_facebook_connect`
--

CREATE TABLE IF NOT EXISTS `zabor_t_facebook_connect` (
  `fk_i_user_id` int(10) unsigned NOT NULL,
  `i_facebook_uid` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`fk_i_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_user_id` int(10) unsigned DEFAULT NULL,
  `fk_i_category_id` int(10) unsigned NOT NULL,
  `dt_pub_date` datetime NOT NULL,
  `dt_mod_date` datetime DEFAULT NULL,
  `f_price` float DEFAULT NULL,
  `i_price` bigint(20) DEFAULT NULL,
  `fk_c_currency_code` char(3) DEFAULT NULL,
  `s_contact_name` varchar(100) DEFAULT NULL,
  `s_contact_email` varchar(140) DEFAULT NULL,
  `s_contact_phone` varchar(45) DEFAULT NULL,
  `s_ip` varchar(64) NOT NULL DEFAULT '',
  `b_premium` tinyint(1) NOT NULL DEFAULT '0',
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `b_active` tinyint(1) NOT NULL DEFAULT '0',
  `b_spam` tinyint(1) NOT NULL DEFAULT '0',
  `s_secret` varchar(40) DEFAULT NULL,
  `b_show_email` tinyint(1) DEFAULT NULL,
  `dt_expiration` datetime NOT NULL DEFAULT '9999-12-31 23:59:59',
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_user_id` (`fk_i_user_id`),
  KEY `idx_s_contact_email` (`s_contact_email`(10)),
  KEY `fk_i_category_id` (`fk_i_category_id`),
  KEY `fk_c_currency_code` (`fk_c_currency_code`),
  KEY `idx_pub_date` (`dt_pub_date`),
  KEY `idx_price` (`i_price`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86717 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_comment`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_comment` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `dt_pub_date` datetime NOT NULL,
  `s_title` varchar(200) NOT NULL,
  `s_author_name` varchar(100) NOT NULL,
  `s_author_email` varchar(100) NOT NULL,
  `s_body` text NOT NULL,
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `b_active` tinyint(1) NOT NULL DEFAULT '0',
  `b_spam` tinyint(1) NOT NULL DEFAULT '0',
  `fk_i_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_item_id` (`fk_i_item_id`),
  KEY `fk_i_user_id` (`fk_i_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_description`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_description` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `fk_c_locale_code` char(5) NOT NULL,
  `s_title` varchar(100) NOT NULL,
  `s_description` mediumtext NOT NULL,
  PRIMARY KEY (`fk_i_item_id`,`fk_c_locale_code`),
  FULLTEXT KEY `s_description` (`s_description`,`s_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_location`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_location` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `fk_c_country_code` char(2) DEFAULT NULL,
  `s_country` varchar(40) DEFAULT NULL,
  `s_address` varchar(100) DEFAULT NULL,
  `s_zip` varchar(15) DEFAULT NULL,
  `fk_i_region_id` int(10) unsigned DEFAULT NULL,
  `s_region` varchar(100) DEFAULT NULL,
  `fk_i_city_id` int(10) unsigned DEFAULT NULL,
  `s_city` varchar(100) DEFAULT NULL,
  `fk_i_city_area_id` int(10) unsigned DEFAULT NULL,
  `s_city_area` varchar(200) DEFAULT NULL,
  `d_coord_lat` decimal(10,6) DEFAULT NULL,
  `d_coord_long` decimal(10,6) DEFAULT NULL,
  PRIMARY KEY (`fk_i_item_id`),
  KEY `fk_c_country_code` (`fk_c_country_code`),
  KEY `fk_i_region_id` (`fk_i_region_id`),
  KEY `fk_i_city_id` (`fk_i_city_id`),
  KEY `fk_i_city_area_id` (`fk_i_city_area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_meta`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_meta` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `fk_i_field_id` int(10) unsigned NOT NULL,
  `s_value` text,
  `s_multi` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`fk_i_item_id`,`fk_i_field_id`,`s_multi`),
  KEY `s_value` (`s_value`(255)),
  KEY `fk_i_field_id` (`fk_i_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_resource`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_resource` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `s_name` varchar(60) DEFAULT NULL,
  `s_extension` varchar(10) DEFAULT NULL,
  `s_content_type` varchar(40) DEFAULT NULL,
  `s_path` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_i_item_id` (`fk_i_item_id`),
  KEY `idx_s_content_type` (`pk_i_id`,`s_content_type`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101043 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_stats`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_stats` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `i_num_views` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_spam` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_repeated` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_bad_classified` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_offensive` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_expired` int(10) unsigned NOT NULL DEFAULT '0',
  `i_num_premium_views` int(10) unsigned NOT NULL DEFAULT '0',
  `dt_date` date NOT NULL,
  PRIMARY KEY (`fk_i_item_id`,`dt_date`),
  KEY `dt_date` (`dt_date`,`fk_i_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_item_youtube`
--

CREATE TABLE IF NOT EXISTS `zabor_t_item_youtube` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
  `s_youtube` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`fk_i_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_keywords`
--

CREATE TABLE IF NOT EXISTS `zabor_t_keywords` (
  `s_md5` varchar(32) NOT NULL,
  `fk_c_locale_code` char(5) NOT NULL,
  `s_original_text` varchar(255) NOT NULL,
  `s_anchor_text` varchar(255) NOT NULL,
  `s_normalized_text` varchar(255) NOT NULL,
  `fk_i_category_id` int(10) unsigned DEFAULT NULL,
  `fk_i_city_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`s_md5`,`fk_c_locale_code`),
  KEY `fk_i_category_id` (`fk_i_category_id`),
  KEY `fk_i_city_id` (`fk_i_city_id`),
  KEY `fk_c_locale_code` (`fk_c_locale_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_latest_searches`
--

CREATE TABLE IF NOT EXISTS `zabor_t_latest_searches` (
  `d_date` datetime NOT NULL,
  `s_search` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_locale`
--

CREATE TABLE IF NOT EXISTS `zabor_t_locale` (
  `pk_c_code` char(5) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_short_name` varchar(40) NOT NULL,
  `s_description` varchar(100) NOT NULL,
  `s_version` varchar(20) NOT NULL,
  `s_author_name` varchar(100) NOT NULL,
  `s_author_url` varchar(100) NOT NULL,
  `s_currency_format` varchar(50) NOT NULL,
  `s_dec_point` varchar(2) DEFAULT '.',
  `s_thousands_sep` varchar(2) DEFAULT '',
  `i_num_dec` tinyint(4) DEFAULT '2',
  `s_date_format` varchar(20) NOT NULL,
  `s_stop_words` text,
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `b_enabled_bo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_c_code`),
  UNIQUE KEY `s_short_name` (`s_short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_locations_tmp`
--

CREATE TABLE IF NOT EXISTS `zabor_t_locations_tmp` (
  `id_location` varchar(10) NOT NULL,
  `e_type` enum('COUNTRY','REGION','CITY') NOT NULL,
  PRIMARY KEY (`id_location`,`e_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_log`
--

CREATE TABLE IF NOT EXISTS `zabor_t_log` (
  `dt_date` datetime NOT NULL,
  `s_section` varchar(50) NOT NULL,
  `s_action` varchar(50) NOT NULL,
  `fk_i_id` int(10) unsigned NOT NULL,
  `s_data` varchar(250) NOT NULL,
  `s_ip` varchar(50) NOT NULL,
  `s_who` varchar(50) NOT NULL,
  `fk_i_who_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_meta_categories`
--

CREATE TABLE IF NOT EXISTS `zabor_t_meta_categories` (
  `fk_i_category_id` int(10) unsigned NOT NULL,
  `fk_i_field_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fk_i_category_id`,`fk_i_field_id`),
  KEY `fk_i_field_id` (`fk_i_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_meta_fields`
--

CREATE TABLE IF NOT EXISTS `zabor_t_meta_fields` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) NOT NULL,
  `s_slug` varchar(255) NOT NULL,
  `e_type` enum('TEXT','TEXTAREA','DROPDOWN','RADIO','CHECKBOX','URL','DATE','DATEINTERVAL') NOT NULL DEFAULT 'TEXT',
  `s_options` varchar(255) DEFAULT NULL,
  `b_required` tinyint(1) NOT NULL DEFAULT '0',
  `b_searchable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_multicurrency`
--

CREATE TABLE IF NOT EXISTS `zabor_t_multicurrency` (
  `s_from` varchar(3) NOT NULL,
  `s_to` varchar(3) NOT NULL,
  `f_rate` float DEFAULT '1',
  `dt_date` datetime NOT NULL,
  PRIMARY KEY (`s_from`,`s_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_pages`
--

CREATE TABLE IF NOT EXISTS `zabor_t_pages` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_internal_name` varchar(50) DEFAULT NULL,
  `b_indelible` tinyint(1) NOT NULL DEFAULT '0',
  `b_link` tinyint(1) NOT NULL DEFAULT '1',
  `dt_pub_date` datetime NOT NULL,
  `dt_mod_date` datetime DEFAULT NULL,
  `i_order` int(3) NOT NULL DEFAULT '0',
  `s_meta` text,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_pages_description`
--

CREATE TABLE IF NOT EXISTS `zabor_t_pages_description` (
  `fk_i_pages_id` int(10) unsigned NOT NULL,
  `fk_c_locale_code` char(5) NOT NULL,
  `s_title` varchar(255) NOT NULL,
  `s_text` text,
  PRIMARY KEY (`fk_i_pages_id`,`fk_c_locale_code`),
  KEY `fk_c_locale_code` (`fk_c_locale_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_plugin_category`
--

CREATE TABLE IF NOT EXISTS `zabor_t_plugin_category` (
  `s_plugin_name` varchar(40) NOT NULL,
  `fk_i_category_id` int(10) unsigned NOT NULL,
  KEY `fk_i_category_id` (`fk_i_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_preference`
--

CREATE TABLE IF NOT EXISTS `zabor_t_preference` (
  `s_section` varchar(40) NOT NULL,
  `s_name` varchar(40) NOT NULL,
  `s_value` longtext NOT NULL,
  `e_type` enum('STRING','INTEGER','BOOLEAN') NOT NULL,
  UNIQUE KEY `s_section` (`s_section`,`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_region`
--

CREATE TABLE IF NOT EXISTS `zabor_t_region` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_c_country_code` char(2) NOT NULL,
  `s_name` varchar(60) NOT NULL,
  `s_slug` varchar(60) NOT NULL DEFAULT '',
  `b_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_i_id`),
  KEY `fk_c_country_code` (`fk_c_country_code`),
  KEY `idx_s_name` (`s_name`),
  KEY `idx_s_slug` (`s_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_region_stats`
--

CREATE TABLE IF NOT EXISTS `zabor_t_region_stats` (
  `fk_i_region_id` int(10) unsigned NOT NULL,
  `i_num_items` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fk_i_region_id`),
  KEY `idx_num_items` (`i_num_items`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_user`
--

CREATE TABLE IF NOT EXISTS `zabor_t_user` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dt_reg_date` datetime NOT NULL,
  `dt_mod_date` datetime DEFAULT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_username` varchar(100) NOT NULL,
  `s_password` char(60) NOT NULL,
  `s_secret` varchar(40) DEFAULT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_website` varchar(100) DEFAULT NULL,
  `s_phone_land` varchar(45) DEFAULT NULL,
  `s_phone_mobile` varchar(45) DEFAULT NULL,
  `b_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `b_active` tinyint(1) NOT NULL DEFAULT '0',
  `s_pass_code` varchar(100) DEFAULT NULL,
  `s_pass_date` datetime DEFAULT NULL,
  `s_pass_ip` varchar(15) DEFAULT NULL,
  `fk_c_country_code` char(2) DEFAULT NULL,
  `s_country` varchar(40) DEFAULT NULL,
  `s_address` varchar(100) DEFAULT NULL,
  `s_zip` varchar(15) DEFAULT NULL,
  `fk_i_region_id` int(10) unsigned DEFAULT NULL,
  `s_region` varchar(100) DEFAULT NULL,
  `fk_i_city_id` int(10) unsigned DEFAULT NULL,
  `s_city` varchar(100) DEFAULT NULL,
  `fk_i_city_area_id` int(10) unsigned DEFAULT NULL,
  `s_city_area` varchar(200) DEFAULT NULL,
  `d_coord_lat` decimal(10,6) DEFAULT NULL,
  `d_coord_long` decimal(10,6) DEFAULT NULL,
  `b_company` tinyint(1) NOT NULL DEFAULT '0',
  `i_items` int(10) unsigned DEFAULT '0',
  `i_comments` int(10) unsigned DEFAULT '0',
  `dt_access_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_access_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_i_id`),
  UNIQUE KEY `s_email` (`s_email`),
  KEY `idx_s_name` (`s_name`(6)),
  KEY `idx_s_username` (`s_username`),
  KEY `fk_c_country_code` (`fk_c_country_code`),
  KEY `fk_i_region_id` (`fk_i_region_id`),
  KEY `fk_i_city_id` (`fk_i_city_id`),
  KEY `fk_i_city_area_id` (`fk_i_city_area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1811 ;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_user_description`
--

CREATE TABLE IF NOT EXISTS `zabor_t_user_description` (
  `fk_i_user_id` int(10) unsigned NOT NULL,
  `fk_c_locale_code` char(5) NOT NULL,
  `s_info` text,
  PRIMARY KEY (`fk_i_user_id`,`fk_c_locale_code`),
  KEY `fk_c_locale_code` (`fk_c_locale_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_user_email_tmp`
--

CREATE TABLE IF NOT EXISTS `zabor_t_user_email_tmp` (
  `fk_i_user_id` int(10) unsigned NOT NULL,
  `s_new_email` varchar(100) NOT NULL,
  `dt_date` datetime NOT NULL,
  PRIMARY KEY (`fk_i_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zabor_t_widget`
--

CREATE TABLE IF NOT EXISTS `zabor_t_widget` (
  `pk_i_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_description` varchar(40) NOT NULL,
  `s_location` varchar(40) NOT NULL,
  `e_kind` enum('TEXT','HTML') NOT NULL,
  `s_content` mediumtext NOT NULL,
  PRIMARY KEY (`pk_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zabor_t_meta_categories`
--
ALTER TABLE `zabor_t_meta_categories`
  ADD CONSTRAINT `zabor_t_meta_categories_ibfk_1` FOREIGN KEY (`fk_i_category_id`) REFERENCES `zabor_t_category` (`pk_i_id`),
  ADD CONSTRAINT `zabor_t_meta_categories_ibfk_2` FOREIGN KEY (`fk_i_field_id`) REFERENCES `zabor_t_meta_fields` (`pk_i_id`);

--
-- Constraints for table `zabor_t_pages_description`
--
ALTER TABLE `zabor_t_pages_description`
  ADD CONSTRAINT `zabor_t_pages_description_ibfk_1` FOREIGN KEY (`fk_i_pages_id`) REFERENCES `zabor_t_pages` (`pk_i_id`),
  ADD CONSTRAINT `zabor_t_pages_description_ibfk_2` FOREIGN KEY (`fk_c_locale_code`) REFERENCES `zabor_t_locale` (`pk_c_code`);

--
-- Constraints for table `zabor_t_plugin_category`
--
ALTER TABLE `zabor_t_plugin_category`
  ADD CONSTRAINT `zabor_t_plugin_category_ibfk_1` FOREIGN KEY (`fk_i_category_id`) REFERENCES `zabor_t_category` (`pk_i_id`);

--
-- Constraints for table `zabor_t_region`
--
ALTER TABLE `zabor_t_region`
  ADD CONSTRAINT `zabor_t_region_ibfk_1` FOREIGN KEY (`fk_c_country_code`) REFERENCES `zabor_t_country` (`pk_c_code`);

--
-- Constraints for table `zabor_t_region_stats`
--
ALTER TABLE `zabor_t_region_stats`
  ADD CONSTRAINT `zabor_t_region_stats_ibfk_1` FOREIGN KEY (`fk_i_region_id`) REFERENCES `zabor_t_region` (`pk_i_id`);

--
-- Constraints for table `zabor_t_user`
--
ALTER TABLE `zabor_t_user`
  ADD CONSTRAINT `zabor_t_user_ibfk_1` FOREIGN KEY (`fk_c_country_code`) REFERENCES `zabor_t_country` (`pk_c_code`),
  ADD CONSTRAINT `zabor_t_user_ibfk_2` FOREIGN KEY (`fk_i_region_id`) REFERENCES `zabor_t_region` (`pk_i_id`),
  ADD CONSTRAINT `zabor_t_user_ibfk_3` FOREIGN KEY (`fk_i_city_id`) REFERENCES `zabor_t_city` (`pk_i_id`),
  ADD CONSTRAINT `zabor_t_user_ibfk_4` FOREIGN KEY (`fk_i_city_area_id`) REFERENCES `zabor_t_city_area` (`pk_i_id`);

--
-- Constraints for table `zabor_t_user_description`
--
ALTER TABLE `zabor_t_user_description`
  ADD CONSTRAINT `zabor_t_user_description_ibfk_1` FOREIGN KEY (`fk_i_user_id`) REFERENCES `zabor_t_user` (`pk_i_id`),
  ADD CONSTRAINT `zabor_t_user_description_ibfk_2` FOREIGN KEY (`fk_c_locale_code`) REFERENCES `zabor_t_locale` (`pk_c_code`);

--
-- Constraints for table `zabor_t_user_email_tmp`
--
ALTER TABLE `zabor_t_user_email_tmp`
  ADD CONSTRAINT `zabor_t_user_email_tmp_ibfk_1` FOREIGN KEY (`fk_i_user_id`) REFERENCES `zabor_t_user` (`pk_i_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
