-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema linguasbd
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema linguasbd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `linguasbd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `linguasbd` ;

-- -----------------------------------------------------
-- Table `linguasbd`.`audio_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`audio_resource` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_audio` VARCHAR(50) NOT NULL,
  `nome_ficheiro` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`dificuldade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`dificuldade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grau_dificuldade` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`idioma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lingua_descricao` VARCHAR(45) NOT NULL,
  `lingua_sigla` VARCHAR(5) NOT NULL,
  `lingua_bandeira` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idioma_id` INT NOT NULL,
  `dificuldade_id` INT NOT NULL,
  `titulo_curso` VARCHAR(70) NOT NULL,
  `status_ativo` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curso_idioma1_idx` (`idioma_id` ASC) VISIBLE,
  INDEX `fk_curso_dificuldade1_idx` (`dificuldade_id` ASC) VISIBLE,
  CONSTRAINT `fk_curso_dificuldade1`
    FOREIGN KEY (`dificuldade_id`)
    REFERENCES `linguasbd`.`dificuldade` (`id`),
  CONSTRAINT `fk_curso_idioma1`
    FOREIGN KEY (`idioma_id`)
    REFERENCES `linguasbd`.`idioma` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`aula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo_aula` VARCHAR(50) NOT NULL,
  `descricao_aula` VARCHAR(80) NOT NULL,
  `numero_de_exercicios` INT NOT NULL,
  `tempo_estimado` VARCHAR(25) NOT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_aula_curso1_idx` (`curso_id` ASC) VISIBLE,
  CONSTRAINT `fk_aula_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `linguasbd`.`curso` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`tipoexercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`tipoexercicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`audio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`audio` (
  `audio_resource_id` INT NOT NULL,
  `aula_id` INT NOT NULL,
  `pergunta` VARCHAR(80) NOT NULL,
  `tipoexercicio_id` INT NOT NULL,
  PRIMARY KEY (`audio_resource_id`, `aula_id`),
  INDEX `fk_audio_resource_has_aula_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_audio_resource_has_aula_audio_resource1_idx` (`audio_resource_id` ASC) VISIBLE,
  INDEX `fk_audio_tipoexercicio1_idx` (`tipoexercicio_id` ASC) VISIBLE,
  CONSTRAINT `fk_audio_resource_has_aula_audio_resource1`
    FOREIGN KEY (`audio_resource_id`)
    REFERENCES `linguasbd`.`audio_resource` (`id`),
  CONSTRAINT `fk_audio_resource_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`id`),
  CONSTRAINT `fk_audio_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`auth_rule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`auth_rule` (
  `name` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `data` BLOB NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL,
  `updated_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`auth_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`auth_item` (
  `name` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `type` SMALLINT NOT NULL,
  `description` TEXT CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `rule_name` VARCHAR(64) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `data` BLOB NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL,
  `updated_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`name`),
  INDEX `rule_name` (`rule_name` ASC) VISIBLE,
  INDEX `idx-auth_item-type` (`type` ASC) VISIBLE,
  CONSTRAINT `auth_item_ibfk_1`
    FOREIGN KEY (`rule_name`)
    REFERENCES `linguasbd`.`auth_rule` (`name`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`auth_assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`auth_assignment` (
  `item_name` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `user_id` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `created_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  INDEX `idx-auth_assignment-user_id` (`user_id` ASC) VISIBLE,
  CONSTRAINT `auth_assignment_ibfk_1`
    FOREIGN KEY (`item_name`)
    REFERENCES `linguasbd`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`auth_item_child`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`auth_item_child` (
  `parent` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `child` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  INDEX `child` (`child` ASC) VISIBLE,
  CONSTRAINT `auth_item_child_ibfk_1`
    FOREIGN KEY (`parent`)
    REFERENCES `linguasbd`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2`
    FOREIGN KEY (`child`)
    REFERENCES `linguasbd`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) CHARACTER SET 'utf8mb3' NOT NULL,
  `auth_key` VARCHAR(32) CHARACTER SET 'utf8mb3' NOT NULL,
  `password_hash` VARCHAR(255) CHARACTER SET 'utf8mb3' NOT NULL,
  `password_reset_token` VARCHAR(255) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb3' NOT NULL,
  `status` SMALLINT NOT NULL DEFAULT '10',
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,
  `verification_token` VARCHAR(255) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC) VISIBLE,
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  UNIQUE INDEX `password_reset_token` (`password_reset_token` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`utilizador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`utilizador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_nascimento` DATETIME NOT NULL,
  `numero_telefone` INT NOT NULL,
  `nacionalidade` VARCHAR(25) NOT NULL,
  `data_inscricao` DATETIME NOT NULL,
  `user_id` INT NOT NULL,
  `idioma_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_utilizador_user1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_utilizador_idioma1_idx` (`idioma_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `linguasbd`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilizador_idioma1`
    FOREIGN KEY (`idioma_id`)
    REFERENCES `linguasbd`.`idioma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao_comentario` VARCHAR(45) NOT NULL,
  `aula_id` INT NOT NULL,
  `hora_criada` DATETIME NOT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_comentario_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_comentario_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`id`),
  CONSTRAINT `fk_comentario_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`feedback`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`feedback` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `assunto_feedback` VARCHAR(45) NOT NULL,
  `descricao_feedback` VARCHAR(45) NOT NULL,
  `hora_criada` DATETIME NOT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_feedback_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_feedback_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`frase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`frase` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `partefrases_1` VARCHAR(100) NOT NULL,
  `partefrases_2` VARCHAR(100) NOT NULL,
  `resposta` VARCHAR(60) NOT NULL,
  `aula_id` INT NOT NULL,
  `tipoexercicio_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_frase_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_frase_tipoexercicio1_idx` (`tipoexercicio_id` ASC) VISIBLE,
  CONSTRAINT `fk_frase_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`id`),
  CONSTRAINT `fk_frase_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`imagem_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`imagem_resource` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_imagem` VARCHAR(45) NOT NULL,
  `nome_ficheiro` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`imagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`imagem` (
  `imagem_resource_id` INT NOT NULL,
  `aula_id` INT NOT NULL,
  `pergunta` VARCHAR(45) NOT NULL,
  `tipoexercicio_id` INT NOT NULL,
  PRIMARY KEY (`imagem_resource_id`, `aula_id`),
  INDEX `fk_imagem_resource_has_aula_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_imagem_resource_has_aula_imagem_resource1_idx` (`imagem_resource_id` ASC) VISIBLE,
  INDEX `fk_imagem_tipoexercicio1_idx` (`tipoexercicio_id` ASC) VISIBLE,
  CONSTRAINT `fk_imagem_resource_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`id`),
  CONSTRAINT `fk_imagem_resource_has_aula_imagem_resource1`
    FOREIGN KEY (`imagem_resource_id`)
    REFERENCES `linguasbd`.`imagem_resource` (`id`),
  CONSTRAINT `fk_imagem_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`opcoesai`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`opcoesai` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `iscorreta` TINYINT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `audio_audio_resource_id` INT NULL DEFAULT NULL,
  `audio_aula_id` INT NULL DEFAULT NULL,
  `imagem_imagem_resource_id` INT NULL DEFAULT NULL,
  `imagem_aula_id` INT NULL DEFAULT NULL,
  `frase_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_opcoesai_audio1_idx` (`audio_audio_resource_id` ASC, `audio_aula_id` ASC) VISIBLE,
  INDEX `fk_opcoesai_imagem1_idx` (`imagem_imagem_resource_id` ASC, `imagem_aula_id` ASC) VISIBLE,
  INDEX `fk_opcao_frase` (`frase_id` ASC) VISIBLE,
  CONSTRAINT `fk_opcao_frase`
    FOREIGN KEY (`frase_id`)
    REFERENCES `linguasbd`.`frase` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_opcoesai_audio1`
    FOREIGN KEY (`audio_audio_resource_id` , `audio_aula_id`)
    REFERENCES `linguasbd`.`audio` (`audio_resource_id` , `aula_id`),
  CONSTRAINT `fk_opcoesai_imagem1`
    FOREIGN KEY (`imagem_imagem_resource_id` , `imagem_aula_id`)
    REFERENCES `linguasbd`.`imagem` (`imagem_resource_id` , `aula_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`resultado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`resultado` (
  `utilizador_id` INT NOT NULL,
  `aula_idaula` INT NOT NULL,
  `data_inicio` DATETIME NULL,
  `data_fim` DATETIME NULL,
  `estado` VARCHAR(45) NOT NULL,
  `nota` INT NULL,
  `tempo_estimado` INT NULL,
  `data_agendamento` DATETIME NULL,
  `respostas_certas` INT NULL,
  `respostas_erradas` INT NULL,
  PRIMARY KEY (`utilizador_id`, `aula_idaula`),
  INDEX `fk_utilizador_has_aula_aula2_idx` (`aula_idaula` ASC) VISIBLE,
  INDEX `fk_utilizador_has_aula_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_aula_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilizador_has_aula_aula2`
    FOREIGN KEY (`aula_idaula`)
    REFERENCES `linguasbd`.`aula` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`inscricao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`inscricao` (
  `utilizador_id` INT NOT NULL,
  `curso_idcurso` INT NOT NULL,
  `data_inscricao` VARCHAR(45) NOT NULL,
  `progresso` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`utilizador_id`, `curso_idcurso`),
  INDEX `fk_utilizador_has_curso_curso2_idx` (`curso_idcurso` ASC) VISIBLE,
  INDEX `fk_utilizador_has_curso_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_curso_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilizador_has_curso_curso2`
    FOREIGN KEY (`curso_idcurso`)
    REFERENCES `linguasbd`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
