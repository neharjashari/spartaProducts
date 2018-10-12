<!DOCTYPE html>
<?php

session_start();
//session_destroy();
require_once ('php-graph-sdk-5.4/src/Facebook/autoload.php');

    $fb = new Facebook\Facebook([
        'app_id' => '973380042843629',
        'app_secret' => 'f71563ddc29bbe8c22e8fb676224853b',
        'default_graph_version' => 'v2.10',
        ]);

if(!isset($_SESSION['facebook_access_token']))
{
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl('http://localhost:1998/Projekti%20Internet/extra/login-callback.php', $permissions);
}

?>
<html>

<head lang="en">
    <meta charset="utf-8" />
    <title> ThisIsSparta.com: Home </title> 
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="productstyle.css"/>
    <style>
        .item
        {
            width: 32%;
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
                    <li> <a href="home.html" class="active"> Home </a></li>
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
        <article>
            <div class="artikujt" style="font-size: 1.2em;font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                
                <h1>OUR COMPANY</h1>
                <hr />
                <p>&nbsp;</p>
                
                <p>Sparta Products is a company located in Prishtina, Kosovo and was 
                created by a group of <abbr style="text-decoration: none;" title="Fakulteti i Inxhinierise Elektrike dhe Kompjuterike">FIEK</abbr> students during the most difficult time of their lives.</p>
                
                <p>Sparta is a well known e-Commerce company all over the world who tries to bring the newest 
                and the most popular teknology products available.</p>
                
                <p>With our good software integrated system we can ship the product fast and without any 
                impairment whatsoever</p>
                
            </div>
            <div class="artikujt" id="bestselling">
                <h1> BEST SELLING PRODUCTS </h1>
                <hr />
                <div class="rreshti">            
                    <div class="item">
                        <div class="foto">
                            <a href="products/smartphones/smartphone6.html#emriproduktit" target="_blank">
                                <img alt="Samsung Galaxy S8 Plus" src="products/smartphones/images/5A.jpg"/>
                            </a>
                        </div>
                        <div class="pershkrimi">
                        	<a href="products/smartphones/smartphone6.html#emriproduktit" target="_blank">
                            Samsung Galaxy S8+ <br/> &nbsp;</a>
                            <div class="cmimi"> 680 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <a href="products/laptops/laptop4.html#emriproduktit" target="_blank">
                                <img alt="Notebook Acer Extensa 15" src="products/laptops/images/3C.jpg"/>
                            </a>
                        </div>
                        <div class="pershkrimi">
                        	<a href="products/laptops/laptop4.html#emriproduktit" target="_blank">
                            Notebook Acer Extensa 15 <br /> &nbsp;</a>
                            <div class="cmimi"> 450 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <a href="products/smartphones/smartphone2.html#emriproduktit" target="_blank">
                                <img alt="Google Pixel 2" src="products/smartphones/images/1A.jpg"/>
                            </a>
                        </div>
                        <div class="pershkrimi">
                        	<a href="products/smartphones/smartphone2.html#emriproduktit" target="_blank">
                            Google Pixel 2<br /> &nbsp;</a>
                            <div class="cmimi"> 730 &euro; </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="rreshti">            
                        <div class="item">
                            <div class="foto">
                                <a href="products/desktops/desktop5.html#emriproduktit" target="_blank">
                                    <img alt="HP Pavilion" src="products/desktops/images/desktop5C.jpg"/>
                                </a>
                            </div>
                            <div class="pershkrimi">
	                            <a href="products/desktops/desktop5.html#emriproduktit" target="_blank">
                                HP Pavilion <br/> &nbsp;</a>
                                <div class="cmimi"> 290 &euro; </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="foto">
                                <a href="products/smartphones/smartphone3.html#emriproduktit  " target="_blank">
                                    <img alt="Iphone X" src="products/smartphones/images/2A.jpg"/>
                                </a>
                            </div>
                            <div class="pershkrimi">
                            	<a href="products/smartphones/smartphone3.html#emriproduktit  " target="_blank">
                                Iphone X<br /> &nbsp;</a>
                                <div class="cmimi"> 1450 &euro; </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="foto">
                                <a href="products/tablets/tablet4.html#emriproduktit" target="_blank">                                    <img alt="Acer Iconia" src="products/tablets/images/tablet4C.jpg"/>
                                </a>
                            </div>
                            <div class="pershkrimi">
                            	<a href="products/tablets/tablet4.html#emriproduktit" target="_blank">
                                Acer Iconia     <br /> &nbsp;</a>
                                <div class="cmimi"> 755 &euro; </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>        
                <br/>
                
            </div>
            
            <div class="artikujt" id="comingsoon">
                <h1> COMING SOON </h1>
                <hr />
                <div class="rreshti">            
                    <div class="item">
                        <div class="foto">
                            <img alt="CORSAIR ONE PRO" src="products/upcoming/upcom1.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            CORSAIR ONE PRO <br/> &nbsp;
                            <div class="cmimi"> 2199 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <img alt="Google Nexus 9" src="products/upcoming/upcom2.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            Google Nexus 9 <br /> &nbsp;
                            <div class="cmimi"> 349 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <img alt="Motorola Moto X" src="products/upcoming/upcom3.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            Motorola Moto X <br /> &nbsp;
                            <div class="cmimi"> 279 &euro; </div>
                        </div>
                    </div>
                    
                </div>
                <br />
                <div class="rreshti">            
                    <div class="item">
                        <div class="foto">
                            <img alt="Huawei Honor 9" src="products/upcoming/upcom4.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            Huawei Honor 9 <br/> &nbsp;
                            <div class="cmimi"> 474 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <img alt="Razer Phone" src="products/upcoming/upcom5.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            Razer Phone<br/> &nbsp;
                            <div class="cmimi"> 699 &euro; </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="foto">
                            <img alt="Lenovo Yoga 920" src="products/upcoming/upcom6.jpg"/>
                        </div>
                        <div class="pershkrimi">
                            Lenovo Yoga 920 <br /> &nbsp;     
                            <div class="cmimi"> 145 &euro; </div>
                        </div>
                    </div>
                    
                </div>
                    
            </div>


        </article>

        <aside>
                <p style='text-align: center;'>
                    <?php
                        // nese nuk eshte i kycur ne facebook shfaqe butonin per Log In
                        if(!isset($_SESSION['facebook_access_token']))
                        {
                            echo '<a href="' . $loginUrl . '"><button style="color:white;background-color: RGB(41,89,177);font-weight: bold;border: none;padding: 5px;cursor: pointer;">Log in with Facebook</button></a>';
                        }
                        // perndryshe shfaqja emrin dhe foton
                        else
                        {
                            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

                            try 
                            {
                                $response = $fb->get('/me');
                                $userNode = $response->getGraphUser();
                                $requestPicture = $fb->get('/me/picture?redirect=false&height=100');
                                $picture = $requestPicture->getGraphUser();
                            } 
                            catch(Facebook\Exceptions\FacebookResponseException $e) 
                            {
                                echo 'Graph returned an error: ' . $e->getMessage();
                                exit;
                            } 
                            catch(Facebook\Exceptions\FacebookSDKException $e)
                            {
                                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                                exit;
                            }
                            
                            echo '<div style="background-color: RGBA(0,0,0,0.1);text-align: center;width: 60%;margin: auto;"><b>' . $userNode->getName()."</b>";
                            echo "<br /><img src='".$picture['url']."'/></div>";
                        }
                    ?> 
                </p>
               <div style="margin-top: 20px;"> 
                <a href="https://www.mcdonalds.com/gb/en-gb.html" target="_blank">
                    <img alt="" src="images/ads/ad1.jpg" width="100%"/>
                </a>
                <br /><br />
                <a href="http://www.ilead.net.in/" target="_blank">
                    <img alt="" src="images/ads/ad2.jpg" width="100%"/>
                </a>
            </div>
        </aside>    
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

</body>

</html>