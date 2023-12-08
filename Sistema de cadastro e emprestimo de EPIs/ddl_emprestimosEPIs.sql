-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_emprestimosepi
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_emprestimosepi
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_emprestimosepi` DEFAULT CHARACTER SET utf8 ;
USE `db_emprestimosepi` ;

-- -----------------------------------------------------
-- Table `db_emprestimosepi`.`colaboradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_emprestimosepi`.`colaboradores` (
  `id_colaborador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `cpf` VARCHAR(255) NULL,
  `imagem` VARCHAR(255) NULL,
  `funcao` VARCHAR(255) NULL,
  `turno` VARCHAR(255) NULL,
  `data_ad` VARCHAR(255) NULL,
  PRIMARY KEY (`id_colaborador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_emprestimosepi`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_emprestimosepi`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `usuario` VARCHAR(255) NULL,
  `senha` VARCHAR(255) NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_emprestimosepi`.`epis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_emprestimosepi`.`epis` (
  `id_epi` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL,
  `quantidade` INT NULL,
  `imagem` VARCHAR(45) NULL,
  PRIMARY KEY (`id_epi`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_emprestimosepi`.`emprestimos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_emprestimosepi`.`emprestimos` (
  `id_emprestimo` INT NOT NULL AUTO_INCREMENT,
  `data_retirada` DATE NULL,
  `data_devolucao` DATE NULL,
  `situacao` VARCHAR(255) NULL,
  `ca` VARCHAR(255) NULL,
  `fk_colaborador` INT NOT NULL,
  `fk_usuario` INT NOT NULL,
  `fk_epi` INT NOT NULL,
  PRIMARY KEY (`id_emprestimo`, `fk_colaborador`, `fk_usuario`, `fk_epi`),
  INDEX `fk_emprestimos_colaboradores_idx` (`fk_colaborador` ASC) ,
  INDEX `fk_emprestimos_usuarios1_idx` (`fk_usuario` ASC) ,
  INDEX `fk_emprestimos_epis1_idx` (`fk_epi` ASC),
  CONSTRAINT `fk_emprestimos_colaboradores`
    FOREIGN KEY (`fk_colaborador`)
    REFERENCES `db_emprestimosepi`.`colaboradores` (`id_colaborador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimos_usuarios1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `db_emprestimosepi`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimos_epis1`
    FOREIGN KEY (`fk_epi`)
    REFERENCES `db_emprestimosepi`.`epis` (`id_epi`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `db_emprestimosepi`.`usuarios` (`nome`, `usuario`, `senha`) VALUES ('admin', 'admin', '123');
