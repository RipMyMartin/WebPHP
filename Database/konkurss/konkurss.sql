create table konkurss(
                         id int primary key AUTO_INCREMENT,
                         konkursiNimi varchar(100),
                         lisamisaeg datetime,
                         komentaarid text,
                         punktid int,
                         avalik int DEFAULT 1
);

INSERT INTO konkurss (konkursiNimi, punktid, lisamisaeg)
VALUES ('jõulukaart',5,'2024-12-02');

SELECT * FROM konkurss

UPDATE konkurss set punktid = punktid+1
WHERE id=1;