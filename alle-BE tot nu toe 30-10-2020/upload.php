<?php
include("ini/connect.php");

  $afbeelding = $_POST['afbeelding'];

if(isset($_POST['afbeelding'])){
 
    // Insert record
    $query = "insert into sch_map.picture(afbeelding) values('".$afbeelding."')";
    pg_query($con,$query);
  
 
}
?>

<!DOCTYPE html>
<html>
<body>
<form method="post" action="upload.php" >
  <label>vul hier bron van afbeelding in</label><br>
  <input type='text' id='afbeelding' name='afbeelding' /><br>
  <input type = "submit" name="opslaan" onclick="alert('Kenniskaart is opgeslagen')"/>
</form>

<?php

 $sql = "select afbeelding from sch_map.picture";
 $result = pg_query($con,$sql);
 $row = pg_fetch_array($result);

 $image_src = $row['afbeelding'];
 
?>

<img src='<?php echo $image_src; ?>' >
</body>
</html>
