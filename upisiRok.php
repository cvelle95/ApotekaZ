<?php   //konekcija na databasu
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
         if(isset($_POST['kod'])){
            if(!isset($_POST['artikal']) ||
            !isset($_POST['kolicina']) ||
            !isset($_POST['mesec']) ||
            !isset($_POST['godina'])) {
            died('Error submiting form to upisiRok.php'); 
            echo "Greska od forme";      
            }
            $code = $_POST['kod'];
            $naziv =  $_POST['artikal'];
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