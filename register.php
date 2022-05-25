<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        Register
    </title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="signUp.css">
    <script>
        function chkPasswords() {

            var user = document.getElementById('un');
            var init = document.getElementById('initial');
            var second = document.getElementById('sec');
            var error = document.getElementById('er');
            var error2 = document.getElementById('er2');
            var uerror = document.getElementById('uer');
            error.innerHTML = " ";
            error2.innerHTML = " ";
            uerror.innerHTML = " ";

            if (user.value == "") {
                user.focus();
                uerror.innerHTML = "Required Field*";
                return false;
            }





            if (sec.value != init.value) {
                error2.innerHTML = "password Does Not Match*"
                sec.select();
                return false;
            } else
                return true;
        }

        function passValidation() {
            var init = document.getElementById('initial');
            var second = document.getElementById('sec');
            var error = document.getElementById('er');

            var error2 = document.getElementById('er2');
            error.innerHTML = " ";
            error2.innerHTML = " ";
            var pos = init.value.search(
                /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/);

            if (init.value == "") {
                error.innerHTML = "Required Field*"
                init.focus();
                return false;
            }

            if (pos != 0) {
                error.innerHTML = "Invalid Paswword*";
                init.select();
                return false;
            }

            if (sec.value == "") {
                error2.innerHTML = "Required Field*";
                scc.focus();
                return false;
            }


        }
    </script>
</head>

<body>
    <?php
    require "dbcon.php";
    $errorUN = "";
    function clean($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
        $upass = $_POST["password"];
        $uname = clean($uname);


        $query = "select * from user where user_name = '$uname'";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows >= 1) {
            $errorUN = "Enter another user name";
        } else {
            mysqli_query($con, "insert into user (user_name, password) values ('$uname', '$upass')");
        }
    }
    mysqli_close($con);
    ?>
    <ul>
        <li><a href="index.html">HOME</a></li>
    </ul>

    <h1 id="heading">Clinic</h1>

    <div class="regbox">
        <h1>Sign Up Now!</h1>
        <form id="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p>User Name </p><input type="text" class="input-box" name="uname" size="35" placeholder="User Name" id="un">
            <div class="errors" id="uer"><?php echo $errorUN; ?></div>
            <p>Password </p>
            <acronym title="
*More than 8 characters
*Upper and Lower cases
*Digits">
                <input type="password" class="input-box" name="password" size="35" placeholder="Password" id="initial"></acronym>
            <div class="errors" id="er"></div>
            <p>Confirm password </p><input type="password" class="input-box" name="cpassword" size="35" placeholder="Password" id="sec">
            <div class="errors" id="er2"></div>
            <input type="submit" class="signup-btn" value="Sign Up">
            <input type="checkbox" name="checkbox" required> I agree to the <a href="#">terms</a> of the services <br>

            <p>Do you have an account ? <a href="http://localhost/WebFinalProject/sign-in.php">Sign in</a></p>
        </form>

        <script>
            document.getElementById("initial").onblur = passValidation;
            document.getElementById('un').onblur = chkPasswords;
            document.getElementById("sec").onblur = chkPasswords;
            document.getElementById("myform").onsubmit = chkPasswords;
        </script>

    </div>



</body>

</html>