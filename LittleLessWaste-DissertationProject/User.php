<?php

include('conn.php');

class User

{
    // will santize $data variable passed in using real_escape_string and htmlentities function
    function sanitizeData($data)
    {
        // global used to import the $conn variable
        global $conn;
        $data = $conn->real_escape_string($data); 
        $data = htmlentities($data);
    
        return $data;
    }
 
    // * usersession.php page *
    // uses the santizeData function on the $username and $password variables passed in
    // queries the database to check if the username and password exists in the llw_user table
    function checkUserCredentials($username, $password)
    {
        // want to test that if the username and password entered matches one in the database 
        // global used to import the $conn variable
        global $conn;
        $username = $this->sanitizeData($username);
        $password = $this->sanitizeData($password);
    
        $checkuser = "SELECT * FROM llw_user
                WHERE user = '$username'
                AND pword = '$password' ";
    
        // stores query result in $userresult variable
        $userresult = $conn->query($checkuser);
    
        // outputs potential connection error
        if (!$userresult) {
            echo $conn->error;
        }
    
    
        // The number of rows returned from $userresult is then stored in $numrow variable.
        $numrow = $userresult->num_rows;
    
        /* if SQL returns no rows of data, it means that the data from the form did not match any field values in the llw user table.
        The header will take the user to the next page if they enter the correct data or back to the login page if not
        */
        if ($numrow > 0) {
            $user = $userresult->fetch_assoc();
            if ($user['user_type'] == 'admin') {
                $_SESSION['llwadmin'] = $username;  // setting session variable 'admin' - if successful admin login 
                header("Location: adminhome.php");
            } else {
                $_SESSION['llwuser'] = $username; // setting session variable 'user' - if successful user login 
                header("Location: userhome.php");
            }
        } else {
            header("Location: login.php"); 
        }
    }

    // starts session and then checks if user session variable is set, otherwise returns to login screen
    function checkUserSession()
    {
        session_start();
        if (!isset($_SESSION['llwuser'])) {
            header("Location: login.php");
        }
    }

    // * adminhome.php page *
    // starts session and then checks if admin session variable is set, otherwise returns to login screen
    function checkAdminSession()
    {
        session_start();
        if (!isset($_SESSION['llwadmin'])) {
            header("Location: login.php");
        }
    }

    // queries the database to select all user IDs and users from the llw_user table
    // returns an array in the $userarray variable, containing each user and their user IDs
    function getAllUsers()
    {
        // global used to import the $conn variable
        global $conn;

        $read = "SELECT user_id, user FROM llw_user";

        $result = $conn->query($read);

        if (!$result) {
            echo $conn->error;
        }
        $userarray = array();

        while ($row = $result->fetch_assoc()) {

            array_push($userarray, $row);
        }
        return $userarray;
    }

