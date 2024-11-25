create table loomad(
   id int PRIMARY KEY AUTO_INCREMENT,
   loomaNimi varchar(30),
   omanik varchar(30),
   varv varchar(30),
   pilt text
);
insert into loomad (loomaNimi,omanik,varv)
VALUES('Gleb','Bogdan','Black');

SELECT * FROM loomad;