<!DOCTYPE html>
<?php
session_start();
//session_destroy();

if(($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['choice']==1))
    $_SESSION['ofertaF'] = $_SESSION['oferta'];
$_SESSION['oferta'] = 0;

if(!isset($_SESSION['boxes']))
{
    $var = array(0,0,0,0,0,0,0,0,0,0);
    $money = array(10,20,100,200,500,1000,2000,5000,20000,50000);
    shuffle($money);
    $_SESSION['money'] = $money;
    $_SESSION['boxes'] = $var;
}
else
{
    $selectedBox = $_POST['inputBox'];
    $_SESSION['boxes'][$selectedBox-1] = 1;
}    


?>
<html>

<head lang="en">
    <meta charset="utf-8"/>
    <title> Title </title>
    <style>
        body
        {
            background-image: url("quizBack.jpg");
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }
        #back
        {
            background-color: RGBA(0,0,0,0.5);
        }
    </style>

</head>


<body>
<div>

<div style="text-align: center;" id="back">
    <img src="logo.png"/>
</div>
    <div style="text-align: center;">
        
       

        <?php
            $stillLeft = false;
            $i=0;
            $nr = 0;
            foreach($_SESSION['boxes'] as $boxes)
            {
                if($boxes==0)
                {
                    $stillLeft = true;
                    $_SESSION['oferta'] += pow($_SESSION['money'][$i],2);
                    $nr ++;
                }
                $i++;
            }
            if($nr!=0)
                $_SESSION['oferta'] = $_SESSION['oferta']/$nr;
            $_SESSION['oferta'] = sqrt($_SESSION['oferta']);
            if($stillLeft)
            {
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['choice']==1)
                {
                    echo '<div style="text-align: center;">  
                    <br />
                        <p style="margin: 30px;color: white;font-weight: bold;font-size: 5em;">
                            Congratulations you have won:<br /> '.$_SESSION['ofertaF'].' &euro;!
                        </p>
                        </div>';
                        session_destroy();
                        exit("");
                }
                echo "<div>";
                for($i=0;$i<10;$i++)
                {
                    if($i==5)
                    {
                        echo "</div><div>";
                    }
                    if($_SESSION['boxes'][$i]==0)
                        echo '<img src="case'.($i+1).'.png"/>';
                    else
                        echo '<img src="case'.$_SESSION['money'][$i].'E.png"/>';
                };
                
                echo "</div> ";
            }
            else if(!$stillLeft)
            {
                echo '<div style="text-align: center;">  
                <br />
                    <img src="case'.$_SESSION['money'][$_POST['inputBox']-1].'E.png"/>
                    <p style="margin: 30px;color: white;font-weight: bold;font-size: 5em;">
                        Congratulations you have won:<br /> '.$_SESSION['money'][$_POST['inputBox']-1].' &euro;!
                    </p>
                    </div>';
                    session_destroy();
                exit("");
            }

        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" style="color: white;font-family: 'Trebuchet MS'">
            <fieldset>
                <legend> Your choice </legend>
                    <label> Banker offer: </label> <?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $_SESSION['oferta']; else echo 0;?> &euro; <br />
                    <!-- 1 eshte per accept offer, 2 per te hapur nje kuti tjeter-->
                    <input type="radio" name="choice" value="1" onchange="funki();"/> Accept Offer
                    <input type="radio" name="choice" value="2" onchange="funki();" checked/> Open another box
                    <br />
                    <select name="inputBox" style="margin: 5px;width: 100px;">
                        <option value="1"> 1 </option><option value="2"> 2 </option><option value="3"> 3 </option><option value="4"> 4 </option><option value="5"> 5 </option><option value="6"> 6 </option><option value="7"> 7 </option><option value="8"> 8 </option><option value="9"> 9 </option><option value="10"> 10 </option>
                    </select>
                    <input type="submit" id="butoni" value="Open" style="background-color: gold;border: none;cursor: pointer;"/>
            </fieldset> 
        </form>
    </div>

</div>
<script>
    function funki()
    {
        var radios = document.getElementsByName("choice");
        var selectedValue = "";
        for(var i = 0 ; i < radios.length; i++)
        {
            if(radios[i].checked)
            {
                selectedValue = radios[i].value;
            }
        }
        if(selectedValue==1)
            document.getElementById("butoni").value = "Accept";
        else
            document.getElementById("butoni").value = "Open";
    }
</script>
</body>
</html>