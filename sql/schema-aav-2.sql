DROP SCHEMA IF EXISTS `aav`;
CREATE SCHEMA IF NOT EXISTS `aav` DEFAULT CHARACTER SET utf8 ;
USE `aav` ;


CREATE TABLE IF NOT EXISTS `aav`.`church` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `profile_picture` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `aav`.`language` (
  `id` VARCHAR(10) NOT NULL,
  `people_group` VARCHAR(45) NULL DEFAULT NULL,
  `region` VARCHAR(45) NULL DEFAULT NULL,
  `number_of_speakers` INT(11) NULL DEFAULT NULL,
  `scripture_published` DATE NULL DEFAULT NULL,
  `project_description` TEXT NULL DEFAULT NULL,
  `pdf_url` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `aav`.`user` (
  `id` INT(11) NOT NULL,
  `church_id` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `first_name` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `register_date` DATE NULL DEFAULT NULL,
  `campaign_admin` INT(11) NULL DEFAULT '0',
  `wycliffe_admin` INT(11) NULL DEFAULT '0',
  `verified` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `church_id_idx` (`church_id` ASC),
  CONSTRAINT FOREIGN KEY (`church_id`) REFERENCES `aav`.`church` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `aav`.`campaign` (
  `id` VARCHAR(10) NOT NULL,
  `church_id` INT(11) NULL DEFAULT NULL,
  `language_id` VARCHAR(10) NULL DEFAULT NULL,
  `book` VARCHAR(45) NULL DEFAULT NULL,
  `goal_description` TEXT NULL DEFAULT NULL,
  `goal_amount` FLOAT NULL DEFAULT NULL,
  `verse_price` FLOAT NULL DEFAULT NULL,
  `start_date` DATE NULL DEFAULT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  `url` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `church_id_idx` (`church_id` ASC),
  INDEX `language_id_idx` (`language_id` ASC),
  CONSTRAINT `church_id`
    FOREIGN KEY (`church_id`)
    REFERENCES `aav`.`church` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `language_id`
    FOREIGN KEY (`language_id`)
    REFERENCES `aav`.`language` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

