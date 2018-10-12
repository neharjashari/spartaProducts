<!DOCTYPE html>
<?php
    session_start();
    
    $_SESSION['countryerror'] = "";
    $_SESSION['regionerror'] = "";
    $_SESSION['cityerror'] = "";
    $_SESSION['postalcodeerror'] = "";
    $_SESSION['addresserror'] = "";
    // nese ka shtypur POST (meqe faqja therret vetveten)
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST['country']))
        {
            $_SESSION['countryerror'] = "Please enter your country!";
        }
        else
        {
            $arrayDatalist = array("USA","GBR","FRA","ESP","KOS","ALB","DEU","JPN","ITA","POR","AUS","BRA","Other");
            if(!in_array($_POST['country'],$arrayDatalist))
            {
                $_SESSION['countryerror'] = "Please select one of the options!";
            }
        }
        if(empty($_POST['region']))
        {
            $_SESSION['regionerror'] = "Please enter your region!";
        }
        else
        {
            if(!preg_match("/^[a-zA-Z ]{2,}$/",$_POST['region']))
            {
                $_SESSION['regionerror'] = "You have entered an invalid region!";
            }
        }
        if(empty($_POST['postalcode']))
        {
            $_SESSION['postalcodeerror'] = "Please enter postal code number!";
        }
        else
        {
            if(!preg_match("/^[a-zA-Z0-9]{0,5}$/",$_POST['postalcode']))
            {
                $_SESSION['postalcodeerror'] = "The postal code number is invalid, please fix it!";
            }
        }

        if(empty($_POST['address']))
        {
            $_SESSION['addresserror'] = "Please enter your address!";
        } 
        
        
        if(isset($_SESSION['regionerror']) && $_SERVER["REQUEST_METHOD"] == "POST")
        {
            if($_SESSION['countryerror'] == "" && $_SESSION['regionerror'] == "" && $_SESSION['cityerror'] == "" && $_SESSION['postalcodeerror'] == "" && $_SESSION['addresserror'] == "")
            {
                unset($_SESSION['regionerror']);
                $array22 = array($_POST['country'], $_POST['region'], $_POST['cities'], $_POST['postalcode']);
                $_SESSION['addressO'] = $_POST['address'];
                $_SESSION['arrrrr'] = $array22;
                // nese gjithcka ne rregull shkojme tek DMLPage qe te insertojme te dhenat e reja
                // ne databaze
                header("Location: DMLpage.php#dmldml");
            }
        }
    }
?>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Update Order  </title>
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
        form p span.error
        {
            float: right;
            color: red;
            font-weight: bold;
            padding: 0px 10px;
            font-size: 0.8em;
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

                        <!-- htmlspecialchars tek action eshte mbrojtje nga sulmet ne URL -->
                        <form id="contactForm" class="forma" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contactForm">
                            <fieldset>
                                <legend> Input your data </legend>
                                
                                <p>
                                    <label> Country: </label>
                                    <input id="countries2" onchange="generateCities();" type="text" name="country" list="countries" placeholder="Select a country..."/>
                                    <datalist id="countries"> 
                                        <option value="USA"> United States </option> <option value="GBR"> United Kingdom </option> <option value="FRA"> France </option> <option value="ESP"> Spain </option>
                                        <option value="KOS"> Kosovo </option><option value="ALB"> Albania </option><option value="DEU"> Germany </option><option value="JPN"> Japan </option>
                                        <option value="ITA"> Italy </option><option value="PRT"> Portugal </option><option value="AUS"> Australia </option><option value="BRA"> Brazil </option> 
                                        <option value="Other"> Other </option>
                                    </datalist>
                                    <span class="error"> <?php echo $_SESSION['countryerror'] ?> </span>
                                </p>
                                <p>
                                    <label> Region: </label>
                                    <input type="text" name="region" placeholder="Enter region..." />
                                    <span class="error"> <?php echo $_SESSION['regionerror'] ?> </span>
                                </p>
                                <p>
                                <label> City: </label>
                                <select name="cities" id="cityList">

                                </select>
                                    <span class="error"> <?php echo $_SESSION['cityerror'] ?> </span>
                                </p>
                                <p>
                                    <label> Postal Code: </label>
                                    <input type="text" name="postalcode" placeholder="Enter postal code..." />
                                    <span class="error"> <?php echo $_SESSION['postalcodeerror'] ?> </span>
                                </p>
                                <p>
                                    <label > Address: </label>
                                    <span style="font-style: italic;font-size: 0.8em;"> (If your country is not in the list please type it here) &nbsp;&nbsp; </span>
                                    <input type="text" name="address" placeholder="Enter your address..." size="50"/>
                                    <span class="error"> <?php echo $_SESSION['addresserror'] ?> </span>
                                </p>
                                
                                <p align="center">
                                    <input type="submit"/>
                                    <input type="reset"/>
                                </p>
                            </fieldset>
                        </form>
                        
                    
                
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
    
    <script>

        function generateCities()
        {
            var selectedValueDatalist = "" + document.getElementById("countries2").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("cityList").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET","../getCities.php?q="+selectedValueDatalist,true);
            xhttp.send();
        }

    </script>
	
</body>




</html>