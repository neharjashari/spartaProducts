<?php
    session_start();

    $_SESSION['nameerror'] = "";
    $_SESSION['surnameerror'] = "";
    $_SESSION['countryerror'] = "";
    $_SESSION['regionerror'] = "";
    $_SESSION['cityerror'] = "";        // depricated
    $_SESSION['emailerror'] = "";
    $_SESSION['postalcodeerror'] = "";
    $_SESSION['addresserror'] = "";
    $_SESSION['methodofpaymenterror'] = "";
    $_SESSION['discountcodeerror'] = "";
    $_SESSION['cardnumbererror'] = "";
    $_SESSION['validuntilerror'] = "";
    $_SESSION['cvcerror'] = "";
    // nese eshte shtypur blej tek ShoppingCart
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // nese emri i zbrazet
        if(empty($_POST['firstname']))
        {
            $_SESSION['nameerror'] = "Please enter your name!";
        }
        // perndryshe shikoje a permban vetem shkronja
        else
        {
            if(!preg_match("/^[a-zA-Z]{2,}$/",$_POST['firstname']))
            {
                $_SESSION['nameerror'] = "You have entered an invalid first name!";
            }
        }
        // nese mbiemri i zbrazet
        if(empty($_POST['surname']))
        {
            $_SESSION['surnameerror'] = "Please enter your surname!";
        }
        // perndryshe shikoje a permban vetem shkronja
        else
        {
            if(!preg_match("/^[a-zA-Z]{2,}$/",$_POST['surname']))
            {
                $_SESSION['surnameerror'] = "You have entered an invalid surname!";
            }
        }
        // nese email i zbrazet
        if(empty($_POST['e-mail']))
        {
            $_SESSION['emailerror'] = "Please enter your email!";
        }
        // perndryshe shikoje a i permbahet rregullave te nje emaili
        else
        {
            if(!preg_match("/^[a-zA-Z0-9_\-.]{3,}@[a-zA-Z0-9\-]{3,}+\.[a-zA-Z0-9\-.]{2,}$/",$_POST['e-mail']))
            {
                $_SESSION['emailerror'] = "Please enter a valid e-mail address!";
            }
        }
        // nese country eshte lene i thate
        if(empty($_POST['country']))
        {
            $_SESSION['countryerror'] = "Please enter your country!";
        }
        // perndryshe shiko a eshte zgjedhur ndonjeri nga keto opsione 
        else
        {
            $arrayDatalist = array("USA","GBR","FRA","ESP","KOS","ALB","DEU","JPN","ITA","POR","AUS","BRA","Other");
            if(!in_array($_POST['country'],$arrayDatalist))
            {
                $_SESSION['countryerror'] = "Please select one of the options!";
            }
        }
        // nese regjioni i thate 
        if(empty($_POST['region']))
        {
            $_SESSION['regionerror'] = "Please enter your region!";
        }
        // perndryshe validoje qe te permbaje vetem shkronja
        else
        {
            if(!preg_match("/^[a-zA-Z ]{2,}$/",$_POST['region']))
            {
                $_SESSION['regionerror'] = "You have entered an invalid region!";
            }
        }
        // nese discount code nuk eshte i thate shikoje a eshte shenuar ne rregull
        if(!empty($_POST['discountCode']))
        {
            if(!preg_match("/^[0-9]{3,8}KK[0-9]{3,8}FXV$/",$_POST['discountCode']))
            {
                $_SESSION['discountcodeerror'] = "You have entered an incorrect discount code!";
            }
        }
        // nese postalCode eshte i thate
        if(empty($_POST['postalcode']))
        {
            $_SESSION['postalcodeerror'] = "Please enter postal code number!";
        }
        // perndryshe shikoje a i permbahet rregullave te Kodeve postale
        else
        {
            if(!preg_match("/^[a-zA-Z0-9]{0,5}$/",$_POST['postalcode']))
            {
                $_SESSION['postalcodeerror'] = "The postal code number is invalid, please fix it!";
            }
        }
        // nese adresa eshte e thate
        if(empty($_POST['address']))
        {
            $_SESSION['addresserror'] = "Please enter your address!";
        }   
        // nese metoda e pageses eshte e thate
        if(empty($_POST['payment']))
        {
            $_SESSION['methodofpaymenterror'] = "Please select a method of payment!";
        }
        // nese numri i karteles eshte i thate
        if(empty($_POST['cardnumber']))
        {
            $_SESSION['cardnumbererror'] = "Please enter a card number!";
        }
        // perndryshe shikoje varesisht se cfare kartele ka zgjedhur dhe validoje
        else
        {
            if(!empty($_POST['payment']))
            {
                $method = $_POST['payment'];
                switch($method)
                {
                    case 'visa':
                        {
                            if(!preg_match("/^4[0-9]{12}(?:[0-9]{3})?$/",$_POST['cardnumber']))
                            {
                                $_SESSION['cardnumbererror'] = "This is not a valid Visa card number!";
                            }
                            break;
                        }
                    case 'mastercard':
                        {
                            if(!preg_match("/^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/",$_POST['cardnumber']))
                            {
                                $_SESSION['cardnumbererror'] = "This is not a valid MasterCard card number!";
                            }
                            break;
                        }
                    case 'discover':
                        {
                            if(!preg_match("/^6(?:011|5[0-9]{2})[0-9]{12}$/",$_POST['cardnumber']))
                            {
                                $_SESSION['cardnumbererror'] = "This is not a valid Discover card number!";
                            }
                            break;                                
                        }
                    case 'americanexpress':
                        {
                            if(!preg_match("/^3[47][0-9]{13}$/",$_POST['cardnumber']))
                            {
                                $_SESSION['cardnumbererror'] = "This is not a valid American Express card number!";
                            }
                            break;
                        }
                }
            }
        }
        // nese viti eshte 2018 dhe muaji me i vogel se 7 mos e lere te porosis
        if($_POST['yearvalid']==2018 && $_POST['monthvalid']<7)
        {
            $_SESSION['validuntilerror'] = "Please enter a valid date!";
        }
        // nese CVC eshte e zbrazet
        if(empty($_POST['cvc']))
        {
            $_SESSION['cvcerror'] = "Please enter your Card Verification Code!";
        }
        // perndryshe shikoje a i permbahet rregullave te CVC-ve
        else
        {
            if(!empty($_POST['payment']))
            {
                $method = $_POST['payment'];
                if($method=='visa' || $method=='mastercard' || $method=='discover')
                {
                    if(!preg_match("/^[0-9]{3}$/",$_POST['cvc']))
                    {
                        $_SESSION['cvcerror'] = "Please enter a valid Card Verification Code!";
                    }
                }
                else
                {
                    if(!preg_match("/^[0-9]{4}$/",$_POST['cvc']))
                    {
                        $_SESSION['cvcerror'] = "Please enter a valid Card Verification Code!";
                    }
                }
            }
        }
        

    }

    // nese nameerror eshte i vendosur (nuk dmth qe ka error, shiko rreshtin 207) dhe metoda eshte POST
    if(isset($_SESSION['nameerror']) && $_SERVER["REQUEST_METHOD"] == "POST")
    {
        // nese nuk ka asnje gabim
        if($_SESSION['nameerror'] == "" && $_SESSION['surnameerror'] == "" && $_SESSION['countryerror'] == "" && $_SESSION['regionerror'] == "" && $_SESSION['emailerror'] == "" && $_SESSION['discountcodeerror']=="" && $_SESSION['cityerror'] == "" && $_SESSION['postalcodeerror'] == "" && $_SESSION['addresserror'] == "" && $_SESSION['methodofpaymenterror'] == "" && $_SESSION['cardnumbererror'] == "" && $_SESSION['validuntilerror'] == "" && $_SESSION['cvcerror'] == "")
        {
            // beja unset nameerror-it
            unset($_SESSION['nameerror']);
            $_SESSION['discountCode']=$_POST['discountCode'];
            $_SESSION['email'] = $_POST['e-mail'];
            $_SESSION['paymentcardd'] = $_POST['payment'];
            $_SESSION['cardnumber'] = $_POST['cardnumber'];
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['surname'] = $_POST['surname'];
            $_SESSION['country'] = $_POST['country'];
            $array22 = array($_POST['country'], $_POST['region'], $_POST['cities'], $_POST['postalcode']);
            $_SESSION['addressO'] = $_POST['address'];
            $_SESSION['arrrrr'] = $array22;
            // nese ka COOKIE te vendosur 
            if(count($_COOKIE)>0)
            {
                setcookie("user",$_SESSION['firstname'], time() + (86400*30));
                setcookie("country",$_SESSION['country'], time() + (86400*30));
            }
            else
            {
                // input code
            }
            // nese gjithcka ka shkuar ne rregull porosia eshte gati dhe nderroje URL-ne
            header("Location: redirect.php#gamep");
        }
    }
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Order </title> 
    <link rel="stylesheet" href="style.css" />
    <style>
        article
        {
            width: 100%;
        }
        form p span.error
        {
            float: right;
            color: red;
            font-weight: bold;
            padding: 0px 10px;
            font-size: 0.8em;
        }
        #paymentMethodsRadio span
        {
            padding: 0px 10px;
            float: right;
        }
    </style>
    <script src="extra/jquery-3.2.1.js"> </script>
    <script src="extra/scrollNav.js"> </script>
    
