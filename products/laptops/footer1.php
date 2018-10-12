<?php

require_once("../../extra/footer.php");
class FooterExt extends Footer
{
    // mbishkruajme funksionin shfaq te trasheguar nga klasa prind Footer
    public function shfaq($array)
    {
        echo '<footer>
            <div>
                <div id="footer" >     
                    <div id="social">
                        <h2>Follow Us</h2>';         
                        
                        foreach($array as $arr)
                        {
                            $i = 1;
                            foreach($arr as $atributi=>$vlera)
                            {
                                if($i==1)
                                {
                                    echo "<a $atributi='$vlera' ";
                                }   
                                else if($i==2)
                                {
                                    echo " $atributi='$vlera'> ";
                                }   
                                else if($i==3)
                                {
                                    echo "<img $atributi='$vlera' ";
                                }   
                                else if($i==4)
                                {
                                    echo " $atributi='$vlera' ";
                                }   
                                else if($i==5)
                                {
                                    echo " $atributi='$vlera' ";
                                }   
                                else
                                {
                                    echo " $atributi='$vlera' /> </a>"; 
                                }   
                                $i++;
                            }
                        }
                    echo '</div>
                    <div id="contact">
                        <h2>Contact Us</h2>
                        <p>Email: '.$this->email.'</p>
                        <p>Phone number: '.$this->phone.'</p>
                        <p>Address: '.$this->address.'</p>
                        <p>Prishtina, Kosovo</p>
                    </div>
                </div>
                    
                <div id="copyright" style="margin-top: 50px;">
                    <p>© 2017 Sparta - Designed by Us</p>            
                </div>
            </div>     

        </footer>';
    }

}


?>