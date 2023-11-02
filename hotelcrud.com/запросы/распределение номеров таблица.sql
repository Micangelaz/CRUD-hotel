USE Hotel;
GO
IF EXISTS (SELECT * FROM sys.tables WHERE NAME = 'Distribution ')
	DROP TABLE Distribution;

create table Distribution(
	ID INT IDENTITY(1,1),
	Room_ID INT NOT NULL,
	Client_ID INT NOT NULL,

	CONSTRAINT PK_distribution PRIMARY KEY (ID),
	CONSTRAINT FK_Room_ID FOREIGN KEY (Room_ID) REFERENCES Rooms (Room_ID),
	CONSTRAINT FK_Client_ID FOREIGN KEY (Client_ID) REFERENCES Clients (Client_ID)
	ON UPDATE CASCADE ON DELETE CASCADE);
GO

USE Hotel;
GO
SET NOCOUNT ON;
INSERT INTO Distribution (Room_ID, Client_ID) VALUES
(1,1),
(1,2),
(5,3),
(5,4),
(8,5),
(16,6),
(16,7),
(20,8),
(20,9),
(20,10);
GO