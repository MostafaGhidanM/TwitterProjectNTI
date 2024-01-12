<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include_once "./dbconnect.php";

        $fields = ["fullName", "userName", "password", "passwordAgain"];
        $flagForRequiredFileds = true;
        for($oneFiled = 0; $oneFiled < count($fields); $oneFiled++){
            if(!testFileds($fields[$oneFiled])){
                $flagForRequiredFileds = false;
                break;
            }
        }
        if($flagForRequiredFileds == false) {
            header("Location: register.php?registerFailed");
            exit();
        }
        if($_POST["password"] != $_POST["passwordAgain"]){
            header("Location: register.php?registerFailed");
            exit();
        }
        function testFileds($fieldName) {
            if(isset($_POST[$fieldName])){
                if(strlen($_POST[$fieldName]) > 0 ){
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }

        $fullName = $_POST["fullName"];
        $userName = $_POST["userName"];
        $password = encryption($_POST["password"]);        

        $sql = "SELECT * FROM users WHERE `fullName`='$fullName' OR `userName`='$userName'";
        if($result = $mysqli -> query($sql)){
            if(mysqli_num_rows($result) > 0){
                header("Location: register.php?sameUserName");
                exit();
            }
            else {
                $sql = "INSERT INTO users (`id`, `fullName`, `userName`, `password`) VALUES (null, '$fullName', '$userName', '$password');";

                if($mysqli -> query($sql) === TRUE){
                    // user registered
                    header("Location: userTwits.php");
                    // user twits
                }
                else {
                    // db failed
                    header("Location: register.php?dbfailed");
                    exit();
                }
            }
        }
    ?>
</head>
<body>
    
</body>
</html>