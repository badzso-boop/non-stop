function inputok() {
    let inputSzam = document.getElementById("szam").value;

    let inputCsNev = document.createElement("input");
    let br = document.createElement("br");

    inputCsNev.type = "text";
    inputCsNev.name = "csapatnev";
    inputCsNev.placeholder = "Csapat név";
    inputCsNev.classList.add('m-2');

    document.getElementById("csapatForm").appendChild(inputCsNev);
    document.getElementById("csapatForm").appendChild(br);
    
    for(let i = 0; i < inputSzam; i++) {
        let inputnev = document.createElement("input");
        let inputosztaly = document.createElement("input");
        let br = document.createElement("br");

        inputnev.placeholder = 'Név';
        inputnev.name = 'nev' + (i+1);
        inputnev.type = 'text';
        inputnev.classList.add('m-2');

        inputosztaly.placeholder = 'Osztály';
        inputosztaly.name = 'osztaly' + (i+1);
        inputosztaly.type = 'text';

        document.getElementById("csapatForm").appendChild(inputnev);
        document.getElementById("csapatForm").appendChild(inputosztaly);
        document.getElementById("csapatForm").appendChild(br);
    }

    let inputmenny = document.createElement("input");
    let inputPontszam = document.createElement("input");
    let button = document.createElement('button');
    
    inputPontszam.type = "number";
    inputPontszam.name = "pontszam";
    inputPontszam.value = 0;
    inputPontszam.style.display = "none";

    inputmenny.name = 'szam';
    inputmenny.type = 'number';
    inputmenny.value = inputSzam;
    inputmenny.style.display = "none";

    button.type = "submit";
    button.name = "submitCS";
    button.innerHTML = "Mentés";
    button.classList.add('btn');
    button.classList.add('btn-secondary');
    button.classList.add('m-2');

    document.getElementById("csapatForm").appendChild(inputmenny);
    document.getElementById("csapatForm").appendChild(inputPontszam);
    document.getElementById("csapatForm").appendChild(button);

    document.getElementById("kezdes").style.display = "none";
}

function csapatokSzerkesztesJS(id, csapat_nev, csapat_tagok, pontszam) {
    //console.log("ID: " + id + ", Csapatnev: " + csapat_nev + ", Csapat tagok: " + csapat_tagok + ", POntszám: " + pontszam);

    var form = document.getElementById("csapatSzerkForm");
    var inputId = document.createElement("input");
    var inputCsNev = document.createElement("input");
    var inputPontszam = document.createElement("input");
    var buttonSubmit = document.createElement("button");
    var buttonBack = document.createElement("button");
    var br = document.createElement("br");
    var segedInput = document.createElement("input");

    inputId.type = "number";
    inputId.name = "id";
    inputId.value = id;
    inputId.style.display = "none";

    inputCsNev.type = "text";
    inputCsNev.name = "csapat_nev";
    inputCsNev.value = csapat_nev;
    inputCsNev.classList.add('m-2')

    inputPontszam.type = "number";
    inputPontszam.name = "pontszam";
    inputPontszam.value = pontszam;
    inputPontszam.style.display = "none";

    buttonSubmit.type = "submit";
    buttonSubmit.name = "submitCsSzerk";
    buttonSubmit.innerHTML = "Mentés";
    buttonSubmit.classList.add('btn');
    buttonSubmit.classList.add('btn-secondary');
    buttonSubmit.classList.add('m-2');

    segedInput.type = "number";
    segedInput.name = "szam";
    segedInput.style.display = "none";

    buttonBack.type = "button";
    buttonBack.name = "buttonBack";
    buttonBack.id = "buttonBack";
    buttonBack.innerHTML = "Vissza";
    buttonBack.classList.add('btn');
    buttonBack.classList.add('btn-secondary');
    buttonBack.classList.add('m-2');

    form.appendChild(inputId);
    form.appendChild(inputCsNev);
    form.appendChild(inputPontszam);
    form.appendChild(br);
    
    
    var csapatTagok = csapat_tagok.split(";");
    segedInput.value = csapatTagok.length-1;
    form.appendChild(segedInput);

    for (let index = 0; index < csapatTagok.length-1; index++) {
        var inputCsTagN = document.createElement("input");
        var inputCsTagO = document.createElement("input");
        var br = document.createElement("br");

        var seged = csapatTagok[index].split("-");
        var szam = index+1;

        inputCsTagN.type = "text";
        inputCsTagN.name = "nev" + szam;
        inputCsTagN.value = seged[0];
        inputCsTagN.classList.add('m-2');

        inputCsTagO.type = "text";
        inputCsTagO.name = "osztaly" + szam;
        inputCsTagO.value = seged[1];
        inputCsTagO.classList.add('m-2');

        form.appendChild(inputCsTagN);
        form.appendChild(inputCsTagO);
        form.appendChild(br);
    }

    form.appendChild(buttonSubmit);
    form.appendChild(buttonBack);

    document.getElementById("buttonBack").addEventListener("click", async function() {
        let form = document.getElementById("csapatSzerkForm");
        while (form.firstChild) {
            form.removeChild(form.firstChild);
        }
      });
}

