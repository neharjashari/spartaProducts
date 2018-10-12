<!DOCTYPE html>

<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Details  </title>
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
        
        <?php
            // thirrim headerin (riperdorimi i kodit)
            require_once("../../extra/header.php");
            $hederii = new Header();
            // shiko me poshte implementimin e GET
        ?>
        <div id="banner">
            <!-- thirrim atributin srcbanner te objektit $hederii i krijuar nga klasa Header-->
            <img src="../../<?php echo $hederii->srcbanner?>" width="100%" height="700" alt="Image showing tech products of all kinds. On a table, Mac PC, tablet, keyboard and a mouse"/> 
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
                    
                    $CommentBtn = $_POST["CommentBtn"];
                    echo "<table>";
                    $data = date('H:i, jS F Y');
                    echo "<p>Comment written at: ".$data."</p>";
                    
                    $komentt = preg_replace("/(shit|idiot|stupid|fuck)/","****",htmlspecialchars($CommentBtn));
                    echo "Comment: ".$komentt;

                    try
                    {
                        $file = fopen("komentet.txt",'a+');
                    }
                    catch(Exception $ex)
                    {
                        echo $ex;
                        exit("Could not be opened!");
                    }

                    flock($file, LOCK_EX);
                    if(filesize("komentet.txt")==0)
                    {
                        $teksti=$data."\r\n".$CommentBtn;
                    }
                    else
                    {
                        $teksti="\r\n".$data."\r\n".$CommentBtn;
                    }
                    // shkruajme komentine ne file
                    fwrite($file,$teksti);
                    flock($file, LOCK_UN);
                    fclose($file);
                    echo "</table>";
                    echo "<br> <br>";
                ?>
                <a href="Komentet.php#komentetID"> <span style="color: coral";>Click here</span> to see all comments </a>
                </div>    			
            </div>

            

        </article>

    </main>
    <?php

        include_once("footer1.php");
        // array i arrayve asociativ
        $arrrrrr = array(array("href"=>"https://www.facebook.com","target"=>"_blank","src"=>"../../images/socialmedia/modern_01.png","width"=>"48","height"=>"46","alt"=>"Facebook logo"),
                          array("href"=>"https://www.twitter.com","target"=>"_blank","src"=>"../../images/socialmedia/modern_02.png","width"=>"47","height"=>"46","alt"=>"Twitter logo"),
                          array("href"=>"https://www.instagram.com","target"=>"_blank","src"=>"../../images/socialmedia/modern_04.png","width"=>"48","height"=>"46","alt"=>"Instagram logo"),
                          array("href"=>"https://www.linkedin.com","target"=>"_blank","src"=>"../../images/socialmedia/modern_07.png","width"=>"49","height"=>"46","alt"=>"Linkedin logo"));
                               
        $footeri = new FooterExt();
        $footeri->shfaq($arrrrrr);

    ?>

	
	
</body>


</html>