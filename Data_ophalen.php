<?php
include("ini/functie.inc");
class Connection {
 
    /**
     * Connection
     * @var type 
     */
    private static $conn;
 
    /**
     * Connect to the database and return an instance of \PDO object
     * @return \PDO
     * @throws \Exception
     */
    public function connect() {
 
        // read parameters in the ini configuration file
        $params = parse_ini_file('.\ini\database_2.ini');
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
 
    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }
 
        return static::$conn;
    }

    /**
     * Return all rows in the naam table
     * @return array
     */
    public function all_naam() {
        $stmt = $this->pdo->query('SELECT kenniskaart_id, titel, wat, wie, hoe, waarom, niveau, rol, onderwerp, bronnen'
                . 'FROM sch_kennis.kenniskaart '
                . 'ORDER BY kenniskaarT_id');

        $kaart = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $kaart[] = [
                'kenniskaart_id' => $row['kenniskaart_id'],
                'titel' => $row['titel'],
                'wat' => $row['wat'],
                'auteur' => $row['auteur'],
                'hoe' => $row['hoe'],
                'waarom' => $row['waarom'],
                'niveau' => $row['niveau'],
                'rol' => $row['rol'],
                'onderwerp' => $row['onderwerp'],
                'bronnen' => $row['bronnen']
            ];
        }
        return $kaart;
    }
}

# legt een connectie neer en export data van de database
if (isset($_POST['titel']) and $_POST['kenniskaart_id'] and $_POST['wat'] and $_POST['auteur'] and $_POST['hoe'] and $_POST['waarom'] and $_POST['niveau'] and $_POST['rol'] and $_POST['onderwerp'] and $_POST['bronnen']) {

    $kenniskaart_id = $row['kenniskaart_id'];
    $titel = $_POST['titel'];
    $wat = $_POST['wat'];
    $auteur = $_POST['auteur'];
    $hoe = $_POST['hoe'];
    $waarom = $_post['waarom'];
    $niveau = $_post['niveau'];
    $rol = $_post['rol'];
    $onderwerp = $_post['onderwerp'];
    $bronnen = $_post['bronnen'];

    $checkbox1=$_POST['niveau'];
    $chk="";  
    foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 

   $checkbox2=$_POST['rol'];
    $rol="";  
    foreach($checkbox2 as $rol1)  
   {  
      $rol .= $rol1.",";  
   } 

   $checkbox3=$_POST['onderwerp'];
    $onderwerp="";  
    foreach($checkbox3 as $onderwerp1)  
   {  
      $onderwerp .= $onderwerp1.",";  
   } 

try {
	$pdo = Connection::get()->connect();
    // 
    $sql_insert_naam = "INSERT INTO sch_kennis.kenniskaart(titel, wat, auteur, hoe, waarom, niveau, rol, onderwerp, bronnen) VALUES ('$_POST[titel]', '$_POST[wat]', '$_POST[auteur]', '$_POST[hoe]', '$_POST[waarom]', '$chk', '$rol', '$onderwerp', '$_POST[bronnen]')";
    $stmt = $pdo->query($sql_insert_naam);

 if($stmt === false){
	die("Error executing the query: $sql_get_depts");
    }
    }
catch (PDOException $e){
	echo $e->getMessage();
}
}

    $sql_get_kaart = "SELECT kenniskaart_id, titel, wat, auteur, hoe, waarom, niveau, rol, onderwerp, bronnen FROM sch_kennis.kenniskaart where kenniskaart_id = 1 order by titel;";

try {
	$pdo = Connection::get()->connect();
    #echo 'A connection to the PostgreSQL database sever has been established successfully.';
    // 
 $stmt = $pdo->query($sql_get_kaart);
 
 if($stmt === false){
	die("Error executing the query: $sql_get_depts");
 }
 
}catch (PDOException $e){
	echo $e->getMessage();
}

$sql = "SELECT kenniskaart_id, titel, wat, auteur, hoe, waarom, niveau, rol, onderwerp, bronnen FROM sch_kennis.kenniskaart where kenniskaart_id = 1" ; 
$sql_result = sql_execute($sql,1) ;
foreach ($sql_result as $row) { 
    // FORMFIELDS SET
    $kenniskaart_id= $row[0];
    $titel= $row[1];
    $wat= $row[0];
    $auteur= $row[0];
    $hoe= ($row[0]);
    $waarom= $row[0];
    $niveau= $row[6];
    $rol= $row[7];
    $onderwerp= $row[0];
    $bronnen= $row[0];
    }

