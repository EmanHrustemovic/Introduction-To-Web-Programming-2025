/* SLIKA :LOGIKA ZA SLIKU */

function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function () {
        const preview = document.getElementById("preview");
        preview.src = reader.result;
        preview.style.display = "block";
        document.querySelector(".plus-icon").style.display = "none"; 
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

/* --------------------- */


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
  
function deleteRow(button) {
    var row = button.closest('tr');
    row.remove();
}
  
function triggerFileUpload(button) {
    var fileInput = button.closest('tr').querySelector('#file-upload');
    fileInput.click(); 
  }
  