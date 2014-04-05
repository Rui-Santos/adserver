    -- md_tables
    CREATE TABLE if not exists `md_publications_user_groups` (
            `inv_id` int(11) NOT NULL,
            `user_group_id` int(11) NOT NULL,
            PRIMARY KEY (`inv_id`,`user_group_id`),
            KEY `inv_id` (`inv_id`),
            KEY `user_group_id` (`user_group_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- ak tables
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

