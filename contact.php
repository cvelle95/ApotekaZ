








<!DOCTYPE html>
<html>
    <head>
        <title>Kontaktirajte nas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" type="text/css"/>
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
        <div id="wrapperKontakt">
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
                    </ul>
            </div>
        </div>
        <div id="bodyKontakt">
            <div id="formaWrapper">
                <form method="post" name="forma" action="email.php" id="forma"onsubmit="return proveriFormu()" >
                    <label for="fname">First name <span class="star">*</span></label>
                    <input type="text" id="fname" name="first_name" placeholder="Enter your first name..." required>
                    
                    <label for="lname">Last name <span class="star">*</span></label>
                    <input type="text" id="lname" name="last_name" placeholder="Enter your last name..." required>
                    
                    <label for="company">Company</label>
                    <input type="text" id="company" name="comp" placeholder="...">
                    
                    <label for="email">E-mail <span class="star">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Enter your e-mail address..." required>
                    
                    <label for="subject">Poruka</label>
                    <textarea id="subject" name="subj" placeholder="..." style="height:27vh;"></textarea>
                    
                    <input type="submit" value="Submit">
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
    
        <script>
            function proveriFormu() {
            var fname = document.forms["forma"]["first_name"].value;
            var lname = document.forms["forma"]["last_name"].value;
            var subject = document.forms["forma"]["subj"].value;
            var email = document.forms["forma"]["email"].value;
            var prIP =/[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}/;
            var emcheck =/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!prIP.test(fname)) {
            alert("Name must begin with capital letter and have maximum of 21 characters");
            return false;
            }
            else if (!prIP.test(lname)) {
            alert("Last name must begin with capital letter and have maximum of 21 characters");
            return false;
            }
            else if (!emcheck.test(email)) {
            alert("Please enter valid email adress");
            return false;
            }
            else if (subject === "" || subject.length<5) {
            alert("Please fill out subject");
            return false;
            }
            else {
            return true;
            }
}
        </script>
    </body>
</html>