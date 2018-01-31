use library_management_system;


insert into book
	values (10000, 'Computer Science', 'Computer Architecture', 'Guangming publisher', 2004, 'Liyang', 30.00, 3,3 );
	
insert into book
	values (10001, 'Computer Science', 'Javascript', 'Hangzhou publisher', 2010, 'Wuweiyang', 50.80, 4,3 );
	
insert into book
	values (10002, 'Classical', 'Pride and prejudice', 'Renming publisher', 2008, 'Austen Jane', 80.80, 2,1 );
	
insert into book
	values (10003, 'Literature', 'Black and white', 'Renming publisher', 2010, 'Pengpeng', 20.80, 4,4 );
	
insert into book
	values (10004, 'Magazine', 'Love Diary', 'Hangzhou publisher', 2014, 'Liyang', 5.80, 3,3 );
	
insert into book
	values (10005, 'Economy', 'Current Economy', 'Guangzhou publisher', 2013, 'Akang', 40.80, 5,5 );
	
insert into administrator
	values (101,'101','admin101',867110622);
	
insert into administrator
	values (102,'102','admin102',867110623);
	
insert into administrator
	values (103,'103','admin103',867110624);
	
insert into administrator
	values (104,'104','admin104',867110625);
	
insert into library_card
	values (2001,'user2001','Computer Science','Teacher');
	
insert into library_card
	values (2002,'user2002','Biology','Student');
	
insert into library_card
	values (2003,'user2003','Fine Art','Teacher');
	
insert into library_card
	values (2004,'user2004','Computer Science','Student');
	
insert into library_card
	values (2005,'user2005','Chemistry','Student');
	
insert into borrow_record
	values (10003,2001,'2015-04-01','2015-04-20',102);
insert into borrow_record
	values (10004,2002,'2015-03-20','2015-04-18',104);
insert into borrow_record
	values (10002,2004,'2015-04-22','0000-00-00',103);
insert into borrow_record
	values (10005,2003,'2015-03-28','0000-00-00',101);
