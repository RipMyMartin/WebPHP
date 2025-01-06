create table jooksjad(
    id int primary key AUTO_INCREMENT,
    eesnimi varchar(120) NOT NULL,
    perenimi varchar(120) NOT NULL,
    alustamisaeg datetime NOT NULL,
    lopetamisaeg datetime NOT NULL,
    vaheaeg int DEFAULT 0
);