function csapatokTorleseJS(id, csapat_nev) {
    var form = document.getElementById("csapatSzerkForm");
    var inputId = document.createElement("input");
    var inputCsNev = document.createElement("p");

    var buttonSubmit = document.createElement("button");
    var buttonBack = document.createElement("button");

    inputId.type = "number";
    inputId.name = "id";
    inputId.value = id;
    inputId.style.display = "none";

    inputCsNev.innerText = "Biztos törölni akarja a(z)" + csapat_nev + " csapatot?";

    buttonSubmit.type = "submit";
    buttonSubmit.name = "submitCsTorles";
    buttonSubmit.innerHTML = "Törlés";
    buttonSubmit.classList.add('btn');
    buttonSubmit.classList.add('btn-secondary');
    buttonSubmit.classList.add('m-2');

    buttonBack.type = "button";
    buttonBack.name = "buttonBack";
    buttonBack.id = "buttonBack";
    buttonBack.innerHTML = "Nem";
    buttonBack.classList.add('btn');
    buttonBack.classList.add('btn-secondary');
    buttonBack.classList.add('m-2');

    form.appendChild(inputId);
    form.appendChild(inputCsNev);

    form.appendChild(buttonSubmit);
    form.appendChild(buttonBack);

    document.getElementById("buttonBack").addEventListener("click", async function() {
        let form = document.getElementById("csapatSzerkForm");
        while (form.firstChild) {
            form.removeChild(form.firstChild);
        }
      });
}

