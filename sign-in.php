<!-- <!DOCTYPE html PUBLIC ″-//w3c//DTD XHTML 1.1//EN″ “http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns=″ http://www.w3.org/1999/xhtml″> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="signUp.css">
    <script src="scripts.js"></script>
</head>

<body>
<?php
    require "dbcon.php";
    $er = "";   

    function clean($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["user"];
        $upass = $_POST["password"];
        $uname = clean($uname);
        if ($uname == "admin" && $upass == "admin") {
            header("location: admin.php");
        }


        $query = "select * from user where user_name = '$uname' and password = '$upass'";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows >= 1) {
            session_start();
            $_SESSION["sid"] = session_id();
            $_SESSION["name"] = $uname;
            header("location:user.php");
        } else {
            // echo("Invalid user name or password");
            $er = "Invalid user name or password";
        }
    }
    mysqli_close($con);
    ?>

    <ul>
        <li><a href="index.html">Home</a></li>
    </ul>
    <h1 id="heading">Clinic</h1>
    <div class="regbox">
        <h1>Sign In</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" class="input-box" name="user" size="35" placeholder="User Name">
            
                <input type="password" class="input-box" name="password" size="35" placeholder="Password">
                <?php echo( "<p class = 'errors'>".$er."</p>");?>
            <input type="submit" class="signup-btn" value="Sign in">
            <p>Create a new account <a href="Index.html">Register</a></p>
        </form>
    </div>

   
</body>

</html>