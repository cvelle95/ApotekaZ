<?php
session_start();
if(isset($_POST['email'])) {
 

 
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo $error."<br /><br />";
        die();
    }
 
 
    // Da li su podaci iz forme primljeni
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subj'])) {
        died('Greska forme');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email = $_POST['email']; // required
    $comp = $_POST['comp']; // not required
    $subj = $_POST['subj']; // required
 
    $error_message = "";
   	$email_to = "cvetkovici888@gmail.com";
    $email_subject = "New form submit from: ".$first_name." ".$last_name;
 
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     // ocisti string
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Company: ".clean_string($comp)."\n";
    $email_message .= "Subject: ".clean_string($subj)."\n";

    /////////////////////////////////////////// UPIS U BAZUZ \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    $host='localhost';
     $user='ivan';//promeni posle
     $pass = 'ivak47';
     $db = 'apotekaz';
 
     $dataBase = new mysqli($host,$user,$pass,$db) or die("Neuspesna konekcija na bazu");
     if ($dataBase->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      }
   ///// proveri da li je ulogovan user i napravi querije na osnovu toga
      if(isset($_SESSION['username'])){
          $user_id = $_SESSION['user_id'];
          $upit = "INSERT INTO message (name,surname,email,text,user_id) VALUES ('$first_name','$last_name','$email','$subj',$user_id);";
      }
      else{
          $upit = "INSERT INTO message (name,surname,email,text) VALUES ('$first_name','$last_name','$email','$subj');";
      }

      $dataBase->query($upit);
  
      $dataBase->close();
    /////////////////////////////////////////////////////////////////////////////////////////
 
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n";
if(@mail($email_to, $email_subject, $email_message, $headers)){
  echo "Thank you for contacting us";
  header( "refresh:3;url=index.php" );
}
else{
  echo "Error sending email";
  header( "refresh:3;url=index.php" );
}
?>
 
 
 
<?php
 
}
?>