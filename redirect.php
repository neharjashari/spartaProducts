<?php
session_start();

// fshiji COOKIET
setcookie("user","undefinedUser", time() - 3600);
setcookie("country","undefinedCountry", time() - 3600);   

// si konstante zbritjet per blerje online
define("LOJADISC", 0.1);
define("EDUDISC",0.05);

$zbritja = 0;
// nese ka shenuar kodin per discount beja zbritjen
if(!empty($_SESSION['discountCode']))
{
    $zbritja = LOJADISC;
}
$email = $_SESSION['email'];
$emailArr = explode(".",$email);
// nese ka email .edu nje tjeter zbritje
if($emailArr[sizeof($emailArr)-1]=="edu")
{
    $zbritja = $zbritja + EDUDISC;
}
// zbresim nga cmimi total
$_SESSION['totaliEuro'] = $_SESSION['totaliEuro'] * (1-$zbritja);

$kartela = substr($_SESSION['paymentcardd'],0,3);
$kartela = strtoupper($kartela);
// bashkojme adresen e shenuar me "," si delimiter
$placee = implode(", ", $_SESSION['arrrrr']);


// ********************************* PHP Mailer ****************************************

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/Exception.php");
require_once("PHPMailer/src/SMTP.php");

$mail = new PHPMailer(true);
// Passing true enables exception

