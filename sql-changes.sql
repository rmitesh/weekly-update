INSERT INTO `settings` (`id`, `name`, `value`) VALUES (NULL, 'weekly_update_day', 'friday');

ALTER TABLE `projects` ADD `tl_name` VARCHAR(30) NOT NULL AFTER `client_name`, ADD `tl_email` VARCHAR(60) NOT NULL AFTER `tl_name`;