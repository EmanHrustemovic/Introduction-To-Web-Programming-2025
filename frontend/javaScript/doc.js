const { query } = require("express");

const searching = document.querySelector('.search-input');

const jmbgPattern = /^\d{13}$/;

const pacijent = query("SELECT DISTINCT FROM pacijenti WHERE p.JMBG = input ;");


searching.addEventListener('click',e=>{
    e.preventDefault();

    const input = searching.value;

    if(jmbgPattern.test(input) && input.length==13){
        newTable = `<tr>
        <td>${pacijent}</td>
        </tr>`;
    }
});