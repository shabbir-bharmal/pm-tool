-- 2 March 2020
ALTER TABLE `feature_details` CHANGE `f_SME` `f_SME` INT(11) UNSIGNED NULL;
UPDATE feature_details SET f_SME = NULL WHERE f_SME <= 0;
ALTER TABLE `feature_details` ADD FOREIGN KEY (`f_SME`) REFERENCES `staff`(`staff_id`);
INSERT INTO `feature_statuses` (`name`) VALUES ('New'); 
INSERT INTO `feature_statuses` (`name`) VALUES ('Requested');

----------------
ALTER TABLE `staff` ADD `staff_team_id` INT(11) NOT NULL AFTER `staff_team`;
ALTER TABLE `staff` ADD FOREIGN KEY (`staff_team_id`) REFERENCES `team`(`id`)
UPDATE staff SET staff_team_id = (SELECT id FROM team WHERE `name` = staff.`staff_team` );
ALTER TABLE `staff` DROP COLUMN `staff_team`;
ALTER TABLE `epics` ADD `team_id` INT(11) NOT NULL AFTER `e_desc`;
ALTER TABLE `epics` ADD FOREIGN KEY (`team_id`) REFERENCES `team`(`id`);