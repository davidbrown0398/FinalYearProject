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

// setting the $username variable from the llwuser session - Needed to get user's inventory
$username = $_SESSION['llwuser'];

// calling the getUserInventory() method of the User class and storing result in the $userinventoryarray variable 
$userinventoryarray = $user->getUserInventory();

// calling the removeButtonUserInventory() method of the User class and storing result in the $removebuttonuserinventory variable 
$removebuttonuserinventory = $user->removeButtonUserInventory();

// calling the consumedButtonUserInventory() method of the User class and storing result in the $consumedbuttonuserinventory variable 
$consumedbutton= $user->consumedButtonUserInventory();

// calling the notConsumedButtonUserInventory() method of the User class and storing result in the $consumedbuttonuserinventory variable 
$notconsumedbutton = $user->notConsumedButtonUserInventory();

// calling the insertFoodIntoUserInventory() method of the User class and storing result in the $insertuserfood variable 
$insertuserfood = $user->insertFoodIntoUserInventory();

// calling the insertFoodIntoUserInventory() method of the User class and storing result in the $insertuserfood variable 
$createfood = $user->createFood();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">

  <title>User Inventory Page

  </title>
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


  <div class="userinventorygrid">
    <div class="userinventorygrid-item1">

      <table class="inventorytable">
        <thead>
          <tr>
            <th scope="col">UserFood ID</th>
            <th scope="col">User</th>
            <th scope="col">Food Name</th>
            <th scope="col">Food Category</th>
            <th scope="col">Purchase Date</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Consumed?</th>
            <th scope="col">Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php 
        $displayuserinventory = $user->displayUserInventory($userinventoryarray);
          ?>
        </tbody>
      </table>
    </div>

    <div class="userinventorygrid-item2">
      <h2>Insert Food</h2>
      <form class="insertfoodform" action="" method="POST">
        <?php
        // retrieving the user id from the username of the session
        $query = "SELECT user_id FROM llw_user WHERE user = '$username'";
        $result = $conn->query($query);
        $llwuser = $result->fetch_assoc();
        $user_id = $llwuser['user_id'];

        // Creating an array of foods
        $query = "SELECT food_id, food_name FROM llw_food";
        $result = $conn->query($query);
        $foods = array();
        while ($row = $result->fetch_assoc()) {
          $foods[] = $row;
        }

        // Creating an array of food categories
        $query = "SELECT food_category_id, category_name FROM llw_food_category";
        $result = $conn->query($query);
        $categories = array();
        while ($row = $result->fetch_assoc()) {
          $categories[] = $row;
        }
        ?>
        <br>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <label for="food_name">Select Food:</label>
        <select id="food_id" name="food_id" required>
          <?php foreach ($foods as $food) { // allows for list of foods to be displayed to choose from?> 
            <option value="<?= $food['food_id'] ?>"><?= $food['food_name'] ?></option>
          <?php } ?>
        </select>
        <br>
        <label for="category_name">Select Category:</label>
        <select id="food_category_id" name="food_category_id" required>
          <?php foreach ($categories as $category) { // allows for list of food categories to be displayed to choose from?>
            <option value="<?= $category['food_category_id'] ?>"><?= $category['category_name'] ?></option>
          <?php } ?>
        </select>
        <br>
        <label for="purchase_date">Purchase Date:</label>
        <input type="date" id="purchase_date" name="purchase_date" required>
        <br>
        <label for="expiry_date">Expiry Date:</label>
        <input type="date" id="expiry_date" name="expiry_date" required>
        <br>
        <button type="reset" name="reset">Reset</button> <button type="insert" name="insert">Insert</button>
      </form>
    </div>


    <div class="userinventorygrid-item3">
      <h2>Create Food</h2>
      <form class="createfoodform" action="userinventory.php" method="POST">
        <p><label>Can"t find your food? Try creating it here!</label></p>
        <input type="text" name="food_name" id="food_name" required>
        <button name="createfood" type="submit">Submit</button>



      </form>
    </div>

</body>
<footer>
  <h4>CONTACT</h4>
  <h4>Little Less Waste &copy; 2023</h4>
</footer>

</html>