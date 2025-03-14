const table = document.querySelector('.table');
const status =document.querySelector('.lab');

table.addEventListener('click' , e=>{
    e.preventDefault();

    const status = table.status.value;

    table.status.addEventListener('status' , e=>{
        console.log(e);
        if(status.value=='Završeno'){
            status.setAttribute('class','success');
        }
        else if(true){
            status.setAttribute('class', 'error');
        }
        else{
            status.setAttribute('class','wait');
        }
    });
}); 