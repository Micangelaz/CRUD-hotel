USE master;  
GO 
IF DB_ID ('Hotel') IS NOT NULL
	DROP DATABASE Hotel;
GO
CREATE DATABASE Hotel  
ON   
( NAME = Hotel_dat,  
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\CARS\Hotel_dat.mdf',  
    SIZE = 5 MB,  
    MAXSIZE = UNLIMITED,  
    FILEGROWTH = 1 MB )  
LOG ON  
( NAME = Hotel_log,  
    FILENAME = 'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\CARS\Hotel_carlog.ldf',  
    SIZE = 1MB,  
    MAXSIZE = 30MB,  
    FILEGROWTH = 1MB );  
GO  




