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

        if( $this->validate( $post, 'nombre', 'required' ) && $this->validate( $post, 'nombre', 'string' )) 
            $this->nombre = $post[ 'nombre' ];
        else $result = false;            
        
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

    /**
     * Devuelve todos los equipos
     * @return array todos los equipos
     */ 
    public function getAll()
    {  
        return $this->all();   
    }

    public function tableName()
    {
        return 'equipo';
    }

    public function getNombre()
    {
        return $this->nombre;
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

    private $nombre;
    private $ciudad;
    private $deporte;
    private $fecha;
}