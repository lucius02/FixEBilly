<?php
class Connection {
 
    //Connection @var type 
    private static $conn;
 
    //Connect to the database and return an instance of \PDO object
    //@return \PDO
    //@throws \Exception
    public function connect() {
 
        // read parameters in the ini configuration file
        $params = parse_ini_file('./ini/database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
        // connect to the postgresql database
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);
 
        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
        return $pdo;
    }
 
    //return an instance of the Connection object
    // @return type
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }
 
        return static::$conn;
    }

}

class BuildHTML {


    function display_table($array,$width){
		$html = '';
		if (! empty ($array) )
		{
		// start table
		$html = '<table class="table table-striped table-bordered" style="width:'.$width.'px;">';
		// header row
		$html .= '<thead><tr>';
		foreach($array[0] as $key=>$value){
				$html .= '<th style="text-align:left">' . htmlspecialchars($key) . '</th>';
			}
		$html .= '</tr></thead><tbody>';

		// data rows
		foreach( $array as $key=>$value){
			$html .= '<tr>';
			foreach($value as $key2=>$value2){
				$html .= '<td>' . htmlspecialchars($value2) . '</td>';
			}
			$html .= '</tr>';
		}

		// finish table and return it

		$html .= '</tbody></table>';
		}
		return $html;
	}

/*
		De volgende functie heeft als doel om met zo min mogelijk code de opgehaalde data te kunnen updaten of inserten.
		Denk aan de volgende mogelijke uitbreidingen:
		Persoon_id				--> naar een combobox label persoon, tabel persoon, PK persoon_id, FK persoon_id
		Achtergrond_kleur_id
		Voorgrond_kleur_id		--> naar een combobox label Voorgrond kleur, tabel kleur, PK kleur_id, FK voorgrond_kleur_id
		Registratie_begin_datum	--> naar een Java-datumobject(calendar) met label Registratie begin

		en een aparte functie voor het makkelijk opslaan vd gegevens

		array(2) {
					[0]=> array(3) { 	["Id."]=> int(1) 
										["Naam"]=> string(11) "Ben Nuttall" 
										["Bedrijf"]=> string(23) "Raspberry Pi Foundation" } 
					[1]=> array(3) { 	["Id."]=> int(2) 
										["Naam"]=> string(13) "Rikki Endsley" 
										["Bedrijf"]=> string(7) "Red Hat" } 
		}

		nog een list verzinnen voor de insert. Met een lege result kan ik geen fieldnames ophalen.
		id=0 reserveren voor de default waarden om te tonen?
		echo var_dump($array);
*/

   function edit_table($array,$width){
		$html = '';
		if (! empty ($array) )
		{
		// start table
		$html = '<table class="table table-striped table-bordered" style="width:'.$width.'px;">';

		// alle data rows
		foreach($array as $key=>$value){
		// alleen de eerste row
			if ($key==0) {
			$html .= '<tr><td></td><td></td></tr><tr>';
			foreach($value as $key2=>$value2){
				$html .= '<tr><td><b>' . htmlspecialchars($key2) . '</b></td>'.
				'<td>' . htmlspecialchars($value2) . '</td></tr>';
			}
			$html .= '</tr>';}
		}

		// finish table and return it

		$html .= '</tbody></table>';
		}
		return $html;
	}

}


	function display_sql_table($sqlcommand,$width) {
	//haal data op:
	$sqlresult=Connection::get()->connect()->query($sqlcommand)->fetchAll(PDO::FETCH_ASSOC);
//	echo var_dump($sqlresult);
	//bouw de html-table:
	$html=BuildHTML::display_table($sqlresult,$width);
	return $html;
	}


	function edit_sql_table($sqlcommand,$width) {
	//haal data op:
	$sqlresult=Connection::get()->connect()->query($sqlcommand)->fetchAll(PDO::FETCH_ASSOC);
	//bouw de html-table:
	$html=BuildHTML::edit_table($sqlresult,$width);
	return $html;
	}


?>