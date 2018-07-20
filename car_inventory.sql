create DATABASE car_inventory;

CREATE TABLE `car_inventory`.`manufacturer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx` (`id` ASC));


CREATE TABLE `car_inventory`.`models` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `manufacturer_ref` INT NOT NULL,
  `model_name` VARCHAR(255) NOT NULL,
  `color` VARCHAR(255) NOT NULL,
  `manufacturing_year` INT NOT NULL,
  `reg_number` VARCHAR(45) NOT NULL,
  `note` TEXT NOT NULL,
`count` INT NOT NULL DEFAULT 0 ,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `model_idx` (`id` ASC),
  INDEX `manu_idx` (`manufacturer_ref` ASC),
  CONSTRAINT `fk_manufacturer_id`
    FOREIGN KEY (`manufacturer_ref`)
    REFERENCES `car_inventory`.`manufacturer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


