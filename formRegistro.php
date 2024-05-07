<div class="formReg">
    <form action="#" method="post">
        <h3>Registro Usuario Nuevo </h3>
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario"/> 
        <label for="email">Email</label>
        <input type="text" id="email" name="email"/> 
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña"/>
        <button type="submit" class="btn btn-success"> Registro Usuario </button>
        
    </form>
</div>
<?php
require_once 'conexion.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = trim($_POST["usuario"]);
    $email = trim($_POST["email"]);
    $contraseña = trim($_POST["contraseña"]);
    
    $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES ('$usuario', '$email' , '$hash_contraseña')";
     
    $resultado = ejecutarConsulta($sql);
     
    if($resultado === TRUE){
        header("Location:index.php");
    }else {
        echo "Error al añadir nuevo usuario: " . $conn->error;
    }
     
     
}

?>

