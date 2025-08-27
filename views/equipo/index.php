<?php

$count = count( $equipos );

?>

<style>
    table, th, td {
    border: 1px solid black;
    padding: 5px;
    }
</style>

<div>
    <h1>Listado de Equipos</h1>
    <p><a class="#" href="index.php">Inicio</a></p>
    <p><a class="#" href="index.php?r=equipo&action=create">Agregar equipo</a></p>
    
    <table>
    <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Ciudad</th>
        <th scope="col">Deporte</th>
        <th scope="col">Fecha</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for( $i = 0; $i < $count; $i ++ ){
                $view_url = 'index.php?r=equipo&action=view&id='.$equipos[ $i ]['id'];
                echo "<tr>
                <td>" .htmlspecialchars( $equipos[ $i ]['nombre'] ). "</td>
                <td>" .htmlspecialchars( $equipos[ $i ]['ciudad'] ). "</td>
                <td>" .htmlspecialchars( $equipos[ $i ]['deporte'] ). "</td>
                <td>" .htmlspecialchars( $equipos[ $i ]['fecha'] ). "</td>
                <td><a href=".$view_url.">Ver</a></td>
                </tr>"; 
            }
        ?> 
    </tbody>
    </table>
</div>


