
-- -----------------------------------------------------
-- Schema sca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sca` DEFAULT CHARACTER SET utf8 ;
USE `sca` ;

-- -----------------------------------------------------
-- Table `sca`.`parqueadero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sca`.`parqueadero` (
  `idparqueadero` INT NOT NULL AUTO_INCREMENT,
  `estado` INT NOT NULL,
  `maximo_ingreso` INT NOT NULL,
  PRIMARY KEY (`idparqueadero`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sca`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sca`.`usuario` (
  `idusuario` INT NOT NULL,
  `idrfid` VARCHAR(20) NOT NULL,
  `password` VARCHAR(10) NOT NULL,
  `nombre_apellidos` VARCHAR(80) NOT NULL,
  `estado_actual` INT NOT NULL,
  `registrado` TIMESTAMP NOT NULL,
  `parqueadero_idparqueadero` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  INDEX `fk_usuario_parqueadero_idx` (`parqueadero_idparqueadero` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_parqueadero`
    FOREIGN KEY (`parqueadero_idparqueadero`)
    REFERENCES `sca`.`parqueadero` (`idparqueadero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

