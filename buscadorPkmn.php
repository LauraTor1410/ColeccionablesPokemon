<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['data-context'] = 'busqueda';
include 'datospokemon.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if( isset($_POST['pokemon'])){
        $pokemon = $_POST['pokemon'];
        $data = obtenerDatosPokemon($pokemon);
        if($data){
            $_SESSION['data']=$data;
            header("Location: index.php");
            exit;
        }else{
            echo "No se encontró ninguno con ese número o nombre";
        }
    }
}
?>

<div>
    <div class="bg-dark text-white text-center">
      <form action ="buscadorPkmn.php" method="post">
        <label for="pokemon">Ingresa Número o Nombre del Pokemon a buscar</label>
        <input type="text" id="pokemon" name="pokemon"/>
        <button type="submit"> Buscar</button>
      </form>  
    </div>
    
</div>
