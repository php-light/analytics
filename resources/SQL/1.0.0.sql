DROP TABLE IF EXISTS `phplight_analytics`;
CREATE TABLE IF NOT EXISTS `phplight_analytics` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identifier` VARCHAR(191) NOT NULL DEFAULT '',
  `currentUrl` VARCHAR(191) NOT NULL DEFAULT '',
  `currentHash` VARCHAR(191) NOT NULL DEFAULT '',
  `event` VARCHAR(191) NOT NULL DEFAULT '',
  `user` TEXT,
  `misc` TEXT,
  `createdAt` VARCHAR(191) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
