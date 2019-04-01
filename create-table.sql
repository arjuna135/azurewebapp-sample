create table [dbo].[User](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    firstname VARCHAR(30),
    lastname VARCHAR(30)
);