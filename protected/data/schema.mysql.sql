CREATE TABLE blog_user (
    `user_id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(128) NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `last_login_time` datetime DEFAULT NULL,
    `add_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL
);

CREATE TABLE `blog_category` (
    `category_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(128) NOT NULL,
    `add_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `blog_article_tag` (
    `article_tag_id` int(11) NOT NULL AUTO_INCREMENT,
    `article_id` int(11) DEFAULT NULL,
    `tag_id` int(11) DEFAULT NULL,
    `add_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    PRIMARY KEY (`article_tag_id`),
    KEY `article_id` (`article_id`),
    KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `blog_tag` (
    `tag_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(128) NOT NULL,
    `add_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `blog_article` (
    `article_id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(256) NOT NULL,
    `content` text DEFAULT NULL,
    `read_count` int(11) DEFAULT NULL,
    `is_post` int(11) DEFAULT 0,
    `category_id` int(11) DEFAULT NULL,
    `add_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    PRIMARY KEY (`article_id`),
    KEY `FK_article_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `blog_article`
    ADD CONSTRAINT `FK_article_category` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`category_id`) ON DELETE CASCADE;

INSERT INTO `blog_user` (`user_id`, `username`, `password`, `email`, `last_login_time`, `add_time`, `update_time`) VALUES
(1, 'david', '89e1d6cd80f270ed149b3f4aec0f47cf', 'davidzhangqin@gmail.com', '2014-01-02 20:04:25', '2013-12-04 17:31:24', '2013-12-04 17:31:24');