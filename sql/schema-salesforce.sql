/*

Salesforce Tables

*/


CREATE TABLE IF NOT EXISTS `aav`.`sf_church` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `aav`.`sf_language` (
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



INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (1,'Wycliffe Church','FL');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (2,'Good Church','IN');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (3,'Best Church','CA');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (4,'God\'s Church','CA');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (5,'Happy Sunday','CO');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (6,'Alpha and Omega','NY');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`) VALUES (7,'Jesus\' Church','ME');

INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`number_of_speakers`,`scripture_published`) VALUES ('ABC','Thai','Thailand',505300,'1940-01-05');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`number_of_speakers`,`scripture_published`) VALUES ('TSW','Kaninuwa','Papua New Guinea',16511,'1991-04-08');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`number_of_speakers`,`scripture_published`) VALUES ('KOR','Korean','South Korea/North Korea',5734211,'1950-06-08');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`number_of_speakers`,`scripture_published`) VALUES ('SWH','Swahili','Africa',1345751,'1970-03-28');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`number_of_speakers`,`scripture_published`) VALUES ('JAP','Japanese','Japan',2447631,'1981-10-02');
