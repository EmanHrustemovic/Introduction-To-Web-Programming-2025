const searchInput = document.querySelector('.search-input');
const searchIcon = document.querySelector('.search-icon');
const patientInfoDiv = document.getElementById('patient-info');

const jmbgPattern = /^\d{13}$/;

searchIcon.addEventListener('click', async (e) => {
    e.preventDefault();

    const input = searchInput.value.trim();

    if (!jmbgPattern.test(input)) {
        alert("Unesite ispravan JMBG (13 cifara)");
        return;
    }

    try {
        const response = await fetch(`http://localhost/webProject/backend/patient/by-jmbg/${input}`, {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("jwt")
            }
        });

        if (!response.ok) {
            throw new Error("Pacijent nije pronađen.");
        }

        const data = await response.json();

        console.log("Pacijent pronađen:", data);

        patientInfoDiv.innerHTML = `
            <h4>Pacijent: ${data.ime} ${data.prezime}</h4>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="#" onclick="loadPatientPage('healthCard', ${data.pacijent_id}); return false;">Karton Pacijenta</a>
                <a href="#" onclick="loadPatientPage('laboratory', ${data.pacijent_id}); return false;">Nalazi Pacijenta</a>
                <a href="#" onclick="loadPatientPage('therapy', ${data.pacijent_id}); return false;">Terapija</a>
                <a href="#" onclick="loadPatientPage('medicalCheck', ${data.pacijent_id}); return false;">Pregledi</a>
            </div>
        `;

    } catch (err) {
        alert(err.message);
        patientInfoDiv.innerHTML = ''; 
    }
});
