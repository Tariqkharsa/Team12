DROP TABLE ACCESS;
DROP TABLE ARTPIECES;
DROP TABLE EMPLOYEES;
DROP TABLE Departments;
DROP TABLE TICKET;
DROP TABLE GiftShop;
DROP TABLE Customers;
DROP TABLE Exhibition;
DROP TABLE Museum;

USE MiniWorld;

CREATE TABLE Museum(
	mName VARCHAR(65) NOT NULL,
    Street VARCHAR(30) NOT NULL,
    City VARCHAR(20) NOT NULL,
    Province VARCHAR(20) NOT NULL,
    ZipCode VARCHAR(5) NOT NULL,
    sTime TIME NOT NULL,
    eTime TIME NOT NULL,
    Ratings DECIMAL (2,1),
    PRIMARY KEY(mName)
    );
CREATE TABLE Exhibition(
	EXID	INT(8) NOT NULL,
	exName VARCHAR(50) NOT NULL,
    COST  DOUBLE(4,2) NOT NULL,
    sDate DATE NOT NULL,
    eDate DATE NOT NULL,
    PRIMARY KEY(exName),
    CONSTRAINT INVALID_INSTALL_DATE CHECK (((sDate > '2001-01-01') and (sDate <= sysdate()))),
	CONSTRAINT INVALID_REMOVE_DATE CHECK (((eDate > '2001-01-01') and (eDate >= sDate))));
CREATE TABLE CUSTOMERS(
	FirstName		CHAR(50),
    LastName		CHAR(50),
    Age				INT(3),
    PhoneNumber		BIGINT(10),
    Email			VARCHAR(50),
    CID				INT(10) NOT NULL,
    SpecialStatus	ENUM('CollegeStudent', 'Veteran', 'Senior', 'Child', 'None') NOT NULL,
    Primary Key (CID)
);
CREATE TABLE GiftShop(
	GiftID		INT(10) NOT NULL,
    GiftName	VARCHAR(30),
    Price		DOUBLE(16,2),
    SpecialStatus	ENUM('Sold', 'In Stock') NOT NULL,
    Primary Key (GiftID),
    FOREIGN KEY (GiftID) REFERENCES CUSTOMERS(CID)
);
CREATE TABLE TICKET 
(
	TID CHAR(10) NOT NULL ,	-- PASSED,  will automatically add trailling spaces
	TTYPES ENUM('CHILD','SENIOR','REGULAR','VETERAN','STUDENT') NOT NULL,
	PRICE DECIMAL(8,2) NOT NULL,
	SOLDDATE DATE  			
	CONSTRAINT INVALID_SOLDDATE
	CHECK( SOLDDATE >= '2001-01-01' AND SOLDDATE  <= SYSDATE()),    -- PASSED 	-- Format: YYYY-MM-DD, date is string
	CUSID INT(8) NOT NULL,
	PRIMARY KEY (TID),
    FOREIGN KEY (CUSID) REFERENCES CUSTOMERS(CID)
);
CREATE TABLE Departments(
    Dep_Num INT(10) NOT NULL,-- artificial key
    Dep_Name VARCHAR(30) NOT NULL,-- ex: giftshop, scultpures, classical
    Dep_Mus	VARCHAR(65) NOT NULL,
    PRIMARY KEY(Dep_Num),
    FOREIGN KEY (Dep_Mus) REFERENCES Museum(mName)
    );
