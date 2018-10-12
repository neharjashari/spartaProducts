<?php

class Footer
{
    private $email;
    private $phone;
    private $address;
    public function __construct()
    {
        $this->email = "contact@sparta.com";
        $this->phone = "+377 44 007 007";
        $this->address = "St. Eçrem Çabej, Fakulteti Teknik";
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }   

    public function shfaq($array)
    {
        echo '<footer>
            <div>
                <div id="footer" >     
                    <div id="social">
                        <h2>Follow Us</h2>';         
                        foreach($array as $arr)
                        {
                            printf('<a href="%s" target="%s"><img src="%s" width="%s" height="%s" alt="%s"/></a>',$arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
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

    public function __destruct()
    {
        // sa per demonstrim
    }
}



?>