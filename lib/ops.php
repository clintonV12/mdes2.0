<?php

function getIllnessByOperation($id){
    $op = Operation::getByUserId( $id );
    $potential_illness = array();

    if($op->vaccination == "No"){
        array_push($potential_illness,"Chicken pox");
        array_push($potential_illness,"hepatitis A");
        array_push($potential_illness,"hepatitis B");
        array_push($potential_illness,"Pneumonia");
    }
    if($op->back_surgery == "Yes"){
        array_push($potential_illness,"Arthritis");
    }
    if($op->thyroid == "Yes"){
        array_push($potential_illness,"Hypothyroidism");
        array_push($potential_illness,"Hyperthyroidism");
    }
    if($op->rectal_surgery == "Yes"){
        array_push($potential_illness,"Dimorphic hemmorhoids(piles)");
    }

    return $potential_illness;
}
