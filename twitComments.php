<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include_once "./dbconnect.php";
        
        if(!isset($_GET["id"])){
            header("Location: index.php");
            exit();
        }
        $id = $_GET["id"];
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
.oneTwit {
    width: 77%;
    background-color: gray;
    margin: 22px auto;
    padding: 0 5px;
    cursor: pointer;
    border: thin red solid; 
}

.oneTwit:hover {
    background-color: lightgreen;
}
.twitComments{
        width: 33%;
        background-color: gray;
        margin: 22px auto;
        padding: 0 5px;
        cursor: pointer;
        border: thin green solid;
    }
    </style>
    <h1>Twit and its comments</h1>

    <?php
        $sql = "SELECT * FROM twits, users WHERE `twits`.`userId`=`users`.`id` AND `twits`.`id`=$id LIMIT 1;";

        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) == 0){
                header("Location: index.php");
                exit();
            }
            else {
                while($row = $result -> fetch_row())
                {
                    echo "<div class='oneTwit'>";
                        echo "<h3>" . $row[5] . "</h3>";
                        echo "<h4>" . $row[3] . "</h4>";
                        echo "<p>" . $row[1] . "</p>";
                    echo "</div>";
                }
            }
        }
    ?>
    
    <hr>

    <?php
        $sql = "SELECT * FROM comments, users WHERE `comments`.`twitId`=$id AND `comments`.`userId`=`users`.`id` ORDER BY `comments`.`createdAt` DESC;";

        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) == 0){
                exit();
            }
            else {
                while($row = $result -> fetch_row())
                {
                    echo "<div class='twitComments'>";
                        echo "<h3>" . $row[7] . "</h3>";
                        echo "<h4>" . $row[1] . "</h4>";
                        echo "<p>" . $row[4] . "</p>";
                    echo "</div>";
                }
            }
        }
    ?>
</body>
</html>