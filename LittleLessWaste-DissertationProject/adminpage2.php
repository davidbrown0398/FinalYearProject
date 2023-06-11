<?php
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php)
$user = new User();

// calling the checkAdminSession() method of the User class and storing result in $adminsession variable 
$adminseession = $user->checkAdminSession();

// calling the getlAllFoods() method of the User class and storing result in the $foodarray variable 
$foodarray = $user->getAllFoods();

// calling the removeFood() method of the User class and storing result in the $removefood variable 
$removefood = $user->removeFood();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylesheet.css">

  <title>User Home</title>


  <header class="userheader">
    <img class="logo" src="./images/LogoNoBG.svg" alt="logo">


    <a href="logout.php">
      <div class=divpersonicon>
        <img class="personicon" src="./images/Person Icon.svg" alt="personicon">
        <p>LOG OUT</p>
      </div>
    </a>

    <nav>
      <ul class="navbar">
        <li><a href="adminhome.php"><button>Users</button></a></li>
        <li><a href="adminpage2.php"><button>Foods</button></a></li>

      </ul>
    </nav>
  </header>
</head>

<body>

  <div class="adminhomegrid">
    <div class="adminhomegrid-item1">
      <table class="inventorytable">
        <thead>
          <tr>
            <th scope="col">Food ID</th>
            <th scope="col">Food Name</th>
            <th scope="col">Added By User</th>
            <th scope="col">Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php

          /* Calling the displayAllFoods() method of the User class, and passing in the $foodarray. 
          Result is then stored in $displayfoods variable */
          $displayfoods = $user->displayAllFoods($foodarray);


          ?>
        </tbody>
      </table>
    </div>

</body>
<footer>
  <h4>CONTACT</h4>
  <h4>Little Less Waste &copy; 2023</h4>
</footer>

</html>