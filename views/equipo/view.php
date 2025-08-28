<?php
$count = count( $jugadores );
?>

<style>
    table, th, td {
    border: 1px solid black;
    padding: 5px;
    }
</style>

<div>    
    <p><a class="#" href="index.php">Inicio</a></p>
    <p><a class="#" href="index.php?r=equipo&action=index">Listar equipos</a></p>   
    <h1>Equipo: <?= htmlspecialchars( $equipo[ 'nombre' ] ) ?></h1>
    <h3>Identificador: <?= htmlspecialchars( $equipo[ 'id' ] ) ?></h3>
    <h3>Ciudad: <?= htmlspecialchars( $equipo[ 'ciudad' ] ) ?></h3>
    <h3>Deporte: <?= htmlspecialchars( $equipo[ 'deporte' ] ) ?></h3>
    <h3>Fecha: <?= htmlspecialchars( $equipo[ 'fecha' ] ) ?></h3>
    <h2>Jugadores del equipo</h2>
    <table>
    <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Número</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php        
            for( $i = 0; $i < $count; $i ++ ){
                $update_url = 'index.php?r=jugador&action=update&id='.$jugadores[ $i ]['id'];
                $delete_url = 'index.php?r=jugador&action=delete&id='.$jugadores[ $i ]['id'];
                echo "<tr>
                <td>" .htmlspecialchars( $jugadores[ $i ]['nombre'] ). "</td>
                <td>" .htmlspecialchars( $jugadores[ $i ]['numero'] ). "</td>
                <td><a href=".$update_url.">Editar</a> <a href=".$delete_url.">Eliminar</a></td>
                </tr>"; 
            }
        ?> 
    </tbody>
    </table>
</div>


