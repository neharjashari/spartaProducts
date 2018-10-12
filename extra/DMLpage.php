<!DOCTYPE html>
<?php
    session_start();
?>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Final Order  </title>
    <link rel="stylesheet" href="../style.css"/>
    <style>
        article
        {
            width: 100%;
        }
        #imazhi
        {
            text-align: center;
        }
        #orderthisitem
        {
            background-color: coral;
            border: none;
            border-radius: 20px;
            padding: 5px;
        }
        #orderthisitem:hover
        {
            background-color: RGB(233,116,74);
        }
        #submitbtn
        {
            background-color: coral;
        }
        #submitbtn:hover
        {
            background-color: rgb(212, 107, 69);
            cursor: pointer;
        }
        #dmldml p
        {
            font-family: 'Trebuchet MS';
            font-size: 1.4em;
        }
		

    </style>
    <script src="jquery-3.2.1.js"> </script>
    <script src="scrollNav.js"> </script>
</head>

<body>
    <header>
        <nav>
            <div style="float: left; margin-left: 80px; margin-top: 5px;padding-top: 4px;"> 
                <a href="index.html"><img src="../images/icon.png" width="300" height="50" alt="Company Logo"/></a>
            </div>
            <div style="float:right; margin-right: 40px;padding-top: 5px;">
                <ul>
                    <li> <a href="../home.php"> Home </a></li>
                    <li> <a href="../about.html"> About us </a></li>
                    <li> <a href="../products.html" class="active"> Products </a></li>
                    <li> <a href="../merchandise.html"> Merchandise </a></li>
                    <li> <a href="../contact.html"> Contact </a></li>
                </ul>
            </div>
        </nav>
        <hr/>
        
        
        <div id="banner">
            <img src="../images/1_1920.jpg" width="100%" height="700" alt="Image showing tech products of all kinds. On a table, Mac PC, tablet, keyboard and a mouse"/> 
        </div>

    </header>


    <main>
        <article>
            
            <div class="artikujt">

                <div id="dmldml">
                <?php

                    require_once("dbConfig.php");
                    $conn = new mysqli(DBhost, DBuser, DBpassword, DBname);

                    if ($conn->connect_error) 
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // nese kemi arritur ne kete faqe me ane te POST dhe kemi shtypur butonin per cancel
                    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['cancelOrder']=="cancel")
                    {
                        // fshije porosine nga DB
                        $sql = "DELETE FROM orders WHERE orderId=".$_SESSION['lastOrderId'];

                        if ($conn->query($sql) === TRUE) 
                        {
                            echo "<p>You have successfully canceled your order!</p>";
                        } 
                        else 
                        {
                            echo "Error deleting record: " . $conn->error;
                        }                     
                    }
                    // perndryshe nese eshte shtypur butoni konfirmo
                    else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['cancelOrder']=="confirm")
                    {
                        echo "<p>You have confirmed your order successfully!</p>";
                    }
                    // perndryshe (pra eshte shtypur butoni update)
                    else
                    {
                        $sql = "UPDATE addressOrder SET country='".mysqli_real_escape_string($conn, $_SESSION['arrrrr'][0])."',
                        region='".mysqli_real_escape_string($conn, $_SESSION['arrrrr'][1])."',
                        city='".mysqli_real_escape_string($conn, $_SESSION['arrrrr'][2])."',
                        postalCode='".mysqli_real_escape_string($conn, $_SESSION['arrrrr'][3])."',
                        addressOrder='".mysqli_real_escape_string($conn, $_SESSION['addressO'])."' 
                        WHERE orderid=".mysqli_real_escape_string($conn, $_SESSION['lastOrderId']);

                        if ($conn->query($sql) === TRUE) 
                        {
                            echo "<p>You have successfully updated your order information and your order is confirmed!</p>";
                        } 
                        else 
                        {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                    // shkaterroje sesionin
                    session_destroy();

                    // mbylle lidhjen
                    $conn->close();
                ?>
                </div>
                
            </div>

        </article>

    </main>
    
    <footer>
        <div>
            <div id="footer" >     
                <div id="social">
                    <h2>Follow Us</h2>            
                        <a href="https://www.facebook.com" target="_blank"><img src="../images/socialmedia/modern_01.png" width="48" height="46" alt="Facebook logo"/></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="../images/socialmedia/modern_02.png" width="47" height="46" alt="Twitter logo"/></a>
                        <a href="https://www.instagram.com" target="_blank"><img src="../images/socialmedia/modern_04.png" width="48" height="46" alt="Instagram logo"/></a>
                        <a href="https://www.linkedin.com" target="_blank"><img src="../images/socialmedia/modern_07.png" width="49" height="46" alt="LinkedIn logo"/></a>            
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
	
	
</body>




</html>