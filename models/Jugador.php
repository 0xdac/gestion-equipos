<?php

namespace models;

require_once( dirname( __FILE__ ) . '/Model.php' );

use models\Model;

/**
 * Jugador representa el modelo de jugador. 
 * @author Darien Alonso <darienalonso@gmail.com>
 */

class Jugador extends Model
{
    /**
     * Carga en un modelo de jugador los nuevos valores 
     * @param array $post valores a partir de los cuales se crea un nuevo jugador
     * @return $result verdadero si se pudieron cargar los datos, falso en caso contrario
     */ 
    public function load( $post )
    {
        if( empty( $post ) ){
            return false;
        }

        $result = true;

        $result = parent::load( $post );           
        
        if( $this->validate( $post, 'numero', 'required' ) ) 
            $this->numero = $post[ 'numero' ];
        else $result = false;  

        if( $this->validate( $post, 'equipo', 'required' ) ) 
            $this->equipo = $post[ 'equipo' ];
        else $result = false;    

        return $result;
    }

    /**
     * Crea un nuevo jugador.
     * @return $id el id del nuevo jugador.
     */ 
    public function save()
    {
        return $this->saveModel([
            'nombre' => $this->nombre,
            'numero' => $this->numero,
            'equipo' => $this->equipo,
        ]);
    }

    public static function allByTeam( $id ) 
    {
        return static::allByField([
            'equipo' => $id
        ]);
    }

    public static function tableName()
    {
        return 'jugador';
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getEquipo()
    {
        return $this->equipo;
    }

    private $numero;
    private $equipo;
}