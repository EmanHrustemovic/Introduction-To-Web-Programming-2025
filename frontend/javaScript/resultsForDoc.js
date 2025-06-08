document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('table tbody');

    function fetchLabs() {
        fetch('http://localhost/webProject/backend/labs') 
            .then(response => {
                if (!response.ok) {
                    throw new Error('Greška prilikom dohvaćanja podataka');
                }
                return response.json();
            })
            .then(data => {
                tbody.innerHTML = '';

                data.forEach(lab => {
                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                        <td>${lab.sifraNalaza ?? ''}</td>
                        <td>${lab.tipNalaza ?? ''}</td>
                        <td>${lab.vrsta_uzorka ?? ''}</td>
                        <td>${lab.datum_obrade ? new Date(lab.datum_obrade).toLocaleString() : ''}</td>
                        <td>${lab.status ?? ''}</td>
                    `;

                    tbody.appendChild(tr);
                });

                addInputRow();
            })
            .catch(error => {
                console.error(error);
                alert('Neuspješan dohvat podataka.');
            });
    }

    function addInputRow() {
        const inputRow = document.createElement('tr');
        inputRow.innerHTML = `
            <td><input id="code" type="text" class="form-control" placeholder="Šifra Nalaza"></td>
            <td><input id="check" type="text" class="form-control" placeholder="Tip nalaza"></td>
            <td><input id="sample" type="text" class="form-control" placeholder="Vrsta uzorka"></td>
            <td><input id="time" type="datetime-local" class="form-control"></td>
            <td><input id="phase" type="text" class="form-control" placeholder="Status"></td>
            <td>
                <button class="btn btn-success" id="uploadButton">Dodajte Vaš Nalaz</button>
                <input type="file" id="fileInput" style="display: none;">
                <span id="fileName" style="margin-left: 10px;"></span>
                <button class="btn btn-warning" id="editFile" style="display: none;">Uredite Nalaz</button>
                <button class="btn btn-danger" id="deleteFile" style="display: none;">Izbrišite Nalaz</button>
                <p id="errorMessage" style="color: red; display: none; margin-top: 5px;"></p>
            </td>
        `;
        tbody.appendChild(inputRow);

        document.getElementById('uploadButton').addEventListener('click', dodajNalaz);
    }


fetchLabs();
});

    function dodajNalaz() {
        const sifraNalaza = document.getElementById('code').value.trim();
        const tipNalaza = document.getElementById('check').value.trim();
        const vrstaUzorka = document.getElementById('sample').value.trim();
        const datumObrade = document.getElementById('time').value;
        const status = document.getElementById('phase').value.trim();

        // Validacija
        if (!sifraNalaza || !tipNalaza || !vrstaUzorka || !datumObrade || !status) {
            alert('Molimo popunite sva polja!');
            return;
        }

        const data = {
            sifraNalaza,
            tipNalaza,
            vrsta_uzorka: vrstaUzorka,
            datum_obrade: new Date(datumObrade).toISOString(),
            status,
            pregledi_id: 1 
        };

       fetch('http://localhost/webProject/backend/labs', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(res => {
        if (!res.ok) throw new Error('Greška kod backend-a');
        return res.json();
    })
    .then(data => {
        console.log('Response:', data);
        alert(data.message || 'Uspješno');
        fetchLabs(); 
    })
    .catch(err => {
        console.error(err);
        alert('Greška: ' + err.message);
    });
}