<?php
session_start();
require_once( 'clases/db_abstract_model.php' );
require_once( 'clases/Usuario.php' );
require_once( 'clases/Noticias.php' );
require_once( 'lib/fechas.php' );
require_once( 'clases/Fichero.php' );
require_once( 'clases/Temarios.php' );
require_once( 'clases/Hilos.php' );
require_once( 'clases/Respuestas.php' );
$msg = '';
if ( isset( $_POST['entrar'] ) ) {
    $usr = new Usuario();
    $usr->buscarUsuarioPass( $_POST['email'], $_POST['password'] );
    $res = $usr->get_rows();

    if ( $res == NULL ) {
        $msg = 'LOGIN INCORRECTO';
    } else {
        $_SESSION['id'] = $res[0]['id'];
        $_SESSION['email'] = $res[0]['email'];
        $_SESSION['password'] = $res[0]['password'];
        $_SESSION['apellidos'] = $res[0]['apellidos'];
        $_SESSION['nombre'] = $res[0]['nombre'];
        $_SESSION['tipo'] = $res[0]['tipo'];
        $_SESSION['avatar'] = $res[0]['avatar'];
        

    }

}

if ( isset( $_SESSION['id'] ) ) {
    $id_usuario = $_SESSION['id'];

}

if ( isset( $_GET['a'] ) ) {
    $accion = $_GET['a'];
    if ( $accion == 'logout' ) {
        unset( $_SESSION['email'] );
        unset( $_SESSION['nombre'] );
        unset( $_SESSION['apellidos'] );
         unset( $_SESSION['password'] );
        unset( $_SESSION['id'] );
        unset( $_SESSION['tipo'] );
        unset( $_SESSION['avatar'] );
        unset( $id_usuario );

    }
}

?>

<!DOCTYPE html>
<html lang = 'en'>

<head>
<meta charset = 'UTF-8'>
<title>Portal Docente</title>
<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src = 'js/portal-docente.js'></script>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1'>
<link href = 'css/fontawesome-free-5.0.1/css/fontawesome-all.css' rel = 'stylesheet' type = 'text/css'>
<link href = 'https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css?family=Lobster&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@500&display=swap' rel = 'stylesheet'>
<link rel = 'stylesheet' href = 'css/style.css'>
</head>
<body>

<div class = 'super_container'>

<!-- Header -->
<header class = 'header'>
<p class = 'mensaje'><?php echo $msg?>
<div class = 'iniSesion'>

<?php if ( !isset( $id_usuario ) ) {
    
    ?>

    <button class = 'botonHeader' type = 'submit' onclick = "location='index.php?p=login'">Iniciar sesión</button>
    <?php } else {
        ?>
        <div class="sessionIniciada">
            <?php
            if($_SESSION['avatar']!=""){
            ?>
            <img class="imagenIniSesion" src="<?=$_SESSION['avatar']?>" width="30">
            <?php
            }
            ?>
            <a href="index.php?p=alta&&e=editar">Hola <?php echo ucfirst(strtolower($_SESSION['nombre']));?></a>
            <button class = 'botonHeader' type = 'submit' onclick = "location='index.php?a=logout'">Cerrar sesión</button>
            
        </div>

        <?php 
        }
       
        ?>
        
        </div>
        <nav>

        <!-- Logo -->
        <div class = 'logo'>
        <img src = 'images/logo.png' alt = ''>
        </div>
        <!-- Main Navigation -->
        <div class = 'menu'>
        <input type = 'checkbox' id = 'btn-menu'>
        <label for = 'btn-menu' class = 'fas fa-bars'></label> <!--icono para menu-->
        <ul class = 'menuLista'>        
        <li><a href = 'index.php?p=inicio'>INICIO</a></li>
        <hr>
        <?php
        if(isset($id_usuario)){
        ?>
        <li><a href = 'index.php?p=temarios'>TEMARIOS</a></li>
        <hr>
        <li><a href = 'index.php?p=noticias'>NOTICIAS</a></li>
        <hr>
        <li><a href = 'index.php?p=foro'>FORO</a></li>
        <hr>
        <?php
        }
        
        if(!isset($id_usuario)){
        ?>
        <li><a href = 'index.php?p=alta'>REGISTRARSE</a></li>
        <?php
        }
        ?>
        </ul>
        </div>

        </nav>
        </header>

        </div> <!--final div super_container-->

        </body>
        </html>

