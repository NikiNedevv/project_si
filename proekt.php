<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="./style.css">
</head>
<body>

<?php
if (!empty($_GET['cards'])) {

	$validSuits = ['C','H','S','D'];//масив с валидна подредба по бои
	$validKey = 0;//валиден ключ за проверка на боите

	$C = $_GET['cards'];//взимаме от формата въведените карти

	$cards = explode(" ",$C); //експлоудваме стринга

	$counter = count($cards);//бройм картите
	$stopValue = false; //флаг дали да спираме цикъла, ако има грешна стойност в картите

	foreach ($cards as $key => $value) {//за всички карти
		$numbers = substr($value,0,-1); //взимаме номерата/стойностите на картите
		$inputSuits[$key][$numbers] = substr($value,-1); //създаваме масив с боята на картите

		if($key < ($counter-1)){//ако не е последния елемент
			switch ($numbers) {//според определени карти пресметаме по различен начин подредбата
				case 'A':
					if($cards[$key+1] != 4){//ако след Асо не идва 4ка
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case 'K':
					if($cards[$key+1] != 3){//ако след Поп не идва 3ка
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case 'Q':
					if($cards[$key+1] != 2){//ако след Дама не идва 2ка
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case 'J':
					if(substr($cards[$key+1],0,-1) != 'A'){//ако след Вале не идва Асо
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case '8':
					if(substr($cards[$key+1],0,-1) != 'J'){//ако след 8-ца не идва Вале
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case '9':
					if(substr($cards[$key+1],0,-1) != 'Q'){//ако след 9-ка не идва Дама
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				case '10':
					if(substr($cards[$key+1],0,-1) != 'K'){//ако след 10-ка не идва Поп
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
				default:
					if(($numbers + 3) != substr($cards[$key+1],0,-1)){//при другите случей с числа смятаме следващата карта да е с 3 по-голяма
						$wrongVal = ($key+2);//запазваме коя позиция е грешна
						$stopValue = true;//спираме цикъла
					}
					break;
			}
		}
		if($stopValue){//ако някой от флаговете за спиране е включен,спираме цикъла и печатим грешната позиция на грешната карта
			echo '<p class="error">Wrong Value Position = '.$wrongVal.'</p><p  class="error"><img src="./img/Oopsbutton.jpg"></p>';
			break;
		}
	}

	$stop = false;//флаг за спиране ако е грешна подредбата по боя
	foreach ($inputSuits as $key => $inputSuit) {//цикъл на масива с боите
			//if suit is on valid order
			foreach ($inputSuit as $str_value => $str_suit) {//цикъл който дели масива на стойност на карта => боя
				if($key < 1){//първата боя
					foreach ($validSuits as $valid_key => $valid) {//цикъл с валидна подредба на боите
						if($str_suit == $valid){//намираме ключа от масива с валидни бои
							$validKey = ($valid_key +1);//задаваме от кой ключ да започва проверката за поредност на боите
						}
					}
				}else{//след първата карта започваме проверка на боите
					if($str_suit == $validSuits[$validKey]){//ако всяка следваща карта е с боя като валидната поредност
						$validKey++;//вдигаме ключа за валидна поредност
						if($validKey > 3){//ако надвиши 3 го нулираме за да започне проверката от начало
							$validKey = 0;
						}
					}else{//ако нямаме валидна поредност
						$wrong = ($key +1);//запазваме позицията на грешната карта
						$stop = true;//спираме цикъла и програмата
					}
				}
			}
			if($stop){//ако флага е включен спираме и изкарваме коя позиция е грешната карта
				echo '<p class="error">Wrong Suit Position= '.$wrong.'</p><p class="error"><img src="./img/Oopsbutton.jpg"></p>';
				break;
			}	
	}

	if(!$stop && !$stopValue){//ако са преминали проверките за стойност и за боя, то подредбата е правилна
		echo '<img src="./img/maxresdefault.jpg" class="success-pic">';
	}   
}
?>
</body>
</html>



