<?php
// Include config file
require_once 'config.php'; 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            $_SESSION['admin'] = 0;
                            header("location: index.html");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:400,700" rel="stylesheet">
    </head>
    
    
    <div class = "wrapper">
        <body>
            <header>

                    <nav>
                        <ul>
                            <li><a href = "index.html">Home</a></li>
                            <li><a href = "login.php">Login</a></li>
                            <li><a href = "register.php">Register</a></li>
                        </ul>
                    </nav>
                
                    <h1>Big Daddy's E-Mart</h1>
                
                    <nav id = "right">
                        <ul>
                            <li><a href = "acc.html">My Account</a></li>
                        </ul>
                    </nav>
            </header>
            
            <main id = "loginMain">
                <div id = "loginDiv">
                    <h1>Login Here!</h1>
                    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='post'>
                        <p>
                            <input type='text' name='username' value='<?php echo $username; ?>'>
                            Username
                        </p>
                        <p><?php echo $username_err; ?></span>
                        <p>
                            <input type='password' name='password'>
                            Password
                        </p>
                        <p><?php echo $password_err; ?></p>
                        <p><input type='submit'></p>
                        <p>Dont have an account? <a href='register.php'>Sign up now</a>.<p>
                    </form>
                </div>
            </main>
            
            
            <footer>
                
                <div id = "foot">
                        <ul>
                            <li>John Novak</li>
                            <li>Adam Hahn</li>
                            <li>Davis Owen</li>
                            <li>Jordan Alexander</li>
                            <li>Nolan Daniels</li>
                            <li>Roy Lin</li>
                            <li>Sheryar Ali</li>
                        </ul>
                </div>
                
            </footer>
         
        </body>
    </div>
</html>
