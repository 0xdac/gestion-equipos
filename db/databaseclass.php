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
    
    private $connection = null;
}