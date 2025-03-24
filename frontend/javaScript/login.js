const form=document.querySelector('.signup-form');
const feedback = document.querySelector('.feedback');
const passwordFeedback = document.querySelector('.passwordFeedback');
const emailFeedback = document.querySelector('.emailFeedback');
const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

form.addEventListener('submit', e=>{

    e.preventDefault();
    
    const email = form.email.value;//dohvacamo konkretnu vrijednost email-a
    const password = form.password.value;

    if (emailPattern.test(email) && passwordPattern.test(password) && password.length>=8){
        feedback.textContent="Dobro Došli !!";
        emailFeedback.textContent="";
        passwordFeedback.textContent="";
        window.location.href = "index.html"
    }
    else if(true){
        if(emailPattern.test(email)){
            emailFeedback.textContent=" ";
        } 
        else{
            emailFeedback.textContent="Pogrešna forma emaila !!";
        }

        if(passwordPattern.test(password) && password.length >= 8){
            passwordFeedback.textContent=" ";
        }        
        else{
            passwordFeedback.textContent="Vaša lozinka mora imati najmanje 8 znakova , slova i mora sadržavati slova od 'A' do 'Z' !!";
        }
    }else{
        if (!emailPattern.test(email) || !passwordPattern.test(password) || password.length < 8) {
            feedback.textContent = "Neuspješna prijava, molimo Vas da resetujete stranicu !!";
        } 
    }
});

form.email.addEventListener('keyup', e=>{
    console.log(e);
    //console.log(e.target.value,form.username.value);
    if(emailPattern.test(e.target.value)){
        form.email.setAttribute('class','success');
    }else{
        form.email.setAttribute('class','error');
    }
});

form.password.addEventListener('keyup', e=>{
    console.log(e);
    if(passwordPattern.test(e.target.value)){
        form.password.setAttribute('class','success');
    }else{
        form.password.setAttribute('class','error');
    }
});