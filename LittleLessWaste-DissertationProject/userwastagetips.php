<?php
//This page is also known as the user's wastage summary

include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php)
$user = new User();

// calling the checkUserSession() method of the User class and storing result in $usersession variable 
$usersession = $user->checkUserSession();


$username = $_SESSION['llwuser'];

$read = "SELECT llw_food_category.category_name, COUNT(llw_food_wasted.food_category_id) AS frequency 
FROM llw_food_wasted 
INNER JOIN llw_user
ON llw_food_wasted.user_id = llw_user.user_id
INNER JOIN llw_food_category
ON llw_food_wasted.food_category_id = llw_food_category.food_category_id
WHERE user = '$username'
GROUP BY llw_food_wasted.food_category_id";

$result = $conn->query($read);

if (!$result) {
    echo $conn->error;
}

$foodwastedarray = array();

while ($row = mysqli_fetch_array($result)) {

    $foodwastedarray[] = array("category_name" => $row['category_name'], "frequency" => $row['frequency']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">

    <title>User Wastage Tips Page</title>


    <header class="userheader">
        <img class="logo" src="./images/LogoNoBG.svg" alt="logo">

        
        <a href="logout.php"> 
        <div class=divpersonicon>
      <img class="personicon"  src="./images/Person Icon.svg" alt="personicon">
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        // code was initially obtained from Google Charts Documentation, and built upon to meet the needs specific to this web-application
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'category_name'],
                <?php
                foreach($foodwastedarray as $foodwasted) {
                    echo "['".$foodwasted['category_name']."', ".$foodwasted['frequency']."],";
                }
                ?>
            ]);

            var options = {
            
                title: 'Food Wastage Chart',
               
                slices: {
                0: {color: '#025043'},
                1: {color: '#037c6e'},
                2: {color: '#05998c'},
                3: {color: '#4fb9af'},
                4: {color: '#b3e0dc'},
        },
        pieSliceText: 'percentage',
        width: "550",
        is3D: true,
        backgroundColor: 'whitesmoke',
        borderRadius: 20,


        chartArea:{left:20,top:60,width:'750%',height:'75%'}    

        
        
    
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
<div class="userwastagesummary">

        <div class="userwastagesummary-item1">
        <h2>MY WASTAGE SUMMARY</h2>
    <div id="piechart" style="width: 550px; height: 400px; padding: 10px;"></div>
    </div>

    <div class="userwastagesummary-item2">
        <h2>ANALYSIS</h2>
        <p>This is your wastage summary! Here you can see the food categories in which you have wasted th most</p>

        <p>By providing this insight we aim to make our users more aware of the food categories they are 
            purchase with the hope that it will help them make more informative purchases in the future.
        </p>

        <p>Tip: You can hover over each section of the pie chart to be certain of the specific food category and how many items have been wasted from it.
        </p>

        <p>We hope this helps you!</p>
        </div>
  
</body>
<footer>
  <h4>CONTACT</h4> 
  <h4>Little Less Waste &copy; 2023</h4>
</footer>
</html>