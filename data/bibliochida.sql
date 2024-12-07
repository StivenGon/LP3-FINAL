-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bibliochida
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bibliochida
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bibliochida` DEFAULT CHARACTER SET utf8 ;
USE `bibliochida` ;

-- -----------------------------------------------------
-- Table `bibliochida`.`idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`idioma` (
  `id_idioma` INT NOT NULL AUTO_INCREMENT,
  `descrip_idioma` VARCHAR(45) NOT NULL,
  `iso_idioma` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_idioma`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `descrip_idioma_UNIQUE` ON `bibliochida`.`idioma` (`descrip_idioma` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`editorial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`editorial` (
  `id_editorial` INT NOT NULL AUTO_INCREMENT,
  `descrip_editorial` VARCHAR(125) NOT NULL,
  `pais_editorial` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_editorial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bibliochida`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`autor` (
  `id_autor` INT NOT NULL AUTO_INCREMENT,
  `descrip_autor` VARCHAR(125) NOT NULL,
  PRIMARY KEY (`id_autor`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idautor_UNIQUE` ON `bibliochida`.`autor` (`id_autor` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`libro` (
  `id_libro` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(90) NOT NULL,
  `isbn_libro` VARCHAR(45) NULL,
  `cantidad_disponible` INT NOT NULL,
  `anho_publicacion` DATE NOT NULL,
  `estado` TINYINT NOT NULL,
  `id_idioma` INT NOT NULL,
  `id_editorial` INT NOT NULL,
  `id_autor` INT NOT NULL,
  PRIMARY KEY (`id_libro`),
  CONSTRAINT `fk_libro_idioma1`
    FOREIGN KEY (`id_idioma`)
    REFERENCES `bibliochida`.`idioma` (`id_idioma`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_libro_editorial1`
    FOREIGN KEY (`id_editorial`)
    REFERENCES `bibliochida`.`editorial` (`id_editorial`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_libro_autor1`
    FOREIGN KEY (`id_autor`)
    REFERENCES `bibliochida`.`autor` (`id_autor`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `isbnLibro_UNIQUE` ON `bibliochida`.`libro` (`isbn_libro` ASC) VISIBLE;

CREATE INDEX `fk_libro_idioma1_idx` ON `bibliochida`.`libro` (`id_idioma` ASC) VISIBLE;

CREATE INDEX `fk_libro_editorial1_idx` ON `bibliochida`.`libro` (`id_editorial` ASC) VISIBLE;

CREATE INDEX `fk_libro_autor1_idx` ON `bibliochida`.`libro` (`id_autor` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`genero` (
  `id_genero` INT NOT NULL AUTO_INCREMENT,
  `descrip_genero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_genero`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `descripGenero_UNIQUE` ON `bibliochida`.`genero` (`descrip_genero` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`libro_genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`libro_genero` (
  `id_libro` INT NOT NULL,
  `id_genero` INT NOT NULL,
  PRIMARY KEY (`id_libro`, `id_genero`),
  CONSTRAINT `fk_libro_genero_libro`
    FOREIGN KEY (`id_libro`)
    REFERENCES `bibliochida`.`libro` (`id_libro`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_libro_genero_genero1`
    FOREIGN KEY (`id_genero`)
    REFERENCES `bibliochida`.`genero` (`id_genero`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_libro_genero_genero1_idx` ON `bibliochida`.`libro_genero` (`id_genero` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`roles` (
  `id_roles` INT NOT NULL AUTO_INCREMENT,
  `descrip_rol` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_roles`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idRoles_UNIQUE` ON `bibliochida`.`roles` (`id_roles` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `alias` VARCHAR(25) NOT NULL,
  `clave` VARCHAR(255) NOT NULL,
  `id_roles` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_usuario_roles1`
    FOREIGN KEY (`id_roles`)
    REFERENCES `bibliochida`.`roles` (`id_roles`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idUsuario_UNIQUE` ON `bibliochida`.`usuario` (`id_usuario` ASC) VISIBLE;

CREATE INDEX `fk_usuario_roles1_idx` ON `bibliochida`.`usuario` (`id_roles` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(125) NOT NULL,
  `telefono` INT NOT NULL,
  `correo` VARCHAR(125) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idCliente_UNIQUE` ON `bibliochida`.`cliente` (`id_cliente` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bibliochida`.`prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliochida`.`prestamo` (
  `id_prestamo` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `id_libro` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `fecha_prestamo` DATE NOT NULL,
  `fecha_devolucion` DATE NOT NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`id_prestamo`),
  CONSTRAINT `fk_prestamo_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `bibliochida`.`cliente` (`id_cliente`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_prestamo_libro1`
    FOREIGN KEY (`id_libro`)
    REFERENCES `bibliochida`.`libro` (`id_libro`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_prestamo_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `bibliochida`.`usuario` (`id_usuario`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idPrestamo_UNIQUE` ON `bibliochida`.`prestamo` (`id_prestamo` ASC) VISIBLE;

CREATE INDEX `fk_prestamo_cliente1_idx` ON `bibliochida`.`prestamo` (`id_cliente` ASC) VISIBLE;

CREATE INDEX `fk_prestamo_libro1_idx` ON `bibliochida`.`prestamo` (`id_libro` ASC) VISIBLE;

CREATE INDEX `fk_prestamo_usuario1_idx` ON `bibliochida`.`prestamo` (`id_usuario` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
