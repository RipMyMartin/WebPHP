create table osaleja(
    id int PRIMARY KEY AUTO_INCREMENT,
    nimi varchar(30),
    telefon int,
    pilt text,
    synniaeg DATE
);
insert INTO osaleja(nimi,telefon,pilt,synniaeg)
VALUES ('Martin', 555555, "https://cdn.mos.cms.futurecdn.net/o2QR532EoNCFnrvjuia6r6-320-80.jpg", '2007-11-11');
SELECT * FROM osaleja