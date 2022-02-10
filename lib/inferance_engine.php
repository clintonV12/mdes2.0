
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
    $st->bindValue( ":illness", $illness, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    
    if(!is_bool($row))
        return $row['risk'];
    else
        return "Risk factor not available";
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


$symptoms = array_unique($symptoms);


//Display question without underscore character
/*
foreach($symptoms as $sy){
    echo str_replace('_', ' ', $sy)."\n";
}*/

//print_r($symptoms);
//die();
