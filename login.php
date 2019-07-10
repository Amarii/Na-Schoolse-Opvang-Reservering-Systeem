<?php
// Include config file
require_once 'connect.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_error = $password_error = "";

// if form is submitted execute following code
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty and gives error if its empty, else set $username with the value from the username filled in the form
    if (empty(trim($_POST["username"]))) {
        $username_error = 'Please enter username.';
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty and gives error if its empty, else set $password with the value from the password filled in the form
    if (empty(trim($_POST['password']))) {
        $password_error = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    // following code executes only if there are no username and password errors
    if (empty($username_error) && empty($password_error)) {
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if ($stmt = $database->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared SQL statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            /* Password is correct, so start a new session and
                            save the username to the session and redirect to main page*/
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: main.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_error = 'The password you entered was not valid.';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_error = 'No account found with that username.';
                }
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close database connection
    $database->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<div class="row">
    <img class="z-depth-3 responsive-img" src="img/blieken01.jpg"
</div>
<div class="container">
    <h2 style="text-align: center">Login</h2>
    <div class="row">
        <form class="col 12 m6 offset-m3" action="" method="post">
            <div class="row">

                <div class="input-field col s7 m6">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="username" id="username" type="text" value="<?= (isset($username) ? $username : ''); ?>"
                           class="validate">
                    <span class="help-block"><?php echo $username_error; ?></span>
                    <label for="username">Gebruikers Naam</label>
                </div>
                <div class="input-field col s7 m6">
                    <i class="material-icons prefix">lock</i>
                    <input name="password" id="password" type="password"
                           value="<?= (isset($password) ? $password : ''); ?>" class="validate">
                    <span class="help-block"><?php echo $password_error; ?></span>
                    <label for="password">Wachtwoord</label>
                </div>

            </div>
            <div class="col s6 m6">

                <button class="btn waves-light waves-effect green" type="submit" name="loginsubmit">Login
                <i class="material-icons right">send</i></button>
            </div>
            <div class="col s6 m6">
                <a class="btn waves-effect waves-light green" href="index.php" >Annuleer
                    <i class="material-icons left">keyboard_return</i>
            </a>
            </div>

        </form>
    </div>
</body>
</html>