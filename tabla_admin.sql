create table admin
(id integer(11),
 username char(50),
 passcode char(50));
 
alter table admin add constraint pk_admin primary key (id);

insert into admin (id, username, passcode) values(1,'pacman','pacman');
commit;
