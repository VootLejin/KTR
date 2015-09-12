--SQL Outline
--Tables:
--Player (ID, Name)
--
--Province (ID, Name, ... Will add more once More stats are determined)
--Permissions
-- RulesElements
--
--Need an approach for continents with same path number?
--Don't, paths will be all made in same over picture and then cropped

CREATE TABLE province (
	ProvinceID int,
	Name varchar(255)
);
CREATE TABLE users(
	userID 	int NOT NULL AUTO_INCREMENT,
	user_name	varchar(255),
	hash	varchar(255),
	PRIMARY KEY (UserID)
);

INSERT INTO users (user_name,hash)
VALUES ('toast', '$2y$10$UXRzI8LSeaX2bC7ta1M9k.K9Sw2nUYC1El82vIgxKhzr.KTPWGAFy
');--SO INSECURE, OMG
--Dear future me, I know this is hilariously bad, 
--don't put the hash and salt in publically visible places
--But toast is going to be the test account with zero privleges