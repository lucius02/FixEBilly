<?php
# De verwerking van de gegevens doen we gewoon
# met een eenvoudig formulier.

# Procedure geschreven door Cynthia Fridsma

// verbind de server
require_once("config.php");

// gebruik het filter voor de afbeeldingen
include ("filter.php");

// lees de waarde van 'go'
$go = $_POST['go'];


# als het formulier nog niet eerder is gebruikt dan
# wordt er een formulier getoond op je scherm.

if ($go ==""):

?>
<br><br><br>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

<!-- Hier komt het verborden veld 'go met de waarde 'go' -->
   <input name="go" type="hidden" value="go">
       <table width="450" border="0" background-color="#99CCFF" align="center">
       <tr><td background-color="#99CCFF">Omschrijving</td>
       <td><input name="omschrijving" type="text" id="omschrijving" size="50"></td>
    </tr>
    <tr>
      <td background-color="#99CCFF">Afbeelding</td>
      <td><input name="afbeelding" type="file" accept="image/jpeg" id="afbeelding" size="50">
  
    </tr>
    <tr>
      <td background-color="#99CCFF">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Verzenden">
      <input type="reset" name="Reset" value="Herstellen"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

<?php
endif;

// Deze procedure wordt aangeroepen nadat men op verzenden heeft gedrukt

if ($go =="go"):
# Deze procedure zordt ervoor dat de afbeeldingen
# op je server worden geplaatst en tevens in je
# mysql database.

// bepaal de huidige directory
$hello = getcwd();

# hier komen de afbeeldingen, als je
# het script in de directory hallo hebt geinstalleerd
# dan worden de afbeeldingen in hallo/images/
# geplaatst.

$file_dir = ($hello . "/images/");

# we moeten natuurlijk wel zeker weten
# dat de directory bestaat. Dit controleren wij
# met de opdracht is_dir via de volgende routine :

if (is_dir ($file_dir)) {
  print "<br><br>++directorty bestaat";  
  }  else {  
  print "<br><br>--Directory bestaat nog niet" . $file_dir;  
    $newpage = $file_dir;
    echo ("<br>we gaan daarom de directory aanmaken");
    mkdir ($newpage, 0777);    
  }  

// toon de systeem datum
echo date("m/d/y G.i:s");


echo ("<br><br>");

# Ik heb besloten om $_FILES als een array te
# laden, zodat je (eventueel) meer afbeeldingen via
# een formulier op je server kunt plaatsen.

foreach($_FILES as $file_name => $file_array) {
      
       # Verander de bestandsnaam zodat het een geldig bestandsnaam wordt
       # in een Linux omgeving. (Een Mac en een Windows omgeving zijn
       # veel relaxer met bestandsnaam m.b.t. spaties, hoofdletters en
       # een mengeling van beide, maar dit geldt niet voor Linux, bovendien
       # zijn bestanden in een Linux omgeving hoofdletter gevoelig.
      
       $file_name=str_replace("'", "_", $file_array['name']);
       $file_name=str_replace(" ", "_", $file_array['name']);
       $file_name=stripslashes ($file_name);
       $file_name=trim($file_name);      
       $file_name=strtolower($file_name);    
                
       echo "path: " .$file_array['tmp_name'] . "<br>\n";
       echo "name: " .$file_name . "<br>\n";    
       echo "type: " .$file_array['type'] ."<br>\n";
       echo "size: " .$file_array['size'] ."<br>\n";
      
       # gebruik de functie afbeeldingen (zie filter.php) om te
       # controleren of het om een afbeelding gaat.
       # de waarde van $test wordt 1 indien het een afbeelding betreft,
       # in alle andere gevallen is $test leeg.

        $omschrijving = $_POST["omschrijving"];

       $test = afbeeldingen($file_name);
       if ($test !=""):
            echo $file_name . " dit is een afbeelding<br>";
            if (is_uploaded_file($file_array['tmp_name'])) {
                 move_uploaded_file($file_array['tmp_name'], "$file_dir/$file_name") or die ("Couldn't copy");
                 echo "Afbeelding staat op de server<br><br>";
                 // voeg de locatie + omschrijving van de afbeelding toe in de database
                 $afbeelding = "images/" . $file_name;
                 $query = "INSERT INTO sch_map.picture (omschrijving, afbeelding) VALUES ('$omschrijving','$afbeelding')";    
                    if(!pg_query($dbname,$query,$db)) die("ERROR!!!");                      
                        echo $afbeelding . " is toegevoegd aan de database met als omschrijving : <br>";                    
                        echo $omschrijving;
            }
       endif;                     
       if ($test ==""):    
             echo $file_name . " dit is geen afbeelding en wordt daarom niet op de server geplaatst<br>\n";      
       endif;
  }
endif;

?>

</body></html>