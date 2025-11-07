-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema linguasteste
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema linguasteste
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `linguasteste` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
-- -----------------------------------------------------
-- Schema linguasbd
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema linguasbd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `linguasbd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `linguasteste` ;

-- -----------------------------------------------------
-- Table `linguasteste`.`audio_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`audio_resource` (
  `idaudio` INT NOT NULL,
  `nome_audio` VARCHAR(50) NOT NULL,
  `nome_ficheiro` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idaudio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`dificuldade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`dificuldade` (
  `iddificuldade` INT NOT NULL,
  `grau_dificuldade` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`iddificuldade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`idioma` (
  `ididiomas` INT NOT NULL,
  `lingua_descricao` VARCHAR(45) NOT NULL,
  `lingua_sigla` VARCHAR(5) NOT NULL,
  `lingua_bandeira` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ididiomas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`curso` (
  `idcurso` INT NOT NULL,
  `idioma_id` INT NOT NULL,
  `dificuldade_id` INT NOT NULL,
  `titulo_curso` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`idcurso`),
  INDEX `fk_curso_idioma1_idx` (`idioma_id` ASC) VISIBLE,
  INDEX `fk_curso_dificuldade1_idx` (`dificuldade_id` ASC) VISIBLE,
  CONSTRAINT `fk_curso_dificuldade1`
    FOREIGN KEY (`dificuldade_id`)
    REFERENCES `linguasteste`.`dificuldade` (`iddificuldade`),
  CONSTRAINT `fk_curso_idioma1`
    FOREIGN KEY (`idioma_id`)
    REFERENCES `linguasteste`.`idioma` (`ididiomas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`aula` (
  `idaula` INT NOT NULL,
  `titulo_aula` VARCHAR(50) NOT NULL,
  `descricao_aula` VARCHAR(80) NULL DEFAULT NULL,
  `numero_de_exercicios` INT NOT NULL,
  `tempo_estimado` VARCHAR(25) NULL DEFAULT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`idaula`),
  INDEX `fk_aula_curso1_idx` (`curso_id` ASC) VISIBLE,
  CONSTRAINT `fk_aula_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `linguasteste`.`curso` (`idcurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`tipoexercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`tipoexercicio` (
  `idtipoexercicios` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`audio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`audio` (
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
    REFERENCES `linguasteste`.`audio_resource` (`idaudio`),
  CONSTRAINT `fk_audio_resource_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasteste`.`aula` (`idaula`),
  CONSTRAINT `fk_audio_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasteste`.`tipoexercicio` (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`auth_rule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`auth_rule` (
  `name` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `data` BLOB NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL,
  `updated_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`auth_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`auth_item` (
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
    REFERENCES `linguasteste`.`auth_rule` (`name`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`auth_assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`auth_assignment` (
  `item_name` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `user_id` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `created_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  INDEX `idx-auth_assignment-user_id` (`user_id` ASC) VISIBLE,
  CONSTRAINT `auth_assignment_ibfk_1`
    FOREIGN KEY (`item_name`)
    REFERENCES `linguasteste`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`auth_item_child`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`auth_item_child` (
  `parent` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  `child` VARCHAR(64) CHARACTER SET 'utf8mb3' NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  INDEX `child` (`child` ASC) VISIBLE,
  CONSTRAINT `auth_item_child_ibfk_1`
    FOREIGN KEY (`parent`)
    REFERENCES `linguasteste`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2`
    FOREIGN KEY (`child`)
    REFERENCES `linguasteste`.`auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`utilizador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`utilizador` (
  `idutilizador` INT NOT NULL,
  `data_nascimento` DATETIME NULL DEFAULT NULL,
  `numero_telefone` INT NULL DEFAULT NULL,
  `nacionalidade` VARCHAR(25) NOT NULL,
  `data_inscricao` DATETIME NOT NULL,
  PRIMARY KEY (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`comentario` (
  `idcomentario` INT NOT NULL,
  `titulo_comentario` VARCHAR(45) NOT NULL,
  `descricao_comentario` VARCHAR(45) NOT NULL,
  `aula_id` INT NOT NULL,
  `hora_criada` DATETIME NULL DEFAULT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comentario_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_comentario_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_comentario_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasteste`.`aula` (`idaula`),
  CONSTRAINT `fk_comentario_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasteste`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`feedback`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`feedback` (
  `idfeedback` INT NOT NULL,
  `assunto_feedback` VARCHAR(45) NOT NULL,
  `descricao_feedback` VARCHAR(45) NOT NULL,
  `hora_criada` DATETIME NULL DEFAULT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`idfeedback`),
  INDEX `fk_feedback_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_feedback_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasteste`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`frase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`frase` (
  `idfrase` INT NOT NULL,
  `partefrases_1` VARCHAR(100) NOT NULL,
  `partefrases_2` VARCHAR(100) NOT NULL,
  `resposta` VARCHAR(60) NOT NULL,
  `aula_id` INT NOT NULL,
  `tipoexercicio_id` INT NOT NULL,
  PRIMARY KEY (`idfrase`),
  INDEX `fk_frase_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_frase_tipoexercicio1_idx` (`tipoexercicio_id` ASC) VISIBLE,
  CONSTRAINT `fk_frase_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasteste`.`aula` (`idaula`),
  CONSTRAINT `fk_frase_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasteste`.`tipoexercicio` (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`imagem_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`imagem_resource` (
  `idimagem` INT NOT NULL,
  `nome_imagem` VARCHAR(45) NULL DEFAULT NULL,
  `nome_ficheiro` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idimagem`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`imagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`imagem` (
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
    REFERENCES `linguasteste`.`aula` (`idaula`),
  CONSTRAINT `fk_imagem_resource_has_aula_imagem_resource1`
    FOREIGN KEY (`imagem_resource_id`)
    REFERENCES `linguasteste`.`imagem_resource` (`idimagem`),
  CONSTRAINT `fk_imagem_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasteste`.`tipoexercicio` (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`inscricao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`inscricao` (
  `utilizador_id` INT NOT NULL,
  `curso_id` INT NOT NULL,
  `data_inscricao` DATETIME NULL DEFAULT NULL,
  `progresso` INT NULL DEFAULT NULL,
  `estado` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`utilizador_id`, `curso_id`),
  INDEX `fk_utilizador_has_curso_curso1_idx` (`curso_id` ASC) VISIBLE,
  INDEX `fk_utilizador_has_curso_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_curso_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `linguasteste`.`curso` (`idcurso`),
  CONSTRAINT `fk_utilizador_has_curso_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasteste`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`opcoesai`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`opcoesai` (
  `idopcoesai` INT NOT NULL,
  `iscorreta` TINYINT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `audio_audio_resource_id` INT NULL DEFAULT NULL,
  `audio_aula_id` INT NULL DEFAULT NULL,
  `imagem_imagem_resource_id` INT NULL DEFAULT NULL,
  `imagem_aula_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idopcoesai`),
  INDEX `fk_opcoesai_audio1_idx` (`audio_audio_resource_id` ASC, `audio_aula_id` ASC) VISIBLE,
  INDEX `fk_opcoesai_imagem1_idx` (`imagem_imagem_resource_id` ASC, `imagem_aula_id` ASC) VISIBLE,
  CONSTRAINT `fk_opcoesai_audio1`
    FOREIGN KEY (`audio_audio_resource_id` , `audio_aula_id`)
    REFERENCES `linguasteste`.`audio` (`audio_resource_id` , `aula_id`),
  CONSTRAINT `fk_opcoesai_imagem1`
    FOREIGN KEY (`imagem_imagem_resource_id` , `imagem_aula_id`)
    REFERENCES `linguasteste`.`imagem` (`imagem_resource_id` , `aula_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`resultado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`resultado` (
  `utilizador_id` INT NOT NULL,
  `aula_id` INT NOT NULL,
  `data_inicio` VARCHAR(45) NULL DEFAULT NULL,
  `data_fim` VARCHAR(45) NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `nota` VARCHAR(45) NULL DEFAULT NULL,
  `tempo_demorado` INT NULL,
  `data_agendamento` DATETIME NULL,
  PRIMARY KEY (`utilizador_id`, `aula_id`),
  INDEX `fk_utilizador_has_aula_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_utilizador_has_aula_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasteste`.`aula` (`idaula`),
  CONSTRAINT `fk_utilizador_has_aula_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasteste`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasteste`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasteste`.`user` (
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
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

USE `linguasbd` ;

-- -----------------------------------------------------
-- Table `linguasbd`.`audio_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`audio_resource` (
  `idaudio` INT NOT NULL,
  `nome_audio` VARCHAR(50) NOT NULL,
  `nome_ficheiro` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idaudio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`dificuldade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`dificuldade` (
  `iddificuldade` INT NOT NULL,
  `grau_dificuldade` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`iddificuldade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`idioma` (
  `ididiomas` INT NOT NULL,
  `lingua_descricao` VARCHAR(45) NOT NULL,
  `lingua_sigla` VARCHAR(5) NOT NULL,
  `lingua_bandeira` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ididiomas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`curso` (
  `idcurso` INT NOT NULL,
  `idioma_id` INT NOT NULL,
  `dificuldade_id` INT NOT NULL,
  `titulo_curso` VARCHAR(70) NOT NULL,
  `status_ativo` TINYINT NOT NULL,
  PRIMARY KEY (`idcurso`),
  INDEX `fk_curso_idioma1_idx` (`idioma_id` ASC) VISIBLE,
  INDEX `fk_curso_dificuldade1_idx` (`dificuldade_id` ASC) VISIBLE,
  CONSTRAINT `fk_curso_dificuldade1`
    FOREIGN KEY (`dificuldade_id`)
    REFERENCES `linguasbd`.`dificuldade` (`iddificuldade`),
  CONSTRAINT `fk_curso_idioma1`
    FOREIGN KEY (`idioma_id`)
    REFERENCES `linguasbd`.`idioma` (`ididiomas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`aula` (
  `idaula` INT NOT NULL,
  `titulo_aula` VARCHAR(50) NOT NULL,
  `descricao_aula` VARCHAR(80) NULL DEFAULT NULL,
  `numero_de_exercicios` INT NOT NULL,
  `tempo_estimado` VARCHAR(25) NULL DEFAULT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`idaula`),
  INDEX `fk_aula_curso1_idx` (`curso_id` ASC) VISIBLE,
  CONSTRAINT `fk_aula_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `linguasbd`.`curso` (`idcurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`tipoexercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`tipoexercicio` (
  `idtipoexercicios` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idtipoexercicios`))
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
    REFERENCES `linguasbd`.`audio_resource` (`idaudio`),
  CONSTRAINT `fk_audio_resource_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`idaula`),
  CONSTRAINT `fk_audio_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`idtipoexercicios`))
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
-- Table `linguasbd`.`utilizador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`utilizador` (
  `idutilizador` INT NOT NULL,
  `data_nascimento` DATETIME NULL DEFAULT NULL,
  `numero_telefone` INT NULL DEFAULT NULL,
  `nacionalidade` VARCHAR(25) NOT NULL,
  `data_inscricao` DATETIME NOT NULL,
  PRIMARY KEY (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`comentario` (
  `idcomentario` INT NOT NULL,
  `titulo_comentario` VARCHAR(45) NOT NULL,
  `descricao_comentario` VARCHAR(45) NOT NULL,
  `aula_id` INT NOT NULL,
  `hora_criada` DATETIME NULL DEFAULT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comentario_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_comentario_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_comentario_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`idaula`),
  CONSTRAINT `fk_comentario_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`feedback`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`feedback` (
  `idfeedback` INT NOT NULL,
  `assunto_feedback` VARCHAR(45) NOT NULL,
  `descricao_feedback` VARCHAR(45) NOT NULL,
  `hora_criada` DATETIME NULL DEFAULT NULL,
  `utilizador_id` INT NOT NULL,
  PRIMARY KEY (`idfeedback`),
  INDEX `fk_feedback_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_feedback_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`idutilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`frase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`frase` (
  `idfrase` INT NOT NULL,
  `partefrases_1` VARCHAR(100) NOT NULL,
  `partefrases_2` VARCHAR(100) NOT NULL,
  `resposta` VARCHAR(60) NOT NULL,
  `aula_id` INT NOT NULL,
  `tipoexercicio_id` INT NOT NULL,
  PRIMARY KEY (`idfrase`),
  INDEX `fk_frase_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_frase_tipoexercicio1_idx` (`tipoexercicio_id` ASC) VISIBLE,
  CONSTRAINT `fk_frase_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`idaula`),
  CONSTRAINT `fk_frase_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`imagem_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`imagem_resource` (
  `idimagem` INT NOT NULL,
  `nome_imagem` VARCHAR(45) NULL DEFAULT NULL,
  `nome_ficheiro` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idimagem`))
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
    REFERENCES `linguasbd`.`aula` (`idaula`),
  CONSTRAINT `fk_imagem_resource_has_aula_imagem_resource1`
    FOREIGN KEY (`imagem_resource_id`)
    REFERENCES `linguasbd`.`imagem_resource` (`idimagem`),
  CONSTRAINT `fk_imagem_tipoexercicio1`
    FOREIGN KEY (`tipoexercicio_id`)
    REFERENCES `linguasbd`.`tipoexercicio` (`idtipoexercicios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `linguasbd`.`inscricao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `linguasbd`.`inscricao` (
  `utilizador_id` INT NOT NULL,
  `curso_id` INT NOT NULL,
  `data_inscricao` DATETIME NULL DEFAULT NULL,
  `progresso` INT NULL DEFAULT NULL,
  `estado` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`utilizador_id`, `curso_id`),
  INDEX `fk_utilizador_has_curso_curso1_idx` (`curso_id` ASC) VISIBLE,
  INDEX `fk_utilizador_has_curso_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_curso_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `linguasbd`.`curso` (`idcurso`),
  CONSTRAINT `fk_utilizador_has_curso_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`idutilizador`))
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
  `idopcoesai` INT NOT NULL,
  `iscorreta` TINYINT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `audio_audio_resource_id` INT NULL DEFAULT NULL,
  `audio_aula_id` INT NULL DEFAULT NULL,
  `imagem_imagem_resource_id` INT NULL DEFAULT NULL,
  `imagem_aula_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idopcoesai`),
  INDEX `fk_opcoesai_audio1_idx` (`audio_audio_resource_id` ASC, `audio_aula_id` ASC) VISIBLE,
  INDEX `fk_opcoesai_imagem1_idx` (`imagem_imagem_resource_id` ASC, `imagem_aula_id` ASC) VISIBLE,
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
  `aula_id` INT NOT NULL,
  `data_inicio` VARCHAR(45) NULL DEFAULT NULL,
  `data_fim` VARCHAR(45) NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `nota` VARCHAR(45) NULL DEFAULT NULL,
  `tempo_demorado` INT NULL DEFAULT NULL,
  `data_agendamento` DATETIME NULL DEFAULT NULL,
  `respostas_certas` INT NULL DEFAULT NULL,
  `respostas_erradas` INT NULL DEFAULT NULL,
  PRIMARY KEY (`utilizador_id`, `aula_id`),
  INDEX `fk_utilizador_has_aula_aula1_idx` (`aula_id` ASC) VISIBLE,
  INDEX `fk_utilizador_has_aula_utilizador1_idx` (`utilizador_id` ASC) VISIBLE,
  CONSTRAINT `fk_utilizador_has_aula_aula1`
    FOREIGN KEY (`aula_id`)
    REFERENCES `linguasbd`.`aula` (`idaula`),
  CONSTRAINT `fk_utilizador_has_aula_utilizador1`
    FOREIGN KEY (`utilizador_id`)
    REFERENCES `linguasbd`.`utilizador` (`idutilizador`))
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
  `utilizador_idutilizador` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC) VISIBLE,
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  UNIQUE INDEX `password_reset_token` (`password_reset_token` ASC) VISIBLE,
  INDEX `fk_user_utilizador1_idx` (`utilizador_idutilizador` ASC) VISIBLE,
  CONSTRAINT `fk_user_utilizador1`
    FOREIGN KEY (`utilizador_idutilizador`)
    REFERENCES `linguasbd`.`utilizador` (`idutilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
