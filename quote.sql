-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema quotes
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quotes
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quotes` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema quote
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quote
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quote` DEFAULT CHARACTER SET utf8mb4 ;
USE `quotes` ;

-- -----------------------------------------------------
-- Table `quotes`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotes`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quotes`.`table2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotes`.`table2` (
)
ENGINE = InnoDB;

USE `quote` ;

-- -----------------------------------------------------
-- Table `quote`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `alias` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(225) NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `quote`.`quotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote`.`quotes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `quoteBy` VARCHAR(45) NULL DEFAULT NULL,
  `message` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `creator` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `creator` (`creator` ASC),
  CONSTRAINT `products_ibfk_1`
    FOREIGN KEY (`creator`)
    REFERENCES `quote`.`users` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `quote`.`favorites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote`.`favorites` (
  `quote_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`quote_id`, `user_id`),
  INDEX `fk_products_has_users_users1_idx` (`user_id` ASC),
  INDEX `fk_products_has_users_products_idx` (`quote_id` ASC),
  CONSTRAINT `fk_products_has_users_products`
    FOREIGN KEY (`quote_id`)
    REFERENCES `quote`.`quotes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `quote`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
