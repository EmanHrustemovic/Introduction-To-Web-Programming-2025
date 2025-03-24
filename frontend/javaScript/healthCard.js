/* Dugmad za doktora  */
const uploadButton = document.querySelector("#uploadButton");
const fileInput = document.querySelector("#file-input");
const errorMessage = document.querySelector("#errorMessage");
const tableBody = document.querySelector("#checkUps-for-doc");

/*POLJA U TABLICI KOJA DR POPUNJAVA */
const checks = document.querySelector('#checks');
const meeting = document.querySelector('#meeting');
const phase = document.querySelector('#phase');
const hospital = document.querySelector('#hospital');
const doctor = document.querySelector('#doctor');
const description = document.querySelector('#description');
const result = document.querySelector('#result');
const recommendation = document.querySelector('#recommendation');

/* FUNCKIJE I IMPLEMENTACIJA LOGIKE */

document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'uploadButton') {
        event.preventDefault();

        if (validateFields()) {
            fileInput.click();
        } else {
            alert("Molimo Vas doktore da popunite sva polja!");
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.querySelector("#fileInput");
    document.addEventListener("click", function (event) {
        if (event.target && event.target.id === "uploadButton") {
            event.preventDefault();

            if (validateFields()) {
                fileInput.click();
            } else {
                alert("Molimo Vas doktore da popunite sva polja!");
            }
        }
    });
});




function addingRows(){
    const useChecks = checks.value;
    const useMeet = meeting.value;
    const usePhase = phase.value;
    const useHospital = hospital.value;
    const yourDoctor = doctor.value;
    const useDescription = description.value;
    const useResult = result.value;
    const useRecommendation= recommendation.value;

    const file = fileInput.files[0].name;
    
    const row = document.createElement('tr');

    row.innerHTML= `
        <td>${useChecks}</td>
        <td>${useMeet}</td>
        <td>${usePhase}</td>
        <td>${useHospital}</td>
        <td>${yourDoctor}</td>
        <td>${useDescription}</td>
        <td>${useResult}</td>
        <td>${useRecommendation}</td>
        <td>${file}</td>
        <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Izbriši nalaz</button></td>
    `;
    tableBody.appendChild(row);

};

function deleteRow(button){
    button.closest('tr').remove();

};

function validateFields(){
    console.log(document.querySelectorAll("input:not([type='file'])")); 
    return [...document.querySelectorAll("input:not([type='file'])")].every(input => input.value.trim() !== "");

};

function deleteFields(){
    return document.querySelectorAll("input:not([type='file'])").forEach(input=>input.value = " ");
};




function addRow(button) {
    var nazivBolesti = button.closest('tr').querySelector('input[placeholder="Naziv bolesti"]').value;
    var dijagnoza = button.closest('tr').querySelector('input[placeholder="Dijagnoza"]').value;
    var terapija = button.closest('tr').querySelector('input[placeholder="Terapija"]').value;
    var zadnjiPregled = button.closest('tr').querySelector('input[type="date"]').value;
    var nalaz = button.closest('tr').querySelector('input[placeholder="Nalaz"]').value;
    
    if (nazivBolesti && dijagnoza && terapija && zadnjiPregled && nalaz) {
      var table = button.closest('table').getElementsByTagName('tbody')[0];
      var newRow = table.insertRow();
  
      newRow.innerHTML = `
        <td>${nazivBolesti}</td>
        <td>${dijagnoza}</td>
        <td>${terapija}</td>
        <td>${zadnjiPregled}</td>
        <td>${nalaz}</td>
        <td><button class="btn btn-danger" onclick="deleteRow(this)">Obriši</button></td>
      `;
  
      button.closest('tr').querySelector('input[placeholder="Naziv bolesti"]').value = '';
      button.closest('tr').querySelector('input[placeholder="Dijagnoza"]').value = '';
      button.closest('tr').querySelector('input[placeholder="Terapija"]').value = '';
      button.closest('tr').querySelector('input[type="date"]').value = '';
      button.closest('tr').querySelector('input[placeholder="Nalaz"]').value = '';
    } else {
      alert('Molimo popunite sva polja!');
    }
  }
  