function meccsEredmenyRogzitese(id, csapat_a, csapat_a_gol, csapat_b, csapat_b_gol, datum, idopont, eredmeny, bunteto) {
    var form = document.getElementById("meccsEredmForm");
    var inputId = document.createElement("input");
    var inputCsapatA = document.createElement("input");
    var inputCsapatAGol = document.createElement("input");
    var inputCsapatB = document.createElement("input");
    var inputCsapatBGol = document.createElement("input");
    var inputDatum = document.createElement("input");
    var inputIdopont = document.createElement("input");

    var inputBuntetoLabel = document.createElement("label");
    var inputBunteto = document.createElement("select");

    var buttonSubmit = document.createElement("button");
    var buttonBack = document.createElement("button");

    var csapatLista = ["Döntetlen", csapat_a, csapat_b];
    var inputEredm = document.createElement("select");

    inputId.type = "number";
    inputId.name = "id";
    inputId.id = "id";
    inputId.value = id;
    inputId.readOnly = true;
    inputId.classList.add('m-2');

    inputCsapatA.type = "text";
    inputCsapatA.name = "csapat_a";
    inputCsapatA.id = "csapat_a";
    inputCsapatA.value = csapat_a;
    inputCsapatA.readOnly = true;
    inputCsapatA.classList.add('m-2');

    inputCsapatAGol.type = "number";
    inputCsapatAGol.name = "csapat_a_gol";
    inputCsapatAGol.id = "csapat_a_gol";
    inputCsapatAGol.value = csapat_a_gol;
    inputCsapatAGol.classList.add('m-2');

    inputCsapatB.type = "text";
    inputCsapatB.name = "csapat_b";
    inputCsapatB.id = "csapat_b";
    inputCsapatB.value = csapat_b;
    inputCsapatB.readOnly = true;
    inputCsapatB.classList.add('m-2');

    inputCsapatBGol.type = "number";
    inputCsapatBGol.name = "csapat_b_gol";
    inputCsapatBGol.id = "csapat_b_gol";
    inputCsapatBGol.value = csapat_b_gol;
    inputCsapatBGol.classList.add('m-2');

    inputIdopont.type = "time";
    inputIdopont.name = "idopont";
    inputIdopont.id = "idopont";
    inputIdopont.value = idopont;
    inputIdopont.readOnly = true;
    inputIdopont.classList.add('m-2');

    inputDatum.type = "date";
    inputDatum.name = "datum";
    inputDatum.id = "datum";
    inputDatum.value = datum;
    inputDatum.readOnly = true;
    inputDatum.classList.add('m-2');

    inputEredm.name = "eredmeny";
    inputEredm.id = "inputEredm";
    inputEredm.classList.add('m-2');

    inputBuntetoLabel.name = "bunteto";
    inputBuntetoLabel.innerText = "Büntetővel nyert?";

    inputBunteto.name = "bunteto";
    inputBunteto.id = "inputBunteto";
    inputBunteto.classList.add('m-2');

    buttonSubmit.type = "submit";
    buttonSubmit.name = "submitMeccsEredm";
    buttonSubmit.id = "submitMeccsEredm";
    buttonSubmit.innerHTML = "Mentés";
    buttonSubmit.classList.add('btn');
    buttonSubmit.classList.add('btn-secondary');
    buttonSubmit.classList.add('m-2');

    buttonBack.type = "button";
    buttonBack.name = "buttonBack";
    buttonBack.id = "buttonBack";
    buttonBack.innerHTML = "Vissza";
    buttonBack.classList.add('btn');
    buttonBack.classList.add('btn-secondary');
    buttonBack.classList.add('m-2');

    form.appendChild(inputId);
    form.appendChild(inputCsapatA);
    form.appendChild(inputCsapatAGol);
    form.appendChild(inputCsapatB);
    form.appendChild(inputCsapatBGol);
    form.appendChild(inputDatum);
    form.appendChild(inputIdopont);
    form.appendChild(inputEredm);
    for (let i = 0; i < csapatLista.length; i++) {
        var option = document.createElement("option");
        option.value = i;
        option.text = csapatLista[i];
        document.getElementById("inputEredm").appendChild(option);
    }
    form.appendChild(inputBuntetoLabel);
    form.appendChild(inputBunteto);
    szavak = ["Nem", "Igen"];
    for (let i = 0; i < 2; i++) {
        var option = document.createElement("option");
        option.value = i;
        option.text = szavak[i];
        document.getElementById("inputBunteto").appendChild(option);
    }

    form.appendChild(buttonSubmit);
    form.appendChild(buttonBack);

    document.getElementById("buttonBack").addEventListener("click", async function() {
        let form = document.getElementById("meccsEredmForm");
        while (form.firstChild) {
            form.removeChild(form.firstChild);
        }
      });
}

