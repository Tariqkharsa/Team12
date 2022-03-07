DROP TABlE Museum;
DROP TABLE Exhibition;
CREATE TABLE `MiniWorld`.`Museum`(
	`mName` VARCHAR(65) NOT NULL,
    `Street` VARCHAR(30) NOT NULL,
    `City` VARCHAR(20) NOT NULL,
    `Province` VARCHAR(20) NOT NULL,
    `ZipCode` VARCHAR(5) NOT NULL,
    `sTime` TIME NOT NULL,
    `eTime` TIME NOT NULL,
    `Ratings` DECIMAL (2,1),
    PRIMARY KEY(`mName`));
CREATE TABLE `MiniWorld`.`Exhibition`(
	`exName` VARCHAR(50) NOT NULL,
    `sDate` DATE NOT NULL,
    `eDate` DATE NOT NULL,
    PRIMARY KEY(`exName`));
    
INSERT INTO `MiniWorld`.`Museum`(`mName`,`Street`,`City`,`Province`, `ZipCode`,`sTime`,`eTime`,`Ratings`)
VALUES('Houston Museum of Fine Arts','1001 Bissonnet St', 'Houston', 'TX', '77005','9:00','18:00',4.9);

INSERT INTO `MiniWorld`.`Exhibition`(`exName`,`sDate`,`eDate`)
VALUES('Summer Art Pieces','2022-06-09','2022-07-09');

SELECT mName AS Museum, CONCAT(Street,', ',City,', ',Province,' ', ZipCode) AS 'Address', sTime AS 'Opening Hours', eTime AS 'Closing Hours', Ratings
FROM Museum;

SELECT exName AS 'Exhibition', sDate AS 'Starting Date', eDate AS 'Ending Date'
FROM Exhibition

