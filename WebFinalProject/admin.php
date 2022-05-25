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
    <ul>
        <li><a href="Contact.htm">Contact</a></li>
        <li><a href="Logout.php">Log out</a></li>
    </ul>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="submit" name="Truncate" class="funbtn" value="Truncate">

        <input type="submit" name="Delete" class="funbtn" value="Delete" style="margin-top: 5%;">
    </form>
    <h2><b>Reserved Patients</b></h2>
    <table border=2 class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        <?php
        require "dbcon.php";
        $query = "select * from reservation ORDER BY ID";
        $res = mysqli_query($con, $query);
        $rows_num = mysqli_num_rows($res);
        for ($row_num = 1; $row_num <= $rows_num; $row_num++) {
            $row = mysqli_fetch_array($res);

            echo ("
                        <tr>
                        <td>"
                . $row["id"] . "</td> <td>" . $row["pname"] . "</td>"

            );
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            if (isset($_POST['Truncate'])) {
                $query = "TRUNCATE TABLE reservation";
                $res = mysqli_query($con, $query);
                header('location:admin.php');
                exit;
            }


            if (isset($_POST['Delete'])) {
                $query_select = "select * from reservation ORDER BY ID";
                $res_select = mysqli_query($con, $query_select);
                $row = mysqli_fetch_array($res_select);
                $id = $row["id"];

                $query_del = "DELETE FROM reservation WHERE id = $id";
                $res = mysqli_query($con, $query_del);
                header('location:admin.php');
                exit;
            }
        }
        header("refresh: 5")
        ?>

</table>

</body>

</html>