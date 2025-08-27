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
    /**
     * Hace persistente el objeto del modelo.
     * @param array $fields los campos y los valores a insertar
     * @return $id el id de la nueva fila
     */   
    protected function saveModel( $fields )
    {
        $table_name = $this->tableName();        
        $db = new DatabaseClass();

        $id = $db->insert( $table_name, $fields );
        return $id;
    }

    /**
     * Devuelve todas las filas del modelo
     */
    protected function all()
    {
        $table_name = $this->tableName();
        $db = new DatabaseClass();

        $all = $db->selectAll( $table_name ); 
        return $all;  
    }

    /**
     * Devuelve un modelo
     */
    public function findOne( $id )
    {
        $table_name = $this->tableName();
        $db = new DatabaseClass();

        $model = $db->selectOne( $table_name, $id ); 
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
            if ( preg_match('/^[A-Za-z0-9_-]*$/', $data[ $field ] ) ) {
                $result = true;
            }
            else{
                $this->errors[ $field ] = 'El campo '. $field .' contiene caracteres incorrectos.';
            }
        }

        return $result;
    }

    protected function tableName()
    {
        return '';
    }

    protected $errors;
}