<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$first = $last = $email = $email_confirm = $username = $password = $confirm_password = $birthday = "";
$email_err = $email_confirm_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $username = trim($_POST['username']);
    }
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter a password.';
    }else{
        $password = trim($_POST['password']);
    }
    if(empty(trim($_POST["password-confirm"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['password-confirm']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    if(empty(trim($_POST['email']))){
        $email_err = 'Please enter email';
    }else{
        $email = trim($_POST['email']);
    }
    if(empty(trim($_POST['email-confirm']))){
        $email_confirm_err = 'Please confirm email';
    }else{
        $email_confirm = trim($_POST['email-confirm']);
        if($email != $email_confirm){
            $email_confirm_err = 'email did not match';
        }
    }

    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameter

        $param_username = $username;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);

    $sql = "SELECT id FROM users WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        // Set parameter
        $param_email = $email;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "This email is already taken.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($email_confirm_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, username, password, first_name, last_name, birthday ) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_email, $param_username, $param_password, $param_first, $param_last, $param_birthday);
            
            // Set parameters
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
           // if(empty($_POST['first'])){
           //     $param_first = 'Null';
           // }else{
                $param_first = $_POST['first'];
           // }
           // if(empty($_POST['last'])){
           //     $param_last = 'Null';
           // }else{
                $param_last = $_POST['last'];
           // }if(empty($_POST['birthday'])){
           //     $param_birthday = 'Null';
           // }else{
                $param_birthday = $_POST['birthday'];
           // }
          

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
        <title>Register - BDEM</title>
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
            
            <main id = "regMain">
                <div class = "regDiv">
                    <table>
                        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='post'>
                            <tr id = "regHead">
                                <caption colspan = "2"><h3>Register Your Account!</h3></caption>
                            </tr>
                            <tr>
                                <th>First Name:</th>
                                <td><input type="text" name='first'></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td><input type="text" name='last'></td>
                            </tr>
                            <tr>
                                <th>E-Mail:<sup>*</sup></th>
                                <td><input type="email" name='email'></td>
                                <td><?php echo $email_err; ?></td>
                            </tr>
                            <tr>
                                <th>Re-enter E-Mail:<sup>*</sup></th>
                                <td><input type="email" name='email-confirm'></td>
                                <td><?php echo $email_confirm_err; ?></td>
                            </tr>
                            <tr>
                                <th>Username:<sup>*</sup></th>
                                <td><input type="text" name='username'></td>
                                <td><?php echo $username_err; ?></td>
                            </tr>
                            <tr>
                                <th>Password:<sup>*</sup></th>
                                <td><input type="password" name='password'></td>
                                <td><?php echo $password_err; ?></td>
                            </tr>
                            <tr>
                                <th>Verify Password:<sup>*</sup></th>
                                <td><input type="password" name='password-confirm'></td>
                                <td><?php echo $confirm_password_err; ?></td>
                            </tr>
                            <tr>
                                <th>Birthday:</th>
                                <td><input type="date" name='birthday'></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="submit"><input type="submit" value="Register"></td>
                            </tr>
                        </form>
                    </table>
                <p>Already have an account? <a href='login.php'>Login here</a>.</p>
                <p><sup>*</sup> denotes required fields</p>
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
