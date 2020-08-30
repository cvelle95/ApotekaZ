<?php
session_start();
     $host='localhost';
     $user='ivan';//promeni posle
     $pass = 'ivak47';
     $db = 'apotekaz';
 
     $dataBase = new mysqli($host,$user,$pass,$db) or die("Neuspesna konekcija na bazu");
     if ($dataBase->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    //ako nije primio podatke iz forme
        $username =  $dataBase->real_escape_string($_POST['username']);
        $password =  $dataBase->real_escape_string($_POST['password']);

        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $dataBase->query($query);
        if($result->num_rows==1){
            $_SESSION['username'] = $username;
            $row = $result->fetch_assoc();
            $priv = $row['privilegije'];
            $_SESSION['privilegije'] = $priv;
            echo "Uspesno ste se ulogovali";
            echo "Vase privilegije su: $priv";
            $_SESSION['logged'] = true;
            header( "refresh:3;url=index.php" ); //redirektuj posle 3 sekundi
        }
        else {
            echo "Pogresan username ili lozinka";
            header( "refresh:3;url=index.php" ); //redirektuj posle 3 sekundi
        }
    
        $result->free();

?>