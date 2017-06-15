CREATE TABLE `addresses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(45) NULL DEFAULT NULL,
  `street` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `companies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `activity` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `company_id` INT NULL DEFAULT NULL,
  `address_id` INT NULL DEFAULT NULL,
  `firstname` VARCHAR(45) NULL DEFAULT NULL,
  `lastname` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `company_idx` (`company_id` ASC),
  INDEX `address_idx` (`address_id` ASC),
  CONSTRAINT `company`
    FOREIGN KEY (`company_id`)
    REFERENCES `companies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `address`
    FOREIGN KEY (`address_id`)
    REFERENCES `addresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);