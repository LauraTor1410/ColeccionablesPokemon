<?php 
session_start();
include "pokemonCard.php"
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cartas Coleccionables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="d-inline p-2 bg-dark text-white title">
    Coleccionables de Pokemon
</div>
<div id="menu">
    <button onclick="loadBuscador()" class="btn btn-outline-light">Buscador</button>
    <button onclick="loadColeccion()" class="btn btn-outline-light">Mi Coleccion</button>
</div>
<div id="content">
    <?php
    if(isset($errorMessage)){
        echo $errorMessage;
    }
    if(isset($_SESSION['data'])){
        $data = $_SESSION['data'] ;
    }
    $context = $_SESSION['data-context'] ?? '';
    if($context === 'busqueda' && isset($data)){
        mostrarPokemon($data);
    }
    if($context === 'coleccion' && isset($_SESSION['usuario'])){
        include 'coleccion.php';
    }
    ?>
</div>
<script>
    function loadFormRegistro(){
        fetch('formRegistro.php')
                .then(response => response.text())
                .then(data =>{
                    document.getElementById('content').innerHTML = data;
        });
    };
    function loadBuscador(){
        fetch('buscadorPkmn.php')
                .then(response=>response.text())
                .then(data => { 
                    document.getElementById('content').innerHTML = data;
                });
    };
    function loadColeccion(){
        fetch('coleccion.php')
                .then(response=>response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                });
    };
        </script>
    </body>
</html>
