<?php
 require_once ( "DatabaseObject.php" );
 require_once ( "databaseVars.php" );

 $database = new DatabaseObject($host, $username, $password, $database);

 if(!empty($_POST["register"])) {
    $username = $database->clean($_POST["username"]);
    $password = $database->clean($_POST["password"]);
    
    try {
        //username
        if(strlen($username) < 5) {
           throw new Exception("Username must be at least 5 characters");
       }
       if(strlen($username) > 50 ) {
           throw new Exception("Username must be shorter than characters");
       }
       if(!ctype_alnum($username) ) {
           throw new Exception("Username must be only letters or numbers");
       }
       if(strlen($password) < 6) {
           throw new Exception("password must be at least 6 characters");
       }

    }
    catch (Exception $e){
        echo $e->getMessage();
    }

    //send to database

    echo "ok";
    
}
?>

<form action="./register.php" method="POST">
   
   username: <input type="text" name="username"><br>
   password: <input type="password" name="password"><br>
   <input type="submit" name="register" value="Register">
   
</form>
<?php var_dump($_POST["username"]);
