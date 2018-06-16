-- MySQL Script generated by MySQL Workbench
-- 2018年06月16日 星期六 17时04分30秒
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema zhaopin
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema zhaopin
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `zhaopin` DEFAULT CHARACTER SET utf8 ;
USE `zhaopin` ;

-- -----------------------------------------------------
-- Table `zhaopin`.`positions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`positions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  `keywords` VARCHAR(245) NOT NULL DEFAULT '',
  `room_and_board` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '管吃管住3、管吃1、管住2、不包0',
  `number` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '预招人数',
  `content` TEXT NOT NULL COMMENT '职位详情',
  `benefit` VARCHAR(245) NOT NULL DEFAULT '' COMMENT '福利待遇',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '职位';


-- -----------------------------------------------------
-- Table `zhaopin`.`districts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`districts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '地区';


-- -----------------------------------------------------
-- Table `zhaopin`.`companies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`companies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  `logo` VARCHAR(245) NOT NULL DEFAULT '',
  `number` VARCHAR(245) NOT NULL DEFAULT '' COMMENT '企业人数',
  `profile` VARCHAR(2000) NOT NULL DEFAULT '' COMMENT '公司简介',
  `phone` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '商务电话',
  `wechat` VARCHAR(45) NOT NULL DEFAULT '',
  `qq` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '企业';


-- -----------------------------------------------------
-- Table `zhaopin`.`salaries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`salaries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '工资';


-- -----------------------------------------------------
-- Table `zhaopin`.`company_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`company_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `zhaopin`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `zhaopin`.`resumes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`resumes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '目前状态：在职1/离职0',
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  `worked_at` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '参加工作时间',
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC),
  CONSTRAINT `fk_resumes_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `zhaopin`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '简历';


-- -----------------------------------------------------
-- Table `zhaopin`.`intentions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`intentions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '求职意向';


-- -----------------------------------------------------
-- Table `zhaopin`.`experiences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`experiences` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '工作经历';


-- -----------------------------------------------------
-- Table `zhaopin`.`credits`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`credits` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '积分';


-- -----------------------------------------------------
-- Table `zhaopin`.`invites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zhaopin`.`invites` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `remark` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '',
  `created_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '邀请';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
