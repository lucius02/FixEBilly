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
			$result=$db->getRecords();
			while($row=pg_fetch_array($result)){
				echo "<tr>
					<td>".$row["onderwerp"]."</td>
					<td>".$row["rol"]." </td>
					<td>".$row["competentie"]." </td>
					<td>".$row["wat"]." </td>
					<td>".$row["why"]." </td>
					<td>".$row["how"]." </td>
                    <td><img src=".$row["plaatje"]." ></td> 
                    <td>".$row["bronnen"]." </td>
					<td>".$row["niveau"]." </td>
					<td>".$row["studieduur"]." </td>
					<td>".$row["rating"]." </td>
				</tr>";
			}
			$db->closeCon();
			?>
</table>