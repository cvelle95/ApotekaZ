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
    $error = false;
    //podaci iz forme
        $username =  $dataBase->real_escape_string($_POST['username']);
        $password =  $dataBase->real_escape_string($_POST['password']);
        $ime_prezime = $dataBase->real_escape_string($_POST['ime_prezime']);

        $userCheck = "SELECT * FROM user WHERE username='$username'";
        $result = $dataBase->query($userCheck);
        $uName = $result->fetch_assoc();
        
        if ($uName) { // Proveri da li vec postoji korisnik sa tim username
            if ($uName['username'] === $username) {
              echo "Vec postoji korisnik sa tim korisnickim imenom";
              $error = true;
              header( "refresh:2;url=register.php" );
            }
        }

        // ako je sve uredu registruj korisnika
        if(!$error){
            $password = md5($password);
            $query = "INSERT INTO user (ime_prezime,username,password) 
                VALUES('$ime_prezime','$username','$password')";
            $dataBase->query($query);
            echo "Uspesno ste se registrovali";
            header( "refresh:2;url=login.php" );
        }
    $dataBase->close();

?>