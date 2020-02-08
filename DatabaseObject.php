<?php

class DatabaseObject {

    private $con;
    
    public function __construct ( $host, $username, $password, $database )
    {
        $this->con = mysqli_connect ( $host, $username, $password, $database, 3306 );
        if ( !$this->con ) {
            throw new Exception ( 'no cnnecti possibili' );

        }
    }

    public function clean($data) {
        return mysqli_real_escape_string($this->con, $data);
    } 
}