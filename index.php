<?php

require( "config.php" );

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && $action != "register" && !$username ) {
  login();
  exit;
}

//var_dump($_POST);die();
switch ( $action ) {
    case 'login':
      login();
      break;
    case 'register':
      register();
      break;  
    case 'logout':
      logout();
      break;
    case 'profile':
      viewProfile();
      break;
    case 'edit_personal_info':
      editPersonalInfo();
      break;
    case 'edit_password':
      editLoginInfo();
      break;
    case 'f-history':
      viewFamilyHistory();
      break;
    case 'edit_f_history':
      editFamilyHistory();
      break;
    case 'diagnosis':
      viewDiagnosis();
      break;
    case 'med_history':
      viewMedHistory();
      break; 
    case 'edit_m1_history':
      editOperationHistory();
      break;
    case 'edit_meds':
      editMeds();
      break;
    case 'diagnosis-reponse':
      getDiagnosisResponse();
      break;                    
    default:
      homepage();
}

function login() {

    $results = array();
    $results['pageTitle'] = "User Login | MDES";
  
    if ( isset( $_POST['login'] ) ) {
  
      // User has posted the login form: attempt to log the user in
      $user = new User;
      $num = $user->getLogin($_POST['username'],$_POST['password']);
  
      if ( $num >= 1 ) {
        // Login successful: Create a session and redirect to the admin homepage
        
        $u = $user->getByCreds( $_POST['username'],$_POST['password'] );
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['user_id'] = $u->id;

        $profile = Profile::getByUserId( $_SESSION['user_id'] );
        if($profile != NULL){
          header( "Location: index.php" );
        }else{
          header( "Location: index.php?action=profile" );
        }
  
      } else {
        // Login failed: display an error message to the user
        $results['errorMessage'] = "Incorrect username or password. Please try again.";
        require( TEMPLATE_PATH . "/login.php" );
      }
  
    } else {
  
      // User has not posted the login form yet: display the form
      require( TEMPLATE_PATH . "/login.php" );
    }  
}

function register() {
    $results = array();
    $results['pageTitle'] = "Sign Up";
    $results['formAction'] = "register";
  
    if ( isset( $_POST['Sign-up'] ) ) {
      
      if($_POST['password'] == $_POST['password_2']){
        // User has posted the data
        $user = new User;
        $user->storeFormValues( $_POST );
        $user->insert();
        header( "Location: index.php?action=login" );
      }
  
    } elseif ( isset( $_POST['Cancel'] ) ) {
      // User has cancelled their edits: return to the article list
      header( "Location: index.php" );
    } else {
  
      // User has not posted the article edit form yet: display the form
      $results['user'] = new User;
      require( TEMPLATE_PATH . "/register.php" );
    }    
}
  
function logout() {
    unset( $_SESSION['username'] );
    unset( $_SESSION['user_id'] );
    header( "Location: index.php" );
}

function viewProfile() {
    $profileIsSet = false;
    $results = array();
    $results['pageTitle'] = "Profile";
    $results['photoFormAction'] = "edit_photo";
    $results['passwordFormAction'] = "edit_password";
    $results['personalFormAction'] = "edit_personal_info";
  
    if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
    if(!isset($_SESSION['username'])){homepage();}
  
    $profile = Profile::getByUserId( $_SESSION['user_id'] );
    if($profile != NULL){ $profileIsSet = true; }
    
    $results['profile'] = $profile;
    require( TEMPLATE_PATH . "/profile.php" );
}

function editPersonalInfo(){
    $results = array();
    $results['pageTitle'] = "Profile";
    $results['photoFormAction'] = "edit_photo";
    $results['passwordFormAction'] = "edit_password";
    $results['personalFormAction'] = "edit_personal_info";
  
    if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
    if(!isset($_SESSION['username'])){homepage();}
  
    if ( isset( $_POST['saveChanges'] ) ) {
        $profile = Profile::getByUserId( $_SESSION['user_id'] );
        
        if($profile != NULL){ 
            $prof = new Profile();
            $prof->storeFormValues( $_POST );
            $prof->update();
        }
        else{
            $prof = new Profile();
            $prof->storeFormValues( $_POST );
            $prof->insert();
        }

      //get updated user info
      viewProfile();
    }else {
      // User has not posted the edit form yet: display the form
      viewProfile();
    }
}

function editLoginInfo(){
    $results = array();
    $results['pageTitle'] = "Profile";
    $results['photoFormAction'] = "edit_photo";
    $results['passwordFormAction'] = "edit_password";
    $results['personalFormAction'] = "edit_personal_info";
  
    if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
    if(!isset($_SESSION['username'])){homepage();}
    
    if ( isset( $_POST['saveChanges'] ) ) {
        if($_POST['password'] == $_POST['password2']){
            $user = new User();
            $num = $user->getLogin($_SESSION['username'],$_POST['current_password']);

            if($num >= 1){
                $user->storeFormValues( $_POST );
                $user->update();

                $u = $user->getByCreds( $_POST['username'],$_POST['password'] );
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['user_id'] = $u->id;
            }
        }
      //get updated user info
      viewProfile();
    }else {
      // User has not posted the edit form yet: display the form
      viewProfile();
    }
}

