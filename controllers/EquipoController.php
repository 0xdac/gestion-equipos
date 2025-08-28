<?php

namespace controllers;

require_once( dirname( dirname( __FILE__ ) ) . '/models/Equipo.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/models/Jugador.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/controllers/Controller.php' );

use models\Equipo;
use models\Jugador;

/**
 * EquipoController es la clase controladora de equipo
 * @author Darien Alonso <darienalonso@gmail.com>
 */
class EquipoController extends Controller
{
    /**
     * Muestra un listado de todos los equipos
     */
    public function actionIndex()
    {
        $equipos = Equipo::all();

        return $this->render( '/views/equipo/index.php', [
                'equipos' => $equipos
            ] 
        );
    }

    /**
     * Crea un nuevo equipo
     */
    public function actionCreate()
    {
        $equipo = new Equipo();

        if ( $equipo->load( $_POST ) ) {            
            $equipo->save();
            return $this->redirect( 'index.php?r=equipo&action=index' );
        } else {
            return $this->render( '/views/equipo/create.php', [
                    'equipo' => $equipo
                ] 
            );
        }
    }

    /**
     * Muestra un equipo especifico
     */
    public function actionView( $id )
    {
        $equipo = Equipo::findOne( $id );
                
        if ( !$equipo ) {            
            return $this->redirect( 'index.php?r=equipo&action=index' );
        } else {
            $jugadores = Jugador::allByTeam( $id );

            return $this->render( '/views/equipo/view.php', [
                    'equipo' => $equipo,
                    'jugadores' => $jugadores
                ] 
            );
        }
    }
}
