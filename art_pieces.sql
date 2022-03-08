
USE MUSEUM;
DROP TABLE ARTPIECES;

CREATE TABLE ARTPIECES (
  AID char(6) NOT NULL,
  ANAME varchar(100) NOT NULL,  -- NAME OF THE PIECE
  ARTIST varchar(50) DEFAULT NULL,  -- ARTIST NAME
  DEPTNAME enum('PAINTING','SCULPTURE','FILM','ARCHITECTURE') NOT NULL,
  ARTINFO varchar(1500) DEFAULT NULL,  -- DESCRIPTION OF ART
  INDATE date NOT NULL,
  OUTDATE date DEFAULT NULL,
  
  PRIMARY KEY (AID),
  -- FOREIGN KEY (DEPTNAME) REFERENCES DEPARTMENT()
  
  -- CONSTRAINT `AID_FORMAT` CHECK ((`AID` like _utf8mb4'[0-9][0-9][0-9][0-9][0-9][0-9]')),
  -- CONSTRAINT `artpieces_chk_1` CHECK ((`AID` like _utf8mb4'[0-9][0-9][0-9][0-9][0-9][0-9]')),
  -- CONSTRAINT `INVALID_AID` CHECK ((`AID` like _utf8mb4'[0-9][0-9][0-9][0-9][0-9][0-9]')),
  
  CONSTRAINT INVALID_INSTALL_DATE CHECK (((INDATE > '2001-01-01') and (INDATE <= sysdate()))),
  CONSTRAINT INVALID_REMOVE_DATE CHECK (((OUTDATE > '2001-01-01') and (OUTDATE <= sysdate()) and (OUTDATE >= INDATE)))
);

-- ------  FOLLOWING IS TEST CASES      --------
INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, INDATE)
VALUES ('198762','DAVID','MICHEANGELO','SCULPTURE','2022-03-08');  -- CORRECT RESULT: INSERT SUCCESSFULLY

INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, INDATE)
VALUES ('19876299','DAVID','MICHEANGELO','SCULPTURE','2022-03-08');  -- CORRECT RESULT: FAIL TO INSERT

INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, INDATE)
VALUES ('198762','DAVID','MICHEANGELO','BOBBY','2022-03-08');  -- CORRECT RESULT: FAIL TO INSERT

INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, INDATE)
VALUES ('198762','DAVID','MICHEANGELO','SCULPTURE','2022-04-08');  -- CORRECT RESULT: FAIL TO INSERT

INSERT INTO ARTPIECES(AID, ANAME, ARTIST, DEPTNAME, INDATE, OUTDATE)
VALUES ('198762','DAVID','MICHEANGELO','SCULPTURE','2022-01-08','2022-01-01');  -- CORRECT RESULT: FAIL TO INSERT






