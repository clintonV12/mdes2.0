<?php

class CurrentMedication {
    public $id;
    public $userid;
    public $list_of_meds;

    /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['userid'] ) ) $this->userid = (int) $data['userid'];
    if ( isset( $data['list_of_meds'] ) ) $this->list_of_meds = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['list_of_meds'] );
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

  public static function getByUserId( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM current_meds WHERE userid = :userid";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":userid", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new CurrentMedication( $row );
  }

  public static function getIllnessFromTreatment( $meds ) {
    $illness = array();

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT illness FROM treatment WHERE meds LIKE :meds";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":meds", "%".$meds."%", PDO::PARAM_STR );
    $st->execute();
    
    while ( $row = $st->fetch() ) {
      array_push($illness,$row['illness']);
    }

    $conn = null;
    return $illness;
  }

  public function insert() {

    // Does the F.A.Q object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "User::insert(): Attempt to insert a User object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the F.A.Q
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO current_meds ( userid,list_of_meds) VALUES ( :userid,:list_of_meds )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid", $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":list_of_meds", $this->list_of_meds, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public function update() {

    // Does the committee object have an ID?
    if ( is_null( $this->userid ) ) trigger_error ( "CurrentMedication::update(): Attempt to update a CurrentMedication object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the committee
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE current_meds SET list_of_meds=:list_of_meds 
            WHERE userid = :userid";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid", $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":list_of_meds", $this->list_of_meds, PDO::PARAM_STR );
    $st->execute();
    $conn = null;
  }


  /**
  * Deletes the current user object from the database.
  */

  public function delete() {

    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "CurrentMedication::delete(): Attempt to delete a CurrentMedication object that does not have its ID property set.", E_USER_ERROR );

    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM current_meds WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
}