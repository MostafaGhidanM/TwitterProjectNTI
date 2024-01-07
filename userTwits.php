<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include_once "./dbconnect.php";
        session_start();
        $userId = $_SESSION["id"];
        $fullName = $_SESSION["fullName"];
        $newTwitAdded = "";

        if(isset($_POST["twitText"])){
            if(strlen($_POST["twitText"]) > 0) {
                
                $twitText = $_POST["twitText"];     

                $sql = "INSERT INTO twits (`id`, `twitText`, `userId`, `createdAt`) VALUES (null, '$twitText', $userId, NOW());";

                if($mysqli -> query($sql) === TRUE){
                    $newTwitAdded = "done";
                }
                else {
                    $newTwitAdded = "error";
                }
            }
        }

    ?>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>
        user Twits
        <?php            
            echo $_SESSION["fullName"];
        ?>
    </h1>
    <h3>
        <a href="logout.php">Logout</a>
    </h3>
    
    <hr>

    <?php
        if($newTwitAdded == "done") {
            echo "<h3 style='color: green;'>the Twit has been Added</h3>";
        }
        if($newTwitAdded == "error") {
            echo "<h3 style='color: green;'>Error in Twit Adding</h3>";
        }
    ?>

    <form action="" method="post">
        <textarea name="twitText" id="" cols="70" rows="3" placeholder="write your new twit here ......."></textarea>
        <input type="submit" value="Send the Twit">
    </form>

    <hr>

    <!-- old twits -->
    <?php
        $sql = "SELECT * FROM twits WHERE `userId`=$userId  ORDER BY `createdAt` DESC;";
        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) == 0){
                echo "<h2>You has no twits yet .....</h2>";
            }
            else {
                while($row = $result -> fetch_row())
                {
                    echo "<div class='oneTwit'>";
                        echo "<h3>$fullName</h3>";
                        echo "<h4>" . $row[3] . "</h4>";
                        echo "<p>" . $row[1] . "</p>";
                    echo "</div>";
                }
            }
        }

    ?>

    
</body>
</html>