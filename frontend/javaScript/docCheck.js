document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("uploadButton").addEventListener("click", function () {
        const nazivPregleda = document.getElementById("checks").value;
        const datumVrijeme = document.getElementById("meeting").value;
        const status = document.getElementById("phase").value;
        const opis = document.getElementById("description").value;
        const rezultati = document.getElementById("result").value; 
        const odjeljenjeId = parseInt(document.getElementById("hospital").value); 
        const doktorId = parseInt(document.getElementById("doctor").value); 
        const preporuka = document.getElementById("recommendation").value;

        const data = {
            nazivPregleda: nazivPregleda,
            datum_vrijeme: datumVrijeme,
            status: status,
            opis: opis,
            rezultati: rezultati,
            odjeljenje_id: odjeljenjeId,
            doktor_id: doktorId,
            preporuka: preporuka
        };

        fetch("http://localhost/webProject/backend/checks/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Auth": "Bearer " + localStorage.getItem("token") 
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Neuspješan zahtjev");
            }
            return response.json();
        })
        .then(result => {
            alert(result.message || "Pregled uspješno dodat!");
        })
        .catch(error => {
            console.error("Greška:", error);
            alert("Greška pri dodavanju pregleda.");
        });
    });
});