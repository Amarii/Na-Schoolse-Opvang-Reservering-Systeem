<?php
// Include connect file
require_once 'connect.php';
if ( isset( $_SESSION['username'] ) ) {header("location: index.php"); }
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_error = $password_error = $confirm_password_error = "";

// if form is submitted execute following code
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username, if username is empty give error "Please enter a username."
    if (empty(trim($_POST["username"]))) {
        $username_error = "Please enter a username.";
    } else {
        // Prepare a select SQL statement of the id of the username submitted by the user
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $database->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared SQL statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();
// if the id of the username submitted by the user exists give error "This username is already taken." else set username with a trim function to avoid SQL injections.
                if ($stmt->num_rows == 1) {
                    $username_error = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close the statement
        $stmt->close();
    }

    // Validate password, check if password is empty if its empty give error "Please enter a password."
    // else if length of password is < 6 give error "Password must have atleast 6 characters." else set password with a trim function to avoid SQL injections.
    if (empty(trim($_POST['password']))) {
        $password_error = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_error = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password, check if confirm password is empty if its empty give error "Please confirm password."
    // else set password with a trim function to avoid SQL injections. if $password is not equal to $confirm_password give error 'Password did not match.'
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_error = 'Please confirm password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_error = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database only executes the following code if all fields are filled in.
    if (empty($username_error) && empty($password_error) && empty($confirm_password_error)) {

        // Prepare an insert SQL statement for username and password
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = $database->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to detail page and puts username in a session.
                session_start();
              //  $_SESSION['formData'] = $_POST;
                $_SESSION['username'] = $username;
                header("location: main.php");
            } else {
                echo "Something went wrong. Please try again later.";
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
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--   <script src="libraries/pickadate.js-3.5.6/lib/ui-pickadate.js"></script>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div class="container">
    <h2 style="text-align: center">Register</h2>
    <div class="row">
        <form class="col 12 m6 offset-m3" action="" method="post">
            <div class="row">
                <form class="col 12 m6 offset-m3" action="" method="post">
                    <div class="row">

                        <div class="input-field col s6 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="username" id="username" type="text" value="<?= (isset($username) ? $username : ''); ?>"
                                   class="validate">
                            <span class="help-block"><?php echo $username_error; ?></span>
                            <label for="username">Gebruikers Naam</label>
                        </div>
                        <div id="row">
                        <div class="input-field col s6 m6">
                            <i class="material-icons prefix">lock</i>
                            <input name="password" id="password" type="password"
                                   value="<?= (isset($password) ? $password : ''); ?>" class="validate">
                            <span class="help-block"><?php echo $password_error; ?></span>
                            <label for="password">Wachtwoord</label>
                        </div>
                        <div class="input-field col s6 m6">
                            <i class="material-icons prefix">lock</i>
                            <input name="confirm_password" id="confirm_password" type="password"
                                   value="<?= (isset($confirm_password) ? $confirm_password : ''); ?>" class="validate">
                            <span class="help-block"><?php echo $confirm_password_error; ?></span>
                            <label for="confirm_password">Herhaal Wachtwoord</label>
                        </div>
                        </div>
                    </div>
                    <div class="col s6 m6">

                        <button class="btn waves-light waves-effect green" type="submit" name="submit">Registreer
                            <i class="material-icons right">send</i></button>
                    </div>
                    <div class="col s6 m6">
                        <a class="btn waves-effect waves-light green" href="index.php" >Annuleer
                            <i class="material-icons left">keyboard_return</i>
                        </a>
                    </div>

                </form>

</body>
</html>