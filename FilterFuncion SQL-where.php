Gebruik ~* ipv LIKE, omdat deze functie:
a. Veel sneller is,
b. Caseinsensitive zoekt, dus hoofdletters zijn niet belangrijk

Je ziet dat je het hele stuk php-case kan weglaten hiermee, wat de code lekker kort en overzichtelijk houdt.
Net als LIKE kan ~* alleen bij zoek op argumenten van het type text en bijvoorbeeld niet op integer, daarom convert ik de laatste (niveau) voor de zekerheid naar text. Dit heeft wel als bijwerking dat als je zoekt op niveau 1 je ook niveau 10,11,12,etc tergu krijgt, omdat daar ook een 1 in zit. Soms is dat juist handig, soms juist niet. Dan moet je hem anders schrijven "AND niveau = COALESCE(".$niveau.",niveau)"

de coalesce() zorgt voor hetzelfde als jouw case. Namelijk als er geen zoek-criteria is meegegeven, dan neemt het vervangings-argument mee. Door het vervangings argument het zelfde te nemen als het veld waar je op zoekt zorgt er voor dat er geen records uit de tabel worden uitgesloten en dus verder kijkt naar de andere where-criteria. Als er dus helemaal geen zoek-criteria zijn meegeven dan krijg je dus alle records terug...

if(!empty($_POST["search"])) {

	$query = "SELECT * FROM sch_map.kenniskaart 
			WHERE	onderwerp ~* COALESCE(".$onderwerp.",onderwerp)
				AND	wat ~* COALESCE('".$wat."',wat)
				AND	why ~* COALESCE('".$why."',why)
				AND	how ~* COALESCE('".$how."',how)
				AND	niveau::text ~* COALESCE('".$niveau."',niveau)::text
			ORDER BY kenniskaart_id desc";

	$result = $db_handle->runQuery($query);
