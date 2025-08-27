<?php

?>

<div>    
    <p><a class="#" href="index.php">Inicio</a></p>
    <p><a class="#" href="index.php?r=equipo&action=index">Listar equipos</a></p>   
    <h1>Equipo: <?= htmlspecialchars( $equipo[ 'nombre' ] ) ?></h1>
    <h3>Identificador: <?= htmlspecialchars( $equipo[ 'id' ] ) ?></h3>
    <h3>Ciudad: <?= htmlspecialchars( $equipo[ 'ciudad' ] ) ?></h3>
    <h3>Deporte: <?= htmlspecialchars( $equipo[ 'deporte' ] ) ?></h3>
    <h3>Fecha: <?= htmlspecialchars( $equipo[ 'fecha' ] ) ?></h3>
</div>


