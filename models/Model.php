<?php

namespace models;

require_once( dirname( dirname( __FILE__ ) ) . '/db/DatabaseClass.php' );

use db\DatabaseClass;

/**
 * Model es la clase base para todos los modelos. 
 * @author Darien Alonso <darienalonso@gmail.com>
 */

class Model
{ 
    public function load( $post )
    {
        $result = true;

        if( $this->validate( $post, 'nombre', 'required' ) && $this->validate( $post, 'nombre', 'string' )) 
            $this->nombre = $post[ 'nombre' ];
        else $result = false;             

        return $result;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Hace persistente el objeto del modelo.
     * @param array $fields los campos y los valores a insertar
     * @return $id el id de la nueva fila
     */   
    protected function saveModel( $fields )
    {
        $table_name = static::tableName();        
        $db = new DatabaseClass();

        $id = $db->insert( $table_name, $fields );
        return $id;
    }

    /**
     * Devuelve todas las filas del modelo
     */
    public static function all()
    {
        $table_name = static::tableName();
        $db = new DatabaseClass();

        $all = $db->selectAll( $table_name ); 
        return $all;  
    }

    /**
     * Devuelve un modelo
     */
    public static function findOne( $id )
    {
        $table_name = static::tableName();
        $db = new DatabaseClass();

        $model = $db->selectOne( $table_name, $id ); 
        return $model;  
    }

    public static function allByField( $field ) 
    {
        $table_name = static::tableName();
        $db = new DatabaseClass();

        $model = $db->selectAllByField( $table_name, $field ); 
        return $model;  
    }

    /**
     * Devuelve los errores encontrados durante la validacion
     * @return array todos los errores
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Hace las validaciones requeridas a los datos de entrada
     */
    protected function validate( $data, $field, $validation )
    {
        $result = false;

        if( 'required' === $validation )
        {
            if( isset( $data[ $field ] ) && !empty( $data[ $field ] ) ) {
                $result = true;                
            }  
            else{
                $this->errors[ $field ] = 'El campo '. $field .' es obligatorio.';
            }
        }
        else if( 'string' === $validation ){
            if ( preg_match( "/^[\w\s\.-]*$/", $data[ $field ] ) ) {
                $result = true;
            }
            else{
                $this->errors[ $field ] = 'El campo '. $field .' contiene caracteres incorrectos.';
            }
        }

        return $result;
    }

    protected static function tableName()
    {
        return '';
    }

    protected $nombre;
    protected $errors;
}