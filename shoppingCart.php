<!DOCTYPE html>
<?php

    session_start();
    // krijojme cookiet pa vlera te sakta
    setcookie("user","undefinedUser", time() + (86400*30));
    setcookie("country","undefinedCountry", time() + (86400*30));
?>
<html>

<head lang="en">
    <meta charset="urf-8"/>
    <title> ThisIsSparta.com: Shopping Cart </title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="productstyle.css"/>
    <style>
        article
        {
            width: 100%;
        }
        button:hover
        {
            cursor: pointer;
        }
		
    </style>
    <script src="extra/jquery-3.2.1.js"> </script>
    <script src="extra/scrollNav.js"> </script>
</head>

<body>
    <?php
        // code reuse
        require_once("extra/header.php");
        $hederi1 = new Header();
        // implementimi i set
        $hederi1->srcbanner = "images/busss.jpg";
        $hederi1->shfaq();

        // nese ka arritur ketu permes POST (pra ka shtypur ORDER ITEM tek ndonjeri nga produktet)
        // ose ka fshire ndonjerin nga produktet momentale
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // nese kemi ardhur nga prekja e ORDER ITEM
            if(isset($_POST['vlera']))
            {
                // nese nuk ka ndonje produkt tjeter tashme ne shoppingCart startoje numeruesin
                // numerues ky i cili na duhet per te ditur sa itema i ka porositur
                if(!isset($_SESSION['numeruesi']))
                    $_SESSION['numeruesi'] = 0;
                // marrim cilin produkt e ka zgjedhur (p.sh. laptop1, smartphone1,...)
                $itemsi = $_POST['vlera'];
                // nese ka produkte tjera variabla array i merr te gjitha ato
                if(isset($_SESSION['items']))
                    $array = $_SESSION['items'];
                // perndryshe krijo nje array te ri
                else
                    $array = array();

                // shtojme blerjen e re ne array (array permban laptop1, laptop2, smartphone1)
                $array[$_SESSION['numeruesi']] = $itemsi;
                // rrisim numeruesin
                $_SESSION['numeruesi'] = $_SESSION['numeruesi'] + 1;
                // ia kthejme ate array te modifikuar sesionit 
                $_SESSION['items'] = $array;
            }
            // perndryshe nese eshte shtypur butoni cancel (pra eshte fshire ndonjeri produkt)
            else if(isset($_POST['cancel']))
            {
                // marrim numrin se cili produkt eshte fshire
                $var = $_POST['cancel'];
                // nese ka produkte
                if(isset($_SESSION['items']))
                {
                    // fshije ate produkt qe eshte selektuar
                    unset($_SESSION['items'][$var]);
                    // zbrite numeruesin (pra tash jane produkte me pak)
                    $_SESSION['numeruesi'] = $_SESSION['numeruesi'] - 1;
                    // krijo nje array te ri
                    $arrayri = array();
                    $varia = 0;
                    // meqe kemi fshire nje produkt atehere array ka mbetur i parregullt,
                    // pra p.sh. mungon elementi 2 dhe kercejme nga 1shi tek 3shi
                    // keshtuqe krijojme nje array te ri nga ato produkte te mbetura 
                    // dhe e strukturojme siq duhet arrayn e sesionit
                    foreach($_SESSION['items'] as $numri)
                    {
                        $arrayri[$varia] = $numri;
                        $varia = $varia + 1;
                    }
                    $_SESSION['items'] = $arrayri; 
                    // nese jane fshire te gjitha produktet atehere zhduke sesionin
                    if(sizeof($_SESSION['items'])==0)
                    {
                        session_unset();
                        session_destroy();
                    } 
                }
            }
        }
       
        
    ?>

    <main>
        <article id="kartela">
            <div class="artikujt">
                <div class="label">
                    ITEMS ORDERED
                </div>
                <div>
                    <?php
                    // nese ka produkte
                    if(isset($_SESSION['items']))
                    {
                        try
                        {
                            require_once("extra/dbConfig.php");
                            $db = new mysqli(DBhost, DBuser, DBpassword, DBname);
                        }
                        catch(Exception $ex)
                        {
                            echo "Gabim: ".$ex;
                        }

                        if(mysqli_connect_errno())
                        {
                            echo "Error: Could not connect to database. Please try again later!";
                            exit;
                        }
                        else
                        {
                            // echo "Connected succesfully";
                        }

                        echo '<table id="orderedTable">
                            <tr>
                                <th> Photo </th>
                                <th> Name </th>
                                <th> Price </th>
                                <th>  </th>
                            </tr>';
                            $ndihmese = 0;
                            // cmimi total i porosise
                            $totaliEuro = 0;
                            // per cdo produkt qe kemi bere "ORDER"
                            foreach($_SESSION['items'] as $itemi)
                            {   
                                $perquery = $itemi;
                                // marrim te dhenat per ate produkt nga DB
                                $query = "select * from products where id='$perquery'";
                                $result = $db->query($query);

                                $row = $result->fetch_assoc();

                                $foto=$row['photo'];
                                $emri=$row['name'];
                                $cmimi=$row['price'];
                                // rrisim cmimin nga te dhenat e DB
                                $totaliEuro = $totaliEuro + $cmimi;

                                echo '<tr>
                                        <td> 
                                            <img src='.$foto.' /> 
                                        </td>
                                        <td> 
                                            '.$emri.'
                                        </td>
                                        <td>
                                            '.$cmimi.' &euro;
                                        </td>
                                        <td>
                                        <form method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'#kartela">
                                            <input type="hidden" name="cancel" value="'.$ndihmese.'"/>
                                            <button style="background-color: white;border: none;"> <img src="images/delete.png" width="35"/> </button>
                                        </form>
                                        </td>
                                    </tr>';
                                    // tek forma ketu siper, kemi butonin X, i cili na mundeson te fshijme ndonjerin nga produktet
                                    // variabla ndihmese e cakton se cili produkt me rend eshte ne kete list
                                $ndihmese = $ndihmese + 1;
                            }
                            echo "<tr><th colspan='4' style='text-align: right;padding: 5px;font-weight: initial;'> Total amount: <b> $totaliEuro &euro; </b></th> </tr>";
                            echo '</table>';
                            // ia japim cmimin sesionit sepse na duhet edhe me vone
                            $_SESSION['totaliEuro'] = $totaliEuro;
                            $result->free();
                            $db->close();

                            echo '<br />
                            <a href="order.php#orderid" style="float: right;"> <button id="butoniPerOrder"> Order </button> </a>';
                    }

                    // fundi i php
                    ?>
                    
                </div>
            </div>

        </article>

    </main>

    <?php
        include_once("extra/footer.php");
        // array i arrayve
        $arrayyyy = array(array("https://www.facebook.com","_blank","images/socialmedia/modern_01.png","48","46","Facebook logo"),
                          array("https://www.twitter.com","_blank","images/socialmedia/modern_02.png","47","46","Twitter logo"),
                          array("https://www.instagram.com","_blank","images/socialmedia/modern_04.png","48","46","Instagram logo"),
                          array("https://www.linkedin.com","_blank","images/socialmedia/modern_07.png","49","46","Linkedin logo"));
        sort($arrayyyy);
        $footeri = new Footer();
        $footeri->shfaq($arrayyyy);
    ?>

</body>

</html>