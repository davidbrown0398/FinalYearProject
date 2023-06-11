<?php
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php) as we call a method below from User Class
$user = new User();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">

  <title>Non User Recipe Page</title>


  <header class="userheader">
    <img class="logo" src="./images/LogoNoBG.svg" alt="logo">


    <nav>
      <ul class="navbar">
        <li><a href="nonuserhome.php"><button>Home</button></a></li>
        <li><a href="nonuserrecipes.php"><button>Recipes</button></a></li>
        <li><a href="nonuserarticles.php"><button>Articles</button></a></li>
        <li><a href="logout.php"><button>Login/Create Account</button></a></li>
      </ul>
    </nav>
  </header>
</head>

<body>

  <div class="userrecipesgrid">
    <div class="userrecipesgrid-item1">
      <h2>Recipe Search</h2>
      <form class="recipesearchform" action="" method="GET">
        <input type="text" name="search" required value="<?php
        // calling the getRecipe() method of the User class and storing result in the $recipesearchresults variable 
        $recipesearchresults = $user->getRecipe();
        ?>">
        <button type="submit">Search</button>
      </form>
    </div>

    <div class="userrecipesgrid-item2">
      <table class="recipetable">
        <thead>
          <tr>
            <th scope="col">Recipe ID</th>
            <th scope="col">Recipe Name</th>
            <th scope="col">Ingredients</th>
            <th scope="col">Instructions</th>
          </tr>
        </thead>
        <tbody>
          <?php

          /* Calling the displayRecipe() method of the User class, and passing in the $recipesearchresults variable value
          from the Recipe Search form. 
          Result is then stored in $displayrecipes variable */
          $displayrecipes = $user->displayRecipe($recipesearchresults);
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