USE test;

create table GiftShop(
	GiftID		INT(10),
    Price		DOUBLE(16),
    SpecialStatus	ENUM('Sold', 'In Stock') NOT NULL,
    Primary Key (GiftID)
);

INSERT INTO GiftShop VALUES ('0000054321', '10.25', 'Sold');
INSERT INTO GiftShop VALUES ('123456789', '1.99', 'In Stock');
INSERT INTO GiftShop VALUES ('987654321', '8.99', 'Sold');
INSERT INTO GiftShop VALUES ('165489763', '4', 'Sold');
