<?php

$ciudades = [ '', 'A Coruña', 'Santiago de Compostela', 'Ferrol', 'Arteixo', 'Culleredo'];

$errors = $equipo->getErrors();

?>

<div>
    <h1>Agregar Equipo</h1>
    <p><a class="#" href="index.php?r=equipo&action=index">Listar equipos</a></p>
    <form action="index.php?r=equipo&action=create" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $equipo->getNombre() ?>" />
        <div style="color: red;"><?= isset( $errors[ 'nombre' ] ) ? $errors[ 'nombre' ] : '' ?></div>
    </p>
    <p>
        <label for="ciudad">Ciudad:</label>
        <select name="ciudad" id="ciudad">
            <?php                
                foreach( $ciudades as $key => $value ){
                    $selected = '';
                    if( $equipo->getCiudad() === $value ){
                        $selected = "selected";
                    }
                    echo '<option value="'. $value .'" '. $selected .'>'. $value .'</option>';
                }
            ?>            
        </select>
        <div style="color: red;"><?= isset( $errors[ 'ciudad' ] ) ? $errors[ 'ciudad' ] : '' ?></div>
    </p>
    <p>
        <label for="deporte">Deporte:</label>
        <input type="text" id="deporte" name="deporte" value="<?= $equipo->getDeporte() ?>" />
        <div style="color: red;"><?= isset( $errors[ 'deporte' ] ) ? $errors[ 'deporte' ] : '' ?></div>
    </p>
    <p>
        <label>
        Fecha: <input type="date" name="fecha" value="<?= $equipo->getFecha() ?>" />
        </label>
        <div style="color: red;"><?= isset( $errors[ 'fecha' ] ) ? $errors[ 'fecha' ] : '' ?></div>
    </p>
    <p>
        <input type="submit" value="Agregar" />
    </p>
    </form>

</div>


