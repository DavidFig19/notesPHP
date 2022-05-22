<?php include("header.php") ?>
<?php include("conecion.php") ?>
<?php

$txtCorreo = "";
$txtPass = "";
if (isset($_POST["login"])) {
    $txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo'] : "";
    $txtPass = (isset($_POST['txtPassword'])) ? $_POST['txtPassword'] : "";
   
    $objCOnexion = new conexion();

    $miConsulta = $objCOnexion->consultar("SELECT * FROM usuario WHERE (correo='$txtCorreo')  AND (contrasenia='$txtPass') ");

 
  //validamos si la consulta trae algo
    if (isset($miConsulta[0])) {
        session_start();
        $_SESSION['correo'] = $txtCorreo;
        header("location:notes.php");
    } else {
        echo " <script>
            alertify.error('Usuario no existe'); 
           </script>";
    }
}

$txtNuevoNombre = "";
$txtNuevoCorreo = "";
$txtNuevoPass = "";
if (isset($_POST["register"])) {
   


    $txtNuevoNombre = (isset($_POST["txtNuevoNombre"])) ? $_POST["txtNuevoNombre"] : "";
    $txtNuevoCorreo = (isset($_POST["txtNuevoEmail"])) ? $_POST["txtNuevoEmail"] : "";
    $txtNuevoPass = (isset($_POST["txtNuevaPass"])) ? $_POST["txtNuevaPass"] : "";

    //instanciamos la clase de la conexion
    $objConex = new conexion();

    $validaCorreo = $objConex->consultar("SELECT * FROM usuario WHERE correo='$txtNuevoCorreo';");

    //si trae datos siempre sera una unico arreglo
    //entonces selecionamos el indice del arreglo y despues del dato
    if (isset($validaCorreo[0]["correo"])) {
        echo " <script>
            alertify.error('Este Correo ya esta registrado'); 
           </script>";
    } else {

        $datos = "INSERT INTO usuario (nombre, correo, contrasenia) VALUES ('$txtNuevoNombre', '$txtNuevoCorreo', '$txtNuevoPass')";
        $objConex->ejecutar($datos);
        echo " <script>
        alertify.success('Cuenta creada con exito!'); 
       </script>";
    }
}
?>
<section class="container-login">
    <div class="container-cards">
        <div class="formularios">
        <div class="container-buttons">
            <button value="btn-login" class="btn round-left btn-select" id="btn-login"><i class="fa-solid fa-user"></i> login</button>
            <button value="btn-registro" class="btn round-right btn-select_active" id="btn-registro"><i class="fa-solid fa-pencil"></i> register</button>
        </div>
       
        <form action="index.php" method="post" class="form-login" id="formLogin">
            <h3>Login</h3>
            <label for="txtCorreo">Correo:</label>
            <input 
            data-prompt-position="bottomLeft"
            autofocus
            data-errormessage-value-missing="El correo es requerido!" 
             value="<?php echo $txtCorreo ?>" 
             type="mail"
              name="txtCorreo" 
              id="txtCorreo" 
              class="block validate[required,custom[email]]"
               placeholder="user@email.com">
           
            <br>
            <label for="txtPassword"> Contraseña:</label>
           <input
           data-prompt-position="bottomLeft"
             value="<?php echo $txtPass ?>" 
             type="password"
              name="txtPassword" 
              id="txtPassword"
               class="block validate[required]" 
               placeholder="*****">
           

            <br>
            <button name="login" type="submit" class="btn boton-login block">Iniciar sesión</button>
        </form>
        <!-- formulario de registro -->
        <form action="index.php" method="POST" class="form-register" id="formRegister">
            <h3>Registro</h3>
            <label for="txtNuevoNombre">
            Nombre de usuario: 
            </label>
            <input
            value="<?php  echo $txtNuevoNombre?>"
            data-prompt-position="bottomLeft"
             class="block validate[required,minSize[4]]"
              placeholder="Nuevo usuario" 
              type="text"
               name="txtNuevoNombre"
                id="txtNuevoNombre">
            <br>
            <label for="txtNuevoNombre">
            Correo electronico:
            </label>
            <input
            value="<?php  echo $txtNuevoCorreo?>"
            data-prompt-position="bottomLeft"
             class="block validate[required,custom[email]]"
              placeholder="user@email.com"
               type="email" 
               name="txtNuevoEmail"
                id="txtNuevoEmail">
            <br>
            <label for="txtNuevaPass">Contraseña: </label>
            <input
            value="<?php  echo $txtNuevoPass?>"
            data-prompt-position="bottomLeft"
             class="block validate[required,minSize[4]]"
              placeholder="****" 
              type="password" 
              name="txtNuevaPass" 
              id="txtNuevaPass">
            <br>
            <button name="register" type="submit" class="btn btn-primary block">Registrar</button>
        </form>
        </div>
        <div class="fondo-login">

        </div>
    </div>
</section>


<?php include("footer.php") ?>