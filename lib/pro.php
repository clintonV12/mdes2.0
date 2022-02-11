<?php





function calculateAge($nationalId){
   $birth_year = substr($nationalId,0,2);
   $year = date("Y");
   $year_sub = substr($year,2);

   $age = 0;

   if($birth_year > $year_sub){
       $birth_year = "19".$birth_year;
       $age = $year - $birth_year;
   }
   elseif($birth_year <= $year_sub){
        $birth_year = "20".$birth_year;
        $age = $year - $birth_year;
   }

   return $age;
}

function getIllnessByProfile($id){
    $pro = Profile::getByUserId( $id );
    $potential_illness = array();

    $age = calculateAge($pro->nationalId);

    if($age <= 19 && $age >= 12){
        array_push($potential_illness,"Acne");
    }
    if($age >= 40 && $age <= 60){
        array_push($potential_illness,"Cervical spondylosis");
    }
    if($pro->gender == "Male"){
        
    }
    if($pro->gender == "Female"){}

    return $potential_illness;
}