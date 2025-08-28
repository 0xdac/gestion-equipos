<?php

$errors = $jugador->getErrors();

?>

<div>
    <h1>Editar jugador</h1>
    <p><a class="#" href="index.php?r=equipo&action=view&id=<?= $model[ 'equipo' ] ?>">Atrás</a></p>
    <form action="index.php?r=jugador&action=update&id=<?= $model[ 'id' ] ?>" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $model[ 'nombre' ] ?>" />
        <div style="color: red;"><?= isset( $errors[ 'nombre' ] ) ? $errors[ 'nombre' ] : '' ?></div>
    </p>
    <p>
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" value="<?= $model[ 'numero' ] ?>" />
        <div style="color: red;"><?= isset( $errors[ 'numero' ] ) ? $errors[ 'numero' ] : '' ?></div>
    </p>
    <p>
        <label for="equipo">Equipo:</label>
        <select name="equipo" id="equipo">
            <?php                
                foreach( $equipos as $e ){
                    $selected = '';
                    if( $model[ 'equipo' ] === $e[ 'id' ] ){
                        $selected = "selected";
                    }
                    echo '<option value="'. $e[ 'id' ] .'" '. $selected .'>'. $e[ 'nombre' ] .'</option>';
                }
            ?>            
        </select>
        <div style="color: red;"><?= isset( $errors[ 'equipo' ] ) ? $errors[ 'equipo' ] : '' ?></div>
    </p>
    <p>
        <input type="submit" value="Actualizar" />
    </p>
    </form>

</div>


