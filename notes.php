<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("location:index.php");
}

?>
<?php include("header.php") ?>
<?php include("conecion.php") ?>

<?php
$usuarioLogueado = $_SESSION['correo'];

//hacemos una consulta con el usuario logueado
$objConect = new conexion();
$consulta = $objConect->consultar("SELECT * FROM usuario WHERE correo = '$usuarioLogueado'");

//guardamos su id
$usuarioID = $consulta[0]["id"];
$txtTitle = "";
$txtDescrip = "";

//una variable para aparrecer el boton
$btnActive = true;
//vamos a hacer un post
if (isset($_POST['agregar'])) {


    $txtTitle = (isset($_POST["txtTitle"])) ? $_POST["txtTitle"] : "";
    $txtDescrip = (isset($_POST["txtDescription"])) ? $_POST["txtDescription"] : "";
    $data = "INSERT INTO tarea (titulo, descripcion, usuario_id) VALUES ('$txtTitle', '$txtDescrip', ' $usuarioID')";
    $objConect->ejecutar($data);
    echo " <script>
    alertify.success('Tarea guardada!'); 
   </script>";
    $txtTitle = "";
    $txtDescrip = "";
}

//vamos a hacer una consulta a la bd
//para mostrar los datos de la persona
//que inicie sesion

$consultaTarea = $objConect->consultar("SELECT * FROM tarea WHERE usuario_id = '$usuarioID'");

//ahora vamos a mostrar los datos dependiendo 
//de la nota seleccionada

//si hay un get mostrar, hacemos la seleccion y
//mandamos los datos a los input
$notaID = ""; //variable para la nota
if (isset($_GET['mostrar'])) {
    //variable para la nota
    //viene de la url
    $notaID = $_GET['mostrar'];
    //desactivamos el boton de guardar
    $btnActive = false;
    //hacemos una seleccion de los datos dependiendo 
    //de el id que tenga la url
    $dataList = $objConect->consultar("SELECT * FROM tarea WHERE id = '$notaID'");


    $txtTitle = (isset($dataList[0]['titulo'])) ? $dataList[0]['titulo'] : "";

    $txtDescrip = (isset($dataList[0]['descripcion'])) ? $dataList[0]['descripcion'] : "";

    //actualizar

  
}
if (isset($_POST['actualizar'])) {

    //esta variable es la id de la nota
    //se imprime como valor de un input escondido
    $txtID = $_POST['txtID'];
    $txtTitle = (isset($_POST["txtTitle"])) ? $_POST["txtTitle"] : "";
    $txtDescrip = (isset($_POST["txtDescription"])) ? $_POST["txtDescription"] : "";
    echo $txtID . "<br>" . $txtTitle . "<br>" . $txtDescrip;
    $query = "UPDATE tarea SET titulo='$txtTitle', descripcion='$txtDescrip' WHERE id='$txtID'";

    $imprimir = $objConect->ejecutar($query);
    print_r($imprimir);
    header('location: notes.php');
}

//eliminar
if (isset($_GET['eliminar'])) {
    $notaDeleteID = $_GET['eliminar'];
    $objConect->ejecutar("DELETE FROM tarea where id='$notaDeleteID'");
    header('location:notes.php');
}








?>
<div class="notes-container">

    <form action="notes.php" method="post" class="form-tareas" id="formTarea">
        <h3>Registro tareas</h3>
        
        <input style="display: none;" type="text" name="txtID" id="" value="<?php echo $notaID; ?>">
        <br>
        <label for="">Titulo tarea:</label>
        <input
        data-prompt-position="bottomLeft"
         autofocus
          value="<?php echo $txtTitle ?>"
           type="text"
            name="txtTitle"
             id="txtTitle"
              class="block validate[required,minSize[4]]">
        <br>
        <label for=""> Descripcion Tarea:</label>
        <textarea  data-prompt-position="bottomLeft" name="txtDescription" id="txtDescription" rows="10" class="block-area validate[required,minSize[4]]">
        <?php echo $txtDescrip ?>
        </textarea>
        <br>

        <!-- mostrar un boton dependiendo de la situacion -->
        <?php if ($btnActive) { ?>
            <button name="agregar" class="btn btn-primary block" type="submit">Guardar <i class="fa-solid fa-floppy-disk"></i></button>

        <?php } else { ?>
            <button name="actualizar" class="btn btn-primary block" type="submit">Actualizar</button>
        <?php } ?>

    </form>
    <div class="container-tarea">
        <?php if (!isset($consultaTarea)) { ?>

            <h1>Aun no hay tareas</h1>

        <?php } else { ?>
            <?php foreach ($consultaTarea as $item) { ?>


                <div class="notas">
                    <img src="./assets/img/chincheta.png" alt="chincheta">
                    <span>
                        <?php echo $item['titulo'] ?>
                    </span>
                    <br>
                    <small>
                        <?php echo $item['descripcion'] ?>
                    </small>
                    <a href="notes.php?mostrar=<?php echo $item['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="notes.php?eliminar=<?php echo $item['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                </a>

            <?php } ?>


        <?php } ?>




    </div>
</div>

<?php include("footer.php") ?>