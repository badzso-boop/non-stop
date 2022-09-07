function inputok() {
    let inputSzam = document.getElementById("szam").value + 1;

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