function openDatePicker() {
    const input = document.getElementById("dateInput");
    if (input.showPicker) {
        input.showPicker();
    } else {
        input.focus();
        input.click();
    }
}

function sendEmail() {
    const recipient = "doktor@example.com"; 
    const subject = "Upit za Doktora";
    const body = "Poštovani doktore,\n\n";

    const mailtoURL = `mailto:${recipient}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

    window.location.href = mailtoURL;
}
