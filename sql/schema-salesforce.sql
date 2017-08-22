/*

Salesforce Tables

*/


CREATE TABLE IF NOT EXISTS `aav`.`sf_church` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `aav`.`sf_language` (
  `id` VARCHAR(10) NOT NULL,
  `people_group` VARCHAR(45) NULL DEFAULT NULL,
  `region` VARCHAR(45) NULL DEFAULT NULL,
  `continent` varchar(45) DEFAULT NULL,
  `number_of_speakers` INT(11) NULL DEFAULT NULL,
  `scripture_published` DATE NULL DEFAULT NULL,
  `project_description` TEXT NULL DEFAULT NULL,
  `pdf_url` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (1,'Wycliffe Church','FL','123-456-4513');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (2,'Good Church','IN','156-164-6434');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (3,'Best Church','CA','156-116-1566');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (4,'God\'s Church','CA','561-953-1651');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (5,'Happy Sunday','CO','546-156-1561');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (6,'Alpha and Omega','NY','654-135-4564');
INSERT INTO `aav`.`sf_church` (`id`,`name`,`state`,`contact`) VALUES (7,'Jesus\' Church','ME','123-456-1364');

INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`) VALUES ('ABC','Thai','Thailand','Asia',505300,'1940-01-05');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`) VALUES ('TSW','Kaninuwa','Papua New Guinea','Australia/Oceania',16511,'1991-04-08');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`) VALUES ('KOR','Korean','South Korea/North Korea','Asia',5734211,'1950-06-08');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`) VALUES ('SWH','Swahili','South Africa','Africa',1345751,'1970-03-28');
INSERT INTO `aav`.`sf_language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`) VALUES ('JAP','Japanese','Japan','Asia',2447631,'1981-10-02');
