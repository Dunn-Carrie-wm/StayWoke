/*USE THIS TO MAKE THE DATABASE*/

CREATE SCHEMA `staywokedb`;

CREATE TABLE `staywokedb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) UNIQUE NULL,
  `email` VARCHAR(128) UNIQUE NULL,
  `password` VARCHAR(128) NULL,
  `token` VARCHAR(128) NULL,
  `highscore` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

CREATE TABLE `staywokedb`.`purchases` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `amount` INT NULL,
  `total_cost` FLOAT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `staywokedb`.`creditCards` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `CardholderName` VARCHAR(16) NOT NULL,
  `CardNumber` INT NOT NULL,
  `City` VARCHAR(30) NOT NULL,
  `StateProvince` VARCHAR(30) NULL,
  `PostalZIP_code` VARCHAR(8) NULL,
  `Country` VARCHAR(30) NULL,
  `BillingAddress1` VARCHAR(128) NULL,
  `BillingAddress2` VARCHAR(128) NULL,
  `ExspirarionDate` VARCHAR(6) NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `staywokedb`.`users`
ADD COLUMN `rank` VARCHAR(45) NULL DEFAULT 'member' AFTER `highscore`,
ADD UNIQUE INDEX `email_UNIQUE` (`email` ASC),
ADD UNIQUE INDEX `username_UNIQUE` (`username` ASC);