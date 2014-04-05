-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2013 at 06:20 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adskom`
--

-- --------------------------------------------------------

--
-- Table structure for table `ak_campaign_perf`
--

CREATE TABLE IF NOT EXISTS `ak_campaign_perf` (
        `advertiser_name` varchar(50) NOT NULL,
        `campaign_id` int(11) NOT NULL,
        `brand_name` varchar(50) NOT NULL,
        `revenue` float NOT NULL,
        `budget` float NOT NULL,
        `eCPM` int(11) NOT NULL,
        `eCPC` int(11) NOT NULL,
        `priority` int(11) NOT NULL,
        `adskom_score` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ak_yield_report`
--

    CREATE TABLE IF NOT EXISTS `ak_yield_report` (
            `zone_id` int(11) NOT NULL,
            `yield_type` varchar(50) NOT NULL,
            `impressions` int(11) NOT NULL,
            `revenue` double DEFAULT NULL,
            `cpm` double DEFAULT NULL,
            `clicks` int(11) NOT NULL,
            `impressions_pct` double DEFAULT NULL,
            `revenue_pct` double DEFAULT NULL,
            `clicks_pct` double DEFAULT NULL,
            `date` date NOT NULL,
            `day` int(11) NOT NULL,
            `month` int(11) NOT NULL,
            `year` int(11) NOT NULL,
            UNIQUE KEY `yield_report_pk` (`zone_id`,`yield_type`,`date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_ad_units`
    --

    CREATE TABLE IF NOT EXISTS `md_ad_units` (
            `adv_id` int(11) NOT NULL AUTO_INCREMENT,
            `campaign_id` varchar(100) NOT NULL,
            `unit_hash` varchar(100) NOT NULL,
            `adv_type` varchar(100) NOT NULL,
            `adv_status` varchar(100) NOT NULL,
            `adv_click_url` longtext NOT NULL,
            `adv_click_opentype` varchar(100) NOT NULL,
            `adv_chtml` longtext NOT NULL,
            `adv_mraid` varchar(1) NOT NULL,
            `adv_bannerurl` longtext NOT NULL,
            `adv_impression_tracking_url` longtext NOT NULL,
            `adv_name` varchar(100) NOT NULL,
            `adv_clickthrough_type` varchar(100) NOT NULL,
            `adv_creative_extension` varchar(100) NOT NULL,
            `adv_height` varchar(100) NOT NULL,
            `adv_width` varchar(100) NOT NULL,
            `creativeserver_id` varchar(100) NOT NULL,
            PRIMARY KEY (`adv_id`),
            KEY `campaign_id` (`campaign_id`,`adv_status`,`adv_height`,`adv_width`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_campaigns`
    --

    CREATE TABLE IF NOT EXISTS `md_campaigns` (
            `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
            `campaign_owner` varchar(100) NOT NULL,
            `campaign_status` varchar(100) NOT NULL,
            `campaign_type` varchar(100) NOT NULL,
            `campaign_name` varchar(100) NOT NULL,
            `campaign_desc` mediumtext NOT NULL,
            `campaign_start` date NOT NULL,
            `campaign_end` date NOT NULL,
            `campaign_creationdate` varchar(100) NOT NULL,
            `campaign_networkid` varchar(100) NOT NULL,
            `campaign_priority` varchar(100) NOT NULL,
            `campaign_rate_type` varchar(100) NOT NULL,
            `campaign_rate` varchar(100) NOT NULL,
            `target_iphone` varchar(1) NOT NULL,
            `target_ipod` varchar(1) NOT NULL,
            `target_ipad` varchar(1) NOT NULL,
            `target_android` varchar(1) NOT NULL,
            `target_other` varchar(1) NOT NULL,
            `ios_version_min` varchar(100) NOT NULL,
            `ios_version_max` varchar(100) NOT NULL,
            `android_version_min` varchar(100) NOT NULL,
            `android_version_max` varchar(100) NOT NULL,
            `country_target` varchar(1) NOT NULL,
            `publication_target` varchar(1) NOT NULL,
            `channel_target` varchar(1) NOT NULL,
            `device_target` varchar(1) NOT NULL,
            PRIMARY KEY (`campaign_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_campaign_limit`
    --

    CREATE TABLE IF NOT EXISTS `md_campaign_limit` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `campaign_id` varchar(100) NOT NULL,
            `cap_type` varchar(100) NOT NULL,
            `total_amount` varchar(100) NOT NULL,
            `total_amount_left` varchar(100) NOT NULL,
            `last_refresh` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`),
            KEY `campaign_id` (`campaign_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_campaign_priorities`
    --

    CREATE TABLE IF NOT EXISTS `md_campaign_priorities` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `priority_id` varchar(100) NOT NULL,
            `priority_name` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_campaign_targeting`
    --

    CREATE TABLE IF NOT EXISTS `md_campaign_targeting` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `campaign_id` int(11) NOT NULL,
            `targeting_type` varchar(100) NOT NULL,
            `targeting_code` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`),
            KEY `s2` (`campaign_id`),
            KEY `s1` (`targeting_type`,`targeting_code`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_channels`
    --

    CREATE TABLE IF NOT EXISTS `md_channels` (
            `channel_id` int(11) NOT NULL AUTO_INCREMENT,
            `channel_type` varchar(100) NOT NULL,
            `channel_name` varchar(100) NOT NULL,
            PRIMARY KEY (`channel_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_code_snippets`
    --

    CREATE TABLE IF NOT EXISTS `md_code_snippets` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `snippet_name` varchar(100) NOT NULL,
            `snippet_file` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_configuration`
    --

    CREATE TABLE IF NOT EXISTS `md_configuration` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `var_name` varchar(200) NOT NULL,
            `var_value` varchar(200) NOT NULL,
            PRIMARY KEY (`entry_id`),
            UNIQUE KEY `var_name` (`var_name`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_creative_servers`
    --

    CREATE TABLE IF NOT EXISTS `md_creative_servers` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `server_type` varchar(255) NOT NULL,
            `server_name` varchar(255) NOT NULL,
            `remote_host` varchar(255) NOT NULL,
            `remote_port` varchar(255) NOT NULL,
            `remote_user` varchar(255) NOT NULL,
            `remote_password` varchar(255) NOT NULL,
            `remote_directory` varchar(255) NOT NULL,
            `server_default_url` varchar(255) NOT NULL,
            `server_status` varchar(1) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_log_types`
    --

    CREATE TABLE IF NOT EXISTS `md_log_types` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `log_id` varchar(100) NOT NULL,
            `log_name` longtext NOT NULL,
            `log_desc` longtext NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_networks`
    --

    CREATE TABLE IF NOT EXISTS `md_networks` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `network_name` varchar(100) NOT NULL,
            `network_logo` varchar(100) NOT NULL,
            `network_description` longtext NOT NULL,
            `network_identifier` varchar(100) NOT NULL,
            `network_d1_name` varchar(100) NOT NULL,
            `network_d2_name` varchar(100) NOT NULL,
            `network_d3_name` varchar(100) NOT NULL,
            `network_d4_name` varchar(100) NOT NULL,
            `signup_url` varchar(100) NOT NULL,
            `info_content` longtext NOT NULL,
            `banner_support` varchar(1) NOT NULL,
            `interstitial_support` varchar(1) NOT NULL,
            `network_auto_approve` varchar(1) NOT NULL,
            `network_aa_min` varchar(1) NOT NULL,
            `network_aa_min_cpc` decimal(5,3) NOT NULL,
            `network_aa_min_cpm` decimal(5,3) NOT NULL,
            PRIMARY KEY (`entry_id`),
            KEY `network_identifier` (`network_identifier`(6))
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_network_config`
    --

    CREATE TABLE IF NOT EXISTS `md_network_config` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `config_type` varchar(100) NOT NULL,
            `publication_id` varchar(100) NOT NULL,
            `zone_id` varchar(100) NOT NULL,
            `network_id` varchar(100) NOT NULL,
            `p_1` varchar(100) NOT NULL,
            `p_2` varchar(100) NOT NULL,
            `p_3` varchar(100) NOT NULL,
            `p_4` varchar(100) NOT NULL,
            `priority` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`),
            KEY `pub_sel` (`publication_id`,`zone_id`,`network_id`,`priority`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_passwordresets`
    --

    CREATE TABLE IF NOT EXISTS `md_passwordresets` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `reset_status` varchar(100) NOT NULL,
            `reset_hash` varchar(100) NOT NULL,
            `reset_accountid` varchar(100) NOT NULL,
            `ip_address` varchar(100) NOT NULL,
            `time_stamp` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_pending_actions`
    --

    CREATE TABLE IF NOT EXISTS `md_pending_actions` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `action_id` varchar(100) NOT NULL,
            `action_detail` longtext NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_publications`
    --

    CREATE TABLE IF NOT EXISTS `md_publications` (
            `inv_id` int(11) NOT NULL AUTO_INCREMENT,
            `creator_id` varchar(100) NOT NULL,
            `inv_status` varchar(100) NOT NULL,
            `inv_type` varchar(100) NOT NULL,
            `inv_name` varchar(100) NOT NULL,
            `inv_description` varchar(100) NOT NULL,
            `inv_address` varchar(100) NOT NULL,
            `inv_defaultchannel` varchar(100) NOT NULL,
            `md_lastrequest` varchar(100) NOT NULL,
            PRIMARY KEY (`inv_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_publications_user_groups`
    --

    CREATE TABLE IF NOT EXISTS `md_publications_user_groups` (
            `inv_id` int(11) NOT NULL,
            `user_group_id` int(11) NOT NULL,
            PRIMARY KEY (`inv_id`,`user_group_id`),
            KEY `inv_id` (`inv_id`),
            KEY `user_group_id` (`user_group_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_publication_types`
    --

    CREATE TABLE IF NOT EXISTS `md_publication_types` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `pub_identification` varchar(100) NOT NULL,
            `pub_name` varchar(100) NOT NULL,
            `pub_description` varchar(100) NOT NULL,
            `pub_sdk_url` varchar(100) NOT NULL,
            `pub_info_content` longtext NOT NULL,
            `pub_icon` varchar(100) NOT NULL,
            `output_type` varchar(100) NOT NULL,
            `code_type` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_regional_targeting`
    --

    CREATE TABLE IF NOT EXISTS `md_regional_targeting` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `targeting_code` varchar(100) NOT NULL,
            `targeting_type` varchar(100) NOT NULL,
            `region_code` varchar(100) NOT NULL,
            `region_name` varchar(100) NOT NULL,
            `head_country` varchar(100) NOT NULL,
            `head_region` varchar(100) NOT NULL,
            `head_city` varchar(100) NOT NULL,
            `entry_status` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8521 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_reporting`
    --

    CREATE TABLE IF NOT EXISTS `md_reporting` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `type` varchar(100) NOT NULL,
            `time_stamp` varchar(100) NOT NULL,
            `date` date NOT NULL,
            `day` varchar(100) NOT NULL,
            `month` varchar(100) NOT NULL,
            `year` varchar(100) NOT NULL,
            `publication_id` varchar(100) NOT NULL,
            `zone_id` varchar(100) NOT NULL,
            `campaign_id` varchar(100) NOT NULL,
            `creative_id` varchar(100) NOT NULL,
            `network_id` varchar(100) NOT NULL,
            `total_requests` varchar(100) NOT NULL,
            `total_requests_sec` varchar(100) NOT NULL,
            `total_impressions` varchar(100) NOT NULL,
            `total_clicks` varchar(100) NOT NULL,
            `total_cost` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`),
            UNIQUE KEY `reporting_select` (`publication_id`(6),`zone_id`(6),`campaign_id`(6),`creative_id`(6),`network_id`(6),`date`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=306 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_syslog`
    --

    CREATE TABLE IF NOT EXISTS `md_syslog` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `log_type` varchar(100) NOT NULL,
            `time_stamp` varchar(100) NOT NULL,
            `status` varchar(100) NOT NULL,
            `details` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_trafficrequests`
    --

    CREATE TABLE IF NOT EXISTS `md_trafficrequests` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `request_id` varchar(100) NOT NULL,
            `network_id` varchar(100) NOT NULL,
            `network_identifier` varchar(100) NOT NULL,
            `request_status` varchar(100) NOT NULL,
            `request_pricing_type` varchar(100) NOT NULL,
            `request_pricing` varchar(100) NOT NULL,
            `request_priority` varchar(100) NOT NULL,
            `request_received_timestamp` varchar(100) NOT NULL,
            `request_sent_timestamp` varchar(100) NOT NULL,
            `request_expiration` date NOT NULL,
            `request_autoapproved` varchar(1) NOT NULL,
            `campaign_name` varchar(255) NOT NULL,
            `campaign_desc` longtext NOT NULL,
            `campaign_start` date NOT NULL,
            `campaign_end` date NOT NULL,
            `target_iphone` varchar(1) NOT NULL,
            `target_ipod` varchar(1) NOT NULL,
            `target_ipad` varchar(1) NOT NULL,
            `target_android` varchar(1) NOT NULL,
            `target_other` varchar(1) NOT NULL,
            `ios_version_min` varchar(100) NOT NULL,
            `ios_version_max` varchar(100) NOT NULL,
            `android_version_min` varchar(100) NOT NULL,
            `android_version_max` varchar(100) NOT NULL,
            `device_target` varchar(1) NOT NULL,
            PRIMARY KEY (`entry_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_trafficrequests_parameters`
    --

    CREATE TABLE IF NOT EXISTS `md_trafficrequests_parameters` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `request_id` varchar(100) NOT NULL,
            `parameter_id` varchar(100) NOT NULL,
            `parameter_value` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_uaccounts`
    --

    CREATE TABLE IF NOT EXISTS `md_uaccounts` (
            `user_id` int(11) NOT NULL AUTO_INCREMENT,
            `email_address` varchar(100) NOT NULL,
            `pass_word` varchar(100) NOT NULL,
            `account_status` char(1) NOT NULL,
            `account_type` varchar(100) NOT NULL,
            `company_name` varchar(100) NOT NULL,
            `first_name` varchar(100) NOT NULL,
            `last_name` varchar(100) NOT NULL,
            `gender` varchar(100) NOT NULL,
            `phone_number` varchar(100) NOT NULL,
            `fax_number` varchar(100) NOT NULL,
            `company_address` varchar(100) NOT NULL,
            `company_city` varchar(100) NOT NULL,
            `company_state` varchar(100) NOT NULL,
            `company_zip` varchar(100) NOT NULL,
            `company_country` varchar(100) NOT NULL,
            `tax_id` varchar(100) NOT NULL,
            `tooltip_setting` varchar(1) NOT NULL,
            `creation_date` varchar(100) NOT NULL,
            PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_user_groups`
    --

    CREATE TABLE IF NOT EXISTS `md_user_groups` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `group_name` varchar(100) NOT NULL,
            `group_description` longtext NOT NULL,
            `group_status` char(1) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_user_rights`
    --

    CREATE TABLE IF NOT EXISTS `md_user_rights` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` varchar(100) NOT NULL,
            `group_id` varchar(100) NOT NULL,
            `view_own_campaigns` varchar(1) NOT NULL,
            `view_all_campaigns` varchar(1) NOT NULL,
            `create_campaigns` varchar(1) NOT NULL,
            `view_publications` varchar(1) NOT NULL,
            `modify_publications` varchar(1) NOT NULL,
            `view_advertisers` varchar(1) NOT NULL,
            `modify_advertisers` varchar(1) NOT NULL,
            `ad_networks` varchar(1) NOT NULL,
            `campaign_reporting` varchar(1) NOT NULL,
            `own_campaign_reporting` varchar(1) NOT NULL,
            `publication_reporting` varchar(1) NOT NULL,
            `network_reporting` varchar(1) NOT NULL,
            `configuration` varchar(1) NOT NULL,
            `traffic_requests` varchar(1) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_usessions`
    --

    CREATE TABLE IF NOT EXISTS `md_usessions` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `session_id` varchar(100) NOT NULL,
            `session_timeout` varchar(100) NOT NULL,
            `session_status` varchar(100) NOT NULL,
            `user_identification` varchar(100) NOT NULL,
            `user_password` varchar(100) NOT NULL,
            `session_type` varchar(100) NOT NULL,
            `ip_address` varchar(100) NOT NULL,
            `date_created` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

    -- --------------------------------------------------------

    --
    -- Table structure for table `md_zones`
    --

    CREATE TABLE IF NOT EXISTS `md_zones` (
            `entry_id` int(11) NOT NULL AUTO_INCREMENT,
            `publication_id` varchar(100) NOT NULL,
            `zone_hash` varchar(100) NOT NULL,
            `zone_name` varchar(100) NOT NULL,
            `zone_type` varchar(100) NOT NULL,
            `zone_width` varchar(100) NOT NULL,
            `zone_height` varchar(100) NOT NULL,
            `zone_refresh` varchar(100) NOT NULL,
            `zone_channel` varchar(100) NOT NULL,
            `zone_lastrequest` varchar(100) NOT NULL,
            `zone_description` longtext NOT NULL,
            `mobfox_backfill_active` varchar(100) NOT NULL,
            `mobfox_min_cpc_active` varchar(100) NOT NULL,
            `min_cpc` decimal(5,3) NOT NULL,
            `min_cpm` decimal(5,3) NOT NULL,
            `backfill_alt_1` varchar(100) NOT NULL,
            `backfill_alt_2` varchar(100) NOT NULL,
            `backfill_alt_3` varchar(100) NOT NULL,
            PRIMARY KEY (`entry_id`),
            KEY `publication_id` (`publication_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

