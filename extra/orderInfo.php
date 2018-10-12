<!DOCTYPE html>
<?php
    session_start();
?>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Order Info  </title>
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
        #datadata label
        {
            font-weight: bold;
        }
        #datadata
        {
            font-size: 1.3em;
            font-family: 'Trebuchet MS';
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
        button 
        {
            font-size: 1.1em;
            padding: 8px;
            /*background-color: coral;*/
            background: linear-gradient(to bottom right, coral,rgb(177, 89, 57));
            border: none;   
            border-radius: 4px;
            font-weight: bold;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        button:hover
        {
            cursor: pointer;
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

                <?php
                    // kodi per anulim dhe updatim te porosise
                    // DML
                    require_once("dbConfig.php");
                    $conn = new mysqli(DBhost, DBuser, DBpassword, DBname);

                    if ($conn->connect_error) 
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $data = date("Y-m-d H:i:s");

                    // shtoji ne DB te gjitha detajet lidhur me blerjen
                    $sql = "INSERT INTO orders (customerName, customerSurname, customerEmail, creditCard, dateOfOrder, totalPrice)
                            VALUES ('". mysqli_real_escape_string($conn, $_SESSION['firstname'])."', 
                            '". mysqli_real_escape_string($conn, $_SESSION['surname'])."', 
                            '".mysqli_real_escape_string($conn, $_SESSION['email'])."', 
                            '".mysqli_real_escape_string($conn, $_SESSION['cardnumber'])."', 
                            '".mysqli_real_escape_string($conn, $data)."', 
                            ".mysqli_real_escape_string($conn, $_SESSION['totaliEuro']).")";
                                  
                    if ($conn->query($sql) === TRUE) 
                    {
                        // marrim id e fundit te sapo insertuar (PRIMARY KEY)
                        // sepse do ta perdorim me tutje kur te fshijme ose bejme update
                        // ne bazen e shenimeve
                        $last_id = $conn->insert_id;
                    } else 
                    {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    // shtoje ne DB rekordin me adresen e bleresit
                    $sql = "INSERT INTO addressOrder 
                    VALUES (".$last_id.",'".$_SESSION['arrrrr'][0]."', '".$_SESSION['arrrrr'][1]."', '".$_SESSION['arrrrr'][2]."', '".$_SESSION['arrrrr'][3]."', '".$_SESSION['addressO']."')";
                    
                    if ($conn->query($sql) === TRUE) 
                    {
                    } 
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    // per cdo produkt te blere shtoje nga nje rekord ne DB
                    foreach($_SESSION['items'] as $itemi)
                    {
                        $sql = "INSERT INTO orderDetails
                        VALUES (".$last_id.", '".$itemi."')";
                    
                        if ($conn->query($sql) === TRUE) 
                        {
                        } 
                        else 
                        {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $_SESSION['lastOrderId'] = $last_id;

                    $conn->close();


                ?>
                <p id="datadata">
                    <label> Name: </label> <?php echo $_SESSION['firstname'];?><br />
                    <label> Surname: </label> <?php echo $_SESSION['surname'];?><br />
                    <label> E-mail: </label> <?php echo $_SESSION['email'];?><br />
                    <label> Date of order: </label> <?php echo $data ?><br />
                    <label> Country: </label> <?php echo $_SESSION['arrrrr'][0];?><br />
                    <label> Region: </label> <?php echo $_SESSION['arrrrr'][1];?><br />
                    <label> City: </label> <?php echo $_SESSION['arrrrr'][2];?><br />
                    <label> Postal Code: </label> <?php echo $_SESSION['arrrrr'][3];?><br />
                    <label> Address: </label> <?php echo $_SESSION['addressO'];?><br />
                    <label> Total price: </label> <?php echo $_SESSION['totaliEuro'];?> &euro;<br />


                </p>

                <p>
                    Press "Cancel Order" if you want to cancel your order, press "Update Order"
                    if you want to update the address information of your order and press
                    "Confirm Order" if your data is correct and you want to confirm your order.
                </p>
                <div align="center" style="margin: 20px;">
                    <div style="display: inline-block;">
                        <form method="POST" action="DMLpage.php#dmldml" >
                            <input type="hidden" name="cancelOrder" value="cancel" />
                            <button> Cancel Order</button>
                        </form>
                    </div>
                    <div style="display: inline-block;">
                            <a href="update.php#contactForm"><button> Update Order</button></a>
                    </div>
                    <div style="display: inline-block;">
                        <form method="POST" action="DMLpage.php#dmldml" >
                            <input type="hidden" name="cancelOrder" value="confirm" />
                            <button> Confirm Order</button>
                        </form>
                    </div>
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