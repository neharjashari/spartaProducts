<?php

    $lidhja = new mysqli("localhost","root","password","world");

    if($lidhja->connect_errno)
    {
        echo "Lidhja nuk mund te krijohet!";
    }

    $selectedVal = $_REQUEST['q'];

    $rezultati = "";

    $query = "SELECT Name from city WHERE CountryCode='".$selectedVal."'";

    $rowt = $lidhja->query($query);

    if($rowt->num_rows>0)
    {
        while($row = $rowt->fetch_assoc())
        {
            $rezultati .= "<option value='".$row['Name']."'> ".$row['Name']."</option>";
        }
    }

    $lidhja->close();

    echo $rezultati;

?>