    /* queries the database, if the reomove button is pressed on a certain user,
    the record of that corresponding user's user_id is deleted from the llw_user table */
    function removeUser()
    {
        // global used to import the $conn variable
        global $conn;

        //removing users if remove button pressed
        if (isset($_POST['remove'])) {
            $userid = $_POST['remove'];
            $deleteuser = "DELETE FROM llw_user WHERE user_id = '$userid';";
            $result = $conn->query($deleteuser);

            if (!$result) {
                echo $conn->error;
                exit();
            } else {
                header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    // takes in $userarray variable and uses the information from that array to output all the users and their user IDs
    /* loops through array, storing each user's information seperately as a $user variable 
    and outputting it each iteration, using the html*/
    function displayAllUsers($userarray)
    {
        if (!empty($userarray)) {
            //for every favourite in the favourites array
            foreach ($userarray as $user) {

                $userid = $user['user_id'];
                $username = $user['user'];
                $postbackself = $_SERVER['PHP_SELF']; 
                echo "<tr>
          <td>$userid </td>
          <td>$username</td>
          <td><form action = '$postbackself' method='POST'>
          <button type= 'submit' value= '$userid' name= 'remove' button class='button'>Remove</button></form></td> 
      </tr>";
            }
        } else {
            echo "<tr>
          <td>No Users Found </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
      </tr>";
        }
    }

    // * adminpage2.php page *
    // queires the database to select all foods and foods ids, as well as the users from llw_food and llw_user tables
    // returns an array in the $foodarray variable, containing the food_id, food and user
    function getAllFoods()
    {
        // global used to import the $conn variable
        global $conn;

        $read = "SELECT llw_food.food_id, llw_food.food_name, llw_user.user
        FROM llw_food
        JOIN llw_user ON llw_food.user_id = llw_user.user_id;";

        $result = $conn->query($read);

        if (!$result) {
            echo $conn->error;
        }
        $foodarray = array();

        while ($row = $result->fetch_assoc()) {

            array_push($foodarray, $row);
        }
        return $foodarray;
    }

    // takes in $foodarray variable and uses the information from that array to output all the foods, food IDs and the users that added the food
    /* loops through array, storing each foods's information seperately as a $food variable 
    and outputting it each iteration, using the html*/
    function displayAllFoods($foodarray)
    {
        if (!empty($foodarray)) {
            //for every favourite in the favourites array
            foreach ($foodarray as $food) {

                $foodid = $food['food_id'];
                $foodname = $food['food_name'];
                $username = $food['user'];

                $postbackself = $_SERVER['PHP_SELF'];
                echo "<tr>
      <td>$foodid </td>
      <td>$foodname</td>
      <td>$username</td>
      <td><form action = '$postbackself' method='POST'>
      <button type= 'submit' value= '$foodid' name= 'remove' button class='button'>Remove</button></form></td> 
        </tr>";
            }
        } else {
            echo "<tr>
      <td>No FOODS Found </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
        </tr>";
        }
    }

    /* queries the database, if the reomove button is pressed on a certain food
    the record of that corresponding food's food_id is deleted from the llw_food table */
    function removeFood()
    {
        // global used to import the $conn variable
        global $conn;

        if (isset($_POST['remove'])) {
            $foodid = $_POST['remove'];
            $deletefood = "DELETE FROM llw_food WHERE food_id = '$foodid';";

            $result = $conn->query($deletefood);

            if (!$result) {
                echo $conn->error;
                exit();
            } else {
                header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    // * createaccount.php page *
    // queries the database, if the insert button is pressed and user details are entered (includes required fields using html function)
    // checks for duplicates within the database, if there are none, will then insert the new user's information into the llw_user table
    function createUser()
    {
        // global used to import the $conn variable
        global $conn;

        //insert statement once insert button is pressed
        if (isset($_POST['insert'])) {
            $username = $_POST['user'];
            $email = $_POST['email_address'];
            $password = $_POST['pword'];


            $insertuser = "INSERT INTO llw_user (user, email_address, pword) VALUES ('$username', '$email','$password')";

            $duplicate = "SELECT * FROM llw_user  WHERE (user) = '$username'";

            $check = $conn->query($duplicate);

            // if the number of rows is equal to 0 from the $duplicate variable, then perform the insert sql
            if ($check->num_rows == 0) {
                $result = $conn->query($insertuser);

                if (!$result) {
                    echo $conn->error;
                    exit();
                } else {
                    header("Location: createaccount.php?status=success"); // will refresh the page automatically once the remove button has been hit 
                }
            } else {
                echo "<script>alert('User already exists. Please try another.')</script>"; // alert will appear if user exists already
            }
        }
    }

    // * nonuserhome.php page *
    // queries the database, to select a wastage fact from the llw_wastage_fact table
    /* will limit to display one fact and this fact will be selected at random. Will update every time 
    the page is refreshed/visited */
    function randomWastageFact()
    {
        // global used to import the $conn variable
        global $conn;

        $selectquery = "SELECT wastage_fact FROM llw_wastage_fact 
                     ORDER BY RAND ( )  LIMIT 1";



        $runquery = mysqli_query($conn, $selectquery);

        // if the number of rows from the $runquery variable is equal to 1 the information will be displayed
        // $data variable will hold the single wastage fact, and be displayed using the html.
        if (mysqli_num_rows($runquery) == 1) {
            foreach ($runquery as $data) { ?>

                <tr>
                    <td><?= $data['wastage_fact']; ?> </td>

                </tr>
            <?php
            }
            // if no wastage fact is found - therefore an error has occured
        } else {
            ?>
            <tr>
                <td>No Wastage Fact Found</td> 
            </tr>
            <?php

        }
    }

    // * nonuserrecipes.php Page *
    // gets the text entered by user in the search bar will be stored in the $searchvalues variable once the user presses the search button
    function getRecipe()
    {
        if (isset($_GET['search'])) {
            // echo $_GET['search']; - check if working
            $searchvalues = $_GET['search'];

            return $searchvalues;
        }
    }

    // takes in $searchvalues variable and uses the information from that variable to output the related recipes
    // queries the database, to select recipe information from the llw_recipe table
    /* if the queries result is greater than 0, recipe/s have been located and each recipe will be a $data variable
    that will be outputted every iteration of the for each loop using the html formatting */
    /* html formatting contains php functions preg_replace to bold print numbers for ingrediants measurements
    and nl2br to insert line breaks for spacing out text when appropriate*/
    function displayRecipe($searchvalues)
    {
        // global used to import the $conn variable
        global $conn;

        if (isset($_GET['search'])) {
            
            $selectquery = "SELECT recipe_id, recipe_name, ingredients, instructions FROM llw_recipe
                       WHERE (recipe_name) LIKE '%$searchvalues%' ";



            $runquery = mysqli_query($conn, $selectquery);

            if (mysqli_num_rows($runquery) > 0) {
                foreach ($runquery as $data) {
            ?>
                <tr>
                        <td><?= $data['recipe_id']; ?> </td>
                        <td><?= $data['recipe_name']; ?> </td>
                        <td><?= preg_replace('/(\d+)/', '<b>$1</b>', nl2br($data['ingredients'])); ?></td> 
                        <td><?= preg_replace('/(\d+)/', '<b>$1</b>', nl2br($data['instructions'])); ?> </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td>No Recipe Found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php
                    }
                }
    }

    // * userfavouriterecipes.php page *
    // sets the $username variable to match the user session
    // queires the datbase to select the favourite recipes information fromt the llw_favourite_recipe table
    // return an array in the $favouriterecipearray variable, containing the favourite recipes information added by that user
    function getFavouriteRecipes()
    {
        // global used to import the $conn variable
        global $conn;

        $username = $_SESSION['llwuser'];

        $read = "SELECT favourite_recipe_id, user, recipe_name, instructions, ingredients FROM llw_favourite_recipe
        INNER JOIN llw_recipe
        ON llw_favourite_recipe.recipe_id = llw_recipe.recipe_id
        INNER JOIN llw_user
        ON llw_favourite_recipe.user_id = llw_user.user_id
        WHERE user = '$username'";

        $result = $conn->query($read);

        if (!$result) {
            echo $conn->error;
        }
        $favouriterecipearray = array();

        while ($row = $result->fetch_assoc()) {

            array_push($favouriterecipearray, $row);
        }
        return $favouriterecipearray;
    }

    // takes in $favouriterecipearray variable and uses the information from that array to output all the favourite recipe information
    /* loops through array, storing each favourite recipes information seperately as a $favouriterecipe variable 
    and outputting it each iteration, using the html*/
    /* html formatting contains php functions preg_replace to bold print numbers for ingrediants measurements
    and nl2br to insert line breaks for spacing out text when appropraite*/
    // Once the remove button is pressed the page will automatically post back to itself, updating the favourites section appropraitely
    function displayFavouriteRecipes($favouriterecipearray)
    {

                if (!empty($favouriterecipearray)) {
                    //for every favourite in the favourites array
                    foreach ($favouriterecipearray as $favouriterecipe) {

                        $favouriteid = $favouriterecipe['favourite_recipe_id'];
                        $user = $favouriterecipe['user'];
                        $recipetitle = $favouriterecipe['recipe_name'];
                        $recipeingredients = preg_replace('/(\d+)/', '<b>$1</b>', nl2br($favouriterecipe['ingredients']));
                        $recipeinstructions = preg_replace('/(\d+)/', '<b>$1</b>', nl2br($favouriterecipe['instructions']));

                        $postbackself = $_SERVER['PHP_SELF'];
                        echo "<tr>
                    <td>$favouriteid </td>
                    <td>$user</td>
                    <td>$recipetitle</td>
                    <td>$recipeingredients</td>
                    <td>$recipeinstructions</td>
                    <td><form action = '$postbackself' method='POST'><button type= 'submit' value= '$favouriteid' name= 'remove' button class='button'>Remove</button></form></td> 
                </tr>";
                    }
                } else {
                    echo "<tr>
                    <td>No Favourites Found </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
        }
    }

    /* queries the database, if the remove button is pressed the record of that corresponding favourited recipe's, favourite_recipe_id 
    is deleted from the llw_favourite_recipe table */
    function removeFavouriteRecipe()
    {
        // global used to import the $conn variable
        global $conn;
        //removing favourites if remove button pressed
        if (isset($_POST['remove'])) {
            $favouriteid = $_POST['remove'];
            $deletefavouriterecipe = "DELETE FROM llw_favourite_recipe WHERE favourite_recipe_id = '$favouriteid';";

            $result = $conn->query($deletefavouriterecipe);

            if (!$result) {
                echo $conn->error;
                exit();
            } else {
                echo "<script>alert('Recipe Removed From Favourites')</script>";
                header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    // *User Inventory page*
    // sets the $username variable to match the user session
    // queires the database to select user's food information for the llw_user_food table
    // returns an array in the $userinvetoryarray variable, containing the chosen food information 
    function getUserInventory()
    {
        // global used to import the $conn variable
        global $conn;

        $username = $_SESSION['llwuser'];
        // selecting the users food inventory data, then inserting it into an array 
        $read = "SELECT user_food_id, user, food_name, category_name, purchase_date, expiry_date, consumed FROM llw_user_food
        INNER JOIN llw_food
        ON llw_user_food.food_id = llw_food.food_id
        INNER JOIN llw_user
        ON llw_user_food.user_id = llw_user.user_id
        INNER JOIN llw_food_category
        ON llw_user_food.food_category_id = llw_food_category.food_category_id
        WHERE user = '$username'
        ORDER BY expiry_date";

        $result = $conn->query($read);

        if (!$result) {
        echo $conn->error;
        }
        $userinventoryarray = array();

        while ($row = $result->fetch_assoc()) {

        array_push($userinventoryarray, $row);
        }
        return $userinventoryarray;
    }

    // takes in $userinventoryarray variable and uses the information from that variable to output the related food information
    // queries the database, to select user's food information from the llw_user_food table
    /* loops through array, storing each of the food information seperately as a $userinventory variable 
    and outputting it each iteration, using the html*/
    // Uses the expiry date information to find out the days remaing and output that to screen
    // Will post back to the page automatically displaying updated results if the 'yes', 'no', or 'remove' buttons are pressed in the food inventory section
    function displayUserInventory($userinventoryarray)
    {
        // if the userinventoryarray is not empty- will loop through each item in the userinvetory and storing each one with its data attached
        if (!empty($userinventoryarray)) {
            //for every user's invetory in the userinventory array
            foreach ($userinventoryarray as $userinventory) {

              $userfoodid = $userinventory['user_food_id'];
              $user = $userinventory['user'];
              $foodname = $userinventory['food_name'];
              $foodcategory = $userinventory['category_name'];
              $purchasedate = $userinventory['purchase_date'];
              $expirydate = $userinventory['expiry_date'];
              $consumed = $userinventory['consumed'];
              $daysremaining = (strtotime($expirydate) - strtotime(date('Y-m-d'))) / 86400; //seconds in a day



              $postbackself = $_SERVER['PHP_SELF'];
              echo "<tr>
                    <td>$userfoodid </td>
                    <td>$user</td>
                    <td>$foodname</td>
                    <td>$foodcategory</td>
                    <td>$purchasedate</td>
                    <td>$expirydate ($daysremaining day/s remaining)</td>
                    <td><form class= 'inventoryform' action = '$postbackself' method='POST'>
                    <button type= 'submit' value= '$userfoodid' name= 'remove' <button>Yes</button>
                    <button type= 'submit' value= '$userfoodid' name= 'wastefood' <button>No</button>
                     </form></td> 
                    <td><form class= 'inventoryform' action = '$postbackself' method='POST'><button type= 'submit' value= '$userfoodid' name= 'remove' <button>Yes</button></form></td> 
                </tr>";
            }
          } else {
            echo "<tr>
                    <td>No Foods Found In User's Inventory </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
          }
    }

    /* queries the database, if the remove button is pressed on a certain user's food,
    the record of that corresponding foods user_food_id is deleted from the llw_user_food table */
    function removeButtonUserInventory()
    {
        // global used to import the $conn variable
        global $conn;

        // removing foods from inventory if remove button pressed
        if (isset($_POST['remove'])) {
            $userfoodid = $_POST['remove'];
            $deleteuserinventory = "DELETE FROM llw_user_food WHERE user_food_id = '$userfoodid';";
        
            $result = $conn->query($deleteuserinventory);
        
            if (!$result) {
            echo $conn->error;
            exit();
            } else {
            header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    /* queries the database, if the consumed button is pressed on a certain user's food,
    the record of that corresponding foods user_food_id is deleted from the llw_user_food table */
    function consumedButtonUserInventory()
    {
        // global used to import the $conn variable
        global $conn;
        // removing foods from inventory if consumed-yes button is pressed
        if (isset($_POST['remove'])) {
            $userfoodid = $_POST['remove'];
            $deleteuserinventory = "DELETE FROM llw_user_food WHERE user_food_id = '$userfoodid';";
        
            $result = $conn->query($deleteuserinventory);
        
            if (!$result) {
            echo $conn->error;
            exit();
            } else {
            header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    /* queries the database, if the 'yes' button for food wasted is pressed on a certain user's food,
    the record of that corresponding foods user_food_id is deleted from the llw_user_food table 
    and inserted into the foodwasted table */
    function notConsumedButtonUserInventory()
    {
        // global used to import the $conn variable
        global $conn;
        // inserting foods into foodwasted table if consumed-no button is pressed (this will be displayed in pie chart)
        // then deleting the foods from user inventory
        if (isset($_POST['wastefood'])) {
            $userfoodid = $_POST['wastefood'];
            $insertfoodwasted = "INSERT INTO llw_food_wasted (user_id, food_id, food_category_id) 
            SELECT user_id, food_id, food_category_id 
            FROM llw_user_food 
            WHERE user_food_id = $userfoodid";

            $deleteuserinventory = "DELETE FROM llw_user_food WHERE user_food_id = '$userfoodid';";
            //performing the insert before deleting the data
            $result = $conn->query($insertfoodwasted);
            $result = $conn->query($deleteuserinventory);
        
            if (!$result) {
            echo $conn->error;
            exit();
            } else {
            echo "<script>alert('Food Was Added To Wastage Summary')</script>"; // lets user know food was added to wastage summary 
            header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    /* queries the database, if the 'insert' button is pressed and the required fields are filled out(done using html).
    Information will be inserted into the llw_user_food table and page will automatically be reloaded to display updated results*/
    function insertFoodIntoUserInventory() 
    {
        // global used to import the $conn variable
        global $conn;
        //insert statement once insert button is pressed
        if (isset($_POST['insert'])) {
            $user_id = $_POST['user_id'];
            $food_id = $_POST['food_id'];
            $food_category_id = $_POST['food_category_id'];
            $purchase_date = $_POST['purchase_date'];
            $expiry_date = $_POST['expiry_date'];
        
        
            $insertuserinventory = "INSERT INTO llw_user_food (user_id, food_id, food_category_id, purchase_date, expiry_date) VALUES ('$user_id', '$food_id','$food_category_id', '$purchase_date', '$expiry_date')";
        
            $result = $conn->query($insertuserinventory);
            if (!$result) {
            echo $conn->error;
            exit();
            } else {
            header("Refresh:0"); // will refresh the page automatically once the remove button has been hit 
            }
        }
    }

    /* queries the database, if the 'insert' button is pressed and the required fields are filled out(done using html).
    Information will be inserted into the llw_food table and page will display an alert showing if food was added or if it already exists*/
    function createFood()
    {
        // global used to import the $conn variable
        global $conn;   

        // create food and inserting it into the food table once the create food button is pressed
        if (isset($_POST['createfood'])) {
            // getting user_id from session variable
            $username = $_SESSION['llwuser'];
            $query = "SELECT user_id FROM llw_user WHERE user = '$username'";
            $result = $conn->query($query);
            $llwuser = $result->fetch_assoc();
            $user_id = $llwuser['user_id'];
            
            //preventing harmful user input
            $newfood = $conn->real_escape_string($_POST['food_name']);
        
            $insertquery = "INSERT INTO llw_food(food_name,user_id)
                            VALUES ('$newfood', '$user_id');";
        
            // SQL query to check for duplicates, will be case sensitive (will help prevent users adding duplicates)
            $duplicate = "SELECT * FROM llw_food  WHERE upper (food_name) = '$newfood'";
        
            // check for duplicate foods within the database
            $check = $conn->query($duplicate);
        
            // if there are no duplicate foods within the database, perform the insert sql
            if ($check->num_rows == 0) {
            $result = $conn->query($insertquery);
        
            if (!$result) {
                echo $conn->error;
                exit();
            } else {
                echo "<script>alert('Food Successfully Created.')</script>";
                header("Refresh:0");
            }
            } else {
            echo "<script>alert('Food already exists. Please try another.')</script>"; // JS alert if the food already exists in database
            }
        }
    }

    // *User Recipes page*
    // Need this function as the table includes a favourtie column unlike the recipe display function for non users
    // takes in $searchvalues variable and uses the information from that variable to output the related recipes
    // queries the database, to select recipe information from the llw_recipe table
    /* if the queries result is greater than 0, recipe/s have been located and each recipe will be stored as $data variable
    that will be outputted every iteration of the for each loop, using the html formatting */
    /* this function incorporates a form action that will post if added to favourites 'Yes' button is pressed,
    allowing for the recipe id to be obtained and used when inserting to user's favourites */
    function displayUserRecipe($searchvalues)
    {
        // global used to import the $conn variable
        global $conn;

        if (isset($_GET['search'])) {

            $searchvalues = $_GET['search'];
            $selectquery = "SELECT recipe_id, recipe_name, ingredients, instructions FROM llw_recipe
                WHERE (recipe_name) LIKE '%$searchvalues%' ";



            $runquery = mysqli_query($conn, $selectquery);

            if (mysqli_num_rows($runquery) > 0) {
                foreach ($runquery as $data) {
                ?>
            <tr>
                <td><?= $data['recipe_id']; ?> </td>
                <td><?= $data['recipe_name']; ?> </td>
                <td><?= preg_replace('/(\d+)/', '<b>$1</b>', nl2br($data['ingredients'])); ?></td>
                <td><?= preg_replace('/(\d+)/', '<b>$1</b>', nl2br($data['instructions'])); ?> </td>
                <td>
                    <form action="" method="POST">
                        <button type="submit" value="<?= $data['recipe_id']; ?>" name="Yes">Yes</button>
                    </form>
            </tr>
        <?php
                }
            } else {
        ?>
        <tr>
            <td>No Recipe Found</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php
        }
    }
 }

    /* queries the database, if the 'Yes' button is pressed. Information will be inserted into the llw_favourite_recipes table 
    after a duplicate check shows there is no duplicates. 
    An alert will appear letting users know if the recipe was added or if a duplicate was found.*/
    function addToFavouriteRecipes()
    {
        // global used to import the $conn variable
        global $conn;

        // Getting the user id associate with the user from the session variable
         if (isset($_POST['Yes'])) {
             $recipe_id = $_POST['Yes']; 

             // getting user id from user table using user session variable
             $user_id = "SELECT user_id FROM llw_user WHERE user = '" . $_SESSION['llwuser'] . "'";
             $result = $conn->query($user_id);
             if (!$result) {
                 echo $conn->error;
                 exit();
         }
         // fetching user_id from query result
         $user_id = $result->fetch_assoc()['user_id'];

         // inserting the recipe_id and user_id into the favourite recipes table - allowing it to be uniquely identified
         $insertfavouriterecipe = "INSERT INTO llw_favourite_recipe (recipe_id, user_id) VALUES ($recipe_id), ($user_id)";

         //duplicate check
         $duplicate = "SELECT * FROM llw_favourite_recipe WHERE recipe_id = '$recipe_id' AND user_id = '$user_id'";
         $check_result = $conn->query($duplicate);
         if ($check_result->num_rows > 0) {
             // combination of recipe_id and user_id already exists in the table, skip insert
             echo "<script>alert('Recipe Already In Favourites')</script>";
             header("Refresh:0");
             exit();
         }

         $insertfavouriterecipe = "INSERT INTO llw_favourite_recipe (recipe_id, user_id) VALUES ('$recipe_id', '$user_id')";
         $result = $conn->query($insertfavouriterecipe);
         if (!$result) {
             echo $conn->error;
             exit();
         } else {
             echo "<script>alert('Recipe Added To Favourites')</script>";
             header("Refresh:0");
         }
     }
    }
    
    // Not Used
    function getFoodsForInventory()
    {
        // global used to import the $conn variable
        global $conn;

            // Creating an array of foods
            $query = "SELECT food_id, food_name FROM llw_food";
            $result = $conn->query($query);
            $foodsarray = array();
            while ($row = $result->fetch_assoc()) {
              $foods[] = $row;
            }
            return $foodsarray;
    }

    // Not Used
    function displayFoodsForInventory($foodsarray)
    {
        foreach ($foodsarray as $food) { // will display list of foods?> 
            <option value="<?= $food['food_id'] ?>"><?= $food['food_name'] ?></option>
          <?php }
    }
}