CREATE TABLE EMPLOYEES (
  EMPLOYEE_ID INT(10) NOT NULL,  -- Employee's ID
  JOBTITLE varchar(100) NOT NULL,
  FIRST_NAME varchar(50) NOT NULL,  -- FNAME OF THE EMPLOYEE
  LAST_NAME varchar(50) NOT NULL,  -- LNAME OF THE EMPLOYEE
  AGE varchar(3) NOT NULL,  -- AGE OF EMPLOYEE
  SEX ENUM('M','F','Other'),
  PHONE_NUMBER char(10) NOT NULL,
  EMPLOYEE_ADDRESS varchar(200) NOT NULL,
  SALARY DECIMAL(9, 2) NOT NULL,
  BIRTHDATE DATE NOT NULL,
  dNUM INT(10) NOT NULL,
  FOREIGN KEY (dNum) REFERENCES Departments(Dep_Num), -- works in department
  PRIMARY KEY (EMPLOYEE_ID)
);
CREATE TABLE ARTPIECES (
  AID char(6) NOT NULL,
  ANAME varchar(100) NOT NULL,  -- NAME OF THE PIECE
  ARTIST varchar(50) DEFAULT NULL,  -- ARTIST NAME
  DEPTNAME enum('PAINTING','SCULPTURE','FILM','ARCHITECTURE') NOT NULL,
  ARTINFO varchar(1500) DEFAULT NULL,  -- DESCRIPTION OF ART
  INDATE date NOT NULL,
  OUTDATE date DEFAULT NULL,
  dID INT(10) NOT NULL,
  PRIMARY KEY (AID),
  FOREIGN KEY (dID) REFERENCES Departments(Dep_Num),
  CONSTRAINT INVALD_INSTALL_DATE CHECK (((INDATE > '2001-01-01') and (INDATE <= sysdate()))),
  CONSTRAINT INVALD_REMOVE_DATE CHECK (((OUTDATE > '2001-01-01') and (OUTDATE >= INDATE)))
);
CREATE TABLE ACCESS(
	ACID INT(8) NOT NULL,
    ACEN VARCHAR(50) NOT NULL,
	FOREIGN KEY(ACID) REFERENCES CUSTOMERS(CID),
    FOREIGN KEY(ACEN) REFERENCES Exhibition(exName)
    
);

INSERT INTO Museum(mName,Street,City,Province, ZipCode,sTime,eTime,Ratings)
VALUES('Houston Museum of Fine Arts','1001 Bissonnet St', 'Houston', 'TX', '77005','9:00','18:00',4.9);

INSERT INTO Exhibition(EXID,exName,COST,sDate,eDate)
VALUES(1,'Summer Art Pieces',10.50,'2021-06-09','2022-07-09');

INSERT INTO CUSTOMERS VALUES ('Dorian', 'Nozales', '23', '8325671234', 'myemail@yahoo.com', 1,'CollegeStudent');
INSERT INTO CUSTOMERS VALUES ('Erika', 'Ubuya', '5', null, null, 2,'Child');
INSERT INTO CUSTOMERS VALUES ('Elijah', 'Tottenham', '69', '6347895003', null, 3,'Senior');
INSERT INTO CUSTOMERS VALUES ('Zachary', 'Sams', '36', '3484700098', null, 4,'None');

INSERT INTO GiftShop VALUES (1, 'a',10.25,'Sold');
INSERT INTO GiftShop VALUES (2, 'b',1.99,'In Stock');
INSERT INTO GiftShop VALUES (3,'c',8.99,'Sold');
INSERT INTO GiftShop VALUES (4,'d',4.00, 'Sold');   


INSERT INTO TICKET(TID,TTYPES, PRICE,  SOLDDATE, CUSID)
VALUES ('123456780','CHILD','12.99', '2020-09-09',1);  -- TESTING : CONSTARINT SOLD, CORRECT RESULT: FAIL_TO_INSERT

INSERT INTO Departments(Dep_Num,Dep_Name,Dep_Mus)
VALUES (1,'S','Houston Museum of Fine Arts');

-- set up in a way that this could now apply to multiple museums if they happen to be owned by the same dude
INSERT INTO EMPLOYEES( EMPLOYEE_ID, JOBTITLE, FIRST_NAME, LAST_NAME,AGE, SEX, PHONE_NUMBER, EMPLOYEE_ADDRESS, SALARY, BIRTHDATE,dNUM)
VALUES (1,'Janitor', 'Harold', 'Hart', 21, 'M', '8328459284', '440 North St Houston, TX', 40000.00, '2000-08-12',1),
(2,'Tour Guide', 'Arnold','Mart', 22, 'M', '2817463838', '100 Stone Blvd Bellaire, TX', 60000.00, '2000-08-13',1);

--  -------Following is test cases ----------

-- ------  FOLLOWING IS TEST CASES      --------
INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, ARTINFO,INDATE,OUTDATE,dID)
VALUES ('198762','DAVID','MICHEANGELO','SCULPTURE','a','2022-01-08','2022-01-08',1);  -- CORRECT RESULT: INSERT SUCCESSFULLY

INSERT INTO ACCESS(ACID,ACEN)
VALUES (1,'Summer Art Pieces');

SELECT *
FROM Museum, Exhibition, CUSTOMERS, GiftShop, TICKET, Departments, EMPLOYEES,ARTPIECES,ACCESS
