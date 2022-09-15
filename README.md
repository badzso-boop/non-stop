# Non-Stop foci weboldal

## Terv
- Csapatok felvitele csapattagokkal egyutt
- Meccsek felvitele csapatokkal es idoponttal, majd eredmeny megadasa vagy kiesett
- keses beallitasa
- tovabbjutas kiszamolasa
- design elkeszitese hogy pofas legyen :D


## ELkeszites
1. belepteto felulet elkeszitese
2. Csapatok felvitele
    - csapat nev (input)
    - csapat tagok (textarea) [nev-osztaly]
3. Meccsek adatbazis elkeszitese
4. Meccsek admin felulet
    - csapat_a (input)
    - csapat_a_gol (input)
    - csapat_b (input)
    - csapat_b_gol (input)
    - idopont (valami time)
    - eredmeny (input) [0 -> döntetlen; 1 -> a; 2 -> b]
5. Döntő számoló
    - minden csapatnak kiszámolja a pontokat
    - dontobe jutott csapatok kilistazasa
    - Vegigmegy a csapatokon es mellette az osszes meccsen es ahol az a csapat nyert felirja hogy +3 a dontetlennel meg +1 es mindketto csapatnak megadja a golok szerint a pontot
    - Ha a csapat nyer, akkor kap 3 pontot, ha döntetlen, akkor mindkét csapat 1-1 pontot, ha veszít, akkor nem kap pontot?


## ADATBÁZIS TERV

### Felhasznalok
- id
- uname || VARCHAR(255)
- pwd   || VARCHAR(512)

CREATE TABLE felhasznalok (
    id INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
    uname VARCHAR(255) NOT NULL,
    pwd VARCHAR(512) NOT NULL
);

---

### Csapatok
- id
- csapat_nev                  || CHAR(255)
- csapat_tagok (nev-osztaly;) || VARCHAR(512)
- csapat_pontszam             || INT(15)

CREATE TABLE csapatok (
    id INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
    csapat_nev CHAR(255),
    csapat_tagok VARCHAR(512),
    pontszam INT(15)
);

---

### Meccsek
- id
- csapat_a     || VARCHAR(255)
- csapat_a_gol || INT(15)
- csapat_b     || VARCHAR(255)
- csapat_b_gol || INT(15)
- idopont      || TIME
- eredmeny     || INT(15)

CREATE TABLE meccsek (
    id INT(15) NOT NULL UNIQUE AUTO_INCREMENT,
    csapat_a VARCHAR(255),
    csapat_a_gol INT(15),
    csapat_b VARCHAR(255),
    csapat_b_gol INT(15),
    datum DATE,
    idopont TIME,
    eredmeny INT(15)
);

---

### Döntő -> ?????
- id
- csapat_a || CHAR(255)
- csapat_b || CHAR(255)
- idopont  || TIME
- eredmeny || INT(15)