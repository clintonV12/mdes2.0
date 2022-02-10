<?php

class Operation{
    public $id;
    public $userid;
    public $vaccination;	
    public $back_surgery;
    public $thyroid;
    public $appendectomy;
    public $tonsillectomy;
    public $sinus;
    public $stomach;
    public $male_female_organs;
    public $gall_bladder;
    public $hernia;
    public $tubes_in_ears;
    public $rectal_surgery;

    /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['userid'] ) ) $this->userid = (int) $data['userid'];
    if ( isset( $data['vaccination'] ) ) $this->vaccination = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['vaccination'] );
    if ( isset( $data['back_surgery'] ) ) $this->back_surgery = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['back_surgery'] );
    if ( isset( $data['thyroid'] ) ) $this->thyroid = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['thyroid'] );
    if ( isset( $data['appendectomy'] ) ) $this->appendectomy = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['appendectomy'] );
    if ( isset( $data['tonsillectomy'] ) ) $this->tonsillectomy = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['tonsillectomy'] );
    if ( isset( $data['sinus'] ) ) $this->sinus = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['sinus'] );
    if ( isset( $data['stomach'] ) ) $this->stomach = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['stomach'] );
    if ( isset( $data['male_female_organs'] ) ) $this->male_female_organs = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['male_female_organs'] );
    if ( isset( $data['gall_bladder'] ) ) $this->gall_bladder = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['gall_bladder'] );
    if ( isset( $data['hernia'] ) ) $this->hernia = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['hernia'] );
    if ( isset( $data['tubes_in_ears'] ) ) $this->tubes_in_ears = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['tubes_in_ears'] );
    if ( isset( $data['rectal_surgery'] ) ) $this->rectal_surgery = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['rectal_surgery'] );
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

  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM operations WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Operation( $row );
  }

  public static function getByUserId( $user_id ) {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "SELECT * FROM operations WHERE userid = :userid";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":userid", $user_id, PDO::PARAM_INT );
      $st->execute();
      $row = $st->fetch();
      $conn = null;
      if ( $row ) return new Operation( $row );
  }

  public function insert() : int{

    // Does the user object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Operation::insert(): Attempt to insert a Operation object that already has its ID property set (to $this->id).", E_USER_ERROR );
    // Insert the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql ="INSERT INTO operations
           (userid,vaccination,back_surgery,thyroid,appendectomy,tonsillectomy,sinus,stomach,male_female_organs,gall_bladder,hernia,tubes_in_ears,rectal_surgery) 
           VALUES (:userid,:vaccination,:back_surgery,:thyroid,:appendectomy,:tonsillectomy,:sinus,:stomach,:male_female_organs,:gall_bladder,:hernia,:tubes_in_ears,:rectal_surgery)";

    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid",             $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":vaccination",        $this->vaccination, PDO::PARAM_STR );
    $st->bindValue( ":back_surgery",       $this->back_surgery, PDO::PARAM_STR );
    $st->bindValue( ":thyroid",            $this->thyroid, PDO::PARAM_STR );
    $st->bindValue( ":appendectomy",       $this->appendectomy, PDO::PARAM_STR );
    $st->bindValue( ":tonsillectomy",      $this->tonsillectomy, PDO::PARAM_STR );
    $st->bindValue( ":sinus",              $this->sinus, PDO::PARAM_STR );
    $st->bindValue( ":stomach",            $this->stomach, PDO::PARAM_STR );
    $st->bindValue( ":male_female_organs", $this->male_female_organs, PDO::PARAM_STR );
    $st->bindValue( ":gall_bladder",       $this->gall_bladder, PDO::PARAM_STR );
    $st->bindValue( ":hernia",             $this->hernia, PDO::PARAM_STR );
    $st->bindValue( ":tubes_in_ears",      $this->tubes_in_ears, PDO::PARAM_STR );
    $st->bindValue( ":rectal_surgery",     $this->rectal_surgery, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
    return $this->id;
  }

  public function update() :bool{

    // Does the user object have an ID?
    if ( is_null( $this->userid ) ) trigger_error ( "Operation::update(): Attempt to update an Operation object that does not have its ID property set.", E_USER_ERROR );
  
    // Update the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE operations 
            SET vaccination=:vaccination,back_surgery=:back_surgery,thyroid=:thyroid,appendectomy=:appendectomy,tonsillectomy=:tonsillectomy,sinus=:sinus,
            stomach=:stomach,male_female_organs=:male_female_organs,gall_bladder=:gall_bladder,hernia=:hernia,tubes_in_ears=:tubes_in_ears,rectal_surgery=:rectal_surgery
            WHERE userid = :userid";

    $st = $conn->prepare ( $sql );
    $st->bindValue( ":userid",             $this->userid, PDO::PARAM_INT );
    $st->bindValue( ":vaccination",        $this->vaccination, PDO::PARAM_STR );
    $st->bindValue( ":back_surgery",       $this->back_surgery, PDO::PARAM_STR );
    $st->bindValue( ":thyroid",            $this->thyroid, PDO::PARAM_STR );
    $st->bindValue( ":appendectomy",       $this->appendectomy, PDO::PARAM_STR );
    $st->bindValue( ":tonsillectomy",      $this->tonsillectomy, PDO::PARAM_STR );
    $st->bindValue( ":sinus",              $this->sinus, PDO::PARAM_STR );
    $st->bindValue( ":stomach",            $this->stomach, PDO::PARAM_STR );
    $st->bindValue( ":male_female_organs", $this->male_female_organs, PDO::PARAM_STR );
    $st->bindValue( ":gall_bladder",       $this->gall_bladder, PDO::PARAM_STR );
    $st->bindValue( ":hernia",             $this->hernia, PDO::PARAM_STR );
    $st->bindValue( ":tubes_in_ears",      $this->tubes_in_ears, PDO::PARAM_STR );
    $st->bindValue( ":rectal_surgery",     $this->rectal_surgery, PDO::PARAM_STR );
    $result = $st->execute();
    $conn = null;

    return $result;
  }

  public function delete() {

    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Operation::delete(): Attempt to delete an Operation object that does not have its ID property set.", E_USER_ERROR );

    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM operations WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}