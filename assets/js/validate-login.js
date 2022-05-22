const formularioLogin = document.getElementById('formLogin');

const inputsLogin = document.querySelectorAll("#formLogin input");
const correoVlidate = document.getElementById('correoValidate');
const passValidate = document.getElementById("passValidate");


const validaciones={
    emailRegex :/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i,
    password : /^.{4,12}$/
}




const formValidado=()=>{

    inputsLogin.forEach(input => {
        input.addEventListener('input', (event) => {
            
            if (event.target.name == "txtCorreo") {
              
                if(validaciones.emailRegex.test(event.target.value)){
                    correoVlidate.innerText = "";
                }else{

                    correoVlidate.innerText = "correo invalido";
                    
                }
               
            }
            if (event.target.name == "txtPassword") {
            
                if(validaciones.password.test(event.target.value)){
                    passValidate.innerText = "";

                }else{
                    passValidate.innerText = "Minimo 4 caracteres";
                }
                
            }
            
    
        })
    })
    
}
formValidado();

formularioLogin.addEventListener('submit', (e) => {


    e.preventDefault();
    inputsLogin.forEach(input => {

        if (input.value == "") {
            alertify.error('Algun campo esta vacio'); 
            
        }

       
    })
  
})
