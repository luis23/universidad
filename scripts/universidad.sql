SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `Universidad` ;
CREATE SCHEMA IF NOT EXISTS `Universidad` DEFAULT CHARACTER SET utf8 ;
USE `Universidad` ;

-- -----------------------------------------------------
-- Table `Universidad`.`Universidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Universidad` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Universidad` (
  `idunivrersidad` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idunivrersidad`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Campus_Ext`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Campus_Ext` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Campus_Ext` (
  `idext` INT NOT NULL ,
  `iduniversidad` INT NOT NULL ,
  `nombreExtencion` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idext`, `iduniversidad`) ,
  INDEX `fk_universidad` (`iduniversidad` ASC) ,
  CONSTRAINT `fk_universidad`
    FOREIGN KEY (`iduniversidad` )
    REFERENCES `Universidad`.`Universidad` (`idunivrersidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Alumnos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Alumnos` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Alumnos` (
  `carnet` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `direccion` VARCHAR(45) NOT NULL ,
  `correo` VARCHAR(45) NULL ,
  `sede` INT NOT NULL ,
  PRIMARY KEY (`carnet`, `sede`) ,
  INDEX `fk_idcampusExt` (`sede` ASC) ,
  CONSTRAINT `fk_idcampusExt`
    FOREIGN KEY (`sede` )
    REFERENCES `Universidad`.`Campus_Ext` (`idext` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Cursos` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Cursos` (
  `idcurso` INT NOT NULL AUTO_INCREMENT ,
  `curso` VARCHAR(45) NOT NULL ,
  `contenido` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idcurso`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Semestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Semestre` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Semestre` (
  `idsemestre` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `fechainicio` VARCHAR(45) NULL ,
  `fechafinal` VARCHAR(45) NULL ,
  `jornada` VARCHAR(45) NULL ,
  PRIMARY KEY (`idsemestre`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Asignacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Asignacion` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Asignacion` (
  `carnet` INT NOT NULL ,
  `idcurso` INT NOT NULL ,
  `nombrealumno` VARCHAR(45) NOT NULL ,
  `nombrecurso` VARCHAR(45) NOT NULL ,
  `idsemestre` INT NOT NULL ,
  PRIMARY KEY (`carnet`, `idcurso`, `idsemestre`) ,
  INDEX `fk_carnet_alumno` (`carnet` ASC) ,
  INDEX `fk_curso_asig` (`idcurso` ASC) ,
  INDEX `fk_semestreasig` (`idsemestre` ASC) ,
  CONSTRAINT `fk_carnet_alumno`
    FOREIGN KEY (`carnet` )
    REFERENCES `Universidad`.`Alumnos` (`carnet` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_asig`
    FOREIGN KEY (`idcurso` )
    REFERENCES `Universidad`.`Cursos` (`idcurso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_semestreasig`
    FOREIGN KEY (`idsemestre` )
    REFERENCES `Universidad`.`Semestre` (`idsemestre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Evaluacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Evaluacion` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Evaluacion` (
  `idevaluacion` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `valor` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idevaluacion`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Notas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Notas` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Notas` (
  `idcurso` INT NOT NULL ,
  `nombrecurso` VARCHAR(45) NOT NULL ,
  `Nota` VARCHAR(45) NOT NULL ,
  `carnet` INT NOT NULL ,
  `idsemestre` INT NOT NULL ,
  `idcarrera` VARCHAR(45) NOT NULL ,
  `idevaluacion` INT NOT NULL ,
  PRIMARY KEY (`idcurso`, `carnet`, `idsemestre`, `idevaluacion`) ,
  INDEX `fk_carnetalumn` (`carnet` ASC) ,
  INDEX `fk_evaluacion` (`idevaluacion` ASC) ,
  CONSTRAINT `fk_carnetalumn`
    FOREIGN KEY (`carnet` )
    REFERENCES `Universidad`.`Asignacion` (`carnet` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluacion`
    FOREIGN KEY (`idevaluacion` )
    REFERENCES `Universidad`.`Evaluacion` (`idevaluacion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Carrera`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Carrera` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Carrera` (
  `idcarrera` INT NOT NULL AUTO_INCREMENT ,
  `idext` INT NOT NULL ,
  `nombre_carrera` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idcarrera`, `idext`) ,
  INDEX `fk_idext` (`idext` ASC) ,
  CONSTRAINT `fk_idext`
    FOREIGN KEY (`idext` )
    REFERENCES `Universidad`.`Campus_Ext` (`idext` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Pensum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Pensum` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Pensum` (
  `idcarrera` INT NOT NULL ,
  `cod_curso` INT NOT NULL ,
  `creditos` INT NOT NULL ,
  `semestre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idcarrera`, `cod_curso`) ,
  INDEX `fk_curso` (`cod_curso` ASC) ,
  INDEX `fk_carrera` (`idcarrera` ASC) ,
  CONSTRAINT `fk_curso`
    FOREIGN KEY (`cod_curso` )
    REFERENCES `Universidad`.`Cursos` (`idcurso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrera`
    FOREIGN KEY (`idcarrera` )
    REFERENCES `Universidad`.`Carrera` (`idcarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Prequisitos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Prequisitos` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Prequisitos` (
  `id_carrera` INT NOT NULL ,
  `cod_cursopost` INT NOT NULL ,
  `cod_cursopre` INT NOT NULL ,
  PRIMARY KEY (`id_carrera`, `cod_cursopost`, `cod_cursopre`) ,
  INDEX `fk_codcursopos` (`cod_cursopost` ASC) ,
  INDEX `fk_codcursopre` (`cod_cursopre` ASC) ,
  CONSTRAINT `fk_codcursopos`
    FOREIGN KEY (`cod_cursopost` )
    REFERENCES `Universidad`.`Cursos` (`idcurso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codcursopre`
    FOREIGN KEY (`cod_cursopre` )
    REFERENCES `Universidad`.`Pensum` (`cod_curso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Usuario` (
  `login` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`login`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Rol` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Rol` (
  `Rol` INT NOT NULL ,
  `nombrerol` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`Rol`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Asignacion_Permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Asignacion_Permisos` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Asignacion_Permisos` (
  `login` VARCHAR(45) NOT NULL ,
  `rol` INT NOT NULL ,
  PRIMARY KEY (`login`, `rol`) ,
  INDEX `fk_login` (`login` ASC) ,
  INDEX `fk_roll` (`rol` ASC) ,
  CONSTRAINT `fk_login`
    FOREIGN KEY (`login` )
    REFERENCES `Universidad`.`Usuario` (`login` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roll`
    FOREIGN KEY (`rol` )
    REFERENCES `Universidad`.`Rol` (`Rol` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Universidad`.`Catedraticos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Universidad`.`Catedraticos` ;

CREATE  TABLE IF NOT EXISTS `Universidad`.`Catedraticos` (
  `idcatedratico` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `correo` VARCHAR(45) NOT NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idcatedratico`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Universidad`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Universidad` (`idunivrersidad`, `nombre`) VALUES (1, 'Universidad Mesoamericana');
INSERT INTO `Universidad`.`Universidad` (`idunivrersidad`, `nombre`) VALUES (2, 'Universidad De San Carlos De Guatemala');
INSERT INTO `Universidad`.`Universidad` (`idunivrersidad`, `nombre`) VALUES (3, 'Universidad del Valle Guatemala');
INSERT INTO `Universidad`.`Universidad` (`idunivrersidad`, `nombre`) VALUES (4, 'Universidad Rafael Landivar');

COMMIT;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Campus_Ext`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Campus_Ext` (`idext`, `iduniversidad`, `nombreExtencion`) VALUES (1, 1, 'Universidad Mesoamericana UPA');
INSERT INTO `Universidad`.`Campus_Ext` (`idext`, `iduniversidad`, `nombreExtencion`) VALUES (2, 1, 'Universidad Mesoamericana CampusCentral');

COMMIT;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Cursos`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (1, 'Matematica I', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (2, 'Biologia', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (4, 'Administracion', '2');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (5, 'Programacion I', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (6, 'Algebra Lineal', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (7, 'Electricidad', '2');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (8, 'Algebra Lineal II', '4');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (9, 'Programacion II', '2');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (10, 'Electronica Digital', '4');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (11, 'Fisica I', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (12, 'Fisica II', '2');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (13, 'Ambiental I', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (14, 'Diseño I', '1');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (15, 'Diseño II', '2');
INSERT INTO `Universidad`.`Cursos` (`idcurso`, `curso`, `contenido`) VALUES (16, 'Matematica II', '2');

COMMIT;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Semestre`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Semestre` (`idsemestre`, `nombre`, `fechainicio`, `fechafinal`, `jornada`) VALUES (1, 'Semestre I', '16/01/2013', '15/06/2013', 'Nocturna');
INSERT INTO `Universidad`.`Semestre` (`idsemestre`, `nombre`, `fechainicio`, `fechafinal`, `jornada`) VALUES (2, 'Semestre II', '15/07/2013', '5/11/2013', 'Nocturna');

COMMIT;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Carrera`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Carrera` (`idcarrera`, `idext`, `nombre_carrera`) VALUES (1, 1, 'Ingenieria En Informatica');
INSERT INTO `Universidad`.`Carrera` (`idcarrera`, `idext`, `nombre_carrera`) VALUES (2, 1, 'Derecho');
INSERT INTO `Universidad`.`Carrera` (`idcarrera`, `idext`, `nombre_carrera`) VALUES (3, 1, 'Arquitectura');
INSERT INTO `Universidad`.`Carrera` (`idcarrera`, `idext`, `nombre_carrera`) VALUES (4, 1, 'Administracion de Empresas');

COMMIT;

-- -----------------------------------------------------
-- Data for table `Universidad`.`Pensum`
-- -----------------------------------------------------
START TRANSACTION;
USE `Universidad`;
INSERT INTO `Universidad`.`Pensum` (`idcarrera`, `cod_curso`, `creditos`, `semestre`) VALUES (1, 1, 4, '1');
INSERT INTO `Universidad`.`Pensum` (`idcarrera`, `cod_curso`, `creditos`, `semestre`) VALUES (1, 5, 4, '1');
INSERT INTO `Universidad`.`Pensum` (`idcarrera`, `cod_curso`, `creditos`, `semestre`) VALUES (1, 6, 4, '1');
INSERT INTO `Universidad`.`Pensum` (`idcarrera`, `cod_curso`, `creditos`, `semestre`) VALUES (1, 11, 4, '1');

COMMIT;