const form = document.querySelector('.signup-form');
const feedback = document.querySelector('.feedback');
const passwordFeedback = document.querySelector('.passwordFeedback');
const emailFeedback = document.querySelector('.emailFeedback');

const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

form.addEventListener('submit', e => {
    e.preventDefault();
    
    const email = form.email.value.trim(); 
    const password = form.password.value.trim();
    const isDoctorEmail = email.endsWith('@kbolnica.com');

    let emailValid = emailPattern.test(email) && !isDoctorEmail;
    let passwordValid = passwordPattern.test(password) && password.length >= 8;

    if (emailValid && passwordValid) {
        feedback.textContent = "Dobro Došli !!";
        feedback.style.color = "green";
        emailFeedback.textContent = "";
        passwordFeedback.textContent = "";
        form.email.setAttribute('class', 'success');
        form.password.setAttribute('class', 'success');
        window.location.href = "index.html";
    } else {
        feedback.textContent = "";
        
        if (!emailPattern.test(email)) {
            emailFeedback.textContent = "Pogrešna forma emaila !!";
            form.email.setAttribute('class', 'error');
        } else if (isDoctorEmail) {
            emailFeedback.textContent = "Pacijent ne može koristiti doktorskog emaila!";
            form.email.setAttribute('class', 'error');
        } else {
            emailFeedback.textContent = "";
            form.email.setAttribute('class', 'success');
        }

        if (emailValid) {
            if (!passwordValid) {
                passwordFeedback.textContent = "Vaša lozinka mora imati najmanje 8 znakova, slova i mora sadržavati brojeve !!";
                form.password.setAttribute('class', 'error');
            } else {
                passwordFeedback.textContent = "";
                form.password.setAttribute('class', 'success');
            }
        } else {
            passwordFeedback.textContent = "";
        }

        if (!emailValid || !passwordValid) {
            feedback.textContent = "Neuspješna prijava, molimo Vas da resetujete stranicu !!";
            feedback.style.color = "red";
        }
    }
});

form.email.addEventListener('keyup', e => {
    const isDoctorEmail = e.target.value.endsWith('@kbolnica.com');

    if (emailPattern.test(e.target.value) && !isDoctorEmail) {
        form.email.setAttribute('class', 'success');
        emailFeedback.textContent = "";
    } else {
        form.email.setAttribute('class', 'error');
        emailFeedback.textContent = isDoctorEmail ? "Pacijent ne može koristiti doktorskog emaila!" : "Pogrešna forma emaila !!";
    }
});

form.password.addEventListener('keyup', e => {
    if (passwordPattern.test(e.target.value)) {
        form.password.setAttribute('class', 'success');
    } else {
        form.password.setAttribute('class', 'error');
    }
});
