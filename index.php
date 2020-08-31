<?php
//////////////////////////////////PROVERI DA LI DATABASA POSTOJI\\\\\\\\\\\\\\\\\
if(!isset($_COOKIE['dbCreated']) && $_COOKIE['dbCreated']==0){
  $link = mysqli_connect('localhost', 'ivan', 'ivak47');

  $db_selected = mysqli_select_db('apotekaz', $link);
  if (!$db_selected) {
      $cookie_name = "dbCreated";
      $cookie_value = 0;
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
      header("refresh:0;url=kreirajBazu.php");
  }
}
///////////////////////////////////////////////////////////////
$godinaCopyright = date('Y');
$smena1 = '7-14h';
$smena2 = '14-21h';
$startDate = date_create("2020-04-27");
$izbor = 0;
if(isset($_POST["izbor"])){  //proveri da li izabrano iz forme
    $izbor=$_POST['izbor'];    //uzmi izbor post metodom
}
$selected0 = "selected";
$selected1 = "";

if($izbor == 1){
	$temp = $smena1;
	$smena1 = $smena2; 
	$smena2 = $temp;
	
	$tempS = $selected0;
	$selected0 = $selected1;
	$selected1 = $tempS;
	
}
else{
	$smena1 = '7-14h';
    $smena2 = '14-21h';
}
//$currentDateGet = getdate(date("U"));
//$currentDate = date_create("$currentDateGet[year]-$currentDateGet[month]-$currentDateGet[mday]");
//$razlikaDatuma = date_diff($startDate,$currentDate);
//if($razlikaDatuma >= 7 ){
	//$ostatak = (int)($razlikaDatuma / 7);
	//$ostatak = $ostatak % 2;
	
	//if($ostatak == 1){
	    //$temp = $smena1;
	    //$smena1 = $smena2; 
	    //$smena2 = $temp;
	//}
//}
$umetniSmenu1="<td>$smena1</td>";
for($i=0;$i<4;$i++){
	$umetniSmenu1 .= "<td>$smena1</td>";
}
$umetniSmenu2="<td>$smena2</td>";
for($i=0;$i<4;$i++){
	$umetniSmenu2 .= "<td>$smena2</td>";
}



	


$page = <<< BEGIN
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
  <div id="wrapper">
    <div id="top">
        <div id="header">
            <div id="logo"></div>
            <div id="menu">
                    <ul class ="navigacija">
                        <li><a class ="active" href="index.php">Home</a></li>
                        <li><a href="faktura.php">RFZO faktura</a></li>
                        <li><a href="aboutUs.html">About us</a></li>
						<li><div class="dropdown">
                        <button class="dropbtn">Rokovi</button>
                          <div class="dropdown-content">
                            <a href="rokovi_unos.php">Unos</a>
                            <a href="rokovi_povrat.php">Povrat</a>
                          </div>
                         </div>
						</li>
                        <li><a href="contact.php">Kontakt</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
            </div>
        </div>
        <div id="headerText"><h1 style="color: black;">Raspored rada</h1>
           <div id="tabela">
                <table id="table"> 
				<form name="izbor" method="POST" action="index.php" value=1> 
				<select style="color:red;" name="izbor" onchange="this.form.submit();"><option style="color:red;" value="0" $selected0>Trenutna Nedelja</option><option value="1" $selected1>Sledeća Nedelja</option>
				</form>
                   <tr>
                     <th style="color: red;">Radnik</th>
                     <th>Ponedeljak</th>
                     <th>Utorak</th>
                     <th>Sreda</th>
                     <th>Četvrtak</th>
                     <th>Petak</th>
                   </tr>
                   <tr>
                       <td style="color: black;">Ivan</td>
					   $umetniSmenu1
				   </tr>
				   <tr>
                       <td style="color: black;">Vesna</td>
					   $umetniSmenu1
				   </tr>
				   <tr>
                       <td style="color: black;">Verica</td>
					   $umetniSmenu2
				   </tr>
				   <tr>
                       <td style="color: black;">Marko</td>
					   $umetniSmenu2
				   </tr>
                   </table>
           </div>
        </div>
    </div>

    <div id="footer">
        <div id="gfooter"><h3 id="ftext1"> Adress:</h3><h4 id="ftext2"> Vozda Karadjordja 39</h4> <h4 id="ftext3">    35250 Paraćin</h4><h4 id="ftext4"> Serbia </h4></div>
        <div id="dfooter"><p id="copyright">&copy Vanii $godinaCopyright</p>
            
        </div>
    </div>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }
    
    td, th {
       border: 1px solid #dddddd;
       text-align: left;
       padding: 8px;
    }
    
    tr:nth-child(even) {
       background-color: #dddddd;
    }
    </style>
    </body>
</html>
BEGIN;
echo $page;
?>