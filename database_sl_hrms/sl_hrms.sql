/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.11-MariaDB : Database - sl_hrms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sl_hrms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sl_hrms`;

/*Table structure for table `civil_status` */

DROP TABLE IF EXISTS `civil_status`;

CREATE TABLE `civil_status` (
  `idno` varchar(10) DEFAULT NULL,
  `civilstatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `civil_status` */

insert  into `civil_status`(`idno`,`civilstatus`) values ('01','Single'),('02','Married'),('03','Widow/Widower'),('04','Separated/Annulled'),('05','Living with Partner');

/*Table structure for table `tbl_company` */

DROP TABLE IF EXISTS `tbl_company`;

CREATE TABLE `tbl_company` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `company_description` varchar(200) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_company` */

insert  into `tbl_company`(`id`,`company_name`,`company_description`,`status`) values (1,'4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City',NULL,'ACTIVE'),(5,'QWEQW','EQWEQ','DELETE');

/*Table structure for table `tbl_emp_salary` */

DROP TABLE IF EXISTS `tbl_emp_salary`;

CREATE TABLE `tbl_emp_salary` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `salary_id` varchar(200) DEFAULT NULL,
  `date_create_salary` varchar(50) DEFAULT NULL,
  `emp_id_salary` varchar(50) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `fullname_salary` varchar(100) DEFAULT NULL,
  `date_from` varchar(50) DEFAULT NULL,
  `date_to` varchar(50) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `emp_basic_salary` varchar(50) DEFAULT NULL,
  `emp_quantity` varchar(50) DEFAULT NULL,
  `emp_rate` varchar(50) DEFAULT NULL,
  `emp_total` varchar(50) DEFAULT NULL,
  `emp_gross_pay` varchar(50) DEFAULT NULL,
  `emp_current_pay` varchar(50) DEFAULT NULL,
  `emp_late_deduction` varchar(50) DEFAULT NULL,
  `emp_quantity_late` varchar(50) DEFAULT NULL,
  `emp_rate_late` varchar(50) DEFAULT NULL,
  `emp_total_late` varchar(50) DEFAULT NULL,
  `emp_absences_deduction` varchar(50) DEFAULT NULL,
  `emp_quantity_absences` varchar(50) DEFAULT NULL,
  `emp_rate_absences` varchar(50) DEFAULT NULL,
  `emp_total_absences` varchar(50) DEFAULT NULL,
  `emp_hrmo_deduction` varchar(50) DEFAULT NULL,
  `emp_hrmo_quantity` varchar(50) DEFAULT NULL,
  `emp_hrmo_rate` varchar(50) DEFAULT NULL,
  `emp_hrmo_total` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_emp_salary` */

