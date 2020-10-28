<?php
	if (isset($_POST['submit'])) {
		$connection = pg_connect("host=localhost dbname=EBilly user=postgres password=WelKom7993");
		$q = $connection->real_escape_string($_POST['q']);
		$column = $connection->real_escape_string($_POST['column']);

		if ($column == "" || ($column != "onderwerp" && $column != "wat"))
			$column = "onderwerp";

		$sql = $connection->query("SELECT onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating FROM sch_map.kenniskaart WHERE $column LIKE '%$q%'");
		if ($sql->num_rows > 0) {
			while ($data = $sql->fetch_array())
				echo $data['onderwerp'] . "<br>";
		} else
			echo "Your search query doesn't match any data!";
	}
?>
<html>
	<head>
		<title>PHP Search Form</title>
	</head>
	<body>
		<form method="post" action="search.php">
			<input type="text" name="q" placeholder="Search Query...">
			<select name="column">
				<option value="">Select Filter</option>
				<option value="onderwerp">onderwerp</option>
				<option value="wat">wat</option>
			</select>
			<input type="submit" name="submit" value="Find">
		</form>
	</body>
</html>
