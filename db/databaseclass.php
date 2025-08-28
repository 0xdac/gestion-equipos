<?php

namespace db;

/**
 * DatabaseClass se encarga del acceso a la base de datos
 * @author Darien Alonso <darienalonso@gmail.com>
 */

class DatabaseClass {       
    /**
     * Crea una conexion a la base de datos
     */
    public function __construct( $dbhost = "localhost", $dbname = "gestion_equipos", $username = "root", $password = "")
    {        
        $this->connection = new \PDO( "mysql:host={$dbhost};dbname={$dbname};", $username, $password );	        
    }
    
    /**
     * Inserta una nueva fila en la tabla
     * @param string $table_name el nombre de la tabla para insertar
     * @param array $fields los campos y los valores a insertar
     * @return id de la nueva fila
     */ 
    public function insert( $table_name = "", $fields = [] )
    {
        $statement = $this->createInsertQuery( $table_name, $fields );

        $this->executeStatement( $statement );
        return $this->connection->lastInsertId();		
    }

    /**
     * Actualiza una  fila en la tabla
     * @param string $table_name el nombre de la tabla 
     * @param array $fields los campos y los valores a actualizar
     * @param $id el id de la fila
     */ 
    public function update( $table_name = "", $fields = [], $id )
    {
        $statement = $this->createUpdateQuery( $table_name, $fields, $id );

        return $this->executeStatement( $statement, $fields );        		
    }

    /**
     * Elimina una fila en la tabla
     * @param string $table_name el nombre de la tabla donde se va a eliminar
     * @param integer $id el id de la fila
     * @return la fila antes de ser eliminada
     */ 
    public function delete( $table_name = "", $id )
    {
        $row = null;
        $row = $this->selectOne( $table_name, $id );

        $statement = "DELETE FROM ". $table_name ." where id = :id";
        $stmt = $this->executeStatement( $statement, [
            'id' => $id
        ] );

        return $row;		
    }

    public function selectAll( $table_name = "" )
    {
        $statement = "SELECT * FROM " . $table_name;
        $stmt = $this->executeStatement( $statement );
        return $stmt->fetchAll();		
    }	

    public function selectOne( $table_name = "", $id )
    {
        $statement = $this->connection->prepare( 'SELECT * FROM ' .$table_name. ' WHERE id = :id' );
        $statement->execute( [ 'id'=> $id ]);
        return $statement->fetch();		
    }

    public function selectAllByField( $table_name = "", $field )
    {
        $statement = $this->connection->prepare( 'SELECT * FROM ' .$table_name. ' WHERE equipo = :equipo' );
        $statement->execute( $field );
        return $statement->fetchAll();		
    }
    
    private function executeStatement( $statement = "" , $parameters = [] )
    {
        $stmt = $this->connection->prepare( $statement );
        $stmt->execute( $parameters );
        return $stmt;	
    }

    /**
     * Crea una instruccion INSERT dinamica segun la tabla y los campos
     */
    private function createInsertQuery( $table_name, $fields ) 
    {
        $keys = array_keys( $fields );
        $vals = array_values( $fields );
        
        $query = "INSERT INTO `". $table_name ."` (" . implode(', ', $keys ) . ") "
             . "VALUES ('" . implode("', '", $vals ) . "')";
    
        return $query;
    }

    /**
     * Crea una instruccion UPDATE dinamica segun la tabla y los campos
     */
    private function createUpdateQuery( $table_name, $fields, $id ) 
    {
        $count = count( $fields );
        $counter = 1;
        $columns = "";
        
        foreach( $fields as $key => $value ){
            $columns .= "`$key` = :$key";
            
            if( $counter < $count )
                $columns .= ", ";

            $counter ++;
        }

        $query = "Update $table_name set $columns where id = $id";
        
        return $query;
    }
    
    private $connection = null;
}
