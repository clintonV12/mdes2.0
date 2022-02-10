<?php

/**
 * Class to handle Users
 */

class User
{
  // Properties

  /**
  * @var int The faq ID from the database
  */
  public $id = null;

  /**
  * @var string username
  */
  public $username = null;

  /**
  * @var string password
  */
  public $password = null;


  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['username'] ) ) $this->username = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['username'] );
    if ( isset( $data['password'] ) ) $this->password = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['password'] );
    
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

  //make the password hash
  public function hashPassword($password){
    $password = hash("sha512",$password);
    return $password;
  }



  /**
  * Returns an User object matching the given F.A.Q ID
  *
  * @param int The User ID
  * @return User|false The User object, or false if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new User( $row );
  }

  public static function getByCreds( $username, $password ) {
    $user = new User();

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users 
            WHERE username = :username AND password = :password";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":username", $username, PDO::PARAM_STR );
    $st->bindValue( ":password", $user->hashPassword($password), PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new User( $row );
  }


  /**
  * Returns all (or a range of) User objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @return Array|false A two-element array : results => array, a list of user objects; totalRows => Total number of articles
  */

  public static function getList( $numRows=1000000 ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users
            ORDER BY id DESC LIMIT :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $user = new User( $row );
      $list[] = $user;
    }

    // Now get the total number of committee that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }

  public function getLogin($username,$password):int {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users
            WHERE username = :username AND password = :password
            ORDER BY id";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":username", $username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->hashPassword($password), PDO::PARAM_STR );
    $st->execute();

    // Now get the total number of users that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return $totalRows[0] ;
  }


  /**
  * Inserts the current F.A.Q object into the database, and sets its ID property.
  */

  public function insert() {

    // Does the F.A.Q object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "User::insert(): Attempt to insert a User object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the F.A.Q
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO users ( username,password) VALUES ( :username,:password )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->hashPassword($this->password), PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  /**
  * Updates the current F.A.Q object in the database.
  */

  public function update() {

    // Does the committee object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::update(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the committee
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE users SET username=:username, password=:password WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->hashPassword($this->password), PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Deletes the current user object from the database.
  */

  public function delete() {

    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::delete(): Attempt to delete a User object that does not have its ID property set.", E_USER_ERROR );

    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>