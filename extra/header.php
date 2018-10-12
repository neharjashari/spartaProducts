<?php

class Header
{
    private $src1;
    private $li1;
    private $li2;
    private $li3;
    private $li4;
    private $li5;
    private $srcbanner;

    public function __construct()
    {
        $this->src1 = "images/icon.png";
        $this->li1 = "home.php";
        $this->li2 = "about.html";
        $this->li3 = "products.html";
        $this->li4 = "merchandise.html";
        $this->li5 = "contact.html";
        $this->srcbanner = "images/1_1920.jpg";
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }   

    public function shfaq()
    {
        echo '<header>
        <nav>
            <div style="float: left; margin-left: 80px; margin-top: 5px;padding-top: 4px;">  
                <a href="index.html"><img src="'.$this->src1.'" width="300" height="50" alt="Company Logo"/></a>
            </div>    
            <div style="float:right; margin-right: 40px;padding-top: 5px;">
                <ul>
                    <li> <a href="'.$this->li1.'"> Home </a></li>
                    <li> <a href="'.$this->li2.'"> About us </a></li>
                    <li> <a href="'.$this->li3.'"> Products </a></li>
                    <li> <a href="'.$this->li4.'"> Merchandise </a></li>
                    <li> <a href="'.$this->li5.'"> Contact </a></li>
                </ul>
            </div>
        </nav>
        <hr/>
        <div id="banner">
            <img src="'.$this->srcbanner.'" width="100%" height="700"/> 
        </div>
    
    </header>';
    }

    public function __destruct()
    {
        // sa per demonstrim
    }
}
?>
