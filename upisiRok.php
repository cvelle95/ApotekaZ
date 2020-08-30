<?php   //konekcija na databasu
        session_start();
         header( "refresh:2;url=rokovi_unos.php" ); //redirektuj posle 2 sekundi
         $host='localhost';
         $user='ivan';//promeni posle
         $pass = 'ivak47';
         $db = 'apotekaz';

         $dataBase = new mysqli($host,$user,$pass,$db) or die("Neuspesna konekcija na bazu");
         if ($dataBase->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
            if(!isset($_POST['kolicina']) ||
            !isset($_POST['mesec']) ||
            !isset($_POST['godina'])) {
            died('Error submiting form to upisiRok.php'); 
            echo "Greska od forme";      
            }
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true){ // proveri da li je ulogovan user
            echo "Morate se ulogovati";
            header( "refresh:2;url=login.php" ); //redirektuj posle 2 sekundi
        } 
        else if($_SESSION['privilegije']!=5){
              echo "Nemate pravo na upis u bazu";
              header( "refresh:2;url=login.php" ); //redirektuj posle 2 sekundi
        }   
        else{                                                        
            $code = $_POST['kod'];
            $kolicina =  $_POST['kolicina'];
            $mesec_isteka =  $_POST['mesec'];
            $godina_isteka =  $_POST['godina'];
            $user_id = 1;

            $upit = "INSERT INTO rok (code,kolicina,mesec_isteka,godina_isteka,user_id) VALUES ('$code',$kolicina,$mesec_isteka,$godina_isteka,$user_id);";
            echo "</br>";
            
                if($dataBase->query($upit)){
                echo "Artikal je upisan u bazu";
                }
                else{
                    echo "Upis u bazu nije izvrsen! Ne postoji artikal sa datim kodom";
                }
                $dataBase->close();
            }
    ?>