ALTER TABLE `pmservice` ADD `previous_smr` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `pm_type`;
ALTER TABLE `fluidentrysmrupdate` ADD `previous_smr` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `servicelog_id`;
ALTER TABLE `smrupdate` ADD `previous_smr` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `servicelog_id`;