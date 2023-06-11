<?php
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php)
$user = new User();

// calling the checkUserSession() method of the User class and storing result in $usersession variable 
$usersession = $user->checkUserSession();

// calling the addToFavouriteRecipes() method of the User class and storing result in the $addfavouriterecipe variable 
$addtofavouriterecipe = $user->addToFavouriteRecipes();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">


  <title>User Recipes Page</title>

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
        <li><a href="userhome.php"><button>Home</button></a></li>
        <li><a href="userinventory.php"><button>Inventory</button></a></li>
        <li><a href="userrecipes.php"><button>Recipes</button></a></li>
        <li><a href="userarticles.php"><button>Articles</button></a></li>
        <li><a href="userwastagetips.php"><button>Wastage Summary</button></a></li>
        <li><a href="userfavouriterecipes.php"><button>Favourite Recipes</button></a></li>

      </ul>
    </nav>
  </header>
</head>

<body>

  <div class="userrecipesgrid">
    <div class="userrecipesgrid-item1">
      <h2>Recipe Search</h2>
      <form class="recipesearchform" action="" method="GET">
        <input type="text" name="search" required value="<?php $recipesearchresults = $user->getRecipe();
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
            <th scope="col">Add To Favourites</th>
          </tr>
        </thead>
        <tbody>
          <?php

          /* Calling the displayRecipe() method of the User class, and passing in the $recipesearchresults variable value
          from the Recipe Search form. 
          Result is then stored in $displayrecipes variable */
          $displayuserrecipes = $user->displayUserRecipe($recipesearchresults);
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