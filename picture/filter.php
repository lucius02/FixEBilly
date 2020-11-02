<?php
#Filter.php
#
# Je kan deze functie zelf verder uitbreiden door
# de functie afbeeldingen te kopiëren en aan te passen
# aan je eigen wensen.
 
# procedure geschreven door Cynthia Fridsma

// functie voor het testen van de file extensies

function afbeeldingen ($file_name)  {
   return(preg_match('(.jpg)|(.gif)|(.bmp)|(.png)', $file_name));  

}

/*

Als je de functie gaat kopieren, dan hoef je alleen de functie naam
aan te passen + de extensies. Bijvoorbeeld :

function geluid ($file_name)  {
   return(ereg('[]0-9a-zA-Z_[-]+(.mp3)|(.wav)|(.wma)|(.snd)', $file_name));  

}

*/

?>