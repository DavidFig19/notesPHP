  //variable para local storage y no recargar los estilos la recargar la pagina




  const formLogin = document.querySelector("#formLogin");

  const correo = document.querySelector('#txtCorreo');
  const pass = document.querySelector('txtPassword');

  const btnLogin = document.getElementById("btn-login");
  const btnRegister = document.getElementById("btn-registro");
  const formRegister = document.getElementById("formRegister");

 


  //para ver que boton seleccionamos y de pendiendo guardar los estilos
  btnLogin.addEventListener('click', () => {
      var seleccion = localStorage.setItem('boton', btnLogin.value);
      cambiarForm();
  });

  //para ver que boton seleccionamos y de pendiendo guardar los estilos
  btnRegister.addEventListener('click', () => {


      var seleccion = localStorage.setItem('boton', btnRegister.value);
      cambiarForm();



  });



  function cambiarForm() {
      if (localStorage.getItem('boton') == "btn-login") {

          //pintamos los datos
          pintarBotonLogin();
      }

      if (localStorage.getItem('boton') == "btn-registro") {

          //pintamos los datos
          pintarBotonRegistro();
      }
  }

  cambiarForm();

  function pintarBotonLogin() {

      formRegister.style = "display:none !important";
      formLogin.style = "display:flex !important";

      btnLogin.classList.remove("btn-select");
      btnLogin.classList.add("btn-select_active");

      btnRegister.classList.remove("btn-select_active");
      btnRegister.classList.add("btn-select");
  }

  function pintarBotonRegistro() {

      formRegister.style = "display:flex !important";
      formLogin.style = "display:none !important";
      btnRegister.classList.remove("btn-select");
      btnRegister.classList.add("btn-select_active");

      btnLogin.classList.remove("btn-select_active");
      btnLogin.classList.add("btn-select");
  }