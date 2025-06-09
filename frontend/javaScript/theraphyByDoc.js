/*
/* Dugmad za doktora  
const uploadButton = document.querySelector("#uploadButton");
const fileInput = document.querySelector("#fileInput");
const errorMessage = document.querySelector("#errorMessage");
const tableBody = document.querySelector("#theraphy-for-doc");

/*POLJA U TABLICI KOJA DR POPUNJAVA 
const theraphy = document.querySelector('#theraphy');
const directions = document.querySelector('#directions');
const duration = document.querySelector('#duration');
const control = document.querySelector('#control');
const doctor = document.querySelector('#doctor');

/* FUNCKIJE I IMPLEMENTACIJA LOGIKE 

uploadButton.addEventListener('click', e=>{
    e.preventDefault();

    if(validateFields()){
        fileInput.click();
    }else{
        alert("Molimo Vas dokotre da popunite sva polja !");
    }
});

fileInput.addEventListener('change' , e=>{
    e.preventDefault();
    
    if(fileInput.files.length>0){
        addingRows();
        deleteRow();
    }
});


function addingRows(){
    const useTheraphy = theraphy.value;
    const useDirections = directions.value;
    const useDurations = duration.value;
    const settingControl = control.value;
    const yourDoctor = doctor.value;

    const file = fileInput.files[0].name;
    
    const row = document.createElement('tr');

    row.innerHTML= `
        <td>${useTheraphy}</td>
        <td>${useDirections}</td>
        <td>${useDurations}</td>
        <td>${settingControl}</td>
        <td>${yourDoctor}</td>
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
*/


const uploadButton = document.querySelector("#uploadButton");
const fileInput = document.querySelector("#fileInput");
const errorMessage = document.querySelector("#errorMessage");
const tableBody = document.querySelector("#theraphy-for-doc");

const theraphy = document.querySelector('#theraphy');
const directions = document.querySelector('#directions');
const duration = document.querySelector('#duration');
const control = document.querySelector('#control');
const doctor = document.querySelector('#doctor');

function loadTherapiesFromDB() {
    fetch('http://localhost/webProject/backend/therapy/getAll')
        .then(response => {
            if (!response.ok) throw new Error('Greška u mrežnom odgovoru');
            return response.json();
        })
        .then(data => {
            tableBody.innerHTML = ''; 
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.vrsta_terapije || ''}</td>
                    <td>${item.doza_i_upute || ''}</td>
                    <td>${item.trajanje_terapije || ''}</td>
                    <td>${item.pracenje_i_kontrola || ''}</td>
                    <td>${item.doktor_specijalista || ''}</td>
                    <td>
                      <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Izbriši nalaz</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Greška prilikom učitavanja terapija:', err);
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Ne mogu se učitati terapije iz baze.';
        });
}

uploadButton.addEventListener('click', e=>{
    e.preventDefault();

    if(validateFields()){
        fileInput.click();
    }else{
        alert("Molimo Vas dokotre da popunite sva polja !");
    }
});

fileInput.addEventListener('change', e=>{
    e.preventDefault();

    if(fileInput.files.length > 0){
        addingRows();
    }
});

function addingRows(){
    const useTheraphy = theraphy.value;
    const useDirections = directions.value;
    const useDurations = duration.value;
    const settingControl = control.value;
    const yourDoctor = doctor.value;

    const file = fileInput.files[0].name;

    const row = document.createElement('tr');
    row.innerHTML= `
        <td>${useTheraphy}</td>
        <td>${useDirections}</td>
        <td>${useDurations}</td>
        <td>${settingControl}</td>
        <td>${yourDoctor}</td>
        <td>${file}</td>
        <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Izbriši nalaz</button></td>
    `;
    tableBody.appendChild(row);

};

function deleteRow(button){
    button.closest('tr').remove();
};

function validateFields(){
    return [...document.querySelectorAll("input:not([type='file'])")]
        .every(input => input.value.trim() !== "");
};

function deleteFields(){
    document.querySelectorAll("input:not([type='file'])").forEach(input=>input.value = "");
}

window.addEventListener('DOMContentLoaded', () => {
    loadTherapiesFromDB();
});
