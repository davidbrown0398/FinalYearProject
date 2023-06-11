<?php

/**
 * Database Connection Class
 * 
 */
class Database
{
  // Vars that will be used to get a database connection
  private $host;
  private $username;
  private $password;
  private $db;
  private $conn;

  public function __construct()
  {
    // these db connections values will change for online  Queen's server
    $this->host = "localhost";
    $this->username = "root";
    $this->password = "root";
    $this->db = "littlelesswaste";

    // Creating connection
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

    // Checking for connection
    if ($this->conn->connect_error) {
      echo $this->conn->connect_error;
    } else {
      // echo "successful connection"; - development aid
    }
  }

  // Will store the connection in the conn variable, this will be used for code requiring database connections
  public function getConnection()
  {
    return $this->conn;
  }
}
