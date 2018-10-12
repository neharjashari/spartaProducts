<?php

    $selectedCard = $_REQUEST["q"];

    $placeHolderValue = "";

    if($selectedCard=="visa")
    {
        $placeHolderValue = "4xxxxxxxxxxxxxxx";
    }
    else if($selectedCard=="mastercard")
    {
        $placeHolderValue = "5xxxxxxxxxxxxxxx";
    }
    else if($selectedCard=="americanexpress")
    {
        $placeHolderValue = "34xxxxxxxxxxxxx or 37xxxxxxxxxxxxx";      // rregullo
    }
    else
    {
        $placeHolderValue = "6011xxxxxxxxxxxx or 65xxxxxxxxxxxxxx";      // rregullo
    }

    echo $placeHolderValue;
?>