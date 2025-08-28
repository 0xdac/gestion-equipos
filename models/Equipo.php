<?php

namespace models;

require_once( dirname( __FILE__ ) . '/Model.php' );

use models\Model;

/**
 * Equipo representa el modelo de equipo. 
 * @author Darien Alonso <darienalonso@gmail.com>
 */

class Equipo extends Model
{
    /**
     * Carga en un modelo de equipo los nuevos valores 
     * @param array $post valores a partir de los cuales se crea un nuevo equipo
     * @return $result verdadero si se pudieron cargar los datos, falso en caso contrario
     */ 
    public function load( $post )
    {
        if( empty( $post ) ){
            return false;
        }

        $result = true;

        $result = parent::load( $post );         
        
        if( $this->validate( $post, 'ciudad', 'required' ) ) 
            $this->ciudad = $post[ 'ciudad' ];
        else $result = false;  

        if( $this->validate( $post, 'deporte', 'required' ) && $this->validate( $post, 'deporte', 'string' )) 
            $this->deporte = $post[ 'deporte' ];
        else $result = false;  

        if( $this->validate( $post, 'fecha', 'required' ) ) 
            $this->fecha = $post[ 'fecha' ];
        else $result = false;  

        return $result;
    }

    /**
     * Crea un nuevo equipo.
     * @return $id el id del nuevo equipo.
     */ 
    public function save()
    {
        return $this->saveModel([
            'nombre' => $this->nombre,
            'ciudad' => $this->ciudad,
            'deporte' => $this->deporte,
            'fecha' => $this->fecha,
        ]);
    }

    public static function tableName()
    {
        return 'equipo';
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function getDeporte()
    {
        return $this->deporte;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    private $ciudad;
    private $deporte;
    private $fecha;
}