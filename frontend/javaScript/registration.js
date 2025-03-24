const form = document.querySelector('form');
const namePattern = /^[A-Z][a-zA-Z]{2,}$/;
const lastNamePattern =/^[A-Z][a-zA-Z]{2,}$/; 
const phonePattern = /^[0-9]{3,}$/;
const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

/* FIDBECI */
const feedback = document.querySelector('.feedback');
const nameFeedback = document.querySelector('.nameFeedback');
const lastNameFeedback = document.querySelector('.lastNameFeedback');
const phoneFeedback = document.querySelector('.phoneFeedback');
const emailFeedback =document.querySelector('.emailFeedback');
const passwordFeedback =document.querySelector('.passwordFeedback');



form.addEventListener('submit', e=>{
    e.preventDefault();

    const name = form.name.value;
    const lastName = form.lastName.value;
    const phone = form.phone.value;
    const city = form.city.value;/*Ovo kasnije uzimati iz baze podataka ali sad ne znam kako*/
    const hospital = form.hospital.value;/*Ovo kasnije uzimati iz baze podataka ali sad ne znam kako*/
    const email = form.email.value;
    const password=form.password.value;

    /* first NAME CHECKING */

    if(namePattern.test(name) && lastNamePattern.test(lastName) && phonePattern.test(phone) && emailPattern.test(email) && passwordPattern.test(password)){
        feedback.textContent ="Korisnik se uspiješno registrovao na platformu."; 
    }
    else if(true){
        if(namePattern.test(name)){
            nameFeedback.textContent =" ";
        }else{
            nameFeedback.textContent="Neispravan format imena !";
        }
        /* LAST NAME CHECKING */
    
        if(lastNamePattern.test(lastName)){
            lastNameFeedback.textContent=" ";
        }else{
            lastNameFeedback.textContent="Neispravan format prezimena !";
        }
        /* PHONE CHECKING */
    
        if (phonePattern.test(phone)){
            phoneFeedback.textContent=" ";
        }else{
            phoneFeedback.textContent ="Neispravan format broja !";
        }
    
        /* Email CHECKING */
    
        if(emailPattern.test(email)){
            emailFeedback.textContent=" ";
        }else{
            emailFeedback.textContent="Pogrešna forma emaila !!";
        }
        
        /* Password CHECKING */
    
        if(passwordPattern.test(password) && password.length >= 8){
            passwordFeedback.textContent=" ";
        }        
        else{
            passwordFeedback.textContent="Vaša lozinka mora imati najmanje 8 znakova , slova i mora sadržavati slova od 'A' do 'Z' !!";
        }
    }else{
        feedback.textContent="Neuspiješna prijava !! Pokušajte ponovo .";
    }
});



form.name.addEventListener('keyup',e =>{
    console.log(e);
    if (namePattern.test(e.target.value)){
        form.name.setAttribute('class','success');
    }else{
        form.name.setAttribute('class','error');
    }
});

form.lastName.addEventListener('keyup',e =>{
    console.log(e);
    if (lastNamePattern.test(e.target.value)){
        form.lastName.setAttribute('class','success');
    }else{
        form.lastName.setAttribute('class','error');
    }
});

form.phone.addEventListener('keyup',e =>{
    console.log(e);
    if (phonePattern.test(e.target.value)){
        form.phone.setAttribute('class','success');
    }else{
        form.phone.setAttribute('class','error');
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
