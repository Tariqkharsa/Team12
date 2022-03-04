USE test;

create table Customers(
	FirstName		CHAR(50),
    LastName		CHAR(50),
    Age				INT(3),
    PhoneNumber		BIGINT(10),
    Email			VARCHAR(50),		
    SpecialStatus	ENUM('CollegeStudent', 'Veteran', 'Senior', 'Child', 'None') NOT NULL,
    Primary Key (SpecialStatus)
);

INSERT INTO Customers VALUES ('Dorian', 'Nozales', '23', '8325671234', 'myemail@yahoo.com', 'CollegeStudent');
INSERT INTO Customers VALUES ('Erika', 'Ubuya', '5', null, null, 'Child');
INSERT INTO Customers VALUES ('Elijah', 'Tottenham', '69', '6347895003', null, 'Senior');
INSERT INTO Customers VALUES ('Zachary', 'Sams', '36', '3484700098', null, 'None');