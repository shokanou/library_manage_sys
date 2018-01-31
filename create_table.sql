

CREATE TABLE book 
(
BookID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(BookID),
Catagory varchar(30) NOT NULL,
BookName varchar(30) NOT NULL,
Publisher varchar(30) NOT NULL,
PubYear int NOT NULL,
Author varchar(30) NOT NULL,
Price float(5,2) NOT NULL,
Total_volume int NOT NULL,
Stock int,
	check (Stock<=Total_volume)
);


CREATE TABLE library_card 
(
CardID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(CardID),
BName varchar(30) NOT NULL,
Dept_name varchar(30),
Type varchar(30)
	CHECK (Type IN('Student','Teacher'))
);


CREATE TABLE administrator 
(
AdminID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(AdminID),
Password varchar(30) NOT NULL,
AdminName varchar(30) NOT NULL,
Telephone int
);

CREATE TABLE borrow_record 
(
BookID int NOT NULL,
CardID int NOT NULL,
BorrowDate date default '0000-00-00',
ReturnDate date default '0000-00-00',
AdminID int NOT NULL,
PRIMARY KEY(BookID,CardID,BorrowDate),
foreign key (BookID) references book(BookID) ON DELETE CASCADE,
foreign key (CardID) references library_card(CardID) ON DELETE CASCADE,
foreign key (AdminID) references administrator(AdminID) ON DELETE CASCADE
);