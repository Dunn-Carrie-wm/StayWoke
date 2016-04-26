/*USE THIS TO MAKE THE DATABASE*/

CREATE SCHEMA `staywokedb`;

CREATE TABLE `staywokedb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NULL,
  `email` VARCHAR(128) NULL,
  `password` VARCHAR(128) NULL,
  `token` VARCHAR(128) NULL,
  `highscore` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