?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="kenniskaart.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kenniskaart</title>
    </head>

    <body>
        <div class="text" id="kaart-title">
            <table>
                <tr>
                    <td><?php echo $titel ?></td>
                </tr>
            </table>
        </div>

        <div class="text" id="selections">
            <div class="text" id="niv-rol-sub">
            <table>
                <tr>Niveau:
                    <td><?php echo $niveau ?></td>
                </tr>
            </table>
                <ul>Rol: <?php echo $rol ?></ul>
                <ul>Onderwerp: Gebruikersinteractie analyseren etc.</ul>
                <span class="horizontal-line-small"></span> 
            </div>
            <div class="text" id="aut-dat-edit">
                <ul>Auteur: Gert van Hardeveld</ul>
                <ul>Datum van uitgave: 23-08-2019</ul>
                <ul>Laatst bewerkt: 19-09-2020</ul>
                <span class="horizontal-line"></span> 
            </div>
        </div>


        <div class="text" id="info">
            <div class="text" id="box-title">
                <p>Wat is het?</p>
                <div class="text" id="box-text">
                    <ul>Aqui blaborerrum suscili beaque optatur, 
                        ommolo volorerspe excest quae sed excea sed el magnimus expe sum ut eat voloribus, 
                        que paria dolenis ciditetur aut acepedis provit ea plicti quatur, 
                        intios porpor auda iur aut ipsum que cum fugiam et omnia voles iliciet volliquam ad 
                        exerrum in pore net pera dolectem ut ipsam re, simpe sunt volorit quo dus ra natate 
                        nimporest officate erspid quiatiant labo. Nequia aut landa vel maio. Cus accae. Quiam, 
                        quam fugias el ipic to dunt quati nonse sedit el estemque nonecus aperia derferumetus 
                        nonsequid et atiaepre molorit veles ut aut il iur solecta sperum est ut faceperi sum, 
                        tet quodis quam vollumquis nim facero vel imagnihilit vellia consequo quiatur, volupta
                        quodigento de cone
                    </ul>
                </div>

        <div class="text" id="box-title">
            <p>Waarvoor wordt het gebruikt?</p>
            <div class="text" id="box-text">
                <ul>Aqui blaborerrum suscili beaque optatur, 
                ommolo volorerspe excest quae sed excea sed el magnimus expe sum ut eat voloribus, 
                que paria dolenis ciditetur aut acepedis provit ea plicti quatur, 
                intios porpor auda iur aut ipsum que cum fugiam et omnia voles iliciet volliquam ad 
                exerrum in pore net pera dolectem ut ipsam re, simpe sunt volorit quo dus ra natate 
                nimporest officate erspid quiatiant labo. Nequia aut landa vel maio. Cus accae. Quiam, 
                quam fugias el ipic to dunt quati nonse sedit el estemque nonecus aperia derferumetus 
                nonsequid et atiaepre molorit veles ut aut il iur solecta sperum est ut faceperi sum, 
                tet quodis quam vollumquis nim facero vel imagnihilit vellia consequo quiatur, volupta
                quodigento de cone  </ul>
            </div>

        <div class="text" id="box-title">
            <p>Hoe wordt het toegepast?</p>
            <div class="text" id="box-text">
                <ul>Aqui blaborerrum suscili beaque optatur, 
                ommolo volorerspe excest quae sed excea sed el magnimus expe sum ut eat voloribus, 
                que paria dolenis ciditetur aut acepedis provit ea plicti quatur, 
                intios porpor auda iur aut ipsum que cum fugiam et omnia voles iliciet volliquam ad 
                exerrum in pore net pera dolectem ut ipsam re, simpe sunt volorit quo dus ra natate 
                nimporest officate erspid quiatiant labo. Nequia aut landa vel maio. Cus accae. Quiam, 
                quam fugias el ipic to dunt quati nonse sedit el estemque nonecus aperia derferumetus 
                nonsequid et atiaepre molorit veles ut aut il iur solecta sperum est ut faceperi sum, 
                tet quodis quam vollumquis nim facero vel imagnihilit vellia consequo quiatur, volupta
                quodigento de cone  </ul>
            </div>  
        </div>

    <div class="button" id="buttons">
        <div class="text" id="button-back">
            
        </div>
    </div>

    </body>
</html>