insert  into `tbl_emp_salary`(`id`,`salary_id`,`date_create_salary`,`emp_id_salary`,`serial_no`,`fullname_salary`,`date_from`,`date_to`,`company`,`emp_basic_salary`,`emp_quantity`,`emp_rate`,`emp_total`,`emp_gross_pay`,`emp_current_pay`,`emp_late_deduction`,`emp_quantity_late`,`emp_rate_late`,`emp_total_late`,`emp_absences_deduction`,`emp_quantity_absences`,`emp_rate_absences`,`emp_total_absences`,`emp_hrmo_deduction`,`emp_hrmo_quantity`,`emp_hrmo_rate`,`emp_hrmo_total`,`status`) values (24,'SAL-6905ef7ae2ca1','2025-11-01','EMP-1593',NULL,'ISMIRALDA ANN GAGANI RUPUESTO ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','99000','1','99000','99000','99000','99000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(28,'SAL-6905f071ecdca','2025-11-01','EMP-1593',NULL,'ISMIRALDA ANN GAGANI RUPUESTO ','2025-09-01','2025-09-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','99000','1','99000','99000','99000','99000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(29,'SAL-6905f0e0bce5a','2025-11-01','EMP-3445',NULL,'FRITZ A. MONDERO ','','','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','','','','','','44,000.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(30,'SAL-6905f3c2c9ee7','2025-11-01','EMP-1593',NULL,'ISMIRALDA ANN GAGANI RUPUESTO ','2025-09-01','2025-09-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','99000','1','99000','99000','99000','99000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(33,'SAL-6905fc84c9e74','2025-11-01','EMP-4172','PS-6905fc84c9e76','MARY ANNE  TOMNOB  LIBRES ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00',NULL,NULL,'','44000','44000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(34,'SAL-6905fe68ee680','2025-11-01','EMP-1593','PS-6905fe68ee682','ISMIRALDA ANN GAGANI RUPUESTO ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','99,000.00',NULL,'99,000.00',NULL,'99000','99000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(35,'SAL-6905fea71dbed','2025-11-01','EMP-3445','PS-6905fea71dbef','FRITZ A. MONDERO ','2025-11-01','2025-11-14','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(36,'SAL-6905ff0673116','2025-11-01','EMP-1593','PS-6905ff0673118','ISMIRALDA ANN GAGANI RUPUESTO ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','99,000.00','1','99,000.00','99,000.00','99,000.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(40,'SAL-690610303fba9','2025-11-01','EMP-4937','PS-690610303fbab','JOHNLIVEN  CABCABAN  TABADA ','2025-08-01','2025-08-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','44,000.00','0','0','0','0','0','0','0','0',NULL,NULL,NULL,NULL,'DELETE'),(41,'SAL-69061104cb437','2025-11-01','EMP-4937','PS-69061104cb439','JOHNLIVEN  CABCABAN  TABADA ','2025-08-01','2025-08-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','44,000.00','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A',NULL,NULL,NULL,NULL,'DELETE'),(42,'SAL-690749d11e154','2025-11-02','EMP-3445','PS-690749d11e156','FRITZ A. MONDERO ','2025-11-01','2025-11-07','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','38,500.00','1','38,500.00','38,500.00','38,500.00','38,500.00','1','1','1','1','2','2','2','2','3','3','3','3','DELETE'),(43,'SAL-6907562f5d9b3','2025-11-02','EMP-3445','PS-6907562f5d9b5','FRITZ A. MONDERO ','2025-11-01','2025-11-07','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','44,000.00','1','1','1','1','2','2','2','2','3','3','3','3','DELETE'),(44,'SAL-6907645f039ac','2025-11-02','EMP-3445','PS-6907645f039ae','FRITZ A. MONDERO ','2025-11-01','2025-11-08','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','123','123','44,000.00','36,000.00','1','1','1','1','2','2','2','2','3','3','3','3','DELETE'),(45,'SAL-69076504d7960','2025-11-02','EMP-4937','PS-69076504d7961','JOHNLIVEN  CABCABAN  TABADA ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44000','41300','44,000.00','41300','','1','100','100','','1','2000','2000','','2','300','600','DELETE'),(46,'SAL-69076852280c8','2025-11-02','EMP-3445','PS-69076852280ca','FRITZ A. MONDERO ','2025-11-01','2025-11-15','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','38,500.00','1','','','','44,000.00','1','1','1,000.00','1,000.00','2','2','2,000.00','2,000.00','3','3','3,000.00','3,000.00','DELETE'),(47,'SAL-690769eae2bce','2025-11-02','EMP-3445','PS-690769eae2bd2','FRITZ A. MONDERO ','2025-11-01','2025-11-15','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44000','41500','44,000.00','36,700.00','1','1','3,000.00','3,000.00','2','2','2,000.00','2,000.00','3','4','4,000.00','4,000.00','DELETE'),(48,'SAL-69076a07374b1','2025-11-02','EMP-4937','PS-69076a07374b2','JOHNLIVEN  CABCABAN  TABADA ','2025-09-01','2025-09-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','5','44000','38900','44,000.00','38,900.00','','2','100.00','200.00','','2','2,000.00','4,000.00','','3','300.00','900.00','DELETE'),(49,'SAL-69076b060b44d','2025-11-02','EMP-4937','PS-69076b060b44f','JOHNLIVEN  CABCABAN  TABADA ','2025-08-01','2025-08-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','40,800.00','44,000.00','40,800.00','','3','100.00','300.00','','2','1,000.00','2,000.00','','3','300.00','900.00','DELETE'),(52,'SAL-690770d2a0cde','2025-11-02','EMP-3445','PS-690770d2a0ce1','FRITZ A. MONDERO ','','','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','','1',NULL,NULL,'','0.00','','',NULL,'500.00','','',NULL,NULL,'','',NULL,NULL,'DELETE'),(53,'SAL-6907739206c4e','2025-11-02','EMP-3445','PS-6907739206c50','FRITZ A. MONDERO ','2025-11-01','2025-11-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','400.00','44,000.00','44,000.00','43,300.00','1','1','100.00','100.00','2','2','200.00','200.00','3','3','300.00','400.00','ACTIVE'),(54,'SAL-690773e3977d8','2025-11-02','EMP-2869','PS-690773e3977da','CHARLESON  EMNAS  DAMING ','2025-08-01','2025-08-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00',NULL,'44,000.00',NULL,'','2','100.00','200.00','','2','1,000.00','2,000.00','','3','300.00','900.00','DELETE'),(55,'SAL-690774de7f850','2025-11-02','EMP-2869','PS-690774de7f852','CHARLESON  EMNAS  DAMING ','','','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','40,900.00','','2','100.00','200.00','','2','1,000.00','2,000.00','','3','300.00','900.00','DELETE'),(57,'SAL-69077b11c9b7c','2025-11-02','EMP-2869','PS-69077b11c9b7e','CHARLESON  EMNAS  DAMING ','2025-09-01','2025-09-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','39,750.00','','3','300.00','900.00','','2','1,000.00','2,000.00','','3','450.00','1,350.00','DELETE'),(58,'SAL-69077bf6df2bb','2025-11-02','EMP-2869','PS-69077bf6df2bd','CHARLESON  EMNAS  DAMING ','2025-09-01','2025-09-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44,000.00','1','44,000.00','44,000.00','44,000.00','38,800.00','','1','150.00','150.00','','2','2,000.00','4,000.00','','3','350.00','1,050.00','DELETE'),(59,'SAL-6908b6c899b90','2025-11-03','EMP-4937','PS-6908b6c899b91','JOHNLIVEN  CABCABAN  TABADA ','2025-08-01','2025-08-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44000','1','44,000.00',NULL,'44000','41,000.00','','1','100.00','100.00','','2','1,000.00','2,000.00','','3','300.00','900.00','DELETE'),(60,'SAL-6908b82d55c04','2025-11-03','EMP-4937','PS-6908b82d55c06','JOHNLIVEN  CABCABAN  TABADA ','2025-08-01','2025-08-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44000','1','44,000.00','44,000.00','44,000.00','44,000.00','','0','0.00','0.00','','0','0.00','0.00','','0','0.00','0.00','ACTIVE'),(61,'SAL-690dba8d278a1','2025-11-07','EMP-3445','PS-690dba8d278a2','FRITZ A. MONDERO ','2025-11-01','2025-11-30','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44000','1','44,000.00','44,000.00','44000','43,997.00','1','1','1.00','1.00','1','1','1.00','1.00','1','1','1.00','1.00','ACTIVE'),(62,'SAL-690f598f922d2','2025-11-08','EMP-4937','PS-690f598f922d5','JOHNLIVEN  CABCABAN  TABADA ','2025-10-01','2025-10-31','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','44000','1','44,000.00','44,000.00','44,000.00','44,000.00','0','0','0.00','0.00','0','0','0.00','0.00','0','0','0.00','0.00','ACTIVE');

/*Table structure for table `tbl_employee_info` */

DROP TABLE IF EXISTS `tbl_employee_info`;

CREATE TABLE `tbl_employee_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(50) DEFAULT NULL,
  `datecreate` varchar(20) DEFAULT NULL,
  `fullname` varchar(150) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birthdate` varchar(50) DEFAULT NULL,
  `civilstatus` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `telephone_no` varchar(50) DEFAULT NULL,
  `identification` varchar(100) DEFAULT NULL,
  `identification_no` varchar(50) DEFAULT NULL,
  `employee_type` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `date_joining` varchar(50) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_no` varchar(50) DEFAULT NULL,
  `bank_holder_name` varchar(100) DEFAULT NULL,
  `bank_account_type` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `sss` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pag_ibig` varchar(50) DEFAULT NULL,
  `emergency_name` varchar(50) DEFAULT NULL,
  `emergency_contact_no` varchar(20) DEFAULT NULL,
  `emergency_relationship` varchar(30) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `account_type` varchar(100) DEFAULT NULL,
  `schedule_code` varchar(50) DEFAULT NULL,
  `net_pay` varchar(100) DEFAULT NULL,
  `weekly_salary` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_employee_info` */

insert  into `tbl_employee_info`(`id`,`emp_id`,`datecreate`,`fullname`,`firstname`,`middlename`,`lastname`,`suffix`,`gender`,`birthdate`,`civilstatus`,`barangay`,`address`,`city`,`province`,`country`,`nationality`,`email_address`,`mobile_no`,`telephone_no`,`identification`,`identification_no`,`employee_type`,`department`,`designation`,`date_joining`,`blood_type`,`photo`,`bank_name`,`bank_no`,`bank_holder_name`,`bank_account_type`,`ifsc_code`,`tin_no`,`sss`,`philhealth`,`pag_ibig`,`emergency_name`,`emergency_contact_no`,`emergency_relationship`,`user_name`,`password`,`account_type`,`schedule_code`,`net_pay`,`weekly_salary`,`created_by`,`created_at`,`status`) values (1,'EMP-3445','2025-11-07','FRITZ A. MONDERO ','FRITZ','A.','MONDERO','','Male','1992-02-28','Single','BARANGAY I','SAN CARLOS CITY','SAN CARLOS CITY','NEGROS OCCIDENTAL','PHILIPPINES','FILIPINO','FRITZMONDERO6@GMAIL.COM','09707202206','N/A','DRIVERS LICENSE','1234567','PERMANENT','IT','MAINTENANCE','2025-10-31','O+','FRITZ.jpg','LAND BANK','12345612345','FRITZ A. MONDERO','SAVINGS','123123','8883133','8877666555','56001233','896665511','FRITZ AMISTAD MONDERO','1234555123','MY SELF',NULL,NULL,NULL,'AA1','44000','450',NULL,'2025-11-09 21:20:08','ACTIVE'),(3,'EMP-4292','2025-11-03','ROGER FERNANDEZ RUPUESTO ','ROGER','FERNANDEZ','RUPUESTO','','Male','1993-11-21','Married','CEBU','MICHAEL JAMES RESIDENCES, BLOCK 1 LOT 8	','CEBU CITY','CEBU CITY','PHILIPPINES','FILIPINO','ROGERFRUPUESTO@GMAIL.COM','09519769307','N/A','N/A','N/A','REGULAR','SHAREHOLDER','OPERATION\'S MANAGER','2024-01-08','A+','690380ba7ce99.jpg','SECURITY BANK PHILIPPINES','0000076476245','ROGER F RUPUESTO','SAVINGS','N/A','314709428000','0728545054','120512249901','121087826496','ISMIRALDA ANN G. RUPUESTO','09519769307','WIFE',NULL,NULL,NULL,'B2','99000','450',NULL,'2025-11-03 21:08:35','ACTIVE'),(6,'EMP-1593','2025-11-08','ISMIRALDA ANN GAGANI RUPUESTO ','ISMIRALDA ANN','GAGANI','RUPUESTO','','Female','1992-10-14','Married','BRGY. SAN JOSE','MICHAEL JAMES RESIDENCES, BLOCK 1 LOT 8','CEBU CITY','CEBU','PHILIPPINES','FILIPINO','GAGANIISMIRALDAANN@GMAIL.COM','09519769307','','','','','DATA MANAGEMENT','MANAGER & HUMAN RESOURCE','2024-01-08','A+','6903203e37bd2.jpg','SECURITY BANK PHILIPPINES','0000076474636','ISMIRALDA ANN G RUPUESTO','SAVINGS','','312838132000','633258465','120512066106','121089724475','ROGER F RUPUESTO','09519769307','HUSBAND',NULL,NULL,NULL,'B2','99000','450',NULL,'2025-11-08 22:43:03','ACTIVE'),(9,'EMP-4172','2025-11-03','MARY ANNE  TOMNOB  LIBRES ','MARY ANNE ','TOMNOB ','LIBRES','','Female','1988-08-24','Married','','HERNAN CORTES ST.','CEBU CITY','CEBU','','FILIPINO','MARYANNE.LIBRES88@GMAIL.COM','09275043598','','','','SUPPORT11','DATA MANAGEMENT','SUPERVISOR','2024-02-05','','6903807969aef.jpg','SECURITY BANK PHILIPPINES','0000076474647','MARY ANNE TOMNOB LIBRES','SAVINGS/PAYROLL','','295650838000','629981678','120508805808','121011759205','BRYAN C LIBRES','09224819943','HUSBAND',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-03 17:54:11','ACTIVE'),(11,'EMP-1455','2025-11-08','SUZETTE AIMEE  ANIÑON   DESPE ','SUZETTE AIMEE ','ANIÑON  ','DESPE','','Female','1977-03-02','Married','','OCAÑA ','CARCAR CITY','CEBU','','FILIPINO','SUZETTE.AIMEE777@GMAIL.COM','09224822280','N/A','N','','','','','2025-11-01','','690608bc278ff.jpg','SECURITY BANK PHILIPPINES','0000076474658','SUZETTE AIMEE ANIñON  DESPE','SAVINGS/PAYROLL','N/A','207091031000','0618251597','120251894200','121158775161','ALLEN DESPE','09224819943','HUSBAND',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-08 22:51:21','ACTIVE'),(12,'EMP-4937','2025-11-03','JOHNLIVEN  CABCABAN  TABADA ','JOHNLIVEN ','CABCABAN ','TABADA','','Male','1992-08-13','Single','BRGY BASAK SAN NICOLAS','145 Q CABREROS ST SITIO UBOS POSO ','CEBU','CEBU','','FILIPINO','WOODEN.MONKEY14@GMAIL.COM','09154533584','N/A','N/A','N/A','REGULAR','CONDITION REPORT','AGENT','2024-03-11','','69060ad235391.jpg','SECURITY BANK PHILIPPINES','0000076474669','JOHNLIVEN CABCABAN TABADA','SAVINGS/PAYROLL','','311439930000','0632204371','120510899550','121024667642','JHANSEN TABADA','9684355266','SISTER',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-03 17:54:55','ACTIVE'),(14,'EMP-2869','2025-11-03','CHARLESON  EMNAS  DAMING ','CHARLESON ','EMNAS ','DAMING','','Male','1991-04-09','Single','','ELIAS V ESPINA ST, SITIO OREL','CEBU','CEBU','','FILIPINO','CHARLESONDAMING@GMAIL.COM','09369376668','','','','REGULAR','CONDITION REPORT','SUPERVISOR','2024-03-28','','690614b3629d4.jpg','SECURITY BANK PHILIPPINES','0000076474692','CHARLESON EMNAS DAMING','SAVINGS/PAYROLL','','317248731','0818777114','150252856694','121114329129','GLENBERT LOBINO','0905464 8684','PARTNER',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-03 17:55:24','ACTIVE'),(15,'EMP-2895','2025-11-03','CLYDE  VELASQUEZ  ABADIA ','CLYDE ','VELASQUEZ ','ABADIA','','Male','1987-01-20','Single','','BURGOS ST.','MANDAUE','CEBU','','FILIPINO','ABADIACLYDE@GMAIL.COM','09773248676','','','','REGULAR','CONDITION REPORT','AGENT','2024-03-11','','6906190cb19c0.jpg','SECURITY BANK PHILIPPINES','0000076474681','CLYDE VELASQUEZ ABADIA','SAVINGS/PAYROLL','','316751077000','0630011346','120511454277','121132920891','CARMILLE ABADIA','09276401843','LIVE-IN PARTNER',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-03 17:55:46','ACTIVE'),(16,'EMP-2080','2025-11-08','JEAN CLAVEL  CARSIDO  RIVERO ','JEAN CLAVEL ','CARSIDO ','RIVERO','','Female','1997-06-30','Single','','SITIO SAMPAGUITA PUROK 3','CONSOLACION','CEBU','','FILIPINO','KSNSREYJEAN@GMAIL.COM','09231566984','','','','REGULAR','DATA MANAGEMENT','AGENT','2024-06-27','','690f4c6712606.jpg','SECURITY BANK PHILIPPINES','0000076474705','JEAN CLAVEL CARSIDO RIVERO','SAVINGS/PAYROLL','','352508966','3479430198','122511766824','121236544488','RIZA RIVERO','09606157037','MOTHER',NULL,NULL,NULL,'B2','38500','175',NULL,'2025-11-08 22:42:04','ACTIVE'),(17,'EMP-1348','2025-11-08','RUPERT JAMES  MALINGIN  QUERUBIN ','RUPERT JAMES ','MALINGIN ','QUERUBIN','','Male','1990-04-26','Single','','P RODRIGUEZ STREET','LAPU-LAPU','CEBU','','FILIPINO','JAMESQRBN@GMAIL.COM','09567140513','','','','REGULAR','DATA MANAGEMENT','AGENT','2024-08-14','','690f4ec043f47.jpg','SECURITY BANK PHILIPPINES','0000076474716','RUPERT JAMES MALINGIN QUERUBIN','SAVINGS/PAYROLL','','309947203','630459995','120252312051','121102482733','MARIVIC DILA','09914333791','LIVE-IN PARTNER',NULL,NULL,NULL,'B2','38500','175',NULL,'2025-11-08 22:41:53','ACTIVE'),(18,'EMP-7873','2025-11-08','ANNA LOU  CABALLERO  EYAC ','ANNA LOU ','CABALLERO ','EYAC','','Female','1992-09-04','Single','','039-A E SABELLANO ST. SAN ROQUE HOMES','CEBU','CEBU','','FILIPINO','ANNA.EYAC@GMAIL.COM','09227844191','','','','REGULAR','DATA MANAGEMENT','AGENT','2024-08-14','','690f51faae050.jpg','SECURITY BANK PHILIPPINES','0000076474727','ANNA LOU CABALLERO EYAC','SAVINGS/PAYROLL','','311502901','632632503','120510915947','121033224739','RENANTE YNCIERTO | RODRIGO EYAC','09298070275 | 093926','BF | FATHER',NULL,NULL,NULL,'B2','38500','175',NULL,'2025-11-08 22:41:41','ACTIVE'),(19,'EMP-2783','2025-11-08','PEARL  SALDAÑA  LIBODLIBOD ','PEARL ','SALDAÑA ','LIBODLIBOD','','Female','1997-01-08','Single','','91-F A. LOPEZ ST.','CEBU','CEBU','','FILIPINO','PSLIBODLIBOD08@GMAIL.COM','09171156580','','','','REGULAR','DATA MANAGEMENT','AGENT','2024-08-14','','690f54fa23005.jpg','SECURITY BANK PHILIPPINES','0000076474738','PEARL SALDAñA LIBODLIBOD','SAVINGS/PAYROLL','','661589186','642311830','122508285882','121279873085','CRISPA LIBODLIBOD','0949329 2277','MOTHER',NULL,NULL,NULL,'B2','38500','175',NULL,'2025-11-08 22:51:04','ACTIVE'),(20,'EMP-1615','2025-11-08','REGGIE MAE  MABOLES  OLING ','REGGIE MAE ','MABOLES ','OLING','','Female','1998-06-03','Single','','LAGUNA BASAK PARDO','CEBU','CEBU','','FILIPINO','REGGIEMAEOLING@GMAIL.COM','09154914053','','','','REGULAR','PHONE PEOPLE','AGENT','2024-08-28','','690f564d4ca42.jpg','SECURITY BANK PHILIPPINES','0000076474749','REGGIE MAE MABOLES OLING','SAVINGS/PAYROLL','','335266684','639351162','120256026975','121193946915','REMA OLING | ROMNICK ROMO','0966 9108014 | 09683','MOTHER | BF',NULL,NULL,NULL,'B2','38500','175',NULL,'2025-11-08 22:44:15','ACTIVE'),(21,'EMP-1319','2025-11-08','PAUL JOHN  CALO  LAMBO ','PAUL JOHN ','CALO ','LAMBO','','Male','1990-12-22','Single','','INAYAWAN','CEBU','CEBU','','FILIPINO','AZK4MORE@YAHOO.COM','09423497194','','','','REGULAR','PHONE PEOPLE','SUPERVISOR','2024-08-28','','690f58b0c81a7.jpg','SECURITY BANK PHILIPPINES','0000076474750','PAUL JOHN CALO LAMBO','SAVINGS/PAYROLL','','309328111000','630619353','120509871642','121030255723','MARIANNE ISABELLE LIBRON','09432863871','LIVE-IN PARTNER',NULL,NULL,NULL,'B2','44000','200',NULL,'2025-11-08 22:51:26','ACTIVE');

/*Table structure for table `tbl_employee_timelogs` */

DROP TABLE IF EXISTS `tbl_employee_timelogs`;

CREATE TABLE `tbl_employee_timelogs` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `date_logs` varchar(50) DEFAULT NULL,
  `emp_id` varchar(50) DEFAULT NULL,
  `punch_in` varchar(50) DEFAULT NULL,
  `punch_out` varchar(50) DEFAULT NULL,
  `late` varchar(50) DEFAULT NULL,
  `late_hours` varchar(50) DEFAULT NULL,
  `late_minutes` int(50) DEFAULT NULL,
  `total_minutes` varchar(100) DEFAULT NULL,
  `work_hours` varchar(100) DEFAULT NULL,
  `overtime_in` varchar(50) DEFAULT NULL,
  `overtime_out` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status_logs` varchar(100) DEFAULT 'ACTIVE',
  `schedule_code` varchar(100) DEFAULT NULL,
  `minutes_amount` varchar(50) DEFAULT NULL,
  `hours_amount` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_employee_timelogs` */

insert  into `tbl_employee_timelogs`(`id`,`date_logs`,`emp_id`,`punch_in`,`punch_out`,`late`,`late_hours`,`late_minutes`,`total_minutes`,`work_hours`,`overtime_in`,`overtime_out`,`name`,`status_logs`,`schedule_code`,`minutes_amount`,`hours_amount`,`total_amount`) values (99,'2025-11-09','EMP-3445','21:20:31','21:34:16','01:46:15',NULL,21,NULL,NULL,NULL,NULL,NULL,'ACTIVE','AA1',NULL,NULL,NULL);

/*Table structure for table `tbl_gender` */

DROP TABLE IF EXISTS `tbl_gender`;

CREATE TABLE `tbl_gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_gender` */

insert  into `tbl_gender`(`id`,`gender`) values (1,'Male'),(2,'Female');

/*Table structure for table `tbl_quantity` */

DROP TABLE IF EXISTS `tbl_quantity`;

CREATE TABLE `tbl_quantity` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `quantity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_quantity` */

insert  into `tbl_quantity`(`id`,`quantity`) values (1,'1'),(2,'2'),(3,'3'),(4,'4'),(5,'5');

/*Table structure for table `tbl_salary_grade` */

DROP TABLE IF EXISTS `tbl_salary_grade`;

CREATE TABLE `tbl_salary_grade` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `salary` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_salary_grade` */

insert  into `tbl_salary_grade`(`id`,`salary`) values (5,''),(6,'38,500.00'),(7,'44,000.00'),(8,'49,500.00'),(9,'99,000.00');

/*Table structure for table `tbl_schedule` */

DROP TABLE IF EXISTS `tbl_schedule`;

CREATE TABLE `tbl_schedule` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `schedule_code` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `sched_in` varchar(100) DEFAULT NULL,
  `sched_out` varchar(100) DEFAULT NULL,
  `ot_in` varchar(100) DEFAULT NULL,
  `ot_out` varchar(100) DEFAULT NULL,
  `total_hours` varchar(100) DEFAULT NULL,
  `daily_rate` varchar(50) DEFAULT NULL,
  `per_hour_rate` varchar(50) DEFAULT NULL,
  `per_minute_rate` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_schedule` */

insert  into `tbl_schedule`(`id`,`schedule_code`,`description`,`sched_in`,`sched_out`,`ot_in`,`ot_out`,`total_hours`,`daily_rate`,`per_hour_rate`,`per_minute_rate`,`status`) values (1,'A1','SATURDAY - SUNDAY','08:30:00','16:30:00','00:00:00','00:00:00','00:00:00','500.00','62.5','1.04','ACTIVE'),(3,'B2','SATURDAY - SUNDAY','10:00:00','18:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL,NULL,'ACTIVE'),(5,'C3','SUNDAY - MONDAY','10:00:00','18:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL,NULL,'ACTIVE'),(6,'D4','SATURDAY - SUNDAY','20:00:00','04:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL,NULL,'ACTIVE'),(7,'F5','SATURDAY - SUNDAY','22:00:00','06:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL,NULL,'ACTIVE'),(9,'SS1','SATURDAY - SUNDAY','08:00:00','17:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(10,'AA1','MONDAY - FRIDAY','21:00:00','23:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DELETE');

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `password_text` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `account_role` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'ACTIVE',
  `last_activity` datetime DEFAULT NULL,
  `status_online` enum('online','offline') DEFAULT 'offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`id`,`emp_id`,`username`,`password`,`password_text`,`user_type`,`account_role`,`status`,`last_activity`,`status_online`) values (1,'EMP-3445','FRITZ','$2y$10$8xGrecncEw7BNfEZzZTWguI28YUGdQVgP0HSLGALzNBimDXO0hD/S','123123','ADMIN','ADMIN','ACTIVE','2025-11-09 22:34:10','online'),(3,'EMP-4292','ROGER','$2y$10$OKJJic8S0Fjc.OBLVOuFhOEJ7cchSW6kMuUf8ZSToE5LYanZeWGdy','EMP-4292','ADMIN',NULL,'ACTIVE','2025-11-09 23:07:36','online'),(6,'EMP-1593','ISGAGANI','$2y$10$f4PwFrPOvY8uaYcQVRKG5Oq7WkZQCRJcAzLF/sD5yujk3nNO1DIcS','EMP-1593','USER',NULL,'ACTIVE','2025-11-09 20:47:54','online'),(9,'EMP-4172','SUPPORT11','$2y$10$km1vzUavcEjSvphC1SGctuz0B65XitJcunZ6NxCnGGZJpfA4j7PQW','EMP-4172','USER',NULL,'ACTIVE',NULL,'offline'),(11,'EMP-1455','SUPPORT12','$2y$10$5leH3vUNA7xll5PdTooMt.49b7GJY6ak2/PqDBOdf.z4PsNnlcmuK','EMP-1455','USER',NULL,'ACTIVE',NULL,'offline'),(12,'EMP-4937','SUPPORT14','$2y$10$8ZbZalMtC3BzoSciFvpcbeifrdhXFULJiJw5WQN8TFKBLecYDRjji','EMP-4937','USER',NULL,'ACTIVE',NULL,'offline'),(14,'EMP-2869','SUPPORT15','$2y$10$6NHQc8uxiq85ARkUc56tR./hZ0Jsm8swZ2cm83cg63Reapgg8Z7Qe','EMP-2869','USER',NULL,'ACTIVE',NULL,'offline'),(15,'EMP-2895','SUPPORT13','$2y$10$nm1CkTldp1Fd9Tbn04W1K.4tmwXXstekCaajjDUFdpFK4XaEyfmlC','EMP-2895','USER',NULL,'ACTIVE',NULL,'offline'),(16,'EMP-2080','SUPPORT16','$2y$10$tKF3RBSVSxFsyXtNDLjq1uN8lS9yqU0o77PBty9SqlDE4t7IafRd6','EMP-2080','USER',NULL,'ACTIVE',NULL,'offline'),(17,'EMP-1348','SUPPORT19','$2y$10$jp5IGxn98hAGS2/9nbKiqOQnNQq7/6bd/.CDH.nDEqWb6GbWiZVgu','EMP-1348','USER',NULL,'ACTIVE',NULL,'offline'),(18,'EMP-7873','SUPPORT18','$2y$10$asnCVJc1H/mwykovDKOd6uwANx0lHeAb7qax2fz9Z3wtvt/x/3uwq','EMP-7873','USER',NULL,'ACTIVE',NULL,'offline'),(19,'EMP-2783','SUPPORT17','$2y$10$2BhXgUPw4MrL6LSEsg/yN.OtiJbttoZl2bHsdg.I0Q5dyHqzYIdX.','EMP-2783','USER',NULL,'ACTIVE',NULL,'offline'),(20,'EMP-1615','SUPPORT20','$2y$10$2BYmI6d7MITjaIBYuJ7dS.mdxN3EL0Y8pcQxgSxqzWkd9srbkgvR.','EMP-1615','USER',NULL,'ACTIVE',NULL,'offline'),(21,'EMP-1319','SUPPORT21','$2y$10$cxBj5D33iX4Wqhqn1gIHxufhdVrBzn4m.xubYoNbYhdUDnyGW6HPK','EMP-1319','USER',NULL,'ACTIVE',NULL,'offline');

/*Table structure for table `tbl_weekly_payslip` */

DROP TABLE IF EXISTS `tbl_weekly_payslip`;

CREATE TABLE `tbl_weekly_payslip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datecreate_payroll` varchar(50) DEFAULT NULL,
  `payroll_id` varchar(100) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `date_from` varchar(50) DEFAULT NULL,
  `date_to` varchar(50) DEFAULT NULL,
  `emp_id` varchar(100) DEFAULT NULL,
  `fullname_payroll` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `daily_hours` varchar(50) DEFAULT NULL,
  `total_workdays` varchar(100) DEFAULT NULL,
  `payroll_gross` varchar(100) DEFAULT NULL,
  `total_emp_deduction` varchar(100) DEFAULT NULL,
  `emp_total_netpay` varchar(100) DEFAULT NULL,
  `emp_late_deduction` varchar(50) DEFAULT NULL,
  `emp_quantity_late` varchar(50) DEFAULT NULL,
  `emp_rate_late` varchar(50) DEFAULT NULL,
  `emp_total_late` varchar(50) DEFAULT NULL,
  `emp_absences_deduction` varchar(50) DEFAULT NULL,
  `emp_quantity_absences` varchar(50) DEFAULT NULL,
  `emp_rate_absences` varchar(50) DEFAULT NULL,
  `emp_total_absences` varchar(50) DEFAULT NULL,
  `emp_hrmo_deduction` varchar(50) DEFAULT NULL,
  `emp_hrmo_quantity` varchar(50) DEFAULT NULL,
  `emp_hrmo_rate` varchar(50) DEFAULT NULL,
  `emp_hrmo_total` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_weekly_payslip` */

insert  into `tbl_weekly_payslip`(`id`,`datecreate_payroll`,`payroll_id`,`serial_no`,`date_from`,`date_to`,`emp_id`,`fullname_payroll`,`company`,`daily_hours`,`total_workdays`,`payroll_gross`,`total_emp_deduction`,`emp_total_netpay`,`emp_late_deduction`,`emp_quantity_late`,`emp_rate_late`,`emp_total_late`,`emp_absences_deduction`,`emp_quantity_absences`,`emp_rate_absences`,`emp_total_absences`,`emp_hrmo_deduction`,`emp_hrmo_quantity`,`emp_hrmo_rate`,`emp_hrmo_total`,`status`) values (1,'2025-03-11','PAY-001',NULL,'2025-11-01 - 2025-11-07',NULL,'EMP-3445','FRITZ A. MONDERO',NULL,NULL,'5',NULL,'2,000.00','12,000.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(2,'2025-11-03','PAYWEEKLY-6908591e2e46b',NULL,NULL,NULL,'EMP-3445','FRITZ A. MONDERO ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(3,'2025-11-03','PAYWEEKLY-69085d49d0d61',NULL,'2025-11-01','2025-11-05','EMP-3445','FRITZ A. MONDERO ',NULL,'213',NULL,'123.00','123.00','123.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(4,'2025-11-03','PAYWEEKLY-690864e9e43fd',NULL,'2025-10-27','2025-10-31','EMP-4937','JOHNLIVEN  CABCABAN  TABADA ',NULL,'40',NULL,'200.00','0.00','200.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'DELETE'),(6,'2025-11-03','PAYWEEKLY-69087c7602e6f','PS-69087c7602e6c','2025-11-01','2025-11-13','EMP-3445','FRITZ A. MONDERO ',NULL,'1',NULL,'1.00','1.00','32.00','5','1','2.00','2.00','3','3','2.00','6.00','5','1','5.00','5.00','DELETE'),(7,'2025-11-03','PAYWEEKLY-69087ee449eaf','PS-69087ee449eae','2025-11-01','2025-11-08','EMP-3445','FRITZ A. MONDERO ','','1',NULL,'1.00','1.00','42.00','1','1','1.00','1.00','1','1','1.00','1.00','1','1','1.00','1.00','DELETE'),(8,'2025-11-03','PAYWEEKLY-69087f18ae726','PS-69087f18ae723','2025-11-01','2025-11-15','EMP-3445','FRITZ A. MONDERO ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','1',NULL,'1.00',NULL,'42.00','1','1','1.00','1.00','1','1','1.00','1.00','1','1','1.00','1.00','DELETE'),(9,'2025-11-03','PAYWEEKLY-69087f67e640d','PS-69087f67e640b','2025-10-27','2025-10-31','EMP-2869','CHARLESON  EMNAS  DAMING ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','40',NULL,'200.00','25.00','175.00','','2','3.00','6.00','','2','5.00','10.00','','3','3.00','9.00','DELETE'),(10,'2025-11-03','PAYWEEKLY-690885d26cf33','PS-690885d26cf31','2025-10-27','2025-10-31','EMP-2869','CHARLESON  EMNAS  DAMING ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','40',NULL,'200.00','18.00','182.00','','2','3.00','6.00','','2','3.00','6.00','','2','3.00','6.00','DELETE'),(11,'2025-11-03','PAYWEEKLY-69088684c1c39','PS-69088684c1c37','2025-11-01','2025-11-07','EMP-3445','FRITZ A. MONDERO ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','24',NULL,'40.00','10.00','35.00','1','2','2.00','4.00','1','1','2.00','2.00','2','2','2.00','4.00','DELETE'),(12,'2025-11-03','PAYWEEKLY-690890939c3af','PS-690890939c3ad','2025-10-27','2025-10-31','EMP-1455','SUZETTE AIMEE  ANIñON   DESPE ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','',NULL,'200.00','23.00','177.00','','1','2.00','2.00','','2','3.00','6.00','','3','5.00','15.00','DELETE'),(13,'2025-11-03','PAYWEEKLY-6908b8b39b521','PS-6908b8b39b520','2025-10-27','2025-10-31','EMP-2869','CHARLESON  EMNAS  DAMING ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','40',NULL,'200.00','0.00','200.00','','0','0.00','0.00','','0','0.00','0.00','','0','0.00','0.00','ACTIVE'),(14,'2025-11-07','PAYWEEKLY-690dba0007e4c','PS-690dba0007e49','','','EMP-3445','FRITZ A. MONDERO ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','',NULL,'450.00','12.00','438.00','1','2','2.00','4.00','2','2','2.00','4.00','2','2','2.00','4.00','DELETE'),(15,'2025-11-08','PAYWEEKLY-690ea48786917','PS-690ea48786915','2025-11-01','2025-11-14','EMP-3445','FRITZ A. MONDERO ','4A 14th Floor Ayala Center Cebu Tower, Cebu Business Park, Cebu City','40',NULL,'450.00','6.00','444.00','1','1','1.00','1.00','2','2','2.00','4.00','1','1','1.00','1.00','ACTIVE');

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_type` */

insert  into `user_type`(`id`,`user_type`) values (1,'ADMIN'),(2,'USER');

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_calculate_minutes_amount_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_calculate_minutes_amount_insert` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE rate DECIMAL(10,2);
    -- Get per_minute_rate from schedule
    SELECT per_minute_rate
    INTO rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    -- Calculate minutes_amount
    SET NEW.minutes_amount = NEW.late_minutes * rate;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_compute_hours_amount` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_compute_hours_amount` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE v_rate DECIMAL(10,2);
    -- get the rate from tbl_schedule
    SELECT per_hour_rate
    INTO v_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    -- compute the total amount
    SET NEW.hours_amount = IFNULL(NEW.work_hours, 0) * IFNULL(v_rate, 0);
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_insert_employee_minutes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_insert_employee_minutes` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE v_rate DECIMAL(10,2);
    -- Ensure work_hours is numeric, default to 0 if NULL
    IF NEW.work_hours IS NULL THEN
        SET NEW.work_hours = 0;
    END IF;
    -- Calculate total minutes
    SET NEW.total_minutes = NEW.work_hours * 60;
    -- Get per_hour_rate from tbl_schedule
    SELECT per_hour_rate
    INTO v_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    -- Calculate hours_amount
    IF v_rate IS NOT NULL THEN
        SET NEW.hours_amount = NEW.work_hours * v_rate;
    ELSE
        SET NEW.hours_amount = 0;
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_employee_timelogs_insert_total_amount` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_employee_timelogs_insert_total_amount` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE schedule_rate DECIMAL(10,2);
    -- Get the daily_rate from tbl_schedule
    SELECT daily_rate INTO schedule_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code;
    -- Calculate total_amount
    SET NEW.total_amount = schedule_rate - NEW.minutes_amount;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_convert_late_to_minutes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_convert_late_to_minutes` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    -- Convert TIME to total minutes
    SET NEW.late_minutes = TIME_TO_SEC(NEW.late) / 60;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_calculate_late_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_calculate_late_insert` BEFORE INSERT ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE schedIn TIME;
    DECLARE lateTime TIME DEFAULT '00:00:00';
    -- Get scheduled in time
    SELECT sched_in
    INTO schedIn
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code;
    -- Only calculate late if punch_in is within schedule range
    IF NEW.punch_in IS NOT NULL THEN
        IF NEW.punch_in >= schedIn THEN
            SET lateTime = TIMEDIFF(NEW.punch_in, schedIn);
        END IF;
        SET NEW.late = lateTime;
    ELSE
        SET NEW.late = '00:00:00';
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_update_work_hours` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_update_work_hours` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE scheduled_hours TIME;
    -- Get total_hours from tbl_schedule based on schedule_code
    SELECT total_hours
    INTO scheduled_hours
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code;
    -- Deduct late time from total_hours and store as TIME
    SET NEW.work_hours = SEC_TO_TIME(TIME_TO_SEC(scheduled_hours) - TIME_TO_SEC(NEW.late));
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_calculate_minutes_amount_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_calculate_minutes_amount_update` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE rate DECIMAL(10,2);
    -- Get per_minute_rate from schedule
    SELECT per_minute_rate
    INTO rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    -- Calculate minutes_amount
    SET NEW.minutes_amount = NEW.late_minutes * rate;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_update_hours_amount` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_update_hours_amount` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE v_rate DECIMAL(10,2);
    SELECT per_hour_rate
    INTO v_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    SET NEW.hours_amount = IFNULL(NEW.work_hours, 0) * IFNULL(v_rate, 0);
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_update_employee_minutes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_update_employee_minutes` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE v_rate DECIMAL(10,2);
    -- Calculate total minutes
    IF NEW.work_hours IS NOT NULL THEN
        SET NEW.total_minutes = NEW.work_hours * 60.00;
    ELSE
        SET NEW.total_minutes = NULL;
    END IF;
    -- Get per_hour_rate from tbl_schedule
    SELECT per_hour_rate
    INTO v_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code
    LIMIT 1;
    -- Calculate hours_amount
    IF NEW.work_hours IS NOT NULL AND v_rate IS NOT NULL THEN
        SET NEW.hours_amount = NEW.work_hours * v_rate;
    ELSE
        SET NEW.hours_amount = NULL;
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_employee_timelogs_update_total_amount` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_employee_timelogs_update_total_amount` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE schedule_rate DECIMAL(10,2);
    -- Get the daily_rate from tbl_schedule
    SELECT daily_rate INTO schedule_rate
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code;
    -- Calculate total_amount
    SET NEW.total_amount = schedule_rate - NEW.minutes_amount;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_update_late_to_minutes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_update_late_to_minutes` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    SET NEW.late_minutes = TIME_TO_SEC(NEW.late) / 60;
END */$$


DELIMITER ;

/* Trigger structure for table `tbl_employee_timelogs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_calculate_late_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_calculate_late_update` BEFORE UPDATE ON `tbl_employee_timelogs` FOR EACH ROW BEGIN
    DECLARE schedIn TIME;
    DECLARE schedOut TIME;
    DECLARE lateTime TIME DEFAULT '00:00:00';
    DECLARE underTime TIME DEFAULT '00:00:00';
    -- Get schedule in/out
    SELECT sched_in, sched_out
    INTO schedIn, schedOut
    FROM tbl_schedule
    WHERE schedule_code = NEW.schedule_code;
    -- Calculate only if both times are available
    IF NEW.punch_in IS NOT NULL AND NEW.punch_out IS NOT NULL THEN
        
        -- LATE: compare only time portions
        IF TIME(NEW.punch_in) > schedIn THEN
            SET lateTime = TIMEDIFF(TIME(NEW.punch_in), schedIn);
        END IF;
        -- UNDERTIME: compare only time portions
        IF TIME(NEW.punch_out) < schedOut THEN
            SET underTime = TIMEDIFF(schedOut, TIME(NEW.punch_out));
        END IF;
        -- Combine both if needed
        IF (lateTime != '00:00:00' OR underTime != '00:00:00') THEN
            SET NEW.late = SEC_TO_TIME(
                TIME_TO_SEC(lateTime) + TIME_TO_SEC(underTime)
            );
        ELSE
            SET NEW.late = '00:00:00';
        END IF;
    ELSE
        SET NEW.late = '00:00:00';
    END IF;
END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
