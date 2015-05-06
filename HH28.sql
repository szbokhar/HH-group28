/****************************************************************/
-- Script: HH28.sql
-- Author: Tom White
-- Date: 04-May-2015
-- Description: Database for Hacking Health Group 28
/****************************************************************/

-- Setting NOCOUNT ON suppresses completion messages
SET NOCOUNT ON

-- Set date format to month, day, year
SET DATEFORMAT dmy;

-- Make the master database the current database
USE master

-- If CHDB database exists, drop it
IF EXISTS ( SELECT  * FROM sysdatabases WHERE name = 'HH28' )
  DROP DATABASE HH28;
GO

CREATE DATABASE HH28
GO

-- Make the HH28 database the current database
USE HH28;


--Table Creation Area
--Patient
CREATE TABLE Patient (
	PatientID INT NOT NULL IDENTITY,
	FirstName VARCHAR(30) NOT NULL,
	LastName VARCHAR(30) NOT NULL,
	Email VARCHAR(50) NOT NULL, 
	CONSTRAINT PK_Patients PRIMARY KEY ( PatientID ) ) ;

--Login
CREATE TABLE UserLogin (
	LoginID INT NOT NULL IDENTITY,
	UserName VARCHAR(30) NOT NULL,
	LoginPassword VARCHAR(30) NOT NULL,
	PatientID INT NOT NULL,
	FOREIGN KEY(PatientID) REFERENCES Patient(PatientID), 
	CONSTRAINT PK_UserLogin PRIMARY KEY ( LoginID ) ) ;

--Condition
CREATE TABLE Condition (
	ConditionID INT NOT NULL IDENTITY,
	Name VARCHAR(50) NOT NULL,
	ConditionDescription VARCHAR(255) NOT NULL,
	PatientID INT NOT NULL,
	FOREIGN KEY(PatientID) REFERENCES Patient(PatientID),
	CONSTRAINT PK_Condition PRIMARY KEY ( ConditionID ) ) ;

--Family History
CREATE TABLE FamilyHistory (
	FamilyHistoryID INT NOT NULL IDENTITY,
	HistoryInformation VARCHAR(1500) NOT NULL,
	PatientID INT NOT NULL,
	FOREIGN KEY(PatientID) REFERENCES Patient(PatientID), 
	CONSTRAINT PK_FamilyHistory PRIMARY KEY ( FamilyHistoryID ) ) ;

--Speciality
CREATE TABLE Speciality (
	SpecialityID INT NOT NULL IDENTITY,
	Descripton VARCHAR(50) NOT NULL
	CONSTRAINT PK_Speciality PRIMARY KEY ( SpecialityID ) ) ;

--Doctor
CREATE TABLE Doctor (
	DoctorID INT NOT NULL IDENTITY,
	FirstName VARCHAR(30) NOT NULL,
	LastName VARCHAR(30) NOT NULL,
	PhoneNumber INT NOT NULL,
	Email VARCHAR(40),
	practiceAddress VARCHAR(255),
	SpecialityID INT,
	FOREIGN KEY(SpecialityID) REFERENCES Speciality(SpecialityID),
	CONSTRAINT PK_Doctor PRIMARY KEY ( DoctorID ) ) ;

--Medication
CREATE TABLE Medications (
	MedicationID INT NOT NULL IDENTITY,
	Name VARCHAR(255) NOT NULL,
	Dosage INT NOT NULL,
	DoctorID INT,
	FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID),
	CONSTRAINT PK_Medications PRIMARY KEY ( MedicationID ) ) ;

--Next of Kin
CREATE TABLE NextOfKin (
	CaregiverID INT NOT NULL IDENTITY,
	Name VARCHAR(50) NOT NULL,
	PhoneNumber INT NOT NULL,
	PatientID INT,
	FOREIGN KEY(PatientID) REFERENCES Patient(PatientID),
	CONSTRAINT PK_NextOfKin PRIMARY KEY ( CaregiverID ) ) ;

--My Plan
CREATE TABLE MyPlan (
	PlanID INT NOT NULL IDENTITY,
	PlanInformation VARCHAR(1500) NOT NULL,
	CONSTRAINT PK_MyPlan PRIMARY KEY ( PlanID ) ) ;

--Test
CREATE TABLE Test (
	TestID INT NOT NULL IDENTITY,
	TestDate DATE NOT NULL,
	Notes VARCHAR(500),
	CONSTRAINT PK_Test PRIMARY KEY ( TestID ) ) ;

--Specific Test
CREATE TABLE SpecificTest (
	SpecificTestID INT NOT NULL IDENTITY,
	TestDescription VARCHAR(255),
	Result VARCHAR(255),
	TestID INT NOT NULL,
	FOREIGN KEY(TestID) REFERENCES Test(TestID), 
	CONSTRAINT PK_SpecificTest PRIMARY KEY ( SpecificTestID ) ) ;

	--Appointment
CREATE TABLE Appointment (
	AppointmentID INT NOT NULL IDENTITY,
	PlanInformation VARCHAR(1500) NOT NULL,
	ReasonForVisit VARCHAR(1500) NOT NULL,
	Location VARCHAR(255),
	AppDate DATE,
	PlanID INT,
	PatientID INT, 
	DoctorID INT,
	TestID INT,
	CONSTRAINT FK_Appointment_PatientID FOREIGN KEY(PatientID) REFERENCES Patient(PatientID),
	CONSTRAINT FK_Appointment_DoctorID FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID),
	CONSTRAINT FK_Appointment_TestID FOREIGN KEY(TestID) REFERENCES Test(TestID),
	CONSTRAINT FK_Appointment_PlanID FOREIGN KEY(PlanID) REFERENCES MyPlan(PlanID),
	CONSTRAINT PK_Appointment PRIMARY KEY ( AppointmentID ) ) ;

	--Recommended Questions
CREATE TABLE RecommendedQuestions (
	QuestionID INT NOT NULL IDENTITY,
	Question VARCHAR(255) NOT NULL,
	Answer VARCHAR(1500) NOT NULL,
	ConditionID INT, 
	DoctorID INT,
	FOREIGN KEY(ConditionID) REFERENCES Condition(ConditionID),
	FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID),
	CONSTRAINT PK_RecommendedQuestions PRIMARY KEY ( QuestionID ) ) ;