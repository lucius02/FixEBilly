
<table   class="table table-striped table-responsive">
	<tr>
		<th><strong>Onderwerp</strong></th>
		<th><strong>Rol</strong></th>          
		<th><strong>Competentie</strong></th>
		<th><strong>Wat</strong></th>
		<th><strong>Why</strong></th>
		<th><strong>How</strong></th>
		<th><strong>Plaatje</strong></th>
		<th><strong>Bronnen</strong></th>
		<th><strong>Niveau</strong></th>
		<th><strong>Studieduur</strong></th>
		<th><strong>Rating</strong></th>
	</tr>
<?php
require('config.php');
$db = new db;

$result1=$db->getRecordsWhere($_POST['niveau']);

while($row1=pg_fetch_array($result1)){
	echo "<tr>
	<td>".$row1["onderwerp"]."</td>
	<td>".$row1["rol"]." </td>
	<td>".$row1["competentie"]." </td>
	<td>".$row1["wat"]." </td>
	<td>".$row1["why"]." </td>
	<td>".$row1["how"]." </td>
	<td><img src=".$row1["plaatje"]." ></td> 
	<td>".$row1["bronnen"]." </td>
	<td>".$row1["niveau"]." </td>
	<td>".$row1["studieduur"]." </td>
	<td>".$row1["rating"]." </td>
	</tr>";
}
$db->closeCon();
?>
</table>