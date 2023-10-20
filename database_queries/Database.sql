create Database ChatRoom ;
use ChatRoom;
drop database ChatRoom;
create table Accounts(
id int auto_increment ,
userName nvarchar(25) unique,
userPassword nvarchar(30),
profileImagePath nvarchar(50),
gender bit , -- 0  = male  , 1 = female
age int ,
connectionID int, 
primary key(id)
);
alter table accounts modify column connectionID nvarchar(40);
select * from accounts_rooms;
select * from rooms ; 
select connectionID from accounts ;
select connectionID from accounts join accounts_rooms on accounts.id = account_id where room_id =2 ;


select roomName  , id from rooms join accounts_rooms 
on rooms.id = accounts_rooms.room_id;
insert into accounts (userName) values('shego');
insert into friends (user_id , friends_id) values(1,2);
delete from accounts where id = 1 ;
select * from accounts ;
create table friends(
friends_id int , 
user_id int , 
friendName nvarchar(15),
primary key(user_id , friends_id),
foreign key(friends_id) references accounts(id) ON DELETE CASCADE,
foreign key(user_id) references accounts(id)ON DELETE CASCADE
);
insert into friends(friends_id,user_id)
values(1,3);
select * from friends;
select * from accounts; 
delete from friends where  user_id = 1;

select connectionID from accounts join rooms 
on accounts.id = rooms.adminID 
where roomName = 'club' ; 

delete from accounts where userName ='hell';

-- show users with thier friends
select  userName , friends_id from accounts join friends
on accounts.id = friends.user_id ;

-- faild test
select userName , friends_id , userStatus from friends join accounts
on accounts.id = friends.user_id 
join log
on friends.user_id = log.userID;

SET SQL_SAFE_UPDATES = 0;
select * from accounts ;
select * from friends;
delete from accounts where id = 1;

create trigger friendName 
after insert on friends
for each row 
insert into friends (friendName)values();

create trigger DeleteOLDFriends
BEFORE DELETE ON accounts
FOR EACH ROW 
delete from friends where friends.friends_id = old.id ;
drop trigger deleteoldfriends;

create table log (
id int auto_increment , 
userStatus bit ,
userID int , 
date_time datetime default now(),
primary key(id),
foreign key (userID) references accounts(id)ON DELETE CASCADE
);
insert into log (userID,userStatus) values(1 ,1);
drop table log;
select*from log;
select id from accounts where userName =' ahmed';
select * from Accounts ;

create table rooms (
id int auto_increment,
roomName nvarchar(20),
AdminID int ,
capacity int ,
roomKey int ,
primary key(id),
foreign key (AdminID)references Accounts(id)ON DELETE CASCADE
);
select *from  rooms;
create table Accounts_rooms(
account_id int not null ,
room_id int not null , 
foreign key (account_id) references Accounts(id)ON DELETE CASCADE,
foreign key (room_id) references rooms(id)ON DELETE CASCADE
);
select * from accounts_rooms;
select * from rooms ;
insert into rooms (roomKey)values(1);

create table friend_request(
id int auto_increment,
senderID int , 
recieverID int ,
date_time datetime default now(),
primary key(id) , 
foreign key (senderID) references accounts(id)on delete cascade,
foreign key (recieverID) references accounts(id)on delete cascade
);
insert into friend_request(senderID , recieverID) values(2,3);
select * from friend_request;
select * from friends ; 
select friends_id from friends where user_id = 1 and friends_id =3 ;
select * from accounts;
select senderID from friend_request where recieverID = 3 ;
delete from friend_request where senderID=1 and recieverID=2 ;

create table rooms_request(
id int auto_increment , 
roomID int , 
recieverID int , 
date_time datetime default now(),
primary key(id),
foreign key (roomID) references rooms(id)on delete cascade ,
foreign key (recieverID)references accounts(id)on delete cascade 
);

select * from rooms_request ;
delete from rooms_request where roomID = 10 and recieverID=1 ;
select * from accounts_rooms ; 
select account_id from accounts_rooms where account_id = 1 and room_id = 9 ;
select * from rooms;
select capacity from rooms where roomName ="chess club" and AdminID = 5 ;
select * from accounts_rooms;
select * from accounts ; 
select count(room_id) from accounts_rooms where room_id =3 ;

select  roomName from rooms join rooms_request 
on rooms.id = rooms_request.roomID 
where rooms_request.recieverID = 6 ;
select * from accounts ;



-- trigger for matching when request_state is set delete the roomRequestID or friendRequestID from the tables

create trigger delete_checked_friendRequest
after insert ON request_state
FOR EACH ROW 
delete from friend_request where friend_request.id =new.friendRequestID;
create trigger delete_checked_roomRequest
after insert on request_state
for each row 
delete from rooms_request where rooms_request.id = new.roomsRequestID;
drop trigger  delete_checked_friendRequest; 
-- ----------------------------------------------------------------------------------------------------------------------------------
create table chatMsg(
id int auto_increment ,
msg text,
dateAndTime datetime default now(),
users_id int ,
room_id int ,
primary key(id),
foreign key (users_id) references Accounts(id)ON DELETE CASCADE,
foreign key (room_id ) references rooms(id)ON DELETE CASCADE
);

select * from chatMsg;
select msg  , userName from chatMsg join accounts
on chatMsg.users_id = accounts.id
where room_id=2 ;
insert into chatMsg (msg , users_id ,room_id)
values ('ggg', 2 ,2) ;
truncate table chatMsg ;
-- -----------------------------------------------------------------------


           

	


