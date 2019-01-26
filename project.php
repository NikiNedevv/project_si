<?php
if (!empty($_GET['cards'])) {
	


$cards = explode(" ",$_GET['cards']); //експлоудваме стринга

    $suits=["C","H","S","D"];

    $values=["A","2","3","4","5","6","7","8","9","10","J","Q","K"];

    $str_suit = array_search(substr($cards[0],-1),$suits); //Търсим съвпадения в "боите" на картите

    $str_value = array_search(substr($cards[0],0,-1),$values); //Търсим съвпадения в стойностите
    $si_steb_count = 1;

foreach ($cards as  $value) {
	if ($value == $values[$str_value].$suits[$str_suit]) {
            $str_suit = ($str_suit + 1) % 4;
            $str_value = ($str_value + 3) % 13;
            ++$si_steb_count;
        } else {
            echo 'ends on' . $si_steb_count;
        }
    }
    echo 1;
}




