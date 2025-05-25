function openDatePicker() {
    document.getElementById("dateInput").showPicker();
}

function sendEmail() {
    const recipient = "doktor@example.com"; 
    const subject = "Upit za Doktora";
    const body = "Poštovani doktore,%0D%0A%0D%0A"; 

    const mailtoURL = `https://mail.google.com/mail/?view=cm&fs=1&to=${recipient}&su=${encodeURIComponent(subject)}&body=${body}`;

    window.open(mailtoURL, '_blank');
}