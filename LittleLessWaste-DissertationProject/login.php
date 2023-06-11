<?php
include('User.php');

// creating a new instance of the database
$database = new Database();

// calling the getConnection() method on that instance which will return a db connection and store it in $conn variable 
$conn = $database->getConnection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet.css">


    <title>Login Page</title>

    <header class="loginheader">

    </header>
</head>

<body class="loginbody">

    <div class="logincontainer">

        <form class="loginform" action="usersession.php" method="POST">
            <div class="login-form-contents">
                <br>
                <h2>Login</h2>
                <label for="username" class="username">Username:</label>
                <input name="usernamefield" type="text" required>
                <br>
                <label for="exampleInputPassword1" class="password">Password:&nbsp;</label>
                <input name="passwordfield" type="password" required>
                <br>

                <button type="submit" class="button">Login</button>

                <a href="createaccount.php"><button type="button" class="button">Create An Account</button></a>
                <a href="nonuserhome.php"><button type="button" class="button">Continue As Guest</button></a>
            </div>
        </form>
    </div>

</body>

</html>