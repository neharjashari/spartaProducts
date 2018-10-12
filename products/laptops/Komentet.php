<!DOCTYPE html>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Comments  </title>
    <link rel="stylesheet" href="../../style.css"/>
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
        table, tr, td, th
        {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            font-size: 1.1em;
            background-color: white;
        }
        caption
        {
            font-weight: bold;
            font-size: 1.5em;
            margin-bottom: 16px;
        }
		

    </style>
    <script src="../../extra/jquery-3.2.1.js"> </script>
    <script src="../../extra/scrollNav.js"> </script>
</head>

<body>
    <header>
        <nav>
            <div style="float: left; margin-left: 80px; margin-top: 5px;padding-top: 4px;"> 
                <a href="../../index.html"><img src="../../images/icon.png" width="300" height="50" alt="Company Logo"/></a>
            </div>
            <div style="float:right; margin-right: 40px;padding-top: 5px;">
                <ul>
                    <li> <a href="../../home.php"> Home </a></li>
                    <li> <a href="../../about.html"> About us </a></li>
                    <li> <a href="../../products.html" class="active"> Products </a></li>
                    <li> <a href="../../merchandise.html"> Merchandise </a></li>
                    <li> <a href="../../contact.html"> Contact </a></li>
                </ul>
            </div>
        </nav>
        <hr/>

        <div id="banner">
            <img src="../../images/1_1920.jpg" width="100%" height="700" alt="Image showing tech products of all kinds. On a table, Mac PC, tablet, keyboard and a mouse"/> 
        </div>

    </header>


    <main>
        <span id="komentetID"> </span>
        <article>
            <div class="artikujt">
            <table>
                <caption> Comments </caption>
                <?php
                    $censored = array("stupid","shit","idiot","fuck");

                    try
                    {
                        $file = fopen("komentet.txt",'r');
                    }
                    catch(Exception $ex)
                    {
                        echo $ex;
                        exit("File could not be opened!");
                    }
                    
                    flock($file, LOCK_EX);
                    $i = 0;
                    // perderisa nuk eshte arritur fundi i files perserit unazen
                    while(!feof($file))
                    {
                        if($i%4==1 || $i%4==3)
                            echo "<tr style='font-weight: bold;'>";
                        else
                            echo "<tr>";
                        if($i%4==0 || $i%4==1)
                            echo "<td>";
                        else
                            echo "<td style='background-color: RGB(229,229,229);'>";
                        
                        $komenti = str_replace($censored,"****",fgets($file));
                        echo $komenti;
                        
                        echo "</td>";
                        echo "</tr>";
                        
                        $i++;
                    }
                    flock($file, LOCK_UN);
                    fclose($file);
                ?>
            </table>
				
            </div>

            

        </article>

    </main>
    <footer>
        <div>
            <div id="footer" >     
                <div id="social">
                    <h2>Follow Us</h2>            
                        <a href="https://www.facebook.com" target="_blank"><img src="../../images/socialmedia/modern_01.png" width="48" height="46" alt="Facebook logo"/></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="../../images/socialmedia/modern_02.png" width="47" height="46" alt="Twitter logo"/></a>
                        <a href="https://www.instagram.com" target="_blank"><img src="../../images/socialmedia/modern_04.png" width="48" height="46" alt="Instagram logo"/></a>
                        <a href="https://www.linkedin.com" target="_blank"><img src="../../images/socialmedia/modern_07.png" width="49" height="46" alt="LinkedIn logo"/></a>            
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