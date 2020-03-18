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
ALTER TABLE `epics` ADD COLUMN `e_owner` INT(11) UNSIGNED NULL AFTER `e_status_id`, ADD FOREIGN KEY (`e_owner`) REFERENCES `staff`(`staff_id`);
ALTER TABLE `epics` CHANGE `e_id` `e_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT; 
CREATE TABLE `epic_details`( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, `e_id` INT(11) UNSIGNED NOT NULL, `e_hs_for` TEXT NOT NULL, `e_hs_for_desc` TEXT NOT NULL, `e_hs_solution` TEXT NOT NULL, `e_hs_how` TEXT NOT NULL, `e_hs_value` TEXT NOT NULL, `e_hs_unlike` TEXT NOT NULL, `e_hs_oursoluion` TEXT NOT NULL, `e_hs_businessoutcome` TEXT NOT NULL, `e_hs_leadingindicators` TEXT NOT NULL, `e_hs_nfr` TEXT NOT NULL, `e_notes` TEXT, PRIMARY KEY (`id`), FOREIGN KEY (`e_id`) REFERENCES `epics`(`e_id`) ON DELETE CASCADE ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE `epic_details` ADD UNIQUE INDEX (`e_id`);
ALTER TABLE `staff` ADD COLUMN `can_manage_config` ENUM('0','1') DEFAULT '0' NOT NULL AFTER `can_edit_epic_feature`;

-- 9 March 2020
ALTER TABLE `epics` CHANGE `e_desc` `e_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `team_id` `team_id` INT(11) NULL;
ALTER TABLE `epic_details` CHANGE `e_hs_for` `e_hs_for` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_for_desc` `e_hs_for_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_solution` `e_hs_solution` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_how` `e_hs_how` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_value` `e_hs_value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_unlike` `e_hs_unlike` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_oursoluion` `e_hs_oursoluion` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_businessoutcome` `e_hs_businessoutcome` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_leadingindicators` `e_hs_leadingindicators` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_nfr` `e_hs_nfr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `epics` CHANGE `e_status_id` `e_status_id` INT(11) NULL DEFAULT '1';

-- 11 March 2020
ALTER TABLE `feature_details` ADD edited_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `feature_details` CHANGE `created_date` `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;


-- 12 March 2020
ALTER TABLE `topics` ADD `team_id` INT(11) NOT NULL AFTER `capacity_source`;
UPDATE `topics` SET `team_id` = '1' WHERE `topics`.`id` = 1;
UPDATE `topics` SET `team_id` = '1' WHERE `topics`.`id` = 2;
UPDATE `topics` SET `team_id` = '2' WHERE `topics`.`id` = 3;
UPDATE `topics` SET `team_id` = '2' WHERE `topics`.`id` = 4;
UPDATE `topics` SET `team_id` = '3' WHERE `topics`.`id` = 5;
UPDATE `topics` SET `team_id` = '3' WHERE `topics`.`id` = 7;
UPDATE `topics` SET `team_id` = '3' WHERE `topics`.`id` = 9;


CREATE TABLE `epic_files` (
  `id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `e_filename` varchar(255) NOT NULL,
  `e_fileurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `epic_files`
  ADD PRIMARY KEY (`id`);

--- 13 March 2020
ALTER TABLE `epic_details`  ADD `e_in_scope` TEXT NULL DEFAULT NULL  AFTER `e_notes`,  ADD `e_out_of_scope` TEXT NULL DEFAULT NULL  AFTER `e_in_scope`,  ADD `e_minimum_viable_product_features` TEXT NULL DEFAULT NULL  AFTER `e_out_of_scope`,  ADD `e_additional_potential_features` TEXT NULL DEFAULT NULL  AFTER `e_minimum_viable_product_features`,  ADD `e_sponsors` TEXT NULL DEFAULT NULL  AFTER `e_additional_potential_features`,  ADD `e_users_markets_affected` TEXT NULL DEFAULT NULL  AFTER `e_sponsors`,  ADD `e_impact_products_programs_services` TEXT NULL DEFAULT NULL  AFTER `e_users_markets_affected`,  ADD `e_impact_sales_distribution_deployment` TEXT NULL DEFAULT NULL  AFTER `e_impact_products_programs_services`,  ADD `e_analysis_summary` TEXT NULL DEFAULT NULL  AFTER `e_impact_sales_distribution_deployment`,  ADD `e_go_no_go` TEXT NULL DEFAULT NULL  AFTER `e_analysis_summary`,  ADD `e_estimated_story_points` FLOAT(11,2) NULL DEFAULT NULL  AFTER `e_go_no_go`,  ADD `e_estimated_monetary_cost` FLOAT(11,2) NULL DEFAULT NULL  AFTER `e_estimated_story_points`,  ADD `e_type_of_return` TEXT NULL DEFAULT NULL  AFTER `e_estimated_monetary_cost`,  ADD `e_anticipated_business_impact` TEXT NULL DEFAULT NULL  AFTER `e_type_of_return`,  ADD `e_in_house_or_outsourced_development` TEXT NULL DEFAULT NULL  AFTER `e_anticipated_business_impact`,  ADD `e_start_date` DATE NULL DEFAULT NULL  AFTER `e_in_house_or_outsourced_development`,  ADD `e_completion_date` DATE NULL DEFAULT NULL  AFTER `e_start_date`,  ADD `e_incremental_implementation_strategy` TEXT NULL DEFAULT NULL  AFTER `e_completion_date`,  ADD `e_sequencing_and_dependencies` TEXT NULL DEFAULT NULL  AFTER `e_incremental_implementation_strategy`,  ADD `e_milestones_or_checkpoints` TEXT NULL DEFAULT NULL  AFTER `e_sequencing_and_dependencies`;
ALTER TABLE `epic_details` CHANGE `e_minimum_viable_product_features` `e_mvp_features` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `e_go_no_go` `e_is_go` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `e_in_house_or_outsourced_development` `e_development_type` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `e_sequencing_and_dependencies` `e_sequencing_dependencies` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `e_milestones_or_checkpoints` `e_milestones` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `epic_details` CHANGE `e_hs_for` `e_hs_for` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_for_desc` `e_hs_for_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_solution` `e_hs_solution` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_how` `e_hs_how` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_value` `e_hs_value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_unlike` `e_hs_unlike` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_oursoluion` `e_hs_oursoluion` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_businessoutcome` `e_hs_businessoutcome` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_leadingindicators` `e_hs_leadingindicators` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, CHANGE `e_hs_nfr` `e_hs_nfr` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

--- 17 March 2020
ALTER TABLE `staff` ADD `staff_avatar` VARCHAR(255) NOT NULL AFTER `can_manage_config`;
CREATE TABLE `watchers`( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, `staff_id` INT(11) UNSIGNED NOT NULL, `model_type` ENUM('feature','epic','topic') NOT NULL DEFAULT 'feature', `model_id` INT(11) UNSIGNED NOT NULL, PRIMARY KEY (`id`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
