function inputok() {
    let inputSzam = document.getElementById("szam").value;

    let inputCsNev = document.createElement("input");
    let br = document.createElement("br");

    inputCsNev.type = "text";
    inputCsNev.name = "csapatnev";
    inputCsNev.placeholder = "Csapat név";

    document.getElementById("csapatForm").appendChild(inputCsNev);
    document.getElementById("csapatForm").appendChild(br);
    
    for(let i = 0; i < inputSzam; i++) {
        let inputnev = document.createElement("input");
        let inputosztaly = document.createElement("input");
        let br = document.createElement("br");

        inputnev.placeholder = 'Név';
        inputnev.name = 'nev' + (i+1);
        inputnev.type = 'text';

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
    var br = document.createElement("br");
    var segedInput = document.createElement("input");

    inputId.type = "number";
    inputId.name = "id";
    inputId.value = id;
    inputId.style.display = "none";

    inputCsNev.type = "text";
    inputCsNev.name = "csapat_nev";
    inputCsNev.value = csapat_nev;

    inputPontszam.type = "number";
    inputPontszam.name = "pontszam";
    inputPontszam.value = pontszam;
    inputPontszam.style.display = "none";

    buttonSubmit.type = "submit";
    buttonSubmit.name = "submitCsSzerk";
    buttonSubmit.innerHTML = "Mentés";

    segedInput.type = "number";
    segedInput.name = "szam";
    segedInput.style.display = "none";

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

        inputCsTagO.type = "text";
        inputCsTagO.name = "osztaly" + szam;
        inputCsTagO.value = seged[1];

        form.appendChild(inputCsTagN);
        form.appendChild(inputCsTagO);
        form.appendChild(br);
    }

    form.appendChild(buttonSubmit);
}

function meccsSzerkeszteseJS(id, csapat_a, csapat_a_gol, csapat_b, csapat_b_gol, idopont, eredmeny) {
    var form = document.getElementById("meccsEredmForm");
    var inputId = documen.createElement("input");
    var inputCsapatA = documen.createElement("input");
    var inputCsapatAGol = documen.createElement("input");
    var inputCsapatB = documen.createElement("input");
    var inputCsapatBGol = documen.createElement("input");
    var inputIdopont = documen.createElement("input");
    var inputEredm = documen.createElement("input");
    var buttonSubmit = document.createElement("button");

    inputId.type = "number";
    inputId.name = "id";
    inputId.value = id;
    //inputId.readonly = true;

    inputCsapatA.type = "text";
    inputCsapatA.name = "csapat_a";
    inputCsapatA.value = csapat_a;
    //inputCsapatA.readonly = true;

    inputCsapatAGol.type = "number";
    inputCsapatAGol.name = "csapat_a_gol";
    inputCsapatAGol.value = csapat_a_gol;
    //inputCsapatAGol.readonly = true;

    inputCsapatB.type = "text";
    inputCsapatB.name = "csapat_b";
    inputCsapatB.value = csapat_b;
    //inputCsapatB.readonly = true;

    inputCsapatBGol.type = "number";
    inputCsapatBGol.name = "csapat_b_gol";
    inputCsapatBGol.value = csapat_b_gol;
    //inputCsapatBGol.readonly = true;

    inputIdopont.type = "time";
    inputIdopont.name = "idopont";
    inputIdopont.value = idopont;
    //inputIdopont.readonly = true;

    inputEredm.type = "number";
    inputEredm.name = "eredmeny";
    

    form.appendChild(inputCsapatA);
    form.appendChild(inputCsapatAGol);
    form.appendChild(inputCsapatB);
    form.appendChild(inputCsapatBGol);
    form.appendChild(idopont);
    form.appendChild(eredmeny);
}

function proba(kurva) {
    console.log(kurva)
}