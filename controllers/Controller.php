<?php

namespace controllers;

/**
 * Controller es la clase base para el resto de los controladores
 * @author Darien Alonso <darienalonso@gmail.com>
 */

class Controller 
{
    /**
     * Muestra una vista 
     * @param string $view la vista que se desea mostrar
     * @param array $model el modelo que se pasa a la vista
     */
    protected function render( $view, $model )
    {        
        $path = dirname( dirname( __FILE__ ) ) . $view;

        echo $this->renderFile( $path, $model );
    }

    /**
     * Redirecciona a una nueva url
     * @param string $url la direccion deseada 
     */
    protected function redirect( $url )
    {        
        header( 'Location: ' . $url, true, 301 );
        exit();
    }

    /**
     * Incluye el archivo de la vista y permite que los objetos del modelo esten disponibles en la misma
     * @param string $filename la ubicacion fisica de la vista
     * @param array $vars variables a importar a la tabla de simbolos
     */
    private function renderFile( $filename, $vars = null ) 
    {
        if ( is_array( $vars ) && !empty( $vars ) ) {
          extract( $vars );
        }

        ob_start();
        include $filename;
        return ob_get_clean();
    }
}
