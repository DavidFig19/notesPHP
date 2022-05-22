<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes PHP</title>
    <!-- mis estilos -->
    <link rel="stylesheet" href="./assets/main.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9463b73c5a.js" crossorigin="anonymous"></script>


    <!-- alertify -->
    <!-- JavaScript -->

    <script src="./assets/js/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/alertify.min.css">
    <link rel="stylesheet" href="./assets/css/themes/bootstrap.min.css">
    <!-- 
    RTL version
-->
    <link rel="stylesheet" href="./assets/css/themes/semantic.css">

    <!-- estilos para validaciones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" integrity="sha512-fvBUZJJBrJrzrFYM/EN2isPokoNnx331y30ZXIxRRlop1aq6rT6d8oY6WJVsiXZoso0dIZ2nbQjtGLi6Kkxr/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php if (isset($_SESSION['correo'])) { ?>
        <header class="header">

            <a class="marca" href="notes.php">Notes PHP</a>

            <div>
                <strong><?php echo $_SESSION['correo']; ?></strong>

                <a href="close.php" class="btn btn-log"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </header>
    <?php } ?>