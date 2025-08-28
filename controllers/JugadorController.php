<?php

namespace controllers;

require_once( dirname( dirname( __FILE__ ) ) . '/models/Equipo.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/models/Jugador.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/controllers/Controller.php' );

use models\Jugador;
use models\Equipo;

/**
 * JugadorController es la clase controladora de jugador
 * @author Darien Alonso <darienalonso@gmail.com>
 */
class JugadorController extends Controller
{
    /**
     * Crea un nuevo jugador
     */
    public function actionCreate()
    {
        $jugador = new Jugador();
        $equipos = Equipo::all();

        if ( $jugador->load( $_POST ) ) {            
            $jugador->save();
            return $this->redirect( 'index.php' );
        } else {
            return $this->render( '/views/jugador/create.php', [
                    'jugador' => $jugador,
                    'equipos' => $equipos
                ] 
            );
        }
    }

    /**
     * Elimina un jugador
     */
    public function actionDelete( $id )
    {
        $jugador = Jugador::deleteOne( $id );
                
        if ( $jugador ) {
            $id_equipo = $jugador[ 'equipo' ];            
            return $this->redirect( 'index.php?r=equipo&action=view&id='.$id_equipo );
        } else {
            return $this->render( '/views/error.php', [] );
        }
    }
}
