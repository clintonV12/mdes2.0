<?php

class FamilyHistory{
    public $id;
    public $userid;
    public $diabetes;
    public $asthma;
    public $high_blood_pressure;
    public $high_cholesterol;
    public $stroke;
    public $mental_illness;
    public $osteoporosis;
    public $cancer;
    public $still_births;
    public $genetic_disorders;

    /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['userid'] ) ) $this->userid = (int) $data['userid'];
    if ( isset( $data['diabetes'] ) ) $this->diabetes = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['diabetes'] );
    if ( isset( $data['asthma'] ) ) $this->asthma = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['asthma'] );
    if ( isset( $data['high_blood_pressure'] ) ) $this->high_blood_pressure = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['high_blood_pressure'] );
    if ( isset( $data['high_cholesterol'] ) ) $this->high_cholesterol = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['high_cholesterol'] );
    if ( isset( $data['stroke'] ) ) $this->stroke = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['stroke'] );
    if ( isset( $data['mental_illness'] ) ) $this->mental_illness = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['mental_illness'] );
    if ( isset( $data['osteoporosis'] ) ) $this->osteoporosis = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['osteoporosis'] );
    if ( isset( $data['cancer'] ) ) $this->cancer = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['cancer'] );
    if ( isset( $data['still_births'] ) ) $this->still_births = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['still_births'] );
    if ( isset( $data['genetic_disorders'] ) ) $this->genetic_disorders = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['genetic_disorders'] );
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
  * Returns an User object matching the given F.A.Q ID
  *
  * @param int The User ID
  * @return User|false The User object, or false if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM family_history WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new FamilyHistory( $row );
  }

  public static function getByUserId( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM family_history WHERE userid = :userid";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":userid", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new FamilyHistory( $row );
  }

  /**
  * Returns all (or a range of) User objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @return Array|false A two-element array : results => array, a list of user objects; totalRows => Total number of articles
  */

  public static function getList( $numRows=1000000 ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM family_history
            ORDER BY id DESC LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $user = new FamilyHistory( $row );
      $list[] = $user;
    }

    // Now get the total number of committee that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }

  public function insert() {
    // Does the F.A.Q object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "FamilyHistory::insert(): Attempt to insert a FamilyHistory object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the F.A.Q
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO family_history (userid, asthma, diabetes, high_blood_pressure, high_cholesterol, stroke, mental_illness, osteoporosis, cancer, still_births, genetic_disorders) 
            VALUES (:userid, :asthma, :diabetes, :high_blood_pressure, :high_cholesterol, :stroke, :mental_illness, :osteoporosis, :cancer, :still_births, :genetic_disorders)";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid", $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":asthma", $this->asthma, PDO::PARAM_STR );
    $st->bindValue( ":diabetes", $this->diabetes, PDO::PARAM_STR );
    $st->bindValue( ":high_blood_pressure", $this->high_blood_pressure, PDO::PARAM_STR );
    $st->bindValue( ":high_cholesterol", $this->high_cholesterol, PDO::PARAM_STR );
    $st->bindValue( ":stroke", $this->stroke, PDO::PARAM_STR );
    $st->bindValue( ":mental_illness", $this->mental_illness, PDO::PARAM_STR );
    $st->bindValue( ":osteoporosis", $this->osteoporosis, PDO::PARAM_STR );
    $st->bindValue( ":cancer", $this->cancer, PDO::PARAM_STR );
    $st->bindValue( ":still_births", $this->still_births, PDO::PARAM_STR );
    $st->bindValue( ":genetic_disorders", $this->genetic_disorders, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public function update() {

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE family_history 
            SET asthma=:asthma, diabetes=:diabetes, high_blood_pressure=:high_blood_pressure, high_cholesterol=:high_cholesterol, stroke=:stroke, mental_illness=:mental_illness, osteoporosis=:osteoporosis, cancer=:cancer, still_births=:still_births, genetic_disorders=:genetic_disorders 
            WHERE userid = :userid";
    
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid", $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":asthma", $this->asthma, PDO::PARAM_STR );
    $st->bindValue( ":diabetes", $this->diabetes, PDO::PARAM_STR );
    $st->bindValue( ":high_blood_pressure", $this->high_blood_pressure, PDO::PARAM_STR );
    $st->bindValue( ":high_cholesterol", $this->high_cholesterol, PDO::PARAM_STR );
    $st->bindValue( ":stroke", $this->stroke, PDO::PARAM_STR );
    $st->bindValue( ":mental_illness", $this->mental_illness, PDO::PARAM_STR );
    $st->bindValue( ":osteoporosis", $this->osteoporosis, PDO::PARAM_STR );
    $st->bindValue( ":cancer", $this->cancer, PDO::PARAM_STR );
    $st->bindValue( ":still_births", $this->still_births, PDO::PARAM_STR );
    $st->bindValue( ":genetic_disorders", $this->genetic_disorders, PDO::PARAM_STR );
    $st->execute();
    $conn = null;
  }

  /**
  * Deletes the current user object from the database.
  */
  public function delete() {
    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "FamilyHistory::delete(): Attempt to delete a FamilyHistory object that does not have its ID property set.", E_USER_ERROR );

    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM family_history WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
}