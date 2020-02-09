<?php

// Database info 

$dbhost ="localhost";
$db_user = "root";
$db_password = "";
$db_name ="rpg-test";

try {
    //dsn = data source name
    $dsn = "mysql:host=" . $dbhost. ";dbname=" . $db_name;
    echo($dsn);
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    $pdo= new PDO($dsn, $db_user, $db_password, $options);
    var_dump($pdo);
}
catch(PDOException $e){
    echo " DB Connection Failed" . $e->getMessage();
}
 
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST["user_name"];
    $user_password = $_POST["user_password"];
    $level    = $_POST["level"];
    
    if( empty($user_name) || empty($user_password) || empty($level) ) {
        $status = "All fields are compulsory.";
    }
    else{
        if(strlen($user_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $user_name)) {
            $status = "Please enter a valid name";
        }
        else {
            $data = [
                'user_name' => $user_name,
                'user_password' => $user_password,
                'level' => $level,
                
            ];
            $sql = 'INSERT INTO users (user_name, user_password, level) VALUES (:user_name, :user_password, :level)';
            $stmt = $pdo->prepare($sql);
            
            
            try {
                //$stmt->execute(["user_name"=>$user_name, "user_password"=>$user_password, "level"=>$level]);
                $stmt->execute($data);
                //$pdo->exec($sql);
                //$stmt->errorInfo();
                //var_dump($stmt);
                //$stmt->execute();

            }
            catch( PDOException $e){
                var_dump($e);
            }
            
            $status = "Your message was sent";

            $user_name = "";
            $user_password = "";
            $level = "";

        }
    }
 }
 var_dump($_POST) ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test from pdo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1>Miakis rpg form</h1>
    </div>

    <form action=" " method="POST" class="form-group">
        <div class="form-group">
            <label for="user_name">user_name</label>
            <input type="text" name="user_name" id="user_name">
        </div>
        <div class="form-group">
            <label for="password">user_password</label>
            <input type="text" name="user_password" id="user_password">
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" name="level" id="level">
        </div>
        <input type="submit" value="Register">

        <div class="error">
            <?php echo $status ?>
        </div>
    </form>

</body>
</html>
 