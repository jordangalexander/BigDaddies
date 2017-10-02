<!DOCTYPE html>
<html>
    <head>
        <title>Buy - BDEM</title>
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

            <main>

            <?php

                    // open this directory 
                    $myDirectory = opendir("uploads");

                    // get each entry
                    while($entryName = readdir($myDirectory)) {
                        $dirArray[] = $entryName;
                    }

                    // close directory
                    closedir($myDirectory);

                    //	count elements in array
                    $indexCount	= count($dirArray);

                    ?>
                    
                        <?php
                        // loop through the array of files and print them all in a list
                        for($index=0; $index < $indexCount; $index++) {
                            if($dirArray[$index] != '.' and $dirArray[$index] != '..'){
                                echo '<p><img src="uploads/' . $dirArray[$index] . '" alt="Image" /></p>';
                            }	
                        }
                        ?>

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
