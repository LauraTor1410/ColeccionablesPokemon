<?php

require_once 'conexion.php';
function mostrarPokemon($data){
        //Color carta 
    $tipoPrimario = $data['types'][0]['type']['name'];
    $coloresPorTipo = array(
        'grass' => 'card-grass',
        'fire' => 'card-fire',
        'water' => 'card-water',
        'dark' => 'card-dark',
        'dragon' => 'card-dragon',
        'fighting' => 'card-fight',
        'psychic' => 'card-psy',
        'flying' => 'card-fly',
        'fairy' => 'card-fairy',
        'rock' => 'card-rock',
        'ice' => 'card-ice',
        'electric' => 'card-electric',
        'ground' => 'card-ground',
        'steel' => 'card-steel',
        'ghost' => 'card-ghost',
        'bug' => 'card-bug',
        'normal' => 'card-normal',
        'poison' => 'card-poison',
    );

    if(array_key_exists($tipoPrimario, $coloresPorTipo)){
        $claseColor = $coloresPorTipo[$tipoPrimario];
    }else{
        $claseColor="";
    }
    ?>
    <div class="card  <?php echo $claseColor ?> pkmnCard ">
        <img class="card-img-top" src="<?php echo $data['sprites']['other']['official-artwork']['front_default']; ?>" alt="Card image cap">
        <div class="card-header">
            <h1 class="text-center"><?php echo $data['name']?></h1>
        </div>
        <div class="card-body">
          <p class="card-text text-center">Pokemon Nº: <?php echo $data['id']?></p>
          <div class="row">
              <div class="col">
                <h6>Types</h6>
                <ul>
                    <?php
                      foreach ($data['types'] as $type){
                          echo "<li class='list-group-item'>{$type['type']['name']}</li>"; 
                      }
                    ?>
                </ul>
              </div>
              <div class ="col">
                <h6>Abilities</h6>
                    <ul>
                         <?php
                          foreach ($data['abilities'] as $ability){
                              echo "<li class='list-group-item'>{$ability['ability']['name']}</li>";
                          }
                         ?>  
                    </ul>
              </div>
          </div>
          <div class="gif-container text-center">
                <img class="card-img gifPkmn" src="<?php echo $data['sprites']['versions']['generation-v']['black-white']['animated']['front_default']; ?>" >
          </div>
          <div id="mensajeConfirmacion-<?php echo $data['id']; ?>" class="alert alert-success mensajeConfirmacion" style="display: none;" role="alert"></div>
          <div class="text-center">
            <?php if($_SESSION['data-context'] === 'busqueda' && isset($_SESSION['usuario'])){?>
            <button type ="button" class="btn btn-dark cardButton" onclick="añadirCarta(<?php echo $data['id']; ?>)">Añadir a Colección</button>
            <?php }elseif($_SESSION['data-context'] === 'coleccion'){ ?>
            <button type ="button" class="btn btn-dark cardButton" onclick="borrarCarta(<?php echo $data['id']; ?>)" >Borrar de Colección</button>
          <?php }?>
          </div>
              
        </div>
    </div>
   
   <?php
    }
    ?>
<script>
    function añadirCarta(pokemonId){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                mostrarMensaje(this.responseText, pokemonId);
            }
        };
        xhttp.open("GET", "conexion.php?accion=añadir&pokemon_id=" + pokemonId, true);
        xhttp.send();
    }
    
    function borrarCarta(pokemonId){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                mostrarMensaje(this.responseText, pokemonId);
                location.reload();
            }
        };
        xhttp.open("GET", "conexion.php?accion=eliminar&pokemon_id=" + pokemonId, true);
        xhttp.send();
    }
    function mostrarMensaje(mensaje, pokemonId) {
        var cartas = document.getElementsByClassName("mensajeConfirmacion");
        for (var i = 0; i< cartas.length; i++){
            if(cartas[i].id === "mensajeConfirmacion-" + pokemonId){
                cartas[i].innerText = mensaje;
                cartas[i].style.display = "block";
                (function(index){
                    setTimeout(function(){
                    cartas[index].style.display = "none";
                    },3000);
                })(i);
                
            }
        }
        // El mensaje se ocultará después de 3 segundos (3000 milisegundos)
    }
</script>