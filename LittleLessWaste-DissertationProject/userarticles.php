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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">

    <title>User Articles Page</title>


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
    <div class="userarticlesgrid">
        <div class="userarticlesgrid-item3">
            <h2>Filter By:</h2>
            <div class="articlebuttons">
                <button name="News" type="submit">News</button> &nbsp; &nbsp;
                <button name="Food" type="submit">Food</button>
            </div>
        </div>

        <div class="userarticlesgrid-item1">
            <h2>Recent Articles</h2>
            <img class="recentarticleimg" src="https://media.asiaone.com/sites/default/files/styles/article_main_image/public/original_images/Feb2023/20230227_food%20waste_pexels.jpg?itok=KGVBcbAW" alt="articleimg">
            <div class="recentarticletext">
                <h6>7 practical tips to reduce food waste at home</h6>
                <a href="https://www.asiaone.com/lifestyle/7-practical-tips-reduce-food-waste-home" target="_blank"><button>View Full Article</button></a>
                <br>
                <p>Priyanka Elhence, 27th Feburary 2023</p>
            </div>
        </div>

        <div class="userarticlesgrid-item4">
            <img class="recentarticleimg2" src="https://i.dailymail.co.uk/1s/2023/02/26/01/68088299-0-image-a-61_1677376149721.jpg" alt="articleimg">
            <div class="recentarticletext">
                <h6>How living the Good Life can bear fruit – and save you £2,000 a year as fruit and vegetable shortages hit UK supermarkets</h6>
                <a href="https://www.dailymail.co.uk/news/article-11794181/How-living-Good-Life-bear-fruit-save-2-000-year.html" target="_blank"><button>View Full Article</button></a>
                <br>
                <p>Daniel Jones, 26th Feburary 2023</p>
            </div>
        </div>

        <div class="userarticlesgrid-item2">
            <h2>Trending</h2>

            <h2>UK must prioritise food security warns NFU</h2>
            <img class="articleimg" src="https://environmentjournal.online/wp-content/uploads/sites/5/2023/02/s9xe5omkj2q.jpg" alt="articleimg">
            <div class="trendingarticletext">
                <p>Food shortages could last for weeks, says the National Farmers’ Union (NFU), as poor weather in Europe and north Africa has impacted food supply.</p>
                <br>
                <a href="https://environmentjournal.online/articles/uk-must-prioritise-food-security-warns-nfu/" target="_blank"><button>View Full Article</button></a>
                <br>
                <p>Mick Haupt, 27th Feburary 2023</p>
            </div>
            <br>
            <div class="trendingarticletext">
                <h2>I’ve a secret vegetable hack that saves time and money</h2>
                <img class="articleimg2" src="https://www.thesun.ie/wp-content/uploads/sites/3/2023/02/NINTCHDBPICT000793762097.jpg?w=1280&quality=44" alt="articleimg2">
                <div class="trendingarticletext">
                    <p>FOOD waste is one of the biggest obstacles to tackling climate change – with more than 700,000 tonnes of food thrown away per year in Ireland.</p>
                    <a href="https://www.thesun.ie/fabulous/10271783/food-expert-vegetables-tips-food-safety-waste/" target="_blank"><button>View Full Article</button></a>
                    <p>Aoife Bannon, 22nd Feburary 2023</p>
                </div>
            </div>
        </div>
</body>
<footer>
    <h4>CONTACT</h4>
    <h4>Little Less Waste &copy; 2023</h4>

</footer>

</html>