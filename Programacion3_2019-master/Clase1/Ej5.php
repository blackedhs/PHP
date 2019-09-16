<?php
    $a = $_POST["var1"];
    $b = $_POST["var2"];
    $c = $_POST["var3"];

    if ($a>$b)
        if($a>$c)
            print($a);
        else
            print($c);
    else if($b>$c)
        print($b);
    else
        print($c);


?>