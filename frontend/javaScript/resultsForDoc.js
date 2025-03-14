/* ELEMENTI DOHVAĆENI*/
const uploadButton = document.querySelector('#uploadButton');
const fileInput = document.querySelector('#fileInput');
const fileName = document.querySelector('#fileName');
const editFile= document.querySelector('#editFile');
const deleteFile = document.querySelector('#deleteFile');
const errorMessage = document.querySelector('#errorMessage');
const tableBody = document.querySelector("table tbody");


/*POLJA ZA POPUNJAVANJE*/
const code = document.querySelector('#code');
const check = document.querySelector('#check');
const sample = document.querySelector('#sample');
const time = document.querySelector('#time');
const phase = document.querySelector('#phase');

/* FUNCKIJE I IMPLEMENTACIJA LOGIKE */

uploadButton.addEventListener('click', e=>{
    e.preventDefault();
    console.log("ValidateFilds" , validateFields());

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
    const useCode = code.value;
    const useCheck = check.value;
    const useSample = sample.value;
    const settingTime = time.value;
    const inPhase = phase.value;

    const file = fileInput.files[0].name;
    
    const row = document.createElement('tr');

    row.innerHTML= `
        <td>${useCode}</td>
        <td>${useCheck}</td>
        <td>${useSample}</td>
        <td>${settingTime}</td>
        <td>${inPhase}</td>
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