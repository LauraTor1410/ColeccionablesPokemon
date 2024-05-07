<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
$mensaje = "";
$host ='127.0.0.1';
$db_usuario = 'laura';
$db_contraseña = '1234';
$db_nombreBase = 'pokemon';

$conn = new mysqli($host, $db_usuario, $db_contraseña, $db_nombreBase);

if ($conn->connect_error){
    die("Error de conexion: " .$conn->connect_error);
}

function ejecutarConsulta($sql){
    global $conn;
    $resultado = $conn->query($sql);
    if(!$resultado){
        die("Error en la consulta: " . $conn->error);
    }
    return $resultado;
}

 if (isset($_GET['accion']) && $_GET['accion'] =='añadir'){
     try{
        añadirCarta();
        echo $mensaje;
     } catch (Exception $ex) {
        echo $ex->getMessage();
     } 
}
if (isset($_GET['accion']) && $_GET['accion'] =='eliminar'){
    try{
        borrarCarta();
        echo $mensaje;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } 
 
}
function añadirCarta(){
    global $mensaje;
    $idUser =  $_SESSION['id'];
    $idPokemon = $_GET['pokemon_id'];

    $sql = "INSERT INTO user_cards (user_id, card_id) VALUES ('$idUser', '$idPokemon')";
    $resultado = ejecutarConsulta($sql);
    if(!$resultado){
        $mensaje = "Error al ejecutar la consulta SQL: " . mysqli_error($conexion); 
    }else{
        $mensaje = "¡Carta añadida!";
    }

}

function borrarCarta(){
    global $mensaje;
    $idUser =  $_SESSION['id'];
    $idPokemon = $_GET['pokemon_id'];

    $sql = "DELETE FROM user_cards WHERE user_id = '$idUser' AND card_id = '$idPokemon'";
    $resultado = ejecutarConsulta($sql);
    if(!$resultado){
        $mensaje = "Error al ejecutar la consulta SQL: " . mysqli_error($conexion); 
    }else{
        $mensaje = "¡Carta Borrada !";
    }

}