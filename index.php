<?php
require_once( dirname(__FILE__) . '/controllers/EquipoController.php' );

use controllers\EquipoController;

if( isset( $_GET[ 'r' ] ) && isset( $_GET[ 'action' ] ) ){

    $route = $_GET[ 'r' ];
    $action = $_GET[ 'action' ];

    if( 'equipo' === $route ){

        $equipo_controller = new EquipoController();

        if( 'index' === $action ){
            $equipo_controller->actionIndex();
            exit;
        }

        if( 'create' === $action ){            
            $equipo_controller->actionCreate();
            exit;
        }

        if( 'view' === $action ){
            $id = isset( $_GET[ 'id' ] ) ? $_GET[ 'id' ] : -1 ;            
            $equipo_controller->actionView( $id );
            exit;
        }

        //Default
        header( 'Location: index.php', true, 301 );
        exit;
        
    }
    else if( 'jugador' === $route ){

    }
    else {
        header( 'Location: index.php', true, 301 );
        exit;
    }
}
else { ?>
    <div>
        <h1>Gestión de Equipos</h1>

        <p>Gestionar equipos</p>
        <p><a class="#" href="index.php?r=equipo&action=create">Agregar equipo</a></p>
        <p><a class="#" href="index.php?r=equipo&action=index">Listar equipos</a></p>
    </div>
<?php } 
?>




