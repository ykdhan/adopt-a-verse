/*

Random Data

*/
USE `aav`;

INSERT INTO `aav`.`church` (`id`,`name`,`state`,`contact`,`profile_picture`) VALUES (1,'Wycliffe Church','FL','156-456-5612',null);
INSERT INTO `aav`.`church` (`id`,`name`,`state`,`contact`,`profile_picture`) VALUES (2,'Good Church','IN','456-465-4564',null);
INSERT INTO `aav`.`church` (`id`,`name`,`state`,`contact`,`profile_picture`) VALUES (3,'Best Church','CA','456-456-4587',null);

INSERT INTO `aav`.`language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`,`project_description`,`pdf_url`) VALUES ('ABC','Thai','Thailand','Asia',505300,'1940-01-05','<p>This is Thai language proejct.</p><p>This is cool.</p>','');
INSERT INTO `aav`.`language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`,`project_description`,`pdf_url`) VALUES ('TSW','Kaninuwa','Papua New Guinea','Australia/Oceania',16511,'1991-04-08','<p>This is Kaninuwa.</p><h3>This is cool.</h3>','');
INSERT INTO `aav`.`language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`,`project_description`,`pdf_url`) VALUES ('SWH','Swahili','South Africa','Africa',2014511,'1950-07-18','<p>This is Swahili.</p><h3>This is cool.</h3>','');
INSERT INTO `aav`.`language` (`id`,`people_group`,`region`,`continent`,`number_of_speakers`,`scripture_published`,`project_description`,`pdf_url`) VALUES ('JAP','Japanese','Japan','Asia',1350511,'1961-12-02','<p>Japanese project.</p><h3>This is cool.</h3>','');

INSERT INTO `aav`.`user` (`id`,`church_id`,`email`,`password`,`first_name`,`last_name`,`phone`,`register_date`,`campaign_admin`,`wycliffe_admin`,`verified`) VALUES (1,null,'admin','wycliffe123','John','Wycliffe','123-123-1234','2017-01-01',0,1,1);
INSERT INTO `aav`.`user` (`id`,`church_id`,`email`,`password`,`first_name`,`last_name`,`phone`,`register_date`,`campaign_admin`,`wycliffe_admin`,`verified`) VALUES (2,1,'good@good.com','good','John','Doe','123-123-1234','2017-07-01',1,0,1);
INSERT INTO `aav`.`user` (`id`,`church_id`,`email`,`password`,`first_name`,`last_name`,`phone`,`register_date`,`campaign_admin`,`wycliffe_admin`,`verified`) VALUES (3,1,'vvv@vvv.com',null,'David','Han','123-123-1234','2017-08-01',1,0,0);
