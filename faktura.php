<?php
$odgovoriObrade = array();     //odgovori za ispis u text area
$sifreRecepata = array();      //Za kasniju proveru duple sifre
class Recept{
    public $RBr;
    public $podApoteka;

    function __construct($RBr, $podApoteka){
        $this->RBr = $RBr;
        $this->podApoteka = $podApoteka;
    }
}

function proveriRp ($SifRp, $DatRodj, $BrZK, $LBO, $DatPropLeka, $PropLek, $DatIzdLeka, $IzdLek, $RBr, $podApoteka){
    global $odgovoriObrade; //Glupi var scope php-a
    global $sifreRecepata;

    if(strlen($SifRp)<11){
        $o = "Neispravna sifra recepta sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
        $odgovoriObrade[] = $o;
    }
    else{
        $sifreRecepata[] = new Recept($RBr,$podApoteka);
    }
    
    if(strlen($DatRodj)>4){
        $godinaRodjenja = substr($DatRodj,-4);
        if($godinaRodjenja<1900){
            $odgovoriObrade[] = "Neispravan datum rodjenja sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
        }
    }
    else{
        $odgovoriObrade[] = "Neispravan datum rodjenja sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }

    if(strlen($BrZK)<10){
        $odgovoriObrade[] = "Neispravan broj knjizice sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }

    if(strlen($LBO)<10){
        $odgovoriObrade[] = "Neispravan LBO sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }

    if(strlen($IzdLek)<5){
        $odgovoriObrade[] = "Neispravna sifra izd leka sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }

    if(strlen($PropLek)<5){
        $odgovoriObrade[] = "Neispravna sifra prop leka sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }
    $godinaPropLeka = substr($DatPropLeka, -4);
    $mesecPropLeka = substr($DatPropLeka,2,2);
    $danPropLeka = substr($DatPropLeka,0,2);
    $datetime1 = new DateTime($godinaPropLeka."-".$mesecPropLeka."-".$danPropLeka);

    $godinaIzdLeka = substr($DatIzdLeka, -4);
    $mesecIzdLeka = substr($DatIzdLeka,2,2);
    $danIzdLeka = substr($DatIzdLeka,0,2);

    $datetime2 = new DateTime($godinaIzdLeka."-".$mesecIzdLeka."-".$danIzdLeka);
    $differenceDate = $datetime1->diff($datetime2);
    $difference = $differenceDate->days;
    if($difference>15){
        $odgovoriObrade[] ="Neispravna datum izdavanja leka sa RBr: ".$RBr . " kod apoteke: ". $podApoteka;
    }
 }


$target_dir = "C:/wamp64/www/test/uploads/"; //absolute!
$uploadOk = 1;
$odgovor = "";
$fileName= "";

if(isset($_POST["submit"])) { // Ako je submitovano
    $fileName = basename( $_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $odgovor =  "Sorry, your file is too large.&#10";
        $uploadOk = 0;
      }

      if($fileType != "xml") {
      $odgovor = "Sorry, only XML files are allowed.&#10";
      $uploadOk = 0;
      }

      if($uploadOk==0){
      // nije uredu,poruke vec ispisane gore
      } 
      else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {//pomeri fajl u uploads
          $odgovor = "The file ". $fileName. " has been uploaded.&#10";
          $xml = simplexml_load_file($target_file) or die ("Cant open xml file"); //otvori fajl i konvertuj u objekat pomocu simpleXml
          //Proveravam fakturu ovde...
          foreach($xml->Faktura as $faktura){
              $podApoteka = $faktura->SifraPodApoteke;
              foreach($faktura->Rp as $rp){
                  proveriRp($rp->SifRp, $rp->DatRodj, $rp->BrZK, $rp->LBO, $rp->DatPropLeka, $rp->PropLek, $rp->DatIzdLeka, $rp->IzdLek, $rp->RBr ,$podApoteka);
              }
          }
        } 
        else {
          $odgovor = "Error!Cant move file to specified location";
        }
      }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Vani</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">  
        body { margin:0;padding: 0; }  
        </style>


    </head>
    <body>
  <div id="wrapperFaktura">
    <div id="topFaktura">
        <div id="header">
            <div id="logo"></div>
            <div id="menu">
                    <ul class ="navigacija">
                        <li><a class ="active" href="index.php">Home</a></li>
                        <li><a href="faktura.php">RFZO faktura</a></li>
                        <li><a href="aboutUs.html">About us</a></li>
                        <li><a href="contact.php">Kontakt</a></li>
                    </ul>
            </div>
        </div>
        <?php
        echo "<div id='txtAreaDiv'>";
        echo    "<textarea id='txtArea' rows='28' cols='130' readonly>";
        echo $odgovor;
        if(isset($_POST["submit"])){
            if(count($odgovoriObrade)<1){
                echo "Faktura je ispravna!";
            }
            foreach($odgovoriObrade as $odg){
                echo "&#10".$odg."  "; 
            } 
        }
        echo    "</textarea>";
        echo "</div>";
        ?>
        <div id="fileUpload">
              <form action="faktura.php" method="post" enctype="multipart/form-data">
               Select image to upload:
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload XML" name="submit">
             </form>
        </div>
    </div>
    <?php
    $godinaCopyright = date('Y');
    ?>
    
    <div id="footerFaktura">
        <div id="dfooter"><p id="copyright">&copy Vanii <?php echo $godinaCopyright?></p>
            
        </div>
    </div>
    </body>
</html>
<?php ?>