<?php
session_start();
require_once 'conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);
    
    $sql = "SELECT id, password  FROM users WHERE username='$usuario'";
    $resultado = ejecutarConsulta($sql);
    
    if($resultado->num_rows == 1){
       
        $fila = $resultado->fetch_assoc();
        $hash_contraseña = $fila['password'];
        $idUser = $fila['id'];
        if(password_verify($contraseña, $hash_contraseña)){
           
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id'] = $idUser;
            header("Location: index.php");
            
            exit;
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            $errorMessage = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado, mostrar mensaje de error
        $errorMessage = "Usuario o contraseña incorrectos.";
    }
}
?>
<div>
    <form action="formInicioSesion.php" method="post">
        <h3>Inicia Sesión </h3>
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario"/> 
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña"/>
        <button type="submit" class="btn btn-success"> Inicio Sesion </button>
        <a href="#" onclick="loadFormRegistro()" class="btn btn-secondary">Registro</a>
         <?php if(isset($errorMessage)) {
            echo "<p>$errorMessage</p>";
         
         } 
         ?>
    </form>
</div>
<?php

?>