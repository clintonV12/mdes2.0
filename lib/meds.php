<?php

function getIllnessByMedication($id){

    $meds = CurrentMedication::getByUserId( $id );
    $potential_illness = array();

    $meds_list  = $meds->list_of_meds;
    $meds_array = explode (",", $meds_list);

    foreach($meds_array as $med){
        
        $illness = CurrentMedication::getIllnessFromTreatment( $med );
        
        $potential_illness = array_merge($potential_illness,$illness);
    }

    return $potential_illness;
}
