
<?php
require_once("f_history.php");
require_once("meds.php");
require_once("pro.php");
require_once("ops.php");

$id = $_SESSION['user_id'];
$arr1 = getIllnessByFamilyHistory($id);
$arr2 = getIllnessByMedication($id);
$arr3 = getIllnessByOperation($id);
$arr4 = getIllnessByProfile($id);

$illness = array_merge($arr1,$arr2,$arr3,$arr4);
$illness = array_unique($illness);

function my_select( $prognosis ) :array{
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM Training WHERE prognosis = :prognosis";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":prognosis", $prognosis, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();

    return array_keys($row, 1);
}

function risk_factor( $illness ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT risk FROM risk_factor WHERE illness = :illness";
    $st = $conn->prepare( $sql );
    @$st->bindValue( ":illness", $illness, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    
    if(!is_bool($row))
        return $row['risk'];
    else
        return "Risk factor not available";
}

function getPrognosis(array $vals) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );

    $sql = "SELECT prognosis FROM Training WHERE";
    $str = ""; 

    $numItems = count($vals);
    $i = 0;
    
    foreach($vals as $val){
        if($i === $numItems-1) {
            $str = $str." ".$val." = 1";
        }else if($i < $numItems-1){
            $str = $str." ".$val." = 1 AND";
        }
        $i++;
    }
    $sql = $sql.$str;

    $st = $conn->prepare( $sql );
    $st->execute();
    $rows = $st->fetchAll(PDO::FETCH_ASSOC);

    $prognosis = array();
    foreach($rows as $row){
        if (!in_array($row['prognosis'], $prognosis))
        {
            $prognosis[] = $row['prognosis']; 
        }
    }

    /*ob_flush();
    ob_start();
    var_dump($prognosis);    
    file_put_contents("dump.txt", ob_get_flush());*/
    
    if(!is_null($prognosis))
        return $prognosis;
    else
        return "Not found";
}

$risks = array();
foreach($illness as $i){
    array_push($risks,risk_factor($i));
}

$symptoms = array();
foreach($illness as $ill){
    $temp = array();
    $temp = my_select( $ill);
    $temp = array_values($temp);
    $symptoms = array_merge($symptoms,$temp);
}

$symptoms = array_filter( $symptoms, fn($arrayEntry) => !is_numeric($arrayEntry));
$symptoms = array_unique($symptoms);
$symptoms = array_values($symptoms);

//var_dump($symptoms);die();
//Display question without underscore character
/*
foreach($symptoms as $sy){
    echo str_replace('_', ' ', $sy)."\n";
}*/

//print_r($symptoms);
//die();
