<?php
    include_once("dbconnect.php");
    
    /* --------------------------------------------- */
    if(isset($_POST["userName"]) && isset($_POST["password"])) {
        $userName = $_POST["userName"];
        $password = encryption($_POST["password"]);

        $sql = "SELECT * FROM users WHERE userName='$userName' AND password='$password' LIMIT 1;";

        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) == 1){
                // login true
                while($row = $result -> fetch_row()){
                    $id = $row[0];
                    $fullName = $row[1];
                }
                //
                session_start();
                $_SESSION["id"] = $id;
                $_SESSION["fullName"] = $fullName;
                //
                header("Location: userTwits.php");
            }
            else {
                // login false
                header("Location: index.php?badLoginInfo");
            }
        }
        else {
            // error
        }
    }
    else {
        // back to login page
    }




?>