function viewFamilyHistory(){
    $historyIsSet = false;
    $results = array();
    $results['pageTitle'] = "Family History";
    $results['formAction'] = "edit_f_history";
  
    if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
    if(!isset($_SESSION['username'])){homepage();}
  
    $history = FamilyHistory::getByUserId($_SESSION['user_id']);
    if($history != NULL){ $historyIsSet = true; }

    $results['history'] = $history;
    require( TEMPLATE_PATH . "/familyHistory.php" );
}

function editFamilyHistory(){
    $results = array();
    $results['pageTitle'] = "Family History";
    $results['formAction'] = "edit_f_history";

    if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
    if(!isset($_SESSION['username'])){homepage();}
    $exists = null;

    if ( isset( $_POST['saveChanges'] ) ) {
      $exists = FamilyHistory::getByUserId($_SESSION['user_id']);
      
      if($exists != null){
        $fh = new FamilyHistory();
        $fh->storeFormValues($_POST);
        $fh->update();
      }
      else{
        $fh = new FamilyHistory();
        $fh->storeFormValues($_POST);
        $fh->insert();  
      }
    }

    viewFamilyHistory();
}

function viewDiagnosis(){
  require_once("lib/inferance_engine.php");
  
  $profileIsSet = false;
  $results = array();
  $results['pageTitle'] = "Diagnosis";
  $results['diagnosisFormAction'] = "diagnosis-reponse";

  if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
  if(!isset($_SESSION['username'])){homepage();}

  $profile = Profile::getByUserId( $_SESSION['user_id'] );
  if($profile != NULL){ $profileIsSet = true; }
  
  $results['profile'] = $profile;
  require( TEMPLATE_PATH . "/diagnosis.php" );
}

function homepage(){
  $results                        = array();
  $results['pageTitle']           = "Dashboard";

  require( TEMPLATE_PATH . "/homepage.php" );
}

function viewMedHistory() {
  $medHistoryIsSet                = false;
  $medIsSet                       = false;
  $results                        = array();
  $results['pageTitle']           = "Medical History";
  $results['operationFormAction'] = "edit_m1_history";
  $results['medsFormAction']      = "edit_meds";

  if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
  if(!isset($_SESSION['username'])){homepage();}

  $op = Operation::getByUserId( $_SESSION['user_id'] );
  $cm = CurrentMedication::getByUserId( $_SESSION['user_id'] );
  if($op != NULL){ $medHistoryIsSet = true; }
  if($cm != NULL){ $medIsSet = true; }
  
  $results['operation'] = $op;
  $results['meds'] = $cm;
  require( TEMPLATE_PATH . "/medicalHistory.php" );
}
 
function editOperationHistory(){
  $results                        = array();
  $results['pageTitle']           = "Medical History";
  $results['operationFormAction'] = "edit_m1_history";
  $results['medsFormAction']      = "edit_meds";

  if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
  if(!isset($_SESSION['username'])){homepage();}
    
  if ( isset( $_POST['saveChanges'] ) ) {
    $op = Operation::getByUserId( $_SESSION['user_id'] );

    if($op != NULL){ 
      $operation = new Operation();
      $operation->storeFormValues( $_POST );
      $operation->update();
    }
    else{
        $operation = new Operation();
        $operation->storeFormValues( $_POST );
        $operation->insert();
    }
    viewMedHistory();
  }else {
    // User has not posted the edit form yet: display the form
    viewMedHistory();
  }
}

function editMeds(){
  $results                        = array();
  $results['pageTitle']           = "Medical History";
  $results['operationFormAction'] = "edit_m1_history";
  $results['medsFormAction']      = "edit_meds";
  
  if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
  if(!isset($_SESSION['username'])){homepage();}
    
  if ( isset( $_POST['saveChanges'] ) ) {
    $cm = CurrentMedication::getByUserId( $_SESSION['user_id'] );
    
    if($cm != NULL){ 
      $med = new CurrentMedication();
      $med->storeFormValues( $_POST );
      $med->update();
    }
    else{
      $med = new CurrentMedication();
      $med->storeFormValues( $_POST );
      $med->insert();
    }
    viewMedHistory();
  }else {
    // User has not posted the edit form yet: display the form
    viewMedHistory();
  }
}

function getDiagnosisResponse(){
  require_once("lib/inferance_engine.php");

  $results = array();
  $results['pageTitle'] = "Diagnosis";
  $results['diagnosisFormAction'] = "diagnosis-reponse";

  if(isset($_SESSION['username'])){$results['username'] = $_SESSION['username'];}
  if(!isset($_SESSION['username'])){homepage();}
  

  $data = json_decode(stripslashes($_POST['data']));
  // here i would like use foreach:
  $a1 = array();
  foreach($data as $d){
    $str_arr = explode (">", $d); 
    $question = $str_arr[0];
    $answer   = $str_arr[1];

    if($answer == "Yes"){
      $a1[] = $question;
    }
  }
  
  $response = array();

  risk_factor( $illness );
  $diagnosis_result = getPrognosis($a1);

  foreach($diagnosis_result as $res){
    $rf = risk_factor($res);
    
    array_push($response,$res."=".$rf);
  }

  echo json_encode($response);

}