try
{
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'spartaproducts.orders@gmail.com';
    $mail->Password = 'thisissparta';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mailto = $_SESSION['email'];

    // recipients
    $mail->setFrom('spartaproducts.orders@gmail.com','Sparta Products');
    $mail->addAddress($mailto,'Client');

    $mailcont = "Your order contains a total of ".$_SESSION['totaliEuro']." Euros.<br>Order will be delivered to: ".$placee.".<br>Method of Payment: ".$kartela;
		   
    //Content
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = 'Sparta Products - Your Order Receipt';
    $mail->Body    = "Your order has been processed <b>successfully</b>!<br><br>"
                        .$mailcont."<br><br>Looking forward to your next order!<br><b>Sparta Products.</b>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} 
catch (Exception $e) 
{
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}



// ketu ka qene destroy por eshte shtuar orderInfo prandaj nuk guxojme te mbyllim sesionin ketu
// session_destroy();

?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Redirection </title> 
    <link rel="stylesheet" href="style.css" />
    <style>
        #gamep
        {
            text-align: center;
            font-size: 2em;
            font-style: italic;
            color: coral;
            text-shadow: 1px 1px black;
        }
        canvas 
        {
            border:1px solid #d3d3d3;
            background-color: #f1f1f1;
            
        }
    </style>
    <script src="extra/jquery-3.2.1.js"> </script>
    <script src="extra/scrollNav.js"> </script>
</head>

<body>
<div id="container">
    <header>
        <nav>
            <div style="float: left; margin-left: 80px; margin-top: 5px;padding-top: 4px;">  
                <a href="index.html"><img src="images/icon.png" width="300" height="50" alt="Company Logo"/></a>
            </div>
            <div style="float:right; margin-right: 40px;padding-top: 5px;">
                <ul>
                    <li> <a href="home.php"> Home </a></li>
                    <li> <a href="about.html"> About us </a></li>
                    <li> <a href="products.html"> Products </a></li>
                    <li> <a href="merchandise.html"> Merchandise </a></li>
                    <li> <a href="contact.html"> Contact </a></li>
                </ul>
            </div>
        </nav>
        <hr/>

        
        <div id="banner">
            <img src="images/1_1920.jpg" width="100%" height="700" alt="Image showing tech products of all kinds. On a table, Mac PC, tablet, keyboard and a mouse"/> 
        </div>

    </header>
    
    <main>
        <article  style="width: 100%;">

            <div class="artikujt">
                <p id="gamep">
                        While your order is being completed, entertain yourself
                        playing this game...
                </p>
                <img alt="A simple game" src="images/game/castle.png" style="display: none;" id="castle"/>
                <img alt="Character of the game" src="images/game/karakteriLojes.png" style="display: none;" id="karakteri"/>
                <img alt="Field background" src="images/game/field.jpg" style="display: none;" id="fusha"/>
                <img alt="Spinny enemy" src="images/game/enemy.png" style="display: none;" id="enemy"/>
                <img alt="Buzzy beetle enemy" src="images/game/enemy2.png" style="display: none;" id="enemy2"/>
                <img alt="Victory" src="images/game/victory.jpg" style="display: none;" id="victory"/>
                <img alt="Big BOSS Bowser" src="images/game/boss.png" style="display: none;" id="boss"/>
                <img alt="Goomba enemy" src="images/game/goomba.png" style="display: none;" id="goomba"/>
                <img alt="Chargin' Chuck enemy" src="images/game/chuck.png" style="display: none;" id="chuck"/>
                <div id="game" style="border-radius: 20px;">            
                    <div id="gamee" style="text-align: center";>
                        <canvas id="kanvasi" width="500" height="300" style="border: 1px solid black;" >
                        </canvas>
                    </div>
                    <div style="text-align:center;width:130px;margin-left: 42%;background-color: RGBA(255,255,255,0.8);border-radius: 100px;padding: 10px;margin-top: 2%;">
                        <button class="butonatloje" onclick="moveTop()" id="butoniloja1">UP</button><br><br>
                        <button class="butonatloje" onclick="moveLeft()" id="butoniloja2">LEFT</button>
                        <button class="butonatloje" onclick="moveRight()" id="butoniloja3">RIGHT</button><br><br>
                        <button class="butonatloje" onclick="moveDown()" id="butoniloja4">DOWN</button>
                    </div>
                    <br />
                    <div style="text-align: center;">
                        <input type="text"  onkeydown="whatKey(event)" placeholder="Play with arrows..."/>
                    </div>
                    <audio src="extra/audio and video/gameTheme.mp3" controls autoplay style="margin-left: 310px;margin-top: 20px;">
                        Your browser does not support audio element.
                    </audio>                       
                    
                </div>    
                <br /><br /><br />
                <div style="text-align: center;">
                    <div id="keyfrdiv1"> </div>
                    <div id="keyfrdiv2"> </div>
                    <div id="keyfrdiv3"> </div>
                </div>

                <p id="readyOrder" style="display: none;">
                    Your order is done! <br />
                    An e-mail was sent to your e-mail address containing the purchase info!
                    Click <a href="extra/orderInfo.php#datadata" style="text-decoration: underline;color: green;">here</a> to view the order!
                    <br /> <?php printf("The total price is %s",$_SESSION['totaliEuro']) ?> &euro;. <br />
                </p>

                <!-- nese ka shenuar useri emrin, shfaqe ketu ne kete span te fshehur dhe 
                e perdorim pastaj tek loja per te ia shfaqur emrin -->
                <span id="emriShfrytezuesit" style="display: none;"> <?php if(isset($_COOKIE['user'])) echo $_COOKIE['user']; ?> </span>

            </div>

            

        </article>

    </main>

    <footer>
        <div>
            <div id="footer" >     
                <div id="social">
                    <h2>Follow Us</h2>            
                        <a href="https://www.facebook.com" target="_blank"><img src="images/socialmedia/modern_01.png" width="48" height="46" alt="Facebook logo"/></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="images/socialmedia/modern_02.png" width="47" height="46" alt="Twitter logo"/></a>
                        <a href="https://www.instagram.com" target="_blank"><img src="images/socialmedia/modern_04.png" width="48" height="46" alt="Instagram logo"/></a>
                        <a href="https://www.linkedin.com" target="_blank"><img src="images/socialmedia/modern_07.png" width="49" height="46" alt="LinkedIn logo"/></a>            
                </div>
                <div id="contact">
                    <h2>Contact Us</h2>
                    <p>Email: contact@sparta.com</p>
                    <p>Phone number: +377 44 007 007</p>
                    <p>Address: St. Eçrem Çabej, Fakulteti Teknik</p>
                    <p>Prishtina, Kosovo</p>
                </div>
            </div>
                
            <div id="copyright" style="margin-top: 50px;">
                <p>© 2017 Sparta - Designed by Us</p>            
            </div>
        </div>     
    
    </footer>


</div>    
    <script type="text/javascript" src="extra/game.js"> </script>
    
</body>

</html>