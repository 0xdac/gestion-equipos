<?php

$ciudades = [ '', 'A Coruña', 'Santiago de Compostela', 'Ferrol', 'Arteixo', 'Culleredo'];

$errors = $equipo->getErrors();

?>

<div>
    <h1>Editar equipo</h1>
    <p><a class="#" href="index.php?r=equipo&action=index">Listar equipos</a></p>
    <form action="index.php?r=equipo&action=update&id=<?= $model[ 'id' ] ?>" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $model[ 'nombre' ] ?>" />
        <div style="color: red;"><?= isset( $errors[ 'nombre' ] ) ? $errors[ 'nombre' ] : '' ?></div>
    </p>
    <p>
        <label for="ciudad">Ciudad:</label>
        <select name="ciudad" id="ciudad">
            <?php                
                foreach( $ciudades as $key => $value ){
                    $selected = '';
                    if( $model[ 'ciudad' ] === $value ){
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
        <input type="text" id="deporte" name="deporte" value="<?= $model[ 'deporte' ] ?>" />
        <div style="color: red;"><?= isset( $errors[ 'deporte' ] ) ? $errors[ 'deporte' ] : '' ?></div>
    </p>
    <p>
        <label>
        Fecha: <input type="date" name="fecha" value="<?= $model[ 'fecha' ] ?>" />
        </label>
        <div style="color: red;"><?= isset( $errors[ 'fecha' ] ) ? $errors[ 'fecha' ] : '' ?></div>
    </p>
    <p>
        <label for="capitan">Capitan:</label>
        <select name="capitan" id="capitan">
            <?php                
                foreach( $jugadores as $e ){
                    $selected = '';
                    if( $model[ 'capitan' ] === $e[ 'id' ] ){
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


