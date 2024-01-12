<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include_once "./dbconnect.php";
    ?>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        if(isset($_GET["badLoginInfo"])){
            echo "<h4 style='background-color: orange; width: 100%; text-align: center;'>Wrong user name OR password</h4>";        
        }
    ?>
    <h3>
        <form action="checkLogin.php" method="post">
            user Name <input type="text" name="userName">
            &nbsp;&nbsp;&nbsp;
            password <input type="password" name="password">
            &nbsp;&nbsp;&nbsp;
            <input type="submit" value="Login">
        </form>
        <br>
        Or <a href="register.php">Register Here</a>
    </h3>
    
    <hr>

    <?php
        $sql = "SELECT 
        twits.id,
        twits.twitText,
        twits.createdAt,
        users.fullName,
        COUNT(comments.id) AS comment_count
        FROM twits LEFT JOIN comments ON twits.id = comments.twitId 
        LEFT JOIN users ON twits.userId = users.id
        GROUP BY twits.id ORDER BY twits.createdAt DESC LIMIT 10";
        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) == 0){
                echo "<h2>You has no twits yet .....</h2>";
            }
            else {
                while($row = $result -> fetch_row())
                {
                    echo "<div class='oneTwit' onclick='gotoComments(" . $row[0] . ");'>";
                        echo "<h3>" . $row[3] . "</h3>";
                        echo "<h4>" . $row[2] . "</h4>";
                        echo "<p>" . $row[1] . "</p>";
                        echo "<P>You have ".$row[4]." Comments</p>";
                    echo "</div>";
                }
            }
        }

    ?>

    <script>
        function gotoComments(twitId){
            window.location.href = "twitComments.php?id=" + twitId;
        }
    </script>
</body>
</html>