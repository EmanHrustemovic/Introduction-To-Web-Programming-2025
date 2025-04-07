const form = document.querySelector('.code-form');
const phonePattern = /^[0-9]{3,}$/;
const idPattern = /^[0-9]{13}$/

const feedback = document.querySelector('.feedback');
const idFeedback = document.querySelector('.idFeedback');
const phoneFeedback = document.querySelector('.phoneFeedback');


form.addEventListener('submit',e=>{
    e.preventDefault();

    const id = form.id.value;
    const phone =form.phone.value;

    if(idPattern.test(id) && id.length==13 && phonePattern.test(phone)){
        feedback.textContent="Dobro Došli !!";
        idFeedback.textContent="";
        phoneFeedback.textContent="";

        setTimeout(() => {
            window.location.href = "login.html"; 
        }, 1500); 
    } else {
        if(!idPattern.test(id) || id.length !== 13){
            idFeedback.textContent="JMBG se sastoji od 13 brojeva !";
        } else {
            idFeedback.textContent="";
        }
        if(!phonePattern.test(phone)){
            phoneFeedback.textContent="Neispravan format broja.";
        } else {
            phoneFeedback.textContent="";
        }
        feedback.textContent="Žao nam je, oporavak Vaše šifre nije uspio.";
    }

});


form.id.addEventListener('keyup',e=>{
    console.log(e);
    if(idPattern.test(e.target.value)){
        form.id.setAttribute('class','success');
    }else{
        form.id.setAttribute('class','error');
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