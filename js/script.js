function inputok() {
    let inputSzam = document.getElementById("szam").value;
    console.log(inputSzam);
    
    for(let i = 0; i < inputSzam; i++) {
        let input = document.createElement("input");

        input.placeholder = 'Név';
        input.name = 'nev' + (i+1);
        input.type = 'text';

        document.getElementById("csapatForm").appendChild(input);
    }

    let inputa = document.createElement("input");
    inputa.name = 'szam';
    inputa.type = 'number';
    inputa.value = inputSzam;
    inputa.style.display = "none";

    document.getElementById("csapatForm").appendChild(inputa);
}