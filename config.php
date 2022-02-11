<?php
    ini_set( "display_errors", true );
    date_default_timezone_set( "Africa/Mbabane" );  
    define( "DB_DSN", "mysql:host=localhost;dbname=mdes" );
    define( "DB_USERNAME", "root" );
    define( "DB_PASSWORD", "" );
    define( "CLASS_PATH", "classes" );
    define( "TEMPLATE_PATH", "templates" );

    //config vaues for gallary images
    define( "GALLARY_IMAGE_PATH", "images/gallary" );
    
    //required class files
    require( CLASS_PATH . "/User.php" );
    require( CLASS_PATH . "/Profile.php" );
    require( CLASS_PATH . "/FamilyHistory.php" );
    require( CLASS_PATH . "/Operation.php" );
    require( CLASS_PATH . "/CurrentMedication.php" );

    function handleException( $exception ) {
      echo "Sorry, a problem occurred. Please try later.";
      echo $exception->getMessage();
      error_log( $exception->getMessage() );
    }

    set_exception_handler( 'handleException' );
?>
