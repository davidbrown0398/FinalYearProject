<?php
session_start();

// include('conn.php');
//include('functions.php');
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php)
$user = new User();

// Username posted from login form
$username = $_POST['usernamefield'];

// Password posted from login form
$password = $_POST['passwordfield'];

/* calling the checkUserCredentials() method of the User class and storing result in $user variable.
Will pass in the $username and $password variable values from login form */
$user = $user->checkUserCredentials($username, $password);
