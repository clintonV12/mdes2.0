<?php

function getIllnessByFamilyHistory($id){
    $fh = FamilyHistory::getByUserId( $id );
    $potential_illness = array();

    if($fh->diabetes == "Yes"){
        array_push($potential_illness,"Diabetes");
    }
    if($fh->asthma == "Yes"){
        array_push($potential_illness,"Bronchial Asthma");
    }
    if($fh->high_blood_pressure == "Yes"){
        array_push($potential_illness,"Hypertension");
    }
    if($fh->stroke == "Yes"){
        array_push($potential_illness,"Paralysis (brain hemorrhage)");
    }

    return $potential_illness;
}