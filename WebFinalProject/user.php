<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="signUp.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION["sid"] == session_id()) {
        echo (" <div class='content_userName'>
        <h1>Welcome 
        ");
        echo ($_SESSION['name'] . "</h1></div>");
    } else {
        header("location: sign-in.php");
    }
    ?>

    <ul>
        <li><a href="Contact.htm">Contact</a></li>
        <li><a href="Logout.php">Log out</a></li>
    </ul>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="reserve" class="funbtn" value="Reserve">
    </form>
    <?php
    require "dbcon.php";
    $query = "select * from reservation";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    if (mysqli_num_rows($res) == 0) {
        echo ("<div class='funbtn' style ='cursor : default; top : 45%; width: 200px; text-align : center ; height: 150px;'><p style = 'margin: 20px'> Queue <br> </p> " .  "<p style='font-size:60pt; margin : -30px'>"."    " . "</p> </div>");
    } else {
        echo ("<div class='funbtn' style ='cursor : default; top : 45%; width: 200px; text-align : center ; height: 150px;'><p style = 'margin: 20px'> Queue <br> </p> " .  "<p style='font-size:60pt; margin : -30px'>".$row["id"] . "</p> </div>");
    }
    
    // $resid;
    // $rowid;
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['post'] = true;
        $name = $_SESSION['name'];
        $query = "select * from reservation where pname = '$name'";
        $res = mysqli_query($con, $query);
        $row_num = mysqli_num_rows($res);
        $rowid = mysqli_fetch_array($res);
        if ($row_num  == 0) {
            $err = "<br>Can not reserve again";
        
            mysqli_query($con, "insert into reservation (pname) values ('$name')");

        $resid = mysqli_query($con, "select id from reservation where pname = '$name'");
        $rowid = mysqli_fetch_array($resid);
        // exit;
        
        }
        $_SESSION['rowid'] = $rowid;
        echo ("<div class='funbtn' style ='cursor : default; top : 45%; width: 200px; text-align : center ; height: 150px; left:54%;'><p style = 'margin: 20px'> Your no. <br> </p> " .  "<p style='font-size:60pt; margin : -30px'>".$rowid["id"] . "</p> </div>");

        // echo ("<div class='id_num'>id: " . $rowid["id"] . "</div>" . $err);

        
    }
    if (isset($_SESSION['rowid']) && (isset($_SESSION['post']) && $_SESSION['post'])) {
        echo ("<div class='funbtn' style ='cursor : default; top : 45%; width: 200px; text-align : center ; height: 150px; left:54%;'><p style = 'margin: 20px'> Your no. <br> </p> " .  "<p style='font-size:60pt; margin : -30px'>".$_SESSION['rowid']["id"] . "</p> </div>");

    }
    header("refresh: 10");


    ?>





</body>

</html>