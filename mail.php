<!DOCTYPE html>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Mail  </title>
    <link rel="stylesheet" href="style.css"/>
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
		

    </style>
    <script src="extra/jquery-3.2.1.js"> </script>
    <script src="extra/scrollNav.js"> </script>
</head>

<body>
    <header>
        <nav>
            <div style="float: left; margin-left: 80px; margin-top: 5px;padding-top: 4px;"> 
                <a href="index.html"><img src="images/icon.png" width="300" height="50" alt="Company Logo"/></a>
            </div>
            <div style="float:right; margin-right: 40px;padding-top: 5px;">
                <ul>
                    <li> <a href="home.php"> Home </a></li>
                    <li> <a href="about.html"> About us </a></li>
                    <li> <a href="products.html" class="active"> Products </a></li>
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
        <article>
            <span id="konfirmimi"> </span>
            <div class="artikujt">
                <div style="font-size: 1.3em;">
                <h2 id="konfirmimi">DETAILS</h2>   
                <hr />
                <?php

                // funksioni qe do te perdorim per te filtruar te dhenat nga useri
                // ashtu qe te parandalojme SQL Injections
                function filter_inputData($data)
                {
                    $data = trim($data);
                    $data = addslashes($data);
                    $data = htmlentities($data);
                    return $data;
                }

                // thirrim konfiguracionin per bazen e te dhenave
                require_once("extra/dbConfig.php");
                // Create connection
				$conn = new mysqli(DBhost, DBuser, DBpassword, DBname);
				
                if ($conn->connect_error) 
                {
					die("Connection failed: " . $conn->connect_error);
				}


                if(isset($_POST['email'])) 
                {
                    $email_to = "contact@sparta.com";
                    $email_subject = "Sparta Products - Costumer Service";
                
                    function died($error) 
                    {
                        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
                        echo "These errors will appear below.<br /><br />";
                        echo $error."<br /><br />";
                        echo "Please go back and fix these errors.<br /><br />";
                        die();
                    }
                    
                    // nese nuk plotesojme ndonjeren nga fushat
                    if(!isset($_POST['firstname']) ||
                        !isset($_POST['surname']) ||
                        !isset($_POST['email']) ||
                        !isset($_POST['phonenumber']) ||
                        !isset($_POST['comments']) ||
                        !isset($_POST['topic']))
                    {
                        died('We are sorry, but there appears to be a problem with the form you submitted.');       
                    }

                    // dergimi i te dhenave ne databaze me prepared statements
					$stmt = $conn->prepare("INSERT INTO mail (firstName, lastName, 
                    mailFrom, telephone, comments, topic) VALUES (?, ?, ?, ?, ?, ?)");

                    // me "ssssss" i tregojme qe te gjitha te dhenat jane stringje
                    $stmt->bind_param("ssssss", $first_name, $last_name, $email_from, $telephone, $comments, $topic);
                
                    // perdorim funksionin e mesiperm per te filtruar te dhenat e userit para
                    // se t'i fusim ne DB
                    $first_name = filter_inputData($_POST['firstname']);
                    $last_name = filter_inputData($_POST['surname']); 
                    $email_from = filter_inputData($_POST['email']); 
                    $telephone = filter_inputData($_POST['phonenumber']);
                    $comments = filter_inputData($_POST['comments']); 
                    $topic = filter_inputData($_POST['topic']);
                
                    $error_message = "";
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                
                    if(!preg_match($email_exp,$email_from)) 
                    {
                        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
                    }
                
                    $string_exp = "/^[A-Za-z .'-]+$/";
                
                    if(!preg_match($string_exp,$first_name)) 
                    {
                        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
                    }
                
                    if(!preg_match($string_exp,$last_name)) 
                    {
                        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
                    }
                  
                  
                    if(!isset($topic)) 
                    {
                        $error_message .= 'You have to specify the topic you want to contact for.<br />';
                    }
                
                    if(strlen($comments) < 2) 
                    {
                        $error_message .= 'The Description you entered does not appear to be valid.<br />';
                    }
                
                    if(strlen($error_message) > 0) 
                    {
                        died($error_message);
                    } 
                
                  
                    $comments = trim($comments);
                
                
                    $email_message = array("Firstname: " => $first_name, "Lastname: " => $last_name, "Email from: " => $email_from,
                              "Phone number: " => $telephone, "Subject: " => $email_subject, 
                              "Topic: " => $topic, "Description: " => $comments);
                              
                    krsort($email_message);

                    // ekzekutojme queryt e mesiperm
                    $stmt->execute();	
                    $stmt->close();
                    $conn->close();
                
                    // i dergojme email websites
                    @mail($email_to, $email_subject, $email_message, $email_from);
                    // dhe userit nje kopje
                    @mail($email_from, $email_subject, $email_message, $email_from);
                  
                    echo "<h2>Your message was send to Sparta Products in this format:</h2>";
                    foreach($email_message as $titulli => $info)
                    {
                        echo "<p><strong>".$titulli."</strong>".$info."</p>";	
                    }

                    echo "<p> A copy of the mail was sent to you too! </p>";

                    $arrarr = preg_split("/[@|\.]/",$email_from);
                    if($arrarr[sizeof($arrarr)-1] == "edu")
                    {
                        echo "<p style='font-size: 0.8em;'> With an .edu email address come 5% discount, plus shorter response time! What are you waiting for, <a href='products.html'>start shopping!</a></p>";
                    }

                }

	
?>
 
  

            <br>
            <h1>Thank you for contacting us. We will be in touch with you very soon.</h1>


                <button type="button" style="margin-left: 41%;background-color: coral;border: 1px solid black; padding: 6px; font-size: 0.6em;"><a href="home.php" style="text-decoration:none;color:#000000">
                        Go back to main page</a>
                </button> 			
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
	
	
</body>




</html>