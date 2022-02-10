<?php

/**
 * Class to handle Profiles
 */

class Profile
{
    // Properties
    public $id = null;
    public $userId = null;
    public $firstname = null;
    public $lastname = null;
    public $email = null;
    public $phone = null;
    public $gender = null;
    public $nationalId = null;

    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */

    public function __construct( $data=array() ) {
      if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
      if ( isset( $data['userid'] ) ) $this->userId = (int) $data['userid'];
      if ( isset( $data['first_name'] ) ) $this->firstname = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['first_name'] );
      if ( isset( $data['last_name'] ) ) $this->lastname = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['last_name'] );
      if ( isset( $data['email'] ) ) $this->email = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['email'] );
      if ( isset( $data['phone'] ) ) $this->phone = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['phone'] );
      if ( isset( $data['gender'] ) ) $this->gender = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['gender'] );
      if ( isset( $data['national_id'] ) ) $this->nationalId = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['national_id'] );
      
    }

    /**
    * Sets the object's properties using the edit form post values in the supplied array
    *
    * @param assoc The form post values
    */

    public function storeFormValues( $params ) {

      // Store all the parameters
      $this->__construct( $params );

    }

    /**
    * Returns a Profile object matching the given F.A.Q ID
    *
    * @param int The Profile ID
    * @return Profile|false The User object, or false if the record was not found or there was a problem
    */

    public static function getById( $id ) {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "SELECT * FROM profiles WHERE id = :id";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":id", $id, PDO::PARAM_INT );
      $st->execute();
      $row = $st->fetch();
      $conn = null;
      if ( $row ) return new Profile( $row );
    }

    public static function getByUserId( $user_id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM profiles WHERE userid = :userid";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":userid", $user_id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Profile( $row );
    }

    /**
    * Returns all (or a range of) User objects in the DB
    *
    * @param int Optional The number of rows to return (default=all)
    * @return Array|false A two-element array : results => array, a list of user objects; totalRows => Total number of articles
    */

    public static function getList( $numRows=1000000 ) {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM profiles
              ORDER BY id DESC LIMIT :numRows";

      $st = $conn->prepare( $sql );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $list = array();

      while ( $row = $st->fetch() ) {
        $user = new Profile( $row );
        $list[] = $user;
      }

      // Now get the total number of users that matched the criteria
      $sql = "SELECT FOUND_ROWS() AS totalRows";
      $totalRows = $conn->query( $sql )->fetch();
      $conn = null;
      return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    /**
    * Inserts the current user object into the database, and sets its ID property.
    */

    public function insert() : int{

      // Does the user object already have an ID?
      if ( !is_null( $this->id ) ) trigger_error ( "Profile::insert(): Attempt to insert a Profile object that already has its ID property set (to $this->id).", E_USER_ERROR );
      // Insert the user
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql ="INSERT INTO profiles (userid, first_name,last_name,email,phone,gender,national_id) 
             VALUES (:userid,:first_name,:last_name,:email,:phone,:gender,:national_id)";

      $st = $conn->prepare ( $sql );
      $st->bindValue( ":userid",      $this->userId, PDO::PARAM_INT );
      $st->bindValue( ":first_name",  $this->firstname, PDO::PARAM_STR );
      $st->bindValue( ":last_name",   $this->lastname, PDO::PARAM_STR );
      $st->bindValue( ":email",       $this->email, PDO::PARAM_STR );
      $st->bindValue( ":phone",       $this->phone, PDO::PARAM_STR );
      $st->bindValue( ":gender",      $this->gender, PDO::PARAM_STR );
      $st->bindValue( ":national_id", $this->nationalId, PDO::PARAM_STR );
      $st->execute();
      $this->id = $conn->lastInsertId();
      $conn = null;
      return $this->id;
    }


    /**
    * Updates the user object in the database.
    */

    public function update(){

      // Does the user object have an ID?
      if ( is_null( $this->userId ) ) trigger_error ( "Profile::update(): Attempt to update a Profile object that does not have its ID property set.", E_USER_ERROR );
    
      // Update the user
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "UPDATE profiles 
              SET first_name=:first_name,last_name=:last_name,email=:email,phone=:phone,gender=:gender,national_id=:national_id 
              WHERE userid = :userid";

      $st = $conn->prepare ( $sql );
      $st->bindValue( ":userid",     $this->userId, PDO::PARAM_INT );
      $st->bindValue( ":first_name", $this->firstname, PDO::PARAM_STR );
      $st->bindValue( ":last_name",  $this->lastname, PDO::PARAM_STR );
      $st->bindValue( ":email",      $this->email, PDO::PARAM_STR );
      $st->bindValue( ":phone",      $this->phone, PDO::PARAM_STR );
      $st->bindValue( ":gender",     $this->gender, PDO::PARAM_STR );
      $st->bindValue( ":national_id",$this->nationalId, PDO::PARAM_STR );
      
      $st->execute();
      $conn = null;
    }

    /**
    * Deletes the current user object from the database.
    */

    public function delete() {

      // Does the user object have an ID?
      if ( is_null( $this->id ) ) trigger_error ( "Profile::delete(): Attempt to delete a Profile object that does not have its ID property set.", E_USER_ERROR );

      // Delete the user
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $st = $conn->prepare ( "DELETE FROM profiles WHERE id = :id LIMIT 1" );
      $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
      $st->execute();
      $conn = null;
    }

}

?>