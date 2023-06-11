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


    <title>Non User Home Page</title>
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

    <div class="userhomegrid">
        <div class="userhomegrid-item1">
            <p style="text-align: center;">
            <h2>Welcome to</h2>
            <h5>Little Less Waste</h5>
            </p>
            <p>
            <h2>Our Aims:</h2>
            </p>
            <p>Limit Wastage! </p>
            <p>Save Money!</p>
            <p>Save The Planet!</p>


        </div>

        <div class="userhomegrid-item5">
            <h2>Did You Know?</h2>

            <?php

            // calling the randomWastageFact() method of the User class and storing result in the $randomwastagefact variable
            $randomwastagefact = $user->randomWastageFact();


            ?>
        </div>

        <div class="userhomegrid-item6">
            <h2>Guide To Site</h2>
            <video class = "guidetosite"
            src="./videos/GuideToSite.mp4" type="video/mp4" controls>
            </video>
        </div>


        <div class="userhomegrid-item3">
            <h2 style="color: #2a6f73;">Recipes</h2>
            <a href="nonuserrecipes.php"><button class="userhomebutton2">Recipe Search</button></a>

        </div>
        <div class="userhomegrid-item2">
            <h2>Articles</h2>
            <a href="nonuserarticles.php"><button class="userhomebutton3">Article Search</button></a>
        </div>

        <div class="userhomegrid-item4">
            <h2>Donations</h2>
            <p>
                To help fight against the food wastage battle, we have a compiled number of food banks that will take food
                off your hands which is likely to not be consumed. </p>
            Therefore helping reducing the food you are wasting while also
            benfitting others in need!
            <br>
            <br>
            1. South Belfast Food Bank - <a class="foodbanklink" href="https://southbelfast.foodbank.org.uk/give-help/donate-food/" target="_blank">Click To Go To Page</a>
            <br>
            <br>
            2. Dundonald Food Bank - <a class="foodbanklink" href="https://dundonald.foodbank.org.uk/give-help/donate-food/" target="_blank">Click To Go To Page</a>
            <br>
            <br>
            3. South-West Belfast Food Bank - <a class="foodbanklink" href="https://southwestbelfast.foodbank.org.uk/give-help/donate-food/" target="_blank">Click To Go To Page</a>

        </div>


</body>
<footer>
    <h4>CONTACT</h4>
    <h4>Little Less Waste &copy; 2023</h4>
</footer>

</html>