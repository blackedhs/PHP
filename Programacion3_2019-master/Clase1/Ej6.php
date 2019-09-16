<?php
    $operador = $_POST["operador"];
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];

    switch ($operador) {
        case '+':
            print($op1+$op2);
            break;
        case '-':
            print($op1-$op2);
            break;
        case '*':
            print($op1*$op2);
            break;
        case '/':
            print($op1/$op2);
            break;
        
        default:
            echo "Boludo";
            break;
    }

?>