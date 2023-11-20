<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include("config.php");
 
if(isset($_REQUEST["term"])){
    
    // Prepare a select statement
    $sql = "SELECT * FROM user_table WHERE username LIKE ?";
    
    if($stmt = mysqli_prepare($connect, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $id=$row["id"];
                    echo "<p>"."<a href='useraccount.php?id=$id'>" . $row["username"] ."</a>". "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
if(isset($_REQUEST["terms"])){
    
    // Prepare a select statement
    $sql = "SELECT * FROM user_table WHERE user_email LIKE ?";
    
    if($stmt = mysqli_prepare($connect, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["terms"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $id=$row["id"];
                    echo "<p>"."<a href='useraccount.php?id=$id'>" . $row["user_email"] ."</a>". "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($connect);
?>