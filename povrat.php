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
    if(!isset($_POST['mesec']) || !isset($_POST['godina'])) {
    died('Error submiting form to povrat.php'); 
    echo "Greska od forme";      
    }

    $izabraniMesec =  $_POST['mesec'];
    $izabranaGodina =  $_POST['godina'];

    $querryPovratDobavljaci ="SELECT rok.*,artikal.naziv,artikal.meseci_pre_isteka,artikal.is_povrat,`user`.ime_prezime FROM rok
    INNER JOIN artikal ON rok.`code`=artikal.`code`
    INNER JOIN `user` ON rok.user_id = `user`.user_id
    WHERE (rok.mesec_isteka - $izabraniMesec)+((rok.godina_isteka-$izabranaGodina)*12)=artikal.meseci_pre_isteka AND is_povrat = 1
    ORDER BY godina_isteka,mesec_isteka ASC;";

    $querryStandardPovrat = "SELECT rok.*,artikal.naziv,artikal.meseci_pre_isteka,artikal.is_povrat,`user`.ime_prezime FROM rok
    INNER JOIN artikal ON rok.`code`=artikal.`code`
    INNER JOIN `user` ON rok.user_id = `user`.user_id
    WHERE (rok.mesec_isteka - $izabraniMesec)+((rok.godina_isteka-$izabranaGodina)*12)=1 AND is_povrat = 0
    ORDER BY godina_isteka,mesec_isteka ASC;";

    $querryRaspodelaPovrat = "SELECT rok.*,artikal.naziv,artikal.meseci_pre_isteka,artikal.is_povrat,`user`.ime_prezime FROM rok
    INNER JOIN artikal ON rok.`code`=artikal.`code`
    INNER JOIN `user` ON rok.user_id = `user`.user_id
    WHERE (rok.mesec_isteka - $izabraniMesec)+((rok.godina_isteka-$izabranaGodina)*12)=4 AND is_povrat = 0
    ORDER BY godina_isteka,mesec_isteka ASC;";
    
    echo "<p style='color:red;'> -------- POVRAT DOBAVLJACIMA --------</p> ";
    echo "<br>";
    echo "<pre><p style='color:green;'> kod     naziv    kolicina     rok       radnik</p></pre> ";
    
    // fetch_assoc() pravi asocijativni array po tabelama sa podacima
    if($result = $dataBase->query($querryPovratDobavljaci)){
        while ($row = $result->fetch_assoc()) {

            $code= $row["code"];
            $naziv= $row["naziv"];
            $rok= $row["mesec_isteka"]."/".$row["godina_isteka"];
            $kolicina= $row["kolicina"];
            $radnik = $row["ime_prezime"];

            $ispis = $code. "    " .$naziv."    ". $kolicina."    ".$rok."    "."Upisao: ".$radnik;
            //jer html dodaje samo 1 whitespace koristimo pre tag
            echo "<pre>$ispis</pre>";
            echo "<br>";
        }
        //prazni rezultat
        $result->free();
    }
    
    echo "<br>";
    echo "<br>";
    echo "<p style='color:red;'> -------- STANDARDNI POVRAT(1 mesec pre isteka roka) --------</p> ";
    echo "<br>";
    echo "<pre><p style='color:green;'> kod     naziv    kolicina     rok       radnik</p></pre> ";

    if($result = $dataBase->query($querryStandardPovrat)){
        while ($row = $result->fetch_assoc()) {

            $code= $row["code"];
            $naziv= $row["naziv"];
            $rok= $row["mesec_isteka"]."/".$row["godina_isteka"];
            $kolicina= $row["kolicina"];
            $radnik = $row["ime_prezime"];
            $ispis = $code. "    " .$naziv."    ". $kolicina."    ".$rok."    "."Upisao: ".$radnik;
            //jer html dodaje samo 1 whitespace koristimo pre tag
            echo "<pre>$ispis</pre>";
            echo "<br>";
        }
        //prazni rezultat
        $result->free();
    }
    
    echo "<br>";
    echo "<br>";
    echo "<p style='color:red;'> -------- POVRAT ZA PRERASPODELU(4 meseca pre isteka roka) --------</p> ";
    echo "<br>";
    echo "<pre><p style='color:green;'> kod     naziv    kolicina     rok       radnik</p></pre> ";

    if($result = $dataBase->query($querryRaspodelaPovrat)){
        while ($row = $result->fetch_assoc()) {

            $code= $row["code"];
            $naziv= $row["naziv"];
            $rok= $row["mesec_isteka"]."/".$row["godina_isteka"];
            $kolicina= $row["kolicina"];
            $radnik = $row["ime_prezime"];
            $ispis = $code. "    " .$naziv."    ". $kolicina."    ".$rok."    "."Upisao: ".$radnik;
            //jer html dodaje samo 1 whitespace koristimo pre tag
            echo "<pre>$ispis</pre>";
            echo "<br>";
        }
        //prazni rezultat
        $result->free();
    }
    $dataBase->close();

    
?>