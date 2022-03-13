<?php 
    for ($i = 1; $i < 101; $i++) {
        if ($i % 3 == 0) {
            print_r("Fizz");
            if ($i % 5 == 0) { print_r("Buzz");}
            print_r("\n");
        }
        elseif ($i % 5 == 0) { print_r("Buzz\n");}
        else {
            print_r($i."\n");
        }  
    }
?>