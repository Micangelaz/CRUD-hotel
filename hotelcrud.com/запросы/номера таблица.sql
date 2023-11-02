USE Hotel;
GO
IF EXISTS (SELECT * FROM sys.tables WHERE NAME = 'Room')
	DROP TABLE Room;

create table Room
	(Room_ID INT IDENTITY(1,1),
	Floor INT NOT NULL,
	Quantity_beds INT NOT NULL,
	Quantity_persons INT NOT NULL,
	Cost MONEY NOT NULL DEFAULT 0.00,

	CONSTRAINT PK_room PRIMARY KEY (Room_ID));
GO

USE Hotel;
GO
SET NOCOUNT ON;
INSERT INTO Room (Floor, Quantity_beds, Quantity_persons, Cost) VALUES
(1,2,4,3900),
(1,1,2,2800),
(1,3,4,4100),
(1,2,2,2900),
(1,2,2,2900),
(1,2,2,2900),
(1,3,6,5900),
(1,1,1,2500),
(1,2,4,3900),
(1,3,3,3300),
(2,2,4,3900),
(2,1,2,2800),
(2,3,4,4100),
(2,2,2,2900),
(2,2,2,2900),
(2,2,2,2900),
(2,3,6,5900),
(2,1,1,2500),
(2,2,4,3900),
(2,3,3,3300);
GO