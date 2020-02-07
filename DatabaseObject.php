<?php

class databaseObject {

    private $con;
    
    public function __construct ( $host, $username, $password, $database )
    {
        $this->con = mysqli_connect ( $host, $username, $password, $database, 3306 );
        if ( !$this->con ) {
            throw new Exception ( " Error occured while connecting to dadatabase" );

        }
    }
}