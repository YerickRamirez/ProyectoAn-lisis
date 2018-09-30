-- MySQL Script generated by MySQL Workbench
-- Sat Sep 29 09:31:07 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Salud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Salud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Salud` DEFAULT CHARACTER SET utf8 ;
USE `Salud` ;

-- -----------------------------------------------------
-- Table `Salud`.`Paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Paciente` (
  `Cedula` VARCHAR(30) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `PrimerApellido` VARCHAR(45) NOT NULL,
  `Segundo Apellido` VARCHAR(45) NOT NULL,
  `Correo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Especialista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Especialista` (
  `Cédula` VARCHAR(30) NOT NULL,
  `Nombre` VARCHAR(100) NOT NULL,
  `Primer_Apellido` VARCHAR(45) NOT NULL,
  `Segundo_Apellido` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Cédula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Cuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Cuenta` (
  `Nombre_Usuario` INT NOT NULL,
  `Contrasenna` VARCHAR(50) NOT NULL,
  `Tipo` VARCHAR(45) NOT NULL,
  `Verificado` TINYINT NOT NULL,
  `Codigo_Verificacion` VARCHAR(45) NULL,
  `Duenno` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Nombre_Usuario`),
  INDEX `FK_Cuenta_Paciente_idx` (`Duenno` ASC),
  CONSTRAINT `FK_Cuenta_Paciente`
    FOREIGN KEY (`Duenno`)
    REFERENCES `Salud`.`Paciente` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cuenta_Especialista`
    FOREIGN KEY (`Duenno`)
    REFERENCES `Salud`.`Especialista` (`Cédula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Diagnostico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Diagnostico` (
  `Descripcion` VARCHAR(254) NOT NULL,
  `Recomendaciones` VARCHAR(700) NULL,
  `Fecha` DATETIME NOT NULL,
  `Paciente` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Descripcion`),
  INDEX `FK_Diagnostico_Paciente_idx` (`Paciente` ASC),
  CONSTRAINT `FK_Diagnostico_Paciente`
    FOREIGN KEY (`Paciente`)
    REFERENCES `Salud`.`Paciente` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Estado_Cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Estado_Cita` (
  `ID_Estado` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`ID_Estado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Recinto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Recinto` (
  `ID_Recinto` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`ID_Recinto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Servicio` (
  `ID_Servicio` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(100) NOT NULL,
  `Descripcion` VARCHAR(200) NOT NULL,
  `Recinto` INT NOT NULL,
  PRIMARY KEY (`ID_Servicio`),
  INDEX `FK_Servicio_Recinto_idx` (`Recinto` ASC),
  CONSTRAINT `FK_Servicio_Recinto`
    FOREIGN KEY (`Recinto`)
    REFERENCES `Salud`.`Recinto` (`ID_Recinto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Cita` (
  `Fecha` DATETIME NOT NULL,
  `Estado` INT NOT NULL,
  `Servicio` INT NOT NULL,
  `Especialista` VARCHAR(30) NOT NULL,
  `Paciente` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Fecha`),
  INDEX `FK_Cita_Estado_idx` (`Estado` ASC),
  INDEX `FK_Cita_Servicio_idx` (`Servicio` ASC),
  INDEX `FK_Cita_Especialista_idx` (`Especialista` ASC),
  INDEX `FK_Cita_Paciente_idx` (`Paciente` ASC),
  CONSTRAINT `FK_Cita_Estado`
    FOREIGN KEY (`Estado`)
    REFERENCES `Salud`.`Estado_Cita` (`ID_Estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cita_Servicio`
    FOREIGN KEY (`Servicio`)
    REFERENCES `Salud`.`Servicio` (`ID_Servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cita_Especialista`
    FOREIGN KEY (`Especialista`)
    REFERENCES `Salud`.`Especialista` (`Cédula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cita_Paciente`
    FOREIGN KEY (`Paciente`)
    REFERENCES `Salud`.`Paciente` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Telefono_Paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Telefono_Paciente` (
  `Telefono` INT NOT NULL,
  `Paciente` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`Telefono`, `Paciente`),
  INDEX `FK_Telefono_Paciente_idx` (`Paciente` ASC),
  CONSTRAINT `FK_Telefono_Paciente`
    FOREIGN KEY (`Paciente`)
    REFERENCES `Salud`.`Paciente` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Servicio_Especialista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Servicio_Especialista` (
  `Especialista` VARCHAR(30) NOT NULL,
  `Servicio` INT NOT NULL,
  PRIMARY KEY (`Especialista`, `Servicio`),
  INDEX `FK_Servicio_Especialista_idx` (`Servicio` ASC),
  CONSTRAINT `FK_Servicio_Especialista`
    FOREIGN KEY (`Servicio`)
    REFERENCES `Salud`.`Servicio` (`ID_Servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Especialista_Servicio`
    FOREIGN KEY (`Especialista`)
    REFERENCES `Salud`.`Especialista` (`Cédula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Salud`.`Correo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Salud`.`Correo` (
  `Correo` VARCHAR(75) NOT NULL,
  `Paciente` VARCHAR(30) NOT NULL,
  `Prioridad` INT NOT NULL,
  PRIMARY KEY (`Correo`, `Paciente`),
  INDEX `FK_Correo_Paciente_idx` (`Paciente` ASC),
  CONSTRAINT `FK_Correo_Paciente`
    FOREIGN KEY (`Paciente`)
    REFERENCES `Salud`.`Paciente` (`Cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
