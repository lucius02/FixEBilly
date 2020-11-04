<?php
require_once(".\search\dbcontroller.php");
$db_handle = new DBController();

$onderwerp = "";
$wat = "";	
$why = "";
$how = "";
$niveau = "";

$queryCondition = "";

/*
Gebruik ~* ipv LIKE, omdat deze functie:
a. Veel sneller is,
b. Caseinsensitive zoekt, dus hoofdletters zijn niet belangrijk

Je ziet dat je het hele stuk php-case kan weglaten hiermee, wat de code lekker kort en overzichtelijk houdt.
Net als LIKE kan ~* alleen bij zoek op argumenten van het type text en bijvoorbeeld niet op integer, daarom convert ik de laatste (niveau) voor de zekerheid naar text. Dit heeft wel als bijwerking dat als je zoekt op niveau 1 je ook niveau 10,11,12,etc tergu krijgt, omdat daar ook een 1 in zit. Soms is dat juist handig, soms juist niet. Dan moet je hem anders schrijven "AND niveau = COALESCE(".$niveau.",niveau)"

de coalesce() zorgt voor hetzelfde als jouw case. Namelijk als er geen zoek-criteria is meegegeven, dan neemt het vervangings-argument mee. Door het vervangings argument het zelfde te nemen als het veld waar je op zoekt zorgt er voor dat er geen records uit de tabel worden uitgesloten en dus verder kijkt naar de andere where-criteria. Als er dus helemaal geen zoek-criteria zijn meegeven dan krijg je dus alle records terug...
*/

if(!empty($_POST["search"])) {

	$onderwerp = $_POST("search[onderwerp]");
	$wat = "";	
	$why = "";
	$how = "";

	$query = "SELECT * FROM sch_map.kenniskaart 
			WHERE	onderwerp ~* COALESCE(".$onderwerp.",onderwerp)
				AND	wat ~* COALESCE('".$wat."',wat)
				AND	why ~* COALESCE('".$why."',why)
				AND	how ~* COALESCE('".$how."',how)
				AND	niveau::text ~* COALESCE('".$niveau."',niveau)::text
			ORDER BY kenniskaart_id desc";

	$result = $db_handle->runQuery($query);
}

?>

<html>
	<head>
		<title>Zoeken</title>
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<h2>PHP CRUD with Search and Pagination</h2>
		<div id="toys-grid">      
			<form name="frmSearch" method="post" action="filterfunction-SQL.php">
			<div class="search-box">
				<p>
					<input type="text" id="mysearch" placeholder="onderwerp" name="search[onderwerp]" class="demoInputBox" value="<?php echo $onderwerp; ?>"/>
					<input type="text" id="mysearch" placeholder="wat" name="search[wat]" class="demoInputBox" value="<?php echo $wat; ?>"/>
					<input type="text" id="mysearch" placeholder="why" name="search[why]" class="demoInputBox" value="<?php echo $why; ?>"/>
					<input type="text" id="mysearch" placeholder="how" name="search[how]" class="demoInputBox" value="<?php echo $how; ?>"/>

					<select id="Place" name="search[niveau]" multiple="multiple">
                        <?php
                        if (! empty($result)) {
                            foreach ($result as $k => $v) {
                                echo '<option value="' . $result[$k]['niveau'] . '">' . $result[$k]['niveau'] . '</option>';
                            }
                        }
                        ?>
                	</select><br> <br>

					<input type="submit" name="go" class="btnSearch" value="Search">
					<input type="reset" class="btnSearch" value="Reset" onclick="window.location='filterfunction.php'">

				<?php
                	if (! empty($_POST['niveau'])) {
            	?>					

			<table cellpadding="10" cellspacing="1">
				<thead>
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
				</thead>
				<tbody>
				<?php
                        $query = "SELECT * from sch_map.kenniskaart";
                        $i = 0;
                        $selectedOptionCount = count($_POST['niveau']);
                        $selectedOption = "";
                        while ($i < $selectedOptionCount) {
                            $selectedOption = $selectedOption . "'" . $_POST['niveau'][$i] . "'";
                            if ($i < $selectedOptionCount - 1) {
                                $selectedOption = $selectedOption . ", ";
                            }
                            
                            $i ++;
                        }
                        $query = $query . " WHERE niveau in (" . $selectedOption . ")";
                        
                        $result = $db_handle->runQuery($query);
                    }
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
							if(is_numeric($k)) {
					?>

					<tr>
						<td><?php echo $result[$k]["onderwerp"]; ?></td>
						<td><?php echo $result[$k]["rol"]; ?></td>
						<td><?php echo $result[$k]["competentie"]; ?></td>
						<td><?php echo $result[$k]["wat"]; ?></td>
						<td><?php echo $result[$k]["why"]; ?></td>
						<td><?php echo $result[$k]["how"]; ?></td>
						<td><img src='<?php echo $result[$k]["plaatje"]; ?>' ></td> 
						<td><?php echo $result[$k]["bronnen"]; ?></td>
						<td><?php echo $result[$k]["niveau"]; ?></td>
						<td><?php echo $result[$k]["studieduur"]; ?></td>
						<td><?php echo $result[$k]["rating"]; ?></td>
					</tr>

					<?php	
						}				   
                    }
					?>
				<tbody>
			</table>
			<?php
                }
            ?> 
			</form>	
		</div>
	</body>
</html>