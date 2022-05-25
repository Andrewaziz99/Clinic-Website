<?php
    require "dbcon.php";
    echo("<script> var err = document.getElementById('uer')
            err.innerHTML = ''</script>");
    function clean($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST['uname'];
        $upass = $_POST['password'];
        $uname = clean($uname);


        $query = "select * from user where user_name = '$uname'";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows >= 1) {
            $errorUN = "Enter another user name";
        } else {
            mysqli_query($con, "insert into user (user_name, password) values ('$uname', '$upass')");
        }
        
        require "register.php";
        echo("<script> var err = document.getElementById('uer')
         err.innerHTML = 'Enter another user name'</script>");
        // $errorUN = "Enter another user name";
        // echo $errorUN;
        
    // }
    ?>