<?php

function obtenerDatosPokemon($pokemon){
    
    $pokemon = trim (filter_var($pokemon, FILTER_SANITIZE_STRING));
    
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/{$pokemon}/";
    try {
        
        $response = @file_get_contents($apiUrl);
        
        
        if ($response === false) {
            $errorMessage = "No se encontró ningún Pokémon con ese nombre o número.";
            include 'index.php';  
        } else {
            // Si no hubo error, procesa la respuesta
            $data = json_decode($response, true);
            
            if ($data !== null && isset($data['name'])) {
                return $data;
            }
        }
    } catch (Exception $e) {
       return false;
    }
   
}
?>