</head>

<body>

    <?php
        
    ?>

    <?php
        // code reuse
        require_once("extra/header.php");
        $hederi1 = new Header();
        $hederi1->shfaq();
    ?>

    <main>

        <article id="orderid">
            <div class="artikujt">

                <form id="contactForm" class="forma" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contactForm">
                    <fieldset>
                        <legend> Input your data </legend>
                        <p>
                            <label> First name: </label>
                            <input id="fname" type="text" name="firstname" placeholder="Enter your first name..." />
                            <span class="error"> <?php echo $_SESSION['nameerror'] ?> </span>
                        </p>
                        <p>
                            <label> Surname: </label>
                            <input id="fsurname" type="text" name="surname" placeholder="Enter your surname..." />
                            <span class="error"> <?php echo $_SESSION['surnameerror'] ?> </span>
                        </p>
                        <p>
                            <label> E-mail: </label>
                            <input id="emailAddress" type="email" name="e-mail" />
                            <span class="error"> <?php echo $_SESSION['emailerror'] ?> </span>
                        </p>
                        <hr />
                        
                        <p>
                            <label> Discount code: </label>
                            <input type="text" name="discountCode" placeholder="Enter the discount code..."/>
                            <span class="error"> <?php echo $_SESSION['discountcodeerror'] ?> </span>
                        </p>
                        
                        <hr />
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
                        

                        <hr />
                        <p id="paymentMethodsRadio">
                            <label> Method of payment:  </label> 
                            <span><input type="radio" name="payment" value="visa" onchange="setPlaceHolder();"/> <img src="images/payment/visa.png" alt="Visa logo" height="22"/> </span>
                            <span><input type="radio" name="payment" value="mastercard" onchange="setPlaceHolder();"/> <img src="images/payment/mastercard.png" alt="Visa logo" height="22"/></span>
                            <span><input type="radio" name="payment" value="americanexpress" onchange="setPlaceHolder();"/> <img src="images/payment/americanexpress.png" alt="Visa logo" height="22"/></span>
                            <span><input type="radio" name="payment" value="discover" onchange="setPlaceHolder();"/> <img src="images/payment/discover.png" alt="Visa logo" height="22"/></span>
                            <span class="error"> <?php echo $_SESSION['methodofpaymenterror'] ?> </span>
                        </p>
                        <p>
                            <label> Card Number: </label>
                            <input id="cardNumber" type="text" name="cardnumber" size="30" />
                            <span class="error"> <?php echo $_SESSION['cardnumbererror'] ?> </span>
                        </p>
                        <p>
                            <label> Valid Until: </label>
                            <select name="monthvalid">
                                <option value="1"> 1 </option> <option value="2"> 2 </option > <option value="3"> 3 </option> <option value="4"> 4 </option>
                                <option value="5"> 5 </option> <option value="6"> 6 </option> <option value="7"> 7 </option> <option value="8"> 8 </option>
                                <option value="9"> 9 </option> <option value="10"> 10 </option> <option value="11"> 11 </option> <option value="12"> 12 </option> 
                            </select>
                            
                            <select name="yearvalid" >
                                <option value="2018"> 2018 </option><option value="2019 "> 2019 </option><option value="2020"> 2020 </option><option value="2021"> 2021 </option>
                                <option value="2022"> 2022 </option><option value="2023"> 2023 </option><option value="2024"> 2024 </option><option value="2025"> 2025 </option><option value="2026"> 2026 </option>
                            </select>
                            <span class="error"> <?php echo $_SESSION['validuntilerror'] ?> </span>
                            <br /><br />
                            
                            <label> CVC: </label> 
                            <input type="text" name="cvc" />
                            <span class="error"> <?php echo $_SESSION['cvcerror'] ?> </span>
                        </p>
                        <p align="center">
                            <input type="submit"/>
                            <input type="reset"/>
                        </p>
                    </fieldset>
                </form>

                <br /><br />
                
                
            </div>
        </article>

    </main>

    <?php
        include_once("extra/footer.php");
        $arrayyyy = array(array("https://www.facebook.com","_blank","images/socialmedia/modern_01.png","48","46","Facebook logo"),
                          array("https://www.twitter.com","_blank","images/socialmedia/modern_02.png","47","46","Twitter logo"),
                          array("https://www.instagram.com","_blank","images/socialmedia/modern_04.png","48","46","Instagram logo"),
                          array("https://www.linkedin.com","_blank","images/socialmedia/modern_07.png","49","46","Linkedin logo"));
        $footeri = new Footer();
        arsort($arrayyyy);
        $footeri->shfaq($arrayyyy);
    ?>

    <script>
        function setPlaceHolder()
        {
            var radios = document.getElementsByName("payment");
            var selectedValue = "";
            for(var i = 0 ; i < radios.length; i++)
            {
                if(radios[i].checked)
                {
                    selectedValue = radios[i].value;
                }
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("cardNumber").setAttribute("placeholder",""+this.responseText);
                    // this.responseText eshte ekuivalente me shtypjen echo nga faqja setPlaceHolder.php
                }
            };
            xhttp.open("GET","setPlaceHolder.php?q="+selectedValue,true);
            xhttp.send();   
        }

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
            xhttp.open("GET","getCities.php?q="+selectedValueDatalist,true);
            xhttp.send();
        }

    </script>

</body>

</html>