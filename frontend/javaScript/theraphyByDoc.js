/* Dugmad za doktora  */
const uploadButton = document.querySelector("#uploadButton");
const fileInput = document.querySelector("#fileInput");
const errorMessage = document.querySelector("#errorMessage");
const tableBody = document.querySelector("#theraphy-for-doc");

/*POLJA U TABLICI KOJA DR POPUNJAVA */
const theraphy = document.querySelector('#theraphy');
const directions = document.querySelector('#directions');
const duration = document.querySelector('#duration');
const control = document.querySelector('#control');
const doctor = document.querySelector('#doctor');

/* FUNCKIJE I IMPLEMENTACIJA LOGIKE */

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