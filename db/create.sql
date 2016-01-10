-- MySQL Script generated by MySQL Workbench
-- 01/10/16 19:57:00
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema 3163_3362_3374
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `3163_3362_3374` ;

-- -----------------------------------------------------
-- Schema 3163_3362_3374
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `3163_3362_3374` DEFAULT CHARACTER SET utf8 ;
USE `3163_3362_3374` ;

-- -----------------------------------------------------
-- Table `3163_3362_3374`.`university`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`university` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`university` (
  `universityId` INT NOT NULL AUTO_INCREMENT,
  `universityName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`universityId`),
  UNIQUE INDEX `id_UNIQUE` (`universityId` ASC),
  UNIQUE INDEX `universityName_UNIQUE` (`universityName` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`department`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`department` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`department` (
  `departmentId` INT NOT NULL AUTO_INCREMENT,
  `departmentName` VARCHAR(45) NOT NULL,
  `university_universityId` INT NOT NULL,
  PRIMARY KEY (`departmentId`),
  UNIQUE INDEX `id_UNIQUE` (`departmentId` ASC),
  INDEX `fk_departments_universities_idx` (`university_universityId` ASC),
  UNIQUE INDEX `uniName_depName_UNIQUE` (`university_universityId` ASC, `departmentName` ASC),
  CONSTRAINT `fk_departments_universities`
    FOREIGN KEY (`university_universityId`)
    REFERENCES `3163_3362_3374`.`university` (`universityId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`student` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`student` (
  `studentId` INT NOT NULL AUTO_INCREMENT,
  `studentUsername` VARCHAR(45) NOT NULL,
  `studentPassword` VARCHAR(45) NOT NULL,
  `department_departmentId` INT NOT NULL,
  PRIMARY KEY (`studentId`),
  UNIQUE INDEX `studentUsername_UNIQUE` (`studentUsername` ASC),
  INDEX `fk_student_department1_idx` (`department_departmentId` ASC),
  UNIQUE INDEX `studentId_UNIQUE` (`studentId` ASC),
  CONSTRAINT `fk_student_department1`
    FOREIGN KEY (`department_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`course` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`course` (
  `courseId` INT NOT NULL AUTO_INCREMENT,
  `courseName` VARCHAR(45) NOT NULL,
  `department_departmentId` INT NOT NULL,
  PRIMARY KEY (`courseId`),
  UNIQUE INDEX `courseId_UNIQUE` (`courseId` ASC),
  INDEX `fk_course_department1_idx` (`department_departmentId` ASC),
  CONSTRAINT `fk_course_department1`
    FOREIGN KEY (`department_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`grade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`grade` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`grade` (
  `grade` DOUBLE NOT NULL,
  `student_studentId` INT NOT NULL,
  `course_courseId` INT NOT NULL,
  PRIMARY KEY (`course_courseId`, `student_studentId`),
  INDEX `fk_grade_student1_idx` (`student_studentId` ASC),
  INDEX `fk_grade_course1_idx` (`course_courseId` ASC),
  CONSTRAINT `fk_grade_student1`
    FOREIGN KEY (`student_studentId`)
    REFERENCES `3163_3362_3374`.`student` (`studentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grade_course1`
    FOREIGN KEY (`course_courseId`)
    REFERENCES `3163_3362_3374`.`course` (`courseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`professor` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`professor` (
  `professorId` INT NOT NULL AUTO_INCREMENT,
  `professorUsername` VARCHAR(45) NOT NULL,
  `professorPassword` VARCHAR(45) NOT NULL,
  `department_departmentId` INT NOT NULL,
  PRIMARY KEY (`professorId`),
  UNIQUE INDEX `professor_UNIQUE` (`professorId` ASC),
  UNIQUE INDEX `professorUsername_UNIQUE` (`professorUsername` ASC),
  INDEX `fk_professor_department1_idx` (`department_departmentId` ASC),
  CONSTRAINT `fk_professor_department1`
    FOREIGN KEY (`department_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`class`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`class` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`class` (
  `classId` INT NOT NULL AUTO_INCREMENT,
  `professor_professorId` INT NOT NULL,
  `course_courseId` INT NOT NULL,
  `department_departmentId` INT NOT NULL,
  `className` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`classId`),
  INDEX `fk_class_professor1_idx` (`professor_professorId` ASC),
  INDEX `fk_class_course1_idx` (`course_courseId` ASC),
  UNIQUE INDEX `classId_UNIQUE` (`classId` ASC),
  INDEX `fk_class_department1_idx` (`department_departmentId` ASC),
  CONSTRAINT `fk_class_professor1`
    FOREIGN KEY (`professor_professorId`)
    REFERENCES `3163_3362_3374`.`professor` (`professorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_course1`
    FOREIGN KEY (`course_courseId`)
    REFERENCES `3163_3362_3374`.`course` (`courseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_department1`
    FOREIGN KEY (`department_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`secretary`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`secretary` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`secretary` (
  `secretaryId` INT NOT NULL AUTO_INCREMENT,
  `secretaryUsername` VARCHAR(45) NOT NULL,
  `secretaryPassword` VARCHAR(45) NOT NULL,
  `department_departmentId` INT NOT NULL,
  PRIMARY KEY (`secretaryId`),
  INDEX `fk_secretary_department1_idx` (`department_departmentId` ASC),
  UNIQUE INDEX `secretaryUsername_UNIQUE` (`secretaryUsername` ASC),
  UNIQUE INDEX `secretaryId_UNIQUE` (`secretaryId` ASC),
  UNIQUE INDEX `department_departmentId_UNIQUE` (`department_departmentId` ASC),
  CONSTRAINT `fk_secretary_department1`
    FOREIGN KEY (`department_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`admin` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`admin` (
  `adminId` INT NOT NULL AUTO_INCREMENT,
  `adminUsername` VARCHAR(45) NOT NULL,
  `adminPassword` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`adminId`),
  UNIQUE INDEX `adminUsername_UNIQUE` (`adminUsername` ASC),
  UNIQUE INDEX `adminId_UNIQUE` (`adminId` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`class_has_student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3163_3362_3374`.`class_has_student` ;

CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`class_has_student` (
  `class_classId` INT NOT NULL,
  `student_studentId` INT NOT NULL,
  PRIMARY KEY (`class_classId`, `student_studentId`),
  INDEX `fk_class_has_student_student1_idx` (`student_studentId` ASC),
  INDEX `fk_class_has_student_class1_idx` (`class_classId` ASC),
  CONSTRAINT `fk_class_has_student_class1`
    FOREIGN KEY (`class_classId`)
    REFERENCES `3163_3362_3374`.`class` (`classId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_has_student_student1`
    FOREIGN KEY (`student_studentId`)
    REFERENCES `3163_3362_3374`.`student` (`studentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
