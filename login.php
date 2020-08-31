<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="style2.css" type="text/css"/>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">  
        body { margin:0;padding: 0; }  
        </style>
    </head>
    <body>
        <div id="wrapperLogin">
        <div id="headerUpis">
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
        <div id="bodyLogin">
            <div id="formaLogin">
                <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){ // proveri da li je ulogovan user
                    $user = $_SESSION['username'];
                    echo "<p style='color:red;'>Vec ste ulogovani kao <span style='color:green;'> $user </span> <a href='odjava.php'>odjavite se</a></p>";
                    $dataBase = new mysqli('localhost','ivan','ivak47','apotekaz') or die("Neuspesna konekcija na bazu");
                    if ($dataBase->connect_errno) {
                       printf("Connect failed: %s\n", $mysqli->connect_error);
                    exit();
                    }
                    // ukupno minuta
                    $userId = $_SESSION['user_id'];
                    $upit = "SELECT SUM(ukupnoMinuta) FROM sesija WHERE user_id = $userId;";
                    $result = $dataBase->query($upit);
                    $row = $result->fetch_assoc();
                    $minuti = $row['SUM(ukupnoMinuta)'];

                    echo "<p style='color:grey;'>Ukupno minuta provedeno kao  <span style='color:green;'> $user </span> na svim vasim prethodnim sesijama: <span style='color:green;'>$minuti </span></p>";
                    $dataBase->close();} ?>
                <form method="post" name="forma" action="validate.php" id="forma" >
                    <label for="username">Username </label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"  required>

                    <input type="submit" id="sub" value="Login">
                </form>
                <p style="float:center;margin-top:5vh;">Nemate nalog? <a href="register.php">Registrujte se</a></p>
            </div>
        </div>
        <?php
        $godinaCopyright = date('Y');// trenutna godina
        ?>
        <div id="footerUpis">
        <div id="dfooterUpis"><p id="copyright">&copy Vanii <?php echo $godinaCopyright?></p>
            
        </div>
    </div>