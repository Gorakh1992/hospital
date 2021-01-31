
ALTER TABLE `patient_details` ADD `department` VARCHAR(50) NULL DEFAULT NULL AFTER `updated_date`;
ALTER TABLE `patient_details` ADD `shift` VARCHAR(60) NULL DEFAULT NULL AFTER `updated_date`;
ALTER TABLE `patient_details` ADD `opd_type` VARCHAR(50) NULL DEFAULT NULL AFTER `department`;
ALTER TABLE `patient_details` ADD `app_no` VARCHAR(50) NULL DEFAULT NULL AFTER `opd_type`;
ALTER TABLE `patient_details` ADD `contact_number` INT(120) NULL DEFAULT NULL AFTER `app_no`;
ALTER TABLE `patient_details` ADD `amount` INT(100) NULL DEFAULT NULL AFTER `contact_number`;
ALTER TABLE `patient_details` ADD `paid_amount` INT(100) NULL DEFAULT NULL AFTER `amount`;
ALTER TABLE `patient_details` ADD `cancelation` VARCHAR(150) NULL DEFAULT NULL AFTER `paid_amount`;
ALTER TABLE `patient_details` DROP `patient_age`, DROP `sex`;
ALTER TABLE `patient_details` DROP `adhar_card_number`;
ALTER TABLE `surgery_patient_details` DROP `parent_risk_bound_file`;
ALTER TABLE `surgery_patient_details` ADD `patient_adhar_number` VARCHAR(100) NULL DEFAULT NULL AFTER `updated_date`;
ALTER TABLE `patient_details` CHANGE `contact_number` `contact_number` VARCHAR(120) NULL DEFAULT NULL;