function meccsSzerkesztese(id, csapat_a, csapat_a_gol, csapat_b, csapat_b_gol, datum, idopont, eredmeny) {
    var table = document.getElementById("csapatokTable").getElementsByClassName("csapat_nev");

    var form = document.getElementById("meccsEredmForm");
    var inputId = document.createElement("input");
    var inputCsapatAGol = document.createElement("input");
    var inputCsapatBGol = document.createElement("input");
    var inputDatum = document.createElement("input");
    var inputIdopont = document.createElement("input");
    var buttonSubmit = document.createElement("button");
    var buttonBack = document.createElement("button");

    var csapatLista = ["Döntetlen", csapat_a, csapat_b];

    var inputCsapatA = document.createElement("select");
    var inputCsapatB = document.createElement("select");

    inputId.type = "number";
    inputId.name = "id";
    inputId.id = "id";
    inputId.value = id;
    inputId.readOnly = true;
    inputId.classList.add('m-2');

    inputCsapatA.name = "csapat_a";
    inputCsapatA.id = "csapat_a";
    inputCsapatA.classList.add('m-2');

    inputCsapatAGol.type = "number";
    inputCsapatAGol.name = "csapat_a_gol";
    inputCsapatAGol.id = "csapat_a_gol";
    inputCsapatAGol.value = csapat_a_gol;
    inputCsapatAGol.readOnly = true;
    inputCsapatAGol.classList.add('m-2');

    inputCsapatB.name = "csapat_b";
    inputCsapatB.id = "csapat_b";
    inputCsapatB.classList.add('m-2');

    inputCsapatBGol.type = "number";
    inputCsapatBGol.name = "csapat_b_gol";
    inputCsapatBGol.id = "csapat_b_gol";
    inputCsapatBGol.value = csapat_b_gol;
    inputCsapatBGol.readOnly = true;
    inputCsapatBGol.classList.add('m-2');

    inputIdopont.type = "time";
    inputIdopont.name = "idopont";
    inputIdopont.id = "idopont";
    inputIdopont.value = idopont;
    inputIdopont.classList.add('m-2');

    inputDatum.type = "date";
    inputDatum.name = "datum";
    inputDatum.id = "datum";
    inputDatum.value = datum;
    inputDatum.classList.add('m-2');

    buttonSubmit.type = "submit";
    buttonSubmit.name = "SubmitMeccsSzerk";
    buttonSubmit.id = "SubmitMeccsSzerk";
    buttonSubmit.innerHTML = "Mentés";
    buttonSubmit.classList.add('btn');
    buttonSubmit.classList.add('btn-secondary');
    buttonSubmit.classList.add('m-2');

    buttonBack.type = "button";
    buttonBack.name = "buttonBack";
    buttonBack.id = "buttonBack";
    buttonBack.innerHTML = "Vissza";
    buttonBack.classList.add('btn');
    buttonBack.classList.add('btn-secondary');
    buttonBack.classList.add('m-2');

    form.appendChild(inputId);
    form.appendChild(inputCsapatA);
    for (let i = 0; i < table.length; i++) {
        var option = document.createElement("option");
        option.value = table[i].innerText; 
        option.text = table[i].innerText;
        document.getElementById("csapat_a").appendChild(option);
    }
    form.appendChild(inputCsapatAGol);
    form.appendChild(inputCsapatB);
    for (let i = 0; i < table.length; i++) {
        var option = document.createElement("option");
        option.value = table[i].innerText; 
        option.text = table[i].innerText;
        document.getElementById("csapat_b").appendChild(option);
    }
    form.appendChild(inputCsapatBGol);
    form.appendChild(inputDatum);
    form.appendChild(inputIdopont);
    form.appendChild(buttonSubmit);
    form.appendChild(buttonBack);

    document.getElementById("buttonBack").addEventListener("click", async function() {
        let form = document.getElementById("meccsEredmForm");
        while (form.firstChild) {
            form.removeChild(form.firstChild);
        }
      });
}

function adottMeccsTorlese(id, csapat_a, csapat_b) {
    let form = document.getElementById("meccsTorles");

    let input = document.createElement("input");
    let button = document.createElement("button");
    var buttonBack = document.createElement("button");
    let h1 = document.createElement("h1");

    input.type = "number";
    input.name = "id";
    input.value = id;
    input.style.display = "none";

    button.type = "submit";
    button.name = "adottMeccsTorlese";
    button.innerHTML = "Törlés";
    button.classList.add('btn');
    button.classList.add('btn-secondary');
    button.classList.add('m-2');

    buttonBack.type = "button";
    buttonBack.name = "buttonBack";
    buttonBack.id = "buttonBack";
    buttonBack.innerHTML = "Nem";
    buttonBack.classList.add('btn');
    buttonBack.classList.add('btn-secondary');
    buttonBack.classList.add('m-2');

    h1.innerText = "Biztos törölni akarja a(z) " + csapat_a + " vs. " + csapat_b + " mérkőzést?";

    form.appendChild(h1);
    form.appendChild(input);
    form.appendChild(button);
    form.appendChild(buttonBack);

    document.getElementById("buttonBack").addEventListener("click", async function() {
        let form = document.getElementById("meccsTorles");
        while (form.firstChild) {
            form.removeChild(form.firstChild);
        }
      });
}