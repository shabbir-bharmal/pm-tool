-- 2 March 2020
ALTER TABLE `feature_details` CHANGE `f_SME` `f_SME` INT(11) UNSIGNED NULL;
UPDATE feature_details SET f_SME = NULL WHERE f_SME <= 0;
ALTER TABLE `feature_details` ADD FOREIGN KEY (`f_SME`) REFERENCES `staff`(`staff_id`);
INSERT INTO `feature_statuses` (`name`) VALUES ('New'); 
INSERT INTO `feature_statuses` (`name`) VALUES ('Requested');
ALTER TABLE `features` ADD COLUMN `f_is_FR` ENUM('0','1') DEFAULT '0' NOT NULL AFTER `f_JS`;
ALTER TABLE `staff` ADD `staff_team_id` INT(11) NOT NULL AFTER `staff_team`;
ALTER TABLE `staff` ADD FOREIGN KEY (`staff_team_id`) REFERENCES `team`(`id`)
UPDATE staff SET staff_team_id = (SELECT id FROM team WHERE `name` = staff.`staff_team` );
ALTER TABLE `staff` DROP COLUMN `staff_team`;
ALTER TABLE `epics` ADD `team_id` INT(11) NOT NULL AFTER `e_desc`;
ALTER TABLE `epics` ADD FOREIGN KEY (`team_id`) REFERENCES `team`(`id`);

-- 5 March 2020
ALTER TABLE `feature_details` ADD created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `topics` ADD `capacity_source` VARCHAR(255) NOT NULL AFTER `name`;
CREATE TABLE `epics_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
);
ALTER TABLE `epics_statuses` ADD PRIMARY KEY (`id`);
INSERT INTO `epics_statuses` (`id`, `name`) VALUES
(1, 'New'),
(2, 'Requested'),
(3, 'Aprroved'),
(4, 'Doing'),
(5, 'Done'),
(6, 'Cancelled');
ALTER TABLE `epics` ADD `e_status_id` int(11) NOT NULL DEFAULT '1';
ALTER TABLE `features` CHANGE `f_desc` `f_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `f_topic_id` `f_topic_id` INT(11) UNSIGNED NULL;
ALTER TABLE `feature_details` CHANGE `f_epic` `f_epic` INT(11) NULL;

-- 6 March 2020
ALTER TABLE `feature_statuses` ADD COLUMN `order` INT(11) UNSIGNED DEFAULT 1 NOT NULL AFTER `name`; 
UPDATE `feature_statuses` SET `order` = '2' WHERE `id` = '2'; 
UPDATE `feature_statuses` SET `order` = '3' WHERE `id` = '3';
UPDATE `feature_statuses` SET `order` = '4' WHERE `id` = '4';
UPDATE `feature_statuses` SET `order` = '5' WHERE `id` = '5';
UPDATE `feature_statuses` SET `order` = '6' WHERE `id` = '6';