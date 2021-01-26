<?php
function random($panjang)
{
   $karakter= 'ABCDEFGHIJKLMNOPQRSTU1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter{$pos};
   }
    return $string;
}

//Contoh Pemanggilan
echo random(67);
?>