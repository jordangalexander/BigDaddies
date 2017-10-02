<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sell - BDEM</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:400,700" rel="stylesheet">
    </head>
    
    <div class = "wrapper">
        <body>
            <header>
                    <nav>
                        <ul>
                            <li><a href = "index.html">Home</a></li>
                            <li><a href = "login.html">Login</a></li>
                            <li><a href = "register.html">Register</a></li>
                        </ul>
                    </nav>
                
                    <h1>Big Daddy's E-Mart</h1>
                
                    <nav id = "right">
                        <ul>
                            <li><a href = "acc.html">My Account</a></li>
                        </ul>
                    </nav>
            </header>
            
            <main>
                <div class = "sellForm">
                    <form action='upload-manager.php' method='post' enctype='multipart/form-data'> 
                    <table>
                        <tr id="browse">
                            <th>Photos:</th>
                            <td><input type="file" name="photo" id='fileSelect'></td>
                        </tr>
                        <tr>
                            <td colspan="2" id="submit"><input type="submit" name='submit' value='Upload'></td>
                        </tr>
                        <tr>
                            <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5MB.</p>
                        </tr>
                    </table>
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
