<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'conexion.php';
require_once 'pokemonCard.php';
require_once 'datosPokemon.php';
$_SESSION['data-context'] = 'coleccion';

if(!isset($_SESSION['usuario'])){
    
    header("Location: formInicioSesion.php");
    exit;
}
$usuario = $_SESSION['usuario'];
$idUser =$_SESSION['id'];
$cartas = array();
$sql = "SELECT card_id FROM user_cards WHERE user_id = '$idUser'";
$resultado = ejecutarConsulta($sql); 
if ($resultado->num_rows >0){
    while($fila = $resultado->fetch_assoc()){
        $cartas[] = $fila['card_id'];
    }
}

?>
<div class="cardsContainer">
    <div class="bg-dark text-white text-center">
        <h1>Bienvenido <?php echo $usuario?>!</h1>
        <p>Aquí está tu colección de cartas:</p>
    </div>
    <?php
        foreach ($cartas as $carta) {
            $dataPkmn = obtenerDatosPokemon($carta);
            mostrarPokemon($dataPkmn);
        }
        ?>
</div>
