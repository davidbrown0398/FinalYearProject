<?php
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

// creating a new instance of the User class (from User.php)
$user = new User();

// calling the createUser() method of the User class and storing result in the $newuser variable 
$newuser = $user->createUser();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">


    <title>Create Account Page</title>

    <header class="loginheader">

    </header>
</head>

<body class="loginbody">

    <div class="logincontainer">

        <form class="loginform" action="createaccount.php" method="POST">
            <div class="create-form-contents">
                <br>
                <h2>Create Account</h2>
                <label for="user" class="user">Username:</label>
                <input name="user" type="text" required>
                <br>
                <label for="email_address" class="email_address">Email Address:</label>
                <input name="email_address" type="email" required>
                <br>
                <label for="exampleInputPassword1" class="pword">Password:</label>
                <input name="pword" type="password" required>
                <br>

                <button id="createButton" type="submit" name="insert" class="insert">Create</button>

                <a href="login.php"><button type="button" class="button">Return To Login</button></a>
                <a href="nonuserhome.php"><button type="button" class="button">Continue As Guest</button></a>
            </div>
        </form>
    </div>
    <script>
        /* JavaScript obtained and used with assistance from StackOverflow & ChatGPT. Will check if new url query 
        parameters are set to 'success', if so the alert message will appear.
        The 'success' query parameter status is set in the createUser function.
        */
        if (new URLSearchParams(window.location.search).get("status") === "success") {
            alert("Account Created Successfully! You May Now Proceed To The Login Page");
        }
    </script>

</body>

</html>