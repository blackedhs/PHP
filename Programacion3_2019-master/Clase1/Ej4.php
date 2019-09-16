<?php
    $count = 1;
    $tot = 0;

    while(true)
    {
        $tot+=$count;
        $count++;
        if  ($tot+$count>=1000)
            break;
    }
    printf("Suma: %d <br/> Total; %d ",$tot,$count);

?>