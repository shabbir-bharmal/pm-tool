-- 2 March 2020
ALTER TABLE `feature_details` CHANGE `f_SME` `f_SME` INT(11) UNSIGNED NULL;
UPDATE feature_details SET f_SME = NULL WHERE f_SME <= 0;
ALTER TABLE `feature_details` ADD FOREIGN KEY (`f_SME`) REFERENCES `staff`(`staff_id`);
INSERT INTO `feature_statuses` (`name`) VALUES ('New'); 
INSERT INTO `feature_statuses` (`name`) VALUES ('Requested'); 