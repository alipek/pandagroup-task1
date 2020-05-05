DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `news`;
CREATE TABLE `user`
(
    `id`         INTEGER UNSIGNED auto_increment,
    `first_name` VARCHAR(64)            NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
    `last_name`  VARCHAR(64)            NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
    `email`      VARCHAR(255)           NOT NULL,
    `gender`     ENUM ('boys', 'girls') NULL,
    `is_active`  TINYINT(1)             NULL DEFAULT 0,
    `password`   VARCHAR(255)           NOT NULL,
    `created_at` DATETIME               NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME               NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDb,
  AUTO_INCREMENT = 0,
  CHARACTER SET 'utf8'
;

CREATE TABLE `news`
(
    `id`          integer unsigned auto_increment,
    `name`        VARCHAR(255)     NULL COLLATE 'utf8_unicode_ci',
    `description` VARCHAR(255)     NULL COLLATE 'utf8_unicode_ci',
    `is_active`   TINYINT(1)       NULL DEFAULT 1,
    `created_at`  DATETIME         NULL DEFAULT current_timestamp,
    `updated_at`  DATETIME         NULL,
    `author_id`   integer unsigned not NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT FOREIGN KEY news_user (`author_id`) REFERENCES user (`id`) ON DELETE CASCADE
) ENGINE = InnoDb,
  AUTO_INCREMENT = 0
  CHARACTER SET 'utf8'
;
