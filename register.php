<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $error = "";
        if(isset($_GET["registerFailed"])) {
            $error = "Some Fields needed !!!";
        }
        if(isset($_GET["sameUserName"])) {
            $error = "Same user name Or full name registered !!!";
        }
        if(isset($_GET["dbfailed"])) {
            $error = "System failed !!!";
        }
    ?>
    <h2>Register As A new user</h2>

    <?php
        if(strlen($error) > 0){
            echo "<h2 style='background-color: orange; width: 100%; text-align: center;'>$error</h2>";
        }
    ?>

    <form action="registerComplete.php" method="post">
        full name <input type="text" name="fullName">
        <br>
        user name <input type="text" name="userName">
        <br>
        password <input type="password" name="password">
        <br>
        password again <input type="password" name="passwordAgain">
        <br>
        <input type="submit" value="register">
    </form>
</body>
</html>