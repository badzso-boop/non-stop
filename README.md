# Non-Stop foci weboldal

## Terv
- Csapatok felvitele csapattagokkal egyutt
- Meccsek felvitele csapatokkal es idoponttal, majd eredmeny megadasa vagy kiesett
- keses beallitasa
- tovabbjutas kiszamolasa
- design elkeszitese hogy pofas legyen :D


## ADATBÁZIS TERV

### Felhasznalok
- id
- uname || VARCHAR(255)
- pwd   || VARCHAR(512)

### Csapatok
- id
- csapat_nev || CHAR(255)
- csapat_tagok (nev-osztaly;) || VARCHAR(512)

### Meccsek
- id
- csapat_a || CHAR(255)
- csapat_b || CHAR(255)
- idopont  || TIME
- eredmeny || INT(15)

### Döntő -> ?????
- id
- csapat_a || CHAR(255)
- csapat_b || CHAR(255)
- idopont  || TIME
- eredmeny || INT(15)